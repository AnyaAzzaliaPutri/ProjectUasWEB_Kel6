<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyCalories - Revolusi Manajemen Kalori</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #0a0a0a;
            color: #ffffff;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated background */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(circle at 20% 50%, #667eea 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, #764ba2 0%, transparent 50%),
                        radial-gradient(circle at 40% 80%, #4facfe 0%, transparent 50%),
                        radial-gradient(circle at 0% 100%, #00f2fe 0%, transparent 50%),
                        radial-gradient(circle at 80% 100%, #a8edea 0%, transparent 50%);
            animation: bgShift 20s ease-in-out infinite;
        }

        @keyframes bgShift {
            0%, 100% { filter: hue-rotate(0deg) brightness(0.3); }
            25% { filter: hue-rotate(45deg) brightness(0.4); }
            50% { filter: hue-rotate(90deg) brightness(0.3); }
            75% { filter: hue-rotate(135deg) brightness(0.4); }
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            position: relative;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .nav-toggle {
            display: none;
            font-size: 24px;
            color: white;
            cursor: pointer;
            padding: 8px;
        }

        .logo {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea, #764ba2, #4facfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo::before {
            content: "⚡";
            font-size: 32px;
            filter: hue-rotate(45deg);
            animation: energyPulse 2s ease-in-out infinite;
        }

        @keyframes energyPulse {
            0%, 100% { transform: scale(1) rotate(0deg); filter: brightness(1); }
            50% { transform: scale(1.2) rotate(180deg); filter: brightness(1.5); }
        }

        .nav-menu {
            display: flex;
            gap: 32px;
            list-style: none;
        }

        .nav-menu a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-menu a:hover {
            color: #667eea;
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        .auth-buttons {
            display: flex;
            gap: 12px;
        }

        .btn-login {
            padding: 10px 20px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }

        .btn-login:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #667eea;
            transform: translateY(-2px);
        }

        .btn-signup {
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }

        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 140px 0 60px;
            position: relative;
        }


        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .hero-text h1 {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #ffffff, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: textGlow 3s ease-in-out infinite;
        }

        


        @keyframes textGlow {
            0%, 100% { filter: brightness(1); }
            50% { filter: brightness(1.2); }
        }

        .hero-text p {
            font-size: clamp(1rem, 2.5vw, 1.2rem);
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            margin-bottom: 48px;
            flex-wrap: wrap;
        }

        .btn-primary {
            padding: 16px 32px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.6);
        }

        .stats {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            min-width: 100px;
        }

        .stat-number {
            font-size: clamp(1.8rem, 4vw, 2.2rem);
            font-weight: 800;
            color: #667eea;
            display: block;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: clamp(0.75rem, 2vw, 0.85rem);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Hero Visual */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .phone-mockup {
            width: 280px;
            height: 560px;
            background: linear-gradient(145deg, #1a1a1a, #2d2d2d);
            border-radius: 32px;
            padding: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            position: relative;
            animation: phoneFloat 4s ease-in-out infinite;
        }

        @keyframes phoneFloat {
            0%, 100% { transform: translateY(0) rotate(-1deg); }
            50% { transform: translateY(-15px) rotate(1deg); }
        }

        .phone-screen {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea, #764ba2, #4facfe);
            border-radius: 24px;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .app-ui {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            flex-direction: column;
            padding: 32px 20px;
        }

        .app-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .app-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: white;
            margin-bottom: 6px;
        }

        .app-subtitle {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
        }

        .feature-cards {
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex: 1;
        }

        .feature-card-mini {
            background: rgba(255, 255, 255, 0.1);
            padding: 12px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            backdrop-filter: blur(10px);
            animation: cardPulse 2s ease-in-out infinite;
        }

        .feature-card-mini:nth-child(2) { animation-delay: 0.5s; }
        .feature-card-mini:nth-child(3) { animation-delay: 1s; }
        .feature-card-mini:nth-child(4) { animation-delay: 1.5s; }

        @keyframes cardPulse {
            0%, 100% { background: rgba(255, 255, 255, 0.1); }
            50% { background: rgba(102, 126, 234, 0.2); }
        }

        .feature-icon-mini {
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .feature-text-mini {
            color: white;
            font-weight: 500;
            font-size: 0.8rem;
        }

        /* Features Section */
        .features {
            padding: 80px 0;
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            margin-bottom: 16px;
            background: linear-gradient(135deg, #ffffff, #667eea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            font-size: clamp(1rem, 2.5vw, 1.1rem);
            color: rgba(255, 255, 255, 0.6);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 32px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 32px;
            backdrop-filter: blur(20px);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2, #4facfe);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 20px 60px rgba(102, 126, 234, 0.2);
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            display: block;
            filter: grayscale(0.3);
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            filter: grayscale(0);
            transform: scale(1.1);
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: white;
            margin-bottom: 12px;
        }

        .feature-description {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        /* CTA Section */
        .cta-section {
            padding: 80px 0;
            text-align: center;
            position: relative;
        }

        .cta-content {
            max-width: 700px;
            margin: 0 auto;
        }

        .cta-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #667eea, #764ba2, #4facfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .cta-text {
            font-size: clamp(1rem, 2.5vw, 1.1rem);
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 32px;
            line-height: 1.6;
        }

        /* Footer */
        .footer {
            background: rgba(0, 0, 0, 0.8);
            padding: 48px 0 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 32px;
            margin-bottom: 32px;
        }

        .footer-section h3 {
            color: #667eea;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .footer-section p, .footer-section a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            line-height: 1.6;
        }

        .footer-section a:hover {
            color: #667eea;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }

            .nav-toggle {
                display: block;
            }

            .nav {
                flex-direction: column;
                align-items: flex-start;
                padding: 12px 0;
                gap: 8px;
            }

            .nav-left {
                width: 100%;
                justify-content: space-between;
                display: flex;
            }

            .auth-buttons {
                margin-top: 10px;
                display: flex;
                flex-wrap: wrap;
                width: 100%;
                justify-content: center;
                gap: 10px;
            }

            .nav-menu {
                display: none;
                width: 100%;
                flex-direction: column;
                gap: 16px;
                padding: 16px 0;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                margin-top: 16px;
            }

            .nav-menu.active {
                display: flex;
            }

            .hero {
                padding: 100px 0 40px; /* Tambah padding top agar tidak tertutup header */
                min-height: auto;
            }

            .hero-content {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }

            .hero-text {
                order: 2;
            }

            .hero-visual {
                order: 1;
            }

            .phone-mockup {
                width: 240px;
                height: 480px;
            }

            .stats {
                justify-content: center;
                gap: 16px;
            }

            .stat-item {
                min-width: 80px;
            }

            .hero-buttons {
                justify-content: center;
            }

            .btn-primary {
                padding: 14px 28px;
                font-size: 0.95rem;
            }

            .features {
                padding: 60px 0;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .feature-card {
                padding: 24px;
            }

            .cta-section {
                padding: 60px 0;
            }

            .footer {
                padding: 40px 0 20px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 24px;
                text-align: center;
            }
        }


        /* Extra small devices */
        @media (max-width: 480px) {
            .container {
                padding: 0 12px;
            }

            .logo {
                font-size: 24px;
            }

            .btn-login, .btn-signup {
                padding: 8px 16px;
                font-size: 13px;
            }

            .phone-mockup {
                width: 200px;
                height: 400px;
            }

            .app-ui {
                padding: 24px 16px;
            }

            .app-title {
                font-size: 1.1rem;
            }

            .feature-text-mini {
                font-size: 0.7rem;
            }

            .feature-card {
                padding: 20px;
            }

            .stats {
                gap: 12px;
            }

            .stat-item {
                min-width: 70px;
            }
        }
        .nav-collapse {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        @media (max-width: 768px) {
            .nav-collapse {
                display: none;
                flex-direction: column;
                width: 100%;
                margin-top: 16px;
                padding: 0 0 12px;
                background: rgba(0, 0, 0, 0.85);
                border-top: 1px solid rgba(255,255,255,0.1);
            }

            .nav-collapse.active {
                display: flex;
            }

            .nav-menu {
                flex-direction: column;
                gap: 16px;
                width: 100%;
                padding: 0;
            }

            .auth-buttons {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
                gap: 12px;
            }
        }


    </style>
</head>
<body>
    <div class="bg-animation"></div>

    <header class="header">
        <nav class="nav container">
            <div class="nav-left">
                <div class="logo">MyCalories</div>
                <div class="nav-toggle" onclick="toggleMenu()">☰</div>
            </div>
            <div class="nav-collapse" id="navCollapse">
                <ul class="nav-menu">
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#features">Fitur</a></li>
                </ul>
                <div class="auth-buttons">
                    <a href="/login" class="btn-login">Masuk</a>
                    <a href="/register" class="btn-signup">Daftar</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero" id="home">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1>Kelola<br>Kalori Anda</h1>
                        <p>Transformasi hidup sehat dimulai dari sini. MyCalories menggunakan teknologi AI untuk memberikan pengalaman tracking kalori yang personal dan mudah.</p>
                        <div class="hero-buttons">
                            <a href="/register" class="btn-primary">Mulai Gratis</a>
                        </div>
                        <div class="stats">
                            <div class="stat-item">
                                <span class="stat-number">50K+</span>
                                <span class="stat-label">Pengguna Aktif</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">99%</span>
                                <span class="stat-label">Akurasi Data</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">4.9</span>
                                <span class="stat-label">Rating App</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero-visual">
                        <div class="phone-mockup">
                            <div class="phone-screen">
                                <div class="app-ui">
                                    <div class="app-header">
                                        <div class="app-title">MyCalories</div>
                                        <div class="app-subtitle">Dashboard Anda</div>
                                    </div>
                                    <div class="feature-cards">
                                        <div class="feature-card-mini">
                                            <span class="feature-icon-mini">📊</span>
                                            <span class="feature-text-mini">Tracking Real-time</span>
                                        </div>
                                        <div class="feature-card-mini">
                                            <span class="feature-icon-mini">🍽️</span>
                                            <span class="feature-text-mini">Daftar Makanan</span>
                                        </div>
                                        <div class="feature-card-mini">
                                            <span class="feature-icon-mini">📈</span>
                                            <span class="feature-text-mini">Progress Monitoring</span>
                                        </div>
                                        <div class="feature-card-mini">
                                            <span class="feature-icon-mini">🎯</span>
                                            <span class="feature-text-mini">Target Personal</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="features" id="features">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Fitur Unggulan</h2>
                    <p class="section-subtitle">Teknologi terdepan untuk mengubah cara Anda mengelola kalori dan mencapai hidup yang lebih sehat</p>
                </div>
                <div class="features-grid">
                    <div class="feature-card">
                        <span class="feature-icon">📱</span>
                        <h3 class="feature-title">Mobile Friendly</h3>
                        <p class="feature-description">Akses MyCalories kapan saja dan di mana saja melalui smartphone Anda. Interface responsif yang optimal untuk semua perangkat.</p>
                    </div>
                    <div class="feature-card">
                        <span class="feature-icon">📈</span>
                        <h3 class="feature-title">Progress Monitoring</h3>
                        <p class="feature-description">Pantau perkembangan berat badan dan pencapaian target kalori dengan grafik yang mudah dipahami dan laporan mingguan.</p>
                    </div>
                    <div class="feature-card">
                        <span class="feature-icon">📊</span>
                        <h3 class="feature-title">Tracking Makanan</h3>
                        <p class="feature-description">Catat dan pantau asupan makanan harian Anda dengan mudah. Database lengkap makanan lokal dan internasional tersedia untuk membantu Anda.</p>
                    </div>
                    <div class="feature-card">
                        <span class="feature-icon">⚡</span>
                        <h3 class="feature-title">Sync Instant</h3>
                        <p class="feature-description">Sinkronisasi real-time di semua perangkat Anda. Data selalu up-to-date kapan pun dan di mana pun Anda akses.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="container">
                <div class="cta-content">
                    <h2 class="cta-title">Siap Mengubah Hidup?</h2>
                    <p class="cta-text">Bergabunglah dengan ribuan orang yang telah merasakan transformasi hidup sehat bersama MyCalories. Mulai perjalanan Anda hari ini!</p>
                    <a href="/register" class="btn-primary">Mulai Sekarang - Gratis</a>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>MyCalories</h3>
                    <p>Kelola kalorimu dengan Mycalories untuk hidup yang lebih sehat.</p>
                </div>
                <div class="footer-section">
                    <h3>Fitur</h3>
                    <p><a href="#">Tracking</a><br>
                    <a href="#">Database Premium</a><br>
                    <a href="#">Analytics Pro</a></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 MyCalories.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('navCollapse');
            menu.classList.toggle('active');
        }


        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(10, 10, 10, 0.95)';
            } else {
                header.style.background = 'rgba(10, 10, 10, 0.8)';
            }
        });

        // Button interactions
        document.querySelectorAll('.btn-primary, .btn-secondary, .btn-login, .btn-signup').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                if (this.classList.contains('btn-primary')) {
                    this.style.transform = 'translateY(-3px) scale(1.03)';
                } else {
                    this.style.transform = 'translateY(-2px)';
                }
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Feature cards animation on scroll
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                                        entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card').forEach(card => {
            card.classList.add('fade-in');
            observer.observe(card);
        });
    </script>

    <style>
        /* Tambahan efek fade-in untuk fitur cards */
        .feature-card {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .feature-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Tambahan animasi untuk elemen lainnya jika ingin diaktifkan nanti */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease, transform 1s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
    </style>
</body>
</html>
