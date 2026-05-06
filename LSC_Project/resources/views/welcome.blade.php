<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lose Shoe Cleaning</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:300,400,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    
    <style>
        /* Vanilla CSS Implementation - Vibrant Theme */
        :root {
            --primary: #0284c7; /* Deeper vibrant blue */
            --primary-hover: #0369a1;
            --primary-light: #38bdf8;
            --secondary: #e0f2fe; /* Soft light blue */
            --background: #f8fafc;
            --white: #ffffff;
            --text-dark: #0f172a;
            --text-light: #475569;
            --accent: #bae6fd;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--background);
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Navbar */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 5%;
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px -2px rgba(14, 165, 233, 0.1);
        }

        .logo {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -1px;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
        }

        .nav-links a {
            font-weight: 600;
            color: var(--text-light);
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -5px;
            left: 0;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            transition: width 0.3s ease;
            border-radius: 5px;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .btn {
            padding: 0.8rem 1.8rem;
            border-radius: 9999px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: none;
            display: inline-block;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            box-shadow: 0 10px 20px -5px rgba(2, 132, 199, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 25px -5px rgba(2, 132, 199, 0.5);
        }

        .btn-outline {
            background-color: rgba(255, 255, 255, 0.9);
            color: var(--primary);
            border: 2px solid var(--primary-light);
            box-shadow: 0 5px 15px -5px rgba(2, 132, 199, 0.1);
        }

        .btn-outline:hover {
            background-color: var(--secondary);
            border-color: var(--primary);
            transform: translateY(-3px);
        }

        /* Hero Section with Soap Bubbles */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            min-height: 100vh;
            padding: 7rem 5% 2rem;
            background: radial-gradient(circle at top right, var(--secondary) 0%, var(--white) 60%, var(--accent) 100%);
            position: relative;
            overflow: hidden;
        }

        /* Realistic Foam Image Layer */
        .foam-image {
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 500px;
            opacity: 0.8;
            mix-blend-mode: multiply;
            z-index: 0;
            pointer-events: none;
            animation: float-foam 8s ease-in-out infinite;
        }
        
        .foam-image-2 {
            position: absolute;
            top: 50px;
            right: 20%;
            width: 300px;
            opacity: 0.5;
            mix-blend-mode: multiply;
            z-index: 0;
            pointer-events: none;
            animation: float-foam 10s ease-in-out infinite reverse;
        }

        @keyframes float-foam {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }

        /* Soap Bubbles Animation */
        .bubbles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .bubble {
            position: absolute;
            bottom: -100px;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.9), rgba(224, 242, 254, 0.4) 60%, rgba(56, 189, 248, 0.3) 100%);
            border-radius: 50%;
            box-shadow: inset 0 0 20px rgba(255, 255, 255, 0.8), inset 10px 0 20px rgba(56, 189, 248, 0.3), inset -10px 0 20px rgba(224, 242, 254, 0.5), 0 0 15px rgba(255, 255, 255, 0.4);
            animation: rise 15s infinite ease-in;
            border: 1px solid rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(2px);
        }

        .bubble:nth-child(1) { width: 60px; height: 60px; left: 10%; animation-duration: 8s; }
        .bubble:nth-child(2) { width: 40px; height: 40px; left: 20%; animation-duration: 5s; animation-delay: 1s; }
        .bubble:nth-child(3) { width: 80px; height: 80px; left: 35%; animation-duration: 10s; animation-delay: 2s; }
        .bubble:nth-child(4) { width: 50px; height: 50px; left: 50%; animation-duration: 7s; animation-delay: 0s; }
        .bubble:nth-child(5) { width: 70px; height: 70px; left: 65%; animation-duration: 11s; animation-delay: 3s; }
        .bubble:nth-child(6) { width: 45px; height: 45px; left: 80%; animation-duration: 6s; animation-delay: 2s; }
        .bubble:nth-child(7) { width: 90px; height: 90px; left: 90%; animation-duration: 12s; animation-delay: 4s; }
        .bubble:nth-child(8) { width: 30px; height: 30px; left: 25%; animation-duration: 9s; animation-delay: 5s; }

        @keyframes rise {
            0% {
                bottom: -100px;
                transform: translateX(0) scale(1);
            }
            50% {
                transform: translateX(30px) scale(1.1);
            }
            100% {
                bottom: 1080px;
                transform: translateX(-30px) scale(0.9);
            }
        }

        .hero-content {
            flex: 1;
            max-width: 50%;
            z-index: 10;
            position: relative;
        }

        .tagline {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: var(--secondary);
            color: var(--primary);
            font-weight: 700;
            border-radius: 50px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: 1px solid var(--primary-light);
        }

        .hero h1 {
            font-size: 4rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
            font-weight: 800;
        }

        .hero h1 span {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.25rem;
            color: var(--text-light);
            margin-bottom: 2.5rem;
            font-weight: 400;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        /* Glowing effect behind the shoe */
        .hero-image::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.4) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: -1;
            animation: pulse 4s infinite alternate;
        }

        .hero-image img {
            max-width: 70%;
            height: auto;
            border-radius: 20px;
            animation: float-shoe 5s ease-in-out infinite;
            filter: drop-shadow(0 30px 30px rgba(2, 132, 199, 0.2));
            z-index: 1;
        }

        @keyframes pulse {
            0% { transform: scale(0.8); opacity: 0.5; }
            100% { transform: scale(1.2); opacity: 0.8; }
        }

        @keyframes float-shoe {
            0% { transform: translateY(0px) rotate(-2deg); }
            50% { transform: translateY(-25px) rotate(2deg); }
            100% { transform: translateY(0px) rotate(-2deg); }
        }

        /* Services Section */
        .services {
            padding: 8rem 5%;
            background-color: var(--white);
            text-align: center;
            position: relative;
        }

        .services::before {
            content: '';
            position: absolute;
            top: -50px;
            left: 0;
            width: 100%;
            height: 100px;
            background: var(--white);
            transform: skewY(-2deg);
            z-index: 0;
        }

        .section-title {
            font-size: 3rem;
            color: var(--text-dark);
            margin-bottom: 1rem;
            font-weight: 800;
            position: relative;
            z-index: 1;
        }

        .section-subtitle {
            color: var(--text-light);
            font-size: 1.2rem;
            margin-bottom: 4rem;
            position: relative;
            z-index: 1;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .service-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 2.5rem;
            text-align: left;
            box-shadow: 0 15px 35px -10px rgba(2, 132, 199, 0.15);
            border: 1px solid rgba(224, 242, 254, 0.8);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .service-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.8), transparent);
            transform: skewX(-20deg);
            transition: 0.7s;
        }

        .service-card:hover::after {
            left: 150%;
        }

        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px -15px rgba(2, 132, 199, 0.25);
            border-color: var(--primary-light);
        }

        .service-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 20px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transition: transform 0.5s ease;
        }

        .service-card:hover .service-img {
            transform: scale(1.05);
        }

        .service-card h3 {
            font-size: 1.8rem;
            margin-bottom: 0.8rem;
            color: var(--text-dark);
            font-weight: 700;
        }

        .service-card p {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
        }

        .service-price {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--primary);
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: var(--secondary);
            border-radius: 12px;
        }

        /* How it Works */
        .how-it-works {
            padding: 8rem 5%;
            background: linear-gradient(180deg, var(--white) 0%, var(--secondary) 100%);
            text-align: center;
        }

        .steps-container {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 5rem;
            flex-wrap: wrap;
        }

        .step {
            flex: 1;
            min-width: 250px;
            max-width: 320px;
            position: relative;
            background: var(--white);
            padding: 3rem 2rem;
            border-radius: 30px;
            box-shadow: 0 20px 40px -20px rgba(2, 132, 199, 0.2);
            transition: transform 0.3s ease;
        }

        .step:hover {
            transform: translateY(-10px);
        }

        .step-number {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 800;
            margin: -60px auto 1.5rem;
            box-shadow: 0 10px 20px rgba(2, 132, 199, 0.3);
            border: 6px solid var(--white);
        }

        .step h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
            font-weight: 700;
        }

        /* Footer */
        footer {
            background-color: var(--text-dark);
            color: var(--white);
            padding: 5rem 5% 2rem;
            text-align: center;
            position: relative;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 3rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 3rem;
        }

        .footer-logo {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-light), var(--white));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .footer-links a {
            color: var(--white);
            margin: 0 1.2rem;
            transition: color 0.3s;
            font-weight: 600;
            opacity: 0.8;
        }

        .footer-links a:hover {
            opacity: 1;
        }

        .footer-hours {
            color: var(--white);
            text-align: left;
            font-size: 0.95rem;
            line-height: 1.8;
            margin: 1rem 0;
        }

        .footer-hours h4 {
            color: var(--white);
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .social-links {
            display: flex;
            gap: 1.2rem;
            margin-top: 1.5rem;
        }

        .social-links a {
            width: 42px;
            height: 42px;
            background-color: rgba(255, 255, 255, 0.08);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .social-links a:hover {
            background-color: var(--primary);
            transform: translateY(-5px);
            border-color: var(--primary-light);
            box-shadow: 0 10px 20px rgba(2, 132, 199, 0.4);
        }

        .copyright {
            color: #64748b;
            font-size: 1rem;
        }

        /* Location Section */
        .location {
            padding: 8rem 5%;
            background-color: var(--white);
            text-align: center;
        }

        .location-container {
            display: flex;
            gap: 3rem;
            margin-top: 4rem;
            align-items: stretch;
            flex-wrap: wrap;
        }

        .location-info {
            flex: 1;
            min-width: 300px;
            text-align: left;
        }

        .info-card {
            background: var(--secondary);
            padding: 2.5rem;
            border-radius: 30px;
            border: 1px solid var(--accent);
            box-shadow: 0 15px 30px -10px rgba(2, 132, 199, 0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-card i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .info-card h3 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .info-card p {
            font-size: 1.1rem;
            color: var(--text-light);
            line-height: 1.6;
        }

        .map-container {
            flex: 1.5;
            min-width: 300px;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1);
            border: 1px solid var(--secondary);
            height: 450px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero h1 { font-size: 3rem; }
            .hero-image::before { width: 300px; height: 300px; }
            .hero-content { max-width: 100%; }
        }

        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                text-align: center;
                padding-top: 8rem;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .nav-links {
                display: none;
            }

            .hero-image {
                margin-top: 4rem;
            }
            
            .steps-container {
                flex-direction: column;
                align-items: center;
                gap: 5rem;
            }
            
            .footer-content {
                flex-direction: column;
                gap: 2rem;
            }

            .footer-hours {
                text-align: center;
            }

            .social-links {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">LSC.</div>
        <div class="nav-links">
            <a href="#beranda">Beranda</a>
            <a href="#layanan">Layanan</a>
            <a href="#cara-kerja">Cara Kerja</a>
            <a href="#lokasi">Lokasi</a>
        </div>
        <div class="auth-buttons">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/admin') }}" class="btn btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline" style="margin-right: 0.5rem;">Masuk</a>
                @endauth
            @endif
        </div>
    </nav>

    <section id="beranda" class="hero">
        <!-- Realistic Foam Images -->
        <img src="{{ asset('images/bubbles.png') }}" alt="Soap Foam" class="foam-image">
        <img src="{{ asset('images/bubbles.png') }}" alt="Soap Foam" class="foam-image-2">

        <!-- Animated Soap Bubbles -->
        <div class="bubbles">
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
        </div>

        <div class="hero-content">
            <span class="tagline">Premium Shoe Care</span>
            <h1>Bawa Kembali Kilau <span>Sepatu Kesayangan</span> Anda</h1>
            <p>Layanan cuci sepatu profesional dengan perawatan premium. Cepat, bersih, dan wangi seperti baru lagi. Serahkan masalah sepatu kotor Anda kepada kami.</p>
            <div style="display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap;">
                <a href="#layanan" class="btn btn-primary">Pesan Sekarang</a>
                <a href="#cara-kerja" class="btn btn-outline">Pelajari Lebih Lanjut</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="{{ asset('images/hero.png') }}" alt="Premium Shoe Cleaning">
        </div>
    </section>

    <section id="layanan" class="services">
        <h2 class="section-title">Layanan Premium Kami</h2>
        <p class="section-subtitle">Pilih perawatan terbaik yang sesuai dengan kondisi sepatu Anda.</p>
        
        <div class="services-grid">
            @if(isset($services) && $services->count() > 0)
                @foreach($services as $service)
                <div class="service-card">
                    @php
                        $img = 'hero.png';
                        if(str_contains(strtolower($service->service_name), 'deep')) $img = 'deep_clean.png';
                        if(str_contains(strtolower($service->service_name), 'yellow')) $img = 'unyellow.png';
                    @endphp
                    <img src="{{ asset('images/' . $img) }}" alt="{{ $service->service_name }}" class="service-img">
                    <h3>{{ $service->service_name }}</h3>
                    <p>{{ $service->description }}</p>
                    <div class="service-price">Mulai Rp {{ number_format($service->price, 0, ',', '.') }}</div>
                </div>
                @endforeach
            @else
                <p style="text-align: center; width: 100%; color: var(--text-light);">Belum ada layanan yang tersedia saat ini.</p>
            @endif
        </div>
    </section>

    <section id="cara-kerja" class="how-it-works">
        <h2 class="section-title">Cara Kerja LSC</h2>
        <p class="section-subtitle">Tiga langkah mudah untuk mendapatkan sepatu bersih Anda.</p>
        
        <div class="steps-container">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Drop / Antar</h3>
                <p>Bawa sepatu kotor Anda ke workshop kami atau gunakan layanan jemput kurir (pickup).</p>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <h3>Proses Cuci</h3>
                <p>Sepatu Anda akan dibersihkan oleh ahlinya dengan hati-hati dan teliti.</p>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <h3>Siap Pakai</h3>
                <p>Sepatu Anda kembali bersih, wangi, dan siap menemani langkah Anda dengan percaya diri.</p>
            </div>
        </div>
    </section>



    <footer>
        <div class="footer-content" style="align-items: flex-start;">
            <div style="flex: 3; text-align: left;">
                <div style="display: flex; align-items: flex-start; gap: 3rem; flex-wrap: wrap; margin-bottom: 2rem;">
                    <div>
                        <div class="footer-logo">LSC.</div>
                        <div class="social-links" style="margin-top: 1.5rem;">
                            <a href="https://wa.me/628123456789" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            <a href="https://instagram.com/loseshoecare" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="https://facebook.com/lose.shoecare" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                    <div class="footer-hours" style="margin: 0; margin-left: 10rem;">
                        <h4 style="font-size: 1.1rem; color: var(--white);">Jam Operasional</h4>
                        <p style="font-size: 0.85rem; color: var(--white);">Senin - Kamis: 09.00 - 16.00 WIB</p>
                        <p style="font-size: 0.85rem; color: var(--white);">Jumat: 13.00 - 18.00 WIB</p>
                        <p style="font-size: 0.85rem; color: var(--white);">Sabtu - Minggu: 10.00 - 17.00 WIB</p>
                    </div>
                    <div class="footer-hours" style="margin: 0; max-width: 280px; margin-left: 14rem;">
                        <h4 style="font-size: 1.1rem; color: var(--white);">Alamat Toko</h4>
                        <p style="font-size: 0.85rem; color: var(--white); line-height: 1.6;">Jl. Begawan, Dusun Begawan, Pandansari Lor, Kec. Jabung, Kabupaten Malang</p>
                        <div style="margin-top: 1rem; border-radius: 15px; overflow: hidden; height: 120px; border: 1px solid rgba(255,255,255,0.1); width: 100%;">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.123456789!2d112.789012!3d-7.901234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6294000000001%3A0x0!2zN8KwNTQnMDQuNCJTIDExMsKwNDcnMjAuNCJF!5e0!3m2!1sen!2sid!4v1714890000000!5m2!1sen!2sid" 
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-links" style="flex: 1; text-align: right;">
                <a href="#beranda">Beranda</a>
                <a href="#layanan">Layanan</a>
                <a href="#cara-kerja">Cara Kerja</a>
            </div>
        </div>
        <p class="copyright">&copy; {{ date('Y') }} Lose Shoe Cleaning. Hak cipta dilindungi undang-undang.</p>
    </footer>

</body>
</html>
