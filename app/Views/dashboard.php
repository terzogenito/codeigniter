<?php
// Pastikan session aktif
if (!session()->get('logged_in')) {
    return redirect()->to('/login')->send(); // Gunakan ->send() agar redirect langsung dieksekusi
    exit();
}

// Ambil username dari session atau cookie
$username = session()->get('username') ?? get_cookie('username');
?>

<?= $this->extend('base') ?>

<?= $this->section('content') ?>
    <div class="dashboard">
        <h3>Selamat datang, <?= esc($username) ?>!</h3>
        <p>Ini adalah dashboard utama Anda.</p>
    </div>
<?= $this->endSection() ?>
