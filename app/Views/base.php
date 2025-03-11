<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Website' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .top-bar {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            padding: 15px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .top-bar h2 {
            margin: 0;
            font-size: 1.5rem;
        }
        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            color: white;
            transition: 0.3s;
        }
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.4);
        }
    </style>
</head>
<body>

<div class="top-bar d-flex justify-content-between align-items-center">
    <h2><?= $title ?? 'Demo' ?></h2>
    <?php if (session()->has('username')): ?>
        <a href="<?= base_url('logout') ?>" class="btn logout-btn">Logout</a>
    <?php endif; ?>
</div>

<div class="container pt-5 pb-5">
    <?= $this->renderSection('content') ?>
</div>

<footer class="footer text-center py-3">
	<hr><p class="mb-0">&copy; <?= date('Y') ?> Demo. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
