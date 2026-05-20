<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Lose ShoesCare</title>
    <link rel="icon" type="image/png" href="{{ asset('decoration/logo_fix.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('head-extra')
</head>
<body>
    <div id="swup" class="bg-surface text-on-surface font-jakarta min-h-screen flex flex-col">

    @include('partials.welcome._navbar')

    {{-- ── Flash Messages ──────────────────────────────────────────── --}}
    @if(session('success'))
        <div class="flash-toast flash-success" id="flash-msg">
            <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1">check_circle</span>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flash-toast flash-error" id="flash-msg">
            <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1">error</span>
            {{ session('error') }}
        </div>
    @endif

    {{-- ── Page Content ─────────────────────────────────────────────── --}}
    <main class="max-w-screen-xl mx-auto px-4 md:px-8 py-10">
        @yield('content')
    </main>

    {{-- ── Footer ───────────────────────────────────────────────────── --}}
    <footer class="bg-surface-container border-t-[3px] border-stroke mt-16">
        <div class="max-w-screen-xl mx-auto px-4 md:px-8 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="font-grotesk font-black text-on-surface uppercase text-lg mb-3">Lose ShoesCare</div>
                <p class="text-sm text-on-surface-variant leading-relaxed">Premium sneaker care platform. Your kicks deserve the best treatment.</p>
            </div>
            <div>
                <h4 class="font-grotesk font-bold uppercase text-sm mb-4 text-on-surface">Layanan</h4>
                <ul class="space-y-2">
                    <li><a href="{{ url('/') }}#layanan" class="text-sm text-on-surface-variant hover:text-on-surface hover:underline decoration-[2px] underline-offset-4">Deep Clean</a></li>
                    <li><a href="{{ url('/') }}#layanan" class="text-sm text-on-surface-variant hover:text-on-surface hover:underline decoration-[2px] underline-offset-4">Whitening</a></li>
                    <li><a href="{{ url('/') }}#layanan" class="text-sm text-on-surface-variant hover:text-on-surface hover:underline decoration-[2px] underline-offset-4">Reglue</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-grotesk font-bold uppercase text-sm mb-4 text-on-surface">Akun</h4>
                <ul class="space-y-2">
                    @auth
                        <li><a href="{{ route('order.history') }}" class="text-sm text-on-surface-variant hover:text-on-surface hover:underline decoration-[2px] underline-offset-4">Pesanan Saya</a></li>
                        <li><a href="{{ route('profile.edit') }}"  class="text-sm text-on-surface-variant hover:text-on-surface hover:underline decoration-[2px] underline-offset-4">Profil</a></li>
                    @else
                        <li><a href="{{ route('login') }}"    class="text-sm text-on-surface-variant hover:text-on-surface hover:underline decoration-[2px] underline-offset-4">Masuk</a></li>
                        <li><a href="{{ route('register') }}" class="text-sm text-on-surface-variant hover:text-on-surface hover:underline decoration-[2px] underline-offset-4">Daftar</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <div class="border-t-[2px] border-stroke px-4 md:px-8 py-5 max-w-screen-xl mx-auto flex justify-between items-center">
            <span class="text-xs text-on-surface-variant">© {{ date('Y') }} Lose ShoesCare. Keep 'em fresh.</span>
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-base" style="font-variation-settings:'FILL' 1">verified</span>
                <span class="material-symbols-outlined text-primary text-base" style="font-variation-settings:'FILL' 1">eco</span>
            </div>
        </div>
    </footer>

    <script>


        // Auto-dismiss flash messages
        (function() {
            const msg = document.getElementById('flash-msg');
            if (!msg) return;
            setTimeout(function() {
                msg.style.animation = 'slideOutRight 0.4s ease forwards';
                setTimeout(function() { msg.remove(); }, 400);
            }, 4500);
        })();
    </script>

    @yield('scripts')

    </div>
</body>
</html>
