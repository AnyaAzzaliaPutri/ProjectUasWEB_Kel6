<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - MyCalories</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .bg-animation .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            animation: float 8s ease-in-out infinite;
        }

        .shape:nth-child(1) { top: 10%; left: 5%; width: 80px; height: 80px; }
        .shape:nth-child(2) { top: 20%; right: 10%; width: 120px; height: 120px; animation-delay: 2s; }
        .shape:nth-child(3) { bottom: 10%; left: 15%; width: 100px; height: 100px; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); opacity: 0.5; }
            50% { transform: translateY(-30px) scale(1.1); opacity: 0.7; }
        }

        .register-box {
            background: rgba(255,255,255,0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 400px;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(60px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-box h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #333;
        }

        .register-box .subtitle {
            text-align: center;
            color: #666;
            font-weight: 400;
            font-size: 15px;
            margin-bottom: 20px;
            animation: fadeInUp 1.2s ease;
        }

        .flash-message {
            text-align: center;
            font-size: 14px;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 10px;
        }

        .flash-error {
            background: #fdd;
            color: #b30000;
            border: 1px solid #ff8080;
        }

        .flash-success {
            background: #e0ffe0;
            color: #006600;
            border: 1px solid #66cc66;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: linear-gradient(135deg, #5a66d0, #6b429b);
        }

        p {
            text-align: center;
            margin-top: 15px;
        }

        a {
            color: #667eea;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="bg-animation">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<div class="register-box">
    <h2>Daftar Sekarang</h2>
    <p class="subtitle">Bergabung dan atur kalori anda</p>

    <!-- Flash Message -->
    <?php if(session()->getFlashdata('error')): ?>
        <div class="flash-message flash-error">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="flash-message flash-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Register Form -->
    <form method="post" action="/registerPost">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required value="<?= old('username') ?>">

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <label for="confirm_password">Konfirmasi Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required>

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="/login">Login di sini</a></p>
</div>

</body>
</html>
