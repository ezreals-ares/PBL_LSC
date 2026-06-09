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

    @include('home.sections._navbar')

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
    @include('home.sections._footer')

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
