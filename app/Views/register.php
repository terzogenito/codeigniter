<?= $this->extend('base'); ?>

<?= $this->section('content'); ?>
<div class="d-flex justify-content-center align-items-center">
    <div class="card shadow-lg p-4" style="width: 350px; border-radius: 15px;">
        <h2 class="text-center mb-4 text-success">Register</h2>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>
        
        <form action="<?= base_url('register'); ?>" method="post">
            <div class="mb-3">
                <label class="form-label fw-bold">Username</label>
                <input type="text" name="username" class="form-control" required style="border-radius: 10px;">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password" class="form-control" required style="border-radius: 10px;">
            </div>
            <button type="submit" class="btn btn-success w-100" style="border-radius: 10px;">
                Register
            </button>
        </form>
        <div class="text-center mt-3">
            <p class="small">Sudah punya akun? <a href="<?= base_url('login'); ?>" class="text-decoration-none text-success">Login</a></p>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
