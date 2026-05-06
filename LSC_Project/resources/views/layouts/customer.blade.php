<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LSC') — Lose ShoesCare</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:300,400,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <style>
        /* ── Design tokens (match landing page exactly) ── */
        :root {
            --primary: #0284c7;
            --primary-hover: #0369a1;
            --primary-light: #38bdf8;
            --secondary: #e0f2fe;
            --background: #f0f9ff;
            --white: #ffffff;
            --text-dark: #0f172a;
            --text-light: #64748b;
            --accent: #bae6fd;
            --border: #e2e8f0;
            --danger: #ef4444;
            --success: #22c55e;
            --warning: #f59e0b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background-color: var(--background); color: var(--text-dark); line-height: 1.6; }
        a { text-decoration: none; color: inherit; }

        /* ── Navbar ── */
        nav.customer-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            background-color: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 1px 0 var(--border);
        }
        .nav-logo {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -1px;
        }
        .nav-center { display: flex; gap: 2rem; }
        .nav-center a {
            font-weight: 600;
            color: var(--text-light);
            transition: color 0.2s;
            font-size: 0.95rem;
        }
        .nav-center a:hover { color: var(--primary); }
        .nav-right { display: flex; align-items: center; gap: 0.75rem; }
        .nav-right a { font-weight: 600; color: var(--text-dark); font-size: 0.9rem; transition: color 0.2s; }
        .nav-right a:hover { color: var(--primary); }
        .btn-nav-primary {
            padding: 0.5rem 1.25rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white !important;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .btn-nav-primary:hover { transform: translateY(-1px); box-shadow: 0 5px 15px rgba(2,132,199,0.3); }
        .btn-nav-logout {
            padding: 0 0;
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-light);
            transition: color 0.2s;
        }
        .btn-nav-logout:hover { color: var(--danger); }

        /* ── Page container ── */
        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 4rem;
        }

        /* ── Cards ── */
        .card {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border: 1px solid var(--border);
        }

        /* ── Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.75rem 1.75rem;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            border: none;
            transition: all 0.25s cubic-bezier(0.4,0,0.2,1);
            text-decoration: none;
            font-family: 'Outfit', sans-serif;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            box-shadow: 0 6px 18px rgba(2,132,199,0.25);
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(2,132,199,0.35); }
        .btn-outline {
            background: transparent;
            color: var(--text-dark);
            border: 2px solid var(--border);
        }
        .btn-outline:hover { border-color: var(--primary-light); color: var(--primary); }
        .btn-sm { padding: 0.45rem 1rem; font-size: 0.85rem; }
        .btn-full { width: 100%; justify-content: center; }

        /* ── Form elements ── */
        .form-group { margin-bottom: 1.25rem; }
        .form-label {
            display: block;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            color: var(--text-dark);
            background: var(--white);
            transition: border-color 0.2s;
            outline: none;
        }
        .form-control:focus { border-color: var(--primary-light); }
        .form-error { color: var(--danger); font-size: 0.8rem; margin-top: 0.3rem; }
        .form-hint { color: var(--text-light); font-size: 0.8rem; margin-top: 0.3rem; }

        /* ── Status badges ── */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.3rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 700;
        }
        .badge-pending  { background: #fef3c7; color: #92400e; }
        .badge-diproses { background: #ffedd5; color: #9a3412; }
        .badge-selesai  { background: #dcfce7; color: #166534; }
        .badge-dibatalkan { background: #fee2e2; color: #991b1b; }

        /* ── Price text ── */
        .price-text { color: var(--primary-light); font-weight: 800; }

        /* ── Divider ── */
        .divider { border: none; border-top: 1px solid var(--border); margin: 1.25rem 0; }

        /* ── Section heading ── */
        .section-heading {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        /* ── Flash messages ── */
        .flash-toast {
            position: fixed;
            top: 1.25rem;
            right: 1.25rem;
            z-index: 9999;
            padding: 1rem 1.5rem;
            border-radius: 14px;
            color: white;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            animation: slideIn 0.3s ease;
            max-width: 380px;
        }
        .flash-success { background: linear-gradient(135deg, #22c55e, #16a34a); }
        .flash-error   { background: linear-gradient(135deg, #ef4444, #dc2626); }
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes slideOut { from { transform: translateX(0); opacity: 1; } to { transform: translateX(100%); opacity: 0; } }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .nav-center { display: none; }
            .page-container { padding: 1.5rem 1rem 3rem; }
        }

        @yield('extra-styles')
    </style>

    @yield('head-extra')
</head>
<body>

    {{-- Navbar --}}
    <nav class="customer-nav">
        <a href="{{ url('/') }}" class="nav-logo">LSC.</a>

        <div class="nav-center">
            <a href="{{ url('/') }}#beranda">Beranda</a>
            <a href="{{ url('/') }}#layanan">Layanan</a>
            <a href="{{ url('/') }}#cara-kerja">Cara Kerja</a>
            <a href="{{ url('/') }}#lokasi">Lokasi</a>
        </div>

        <div class="nav-right">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ url('/admin') }}" class="btn-nav-primary">Dashboard Admin</a>
                @else
                    <a href="{{ route('order.history') }}">Pesanan Saya</a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-nav-logout">Keluar</button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}">Masuk</a>
                <a href="{{ route('register') }}" class="btn-nav-primary">Daftar</a>
            @endauth
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="flash-toast flash-success" id="flash-msg">
            <span>✓</span> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flash-toast flash-error" id="flash-msg">
            <span>✕</span> {{ session('error') }}
        </div>
    @endif

    {{-- Page Content --}}
    <div class="page-container">
        @yield('content')
    </div>

    <script>
        // Auto-dismiss flash messages
        (function() {
            const msg = document.getElementById('flash-msg');
            if (!msg) return;
            setTimeout(function() {
                msg.style.animation = 'slideOut 0.4s ease forwards';
                setTimeout(function() { msg.remove(); }, 400);
            }, 4000);
        })();
    </script>

    @yield('scripts')

</body>
</html>
