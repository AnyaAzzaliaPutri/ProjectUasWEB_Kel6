<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>MyCalories - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link href="<?= base_url('assets/css/mycalories-style.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .navbar .profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .navbar .profile i {
            font-size: 1.2rem;
        }
        .navbar .profile a.logout-btn {
            font-size: 0.9rem;
            padding: 4px 10px;
        }
        .nav-link {
            color: #fff !important;
            font-weight: 500;
            font-size: 1.1rem;
        }
        .nav-link:hover {
            text-decoration: underline;
        }
        .navbar-brand {
            font-size: 1.6rem;
            font-weight: bold;
        }
        .navbar .dropdown-toggle {
            font-size: 1.1rem;
            font-weight: 500;
        }
        .navbar .dropdown-menu a {
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/') ?>">
            <i class="fas fa-utensils me-2"></i>MyCalories
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-3">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/dashboard') ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/dashboard#dashboard') ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/dashboard#form-makanan') ?>">Makanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/history') ?>">Riwayat</a>
                </li>
            </ul>

            <?php if (session()->has('user_id')): ?>
                <?php
                    $userModel = new \App\Models\UserModel();
                    $user = $userModel->find(session('user_id'));
                ?>
                <div class="dropdown ms-auto">
                    <a href="#" class="btn btn-outline-light dropdown-toggle d-flex align-items-center gap-2" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> <?= esc($user['username']) ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                       <li><a class="dropdown-item" href="<?= base_url('/dashboard/profile') ?>">Profil</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('/kalkulator-kalori') ?>">Kalkulator Kalori</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?= base_url('/logout') ?>">Logout</a></li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Mulai konten utama -->
<main>
    <?= $this->renderSection('content') ?>
</main>
