<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class Auth extends Controller {
    private $userFile = WRITEPATH . 'users.json';

    public function index() {
        $session = session();
        if ($session->has('username')) {
            return view('dashboard');
        }
        return view('login');
    }

    public function login() {
        helper(['form', 'url', 'cookie']);
        session();

        if ($this->request->getMethod() === 'POST') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            // Ambil data dari JSON
            $users = json_decode(file_get_contents($this->userFile), true);

            // Cek apakah username ada di JSON
            foreach ($users as $user) {
                if ($user['username'] === $username && password_verify($password, $user['password'])) {
                    // Set session
                    session()->set([
                        'username' => $username,
                        'logged_in' => true
                    ]);

                    // Set cookie (opsional)
                    set_cookie('username', $username, 86400 * 30);

                    // Redirect ke dashboard
                    return redirect()->to('/dashboard');
                }
            }

            // Jika gagal login
            return redirect()->to('/login')->with('error', 'Username atau password salah.');
        }

        return view('login');
    }

    public function register() {
        if ($this->request->getMethod() === 'POST') {
            $users = $this->readUsers();
            $username = trim($this->request->getPost('username'));
            $password = trim($this->request->getPost('password'));

            if (empty($username) || empty($password)) {
                return redirect()->to('/register')->with('error', 'Username dan password tidak boleh kosong.');
            }

            foreach ($users as $user) {
                if ($user['username'] === $username) {
                    return redirect()->to('/register')->with('error', 'Username sudah terdaftar.');
                }
            }

            $users[] = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];

            if (file_put_contents($this->userFile, json_encode($users, JSON_PRETTY_PRINT))) {
                return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login.');
            } else {
                return view('register', ['error' => 'Gagal menyimpan akun. Coba lagi.']);
            }
        }

        return view('register');
    }

    public function dashboard() {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        return view('dashboard', ['username' => session()->get('username')]);
    }

    public function logout() {
        helper('cookie'); // Tambahkan ini untuk memastikan delete_cookie() tersedia

        session()->destroy();
        delete_cookie('username');

        return redirect()->to('/login');
    }

    private function readUsers() {
        if (!file_exists($this->userFile)) {
            file_put_contents($this->userFile, json_encode([]));
        }
        $data = file_get_contents($this->userFile);
        return json_decode($data, true) ?: [];
    }
}
