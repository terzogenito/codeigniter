<?php

if (!session()->get('logged_in')) {
    return redirect()->to('/login')->send();
    exit();
}

$username = session()->get('username') ?? get_cookie('username');

?>

<?= $this->extend('base') ?>

<?= $this->section('content') ?>
    <div class="dashboard">
        <h3>Selamat datang, <?= esc($username) ?>!</h3>
        <p>Ini adalah dashboard utama Anda.</p>
    </div>
<?= $this->endSection() ?>
