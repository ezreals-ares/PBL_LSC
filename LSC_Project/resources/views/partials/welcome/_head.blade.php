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

        /* User Dropdown */
        .user-dropdown {
            position: relative;
            display: inline-block;
        }
        .user-dropdown-btn {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0.25rem 0.5rem 0.25rem 0.25rem;
            border-radius: 9999px;
            transition: background 0.2s;
            border: 1px solid transparent;
        }
        .user-dropdown-btn:hover {
            background: var(--secondary);
            border-color: var(--accent);
        }
        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.3);
        }
        .user-name {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 0.95rem;
            font-family: 'Outfit', sans-serif;
        }
        .user-dropdown-btn i.fa-chevron-down {
            color: var(--text-light);
            font-size: 0.8rem;
            transition: transform 0.3s;
        }
        .user-dropdown-menu {
            position: absolute;
            top: 110%;
            right: 0;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            min-width: 200px;
            padding: 0.5rem;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--border);
            z-index: 1000;
        }
        .user-dropdown:hover .user-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .user-dropdown:hover .user-dropdown-btn i.fa-chevron-down {
            transform: rotate(180deg);
        }
        .user-dropdown-menu a, .user-dropdown-menu button.logout-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            width: 100%;
            padding: 0.75rem 1rem;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
            background: transparent;
            border: none;
            cursor: pointer;
            border-radius: 10px;
            text-align: left;
            transition: all 0.2s;
            text-decoration: none;
        }
        .user-dropdown-menu a i, .user-dropdown-menu button.logout-btn i {
            color: var(--primary-light);
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }
        .user-dropdown-menu a:hover {
            background: var(--secondary);
            color: var(--primary);
        }
        .user-dropdown-menu button.logout-btn:hover {
            background: #fee2e2;
            color: #ef4444;
        }
        .user-dropdown-menu button.logout-btn:hover i {
            color: #ef4444;
        }
        .user-dropdown-menu form {
            margin: 0;
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
            overflow: hidden;
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

        /* ── Reviews / Testimonials Section ── */
        .reviews-section {
            padding: 8rem 5%;
            background: linear-gradient(180deg, var(--text-dark) 0%, #1e293b 100%);
            text-align: center;
        }

        .reviews-section .section-title  { color: var(--white); }
        .reviews-section .section-subtitle { color: #94a3b8; }

        /* Rating summary bar */
        .rating-summary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin: 2.5rem auto 3.5rem;
            flex-wrap: wrap;
        }
        .rating-big {
            font-size: 4rem;
            font-weight: 800;
            color: var(--primary-light);
            line-height: 1;
        }
        .rating-stars-big { display: flex; gap: 4px; }
        .star-filled { color: #f59e0b; font-size: 1.6rem; }
        .star-half   { color: #f59e0b; font-size: 1.6rem; opacity: 0.6; }
        .star-empty  { color: #475569; font-size: 1.6rem; }
        .rating-count { color: #94a3b8; font-size: 0.95rem; }

        /* Review grid */
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.75rem;
            text-align: left;
        }
        .review-card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transition: all 0.3s ease;
        }
        .review-card:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(56,189,248,0.3);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        .review-stars { display: flex; gap: 2px; }
        .review-stars .star-filled { font-size: 1.1rem; }
        .review-stars .star-empty  { font-size: 1.1rem; color: #475569; }
        .review-comment {
            color: #cbd5e1;
            font-size: 0.95rem;
            line-height: 1.7;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .review-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: auto;
        }
        .review-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            font-weight: 800;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .review-name { font-weight: 700; color: var(--white); font-size: 0.95rem; }
        .review-date { font-size: 0.78rem; color: #64748b; margin-top: 0.1rem; }

        /* ── Location Section ── */
        .location-section {
            padding: 8rem 5%;
            background: var(--background);
            text-align: center;
        }

        .location-header { margin-bottom: 4rem; }

        .location-wrapper {
            display: grid;
            grid-template-columns: 1fr 1.4fr;
            gap: 3rem;
            align-items: stretch;
            text-align: left;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Info column */
        .location-info-col {
            background: var(--white);
            border-radius: 28px;
            padding: 2.5rem;
            box-shadow: 0 15px 40px -10px rgba(2,132,199,0.12);
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .outlet-name-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-dark);
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border);
        }

        .outlet-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--primary-light);
            display: inline-block;
            box-shadow: 0 0 0 4px rgba(56,189,248,0.2);
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0%  { box-shadow: 0 0 0 0 rgba(56,189,248,0.4); }
            70% { box-shadow: 0 0 0 8px rgba(56,189,248,0); }
            100%{ box-shadow: 0 0 0 0 rgba(56,189,248,0); }
        }

        .info-item-row {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--secondary);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .info-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-light);
            margin-bottom: 0.2rem;
        }

        .info-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
            line-height: 1.5;
        }

        /* Operational hours mini table */
        .hours-table {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            margin-top: 0.35rem;
        }

        .hours-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            padding: 0.3rem 0.6rem;
            border-radius: 8px;
            transition: background 0.15s;
        }

        .hours-row:hover { background: var(--secondary); }

        .hours-day  { font-weight: 600; color: var(--text-dark); min-width: 120px; }
        .hours-time { color: var(--primary); font-weight: 700; }

        /* CTA buttons */
        .location-ctas {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-top: auto;
            padding-top: 0.5rem;
            border-top: 1px solid var(--border);
        }

        .btn-loc {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.3rem;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .btn-loc-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            box-shadow: 0 6px 18px rgba(2,132,199,0.25);
        }

        .btn-loc-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(2,132,199,0.35);
        }

        .btn-loc-whatsapp {
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: white;
            box-shadow: 0 6px 18px rgba(37,211,102,0.25);
        }

        .btn-loc-whatsapp:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37,211,102,0.35);
        }

        /* Map column */
        .location-map-col {
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 20px 50px -15px rgba(0,0,0,0.15);
            border: 1px solid var(--border);
            min-height: 450px;
        }

        .map-embed-wrap {
            width: 100%;
            height: 100%;
            min-height: 450px;
        }

        .map-embed-wrap iframe {
            display: block;
            width: 100%;
            height: 100%;
            min-height: 450px;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .location-wrapper {
                grid-template-columns: 1fr;
            }
            .location-map-col { min-height: 320px; }
            .map-embed-wrap, .map-embed-wrap iframe { min-height: 320px; }
        }
    </style>
</head>
