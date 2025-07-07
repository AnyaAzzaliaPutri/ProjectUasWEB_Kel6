<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - MyCalories</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/login-style.css') ?>" rel="stylesheet">

    <style>
        /* Animasi Judul */
        .login-title {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            font-size: 2.8rem;
            font-weight: bold;
            color: white;
            margin-bottom: 30px;
            animation: fadeSlideDown 1s ease-out;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
        }

        .apple-icon {
            width: 80px;
            height: 80px;
            object-fit: contain;
            animation: popIn 1s ease-out;
        }

        @keyframes fadeSlideDown {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes popIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<!-- Bubble Background -->
<ul class="background-bubbles">
    <?php for ($i = 0; $i < 10; $i++): ?>
        <li></li>
    <?php endfor; ?>
</ul>

<div class="container">
    <!-- Judul Mycalories dengan ikon apel -->
    <div class="login-title">
        <img src="<?= base_url('assets/images/apel.png') ?>" alt="Apple" class="apple-icon" style="max-height: 300px;">
        Mycalories
    </div>

    <div class="login-box">
        <h2>Login</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/login" method="post">
            <div class="input-box">
                <span class="icon"><i class="fas fa-user"></i></span>
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="input-box">
                <span class="icon"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <button type="submit" class="btn">Masuk</button>

            <div class="register-link">
                Belum punya akun? <a href="/register">Daftar di sini</a>
            </div>
        </form>
    </div>
</div>

<script src="<?= base_url('assets/js/login-script.js') ?>"></script>
</body>
</html>
