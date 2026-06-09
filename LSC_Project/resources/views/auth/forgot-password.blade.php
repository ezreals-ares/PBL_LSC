<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Kata Sandi — Lose ShoesCare</title>
    <meta name="description" content="Reset kata sandi akun Lose ShoesCare kamu melalui email.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color: #FDFCF6; min-height: 100vh; display: flex; flex-direction: column;">

{{-- ── Navbar strip ────────────────────────────────────────────── --}}
<div style="border-bottom: 3px solid #000; background: #FDFCF6; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center;">
    <a href="{{ route('landing') }}" style="text-decoration: none; display: flex; align-items: center; gap: 10px;">
        <div style="width:36px; height:36px; background:#0058be; border:3px solid #000; display:flex; align-items:center; justify-content:center; font-family:'Space Grotesk',sans-serif; font-weight:900; color:#fff; font-size:14px; box-shadow:2px 2px 0 #000;">L</div>
        <span style="font-family:'Space Grotesk',sans-serif; font-weight:900; text-transform:uppercase; color:#191b23; letter-spacing:-0.03em; font-size:1.1rem;">Lose ShoesCare</span>
    </a>
    <a href="{{ route('login') }}" style="font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:0.85rem; text-transform:uppercase; color:#191b23; text-decoration:none; border:3px solid #000; padding:6px 16px; background:#FDFCF6; box-shadow:2px 2px 0 #000;">
        ← Kembali Masuk
    </a>
</div>

{{-- ── Main Auth Layout ────────────────────────────────────────── --}}
<main style="flex:1; display:flex; align-items:center; justify-content:center; padding: 3rem 1rem;">
    <div style="display:grid; grid-template-columns:1fr 1fr; max-width:960px; width:100%; border:3px solid #000; box-shadow: 8px 8px 0px 0px #000; overflow:hidden; background:#fff;">

        {{-- Left: Brand panel --}}
        <div style="background:#0058be; padding:3rem; display:flex; flex-direction:column; justify-content:space-between; min-height:480px;">
            <div>
                <div style="background:#fed01b; border:3px solid #000; display:inline-block; padding:4px 14px; font-family:'Space Grotesk',sans-serif; font-weight:900; font-size:0.7rem; text-transform:uppercase; letter-spacing:.1em; color:#6f5900; margin-bottom:2rem;">
                    Pemulihan Akun
                </div>
                <h1 style="font-family:'Space Grotesk',sans-serif; font-weight:900; font-size:2.4rem; text-transform:uppercase; color:#fff; line-height:1; margin-bottom:1.5rem;">
                    LUPA<br>KATA<br><span style="color:#fed01b;">SANDI?</span>
                </h1>
                <p style="color:rgba(255,255,255,0.75); font-size:0.9rem; line-height:1.6;">
                    Masukkan email kamu dan kami akan mengirimkan tautan untuk membuat kata sandi baru.
                </p>
            </div>
            {{-- Bottom steps --}}
            <div style="display:flex; flex-direction:column; gap:12px; margin-top:2rem;">
                @foreach(['Masukkan email akunmu', 'Cek kotak masuk emailmu', 'Klik tautan & buat sandi baru'] as $idx => $step)
                    <div style="display:flex; align-items:center; gap:10px; color:#fff;">
                        <div style="width:24px; height:24px; background:#fed01b; border:2px solid rgba(255,255,255,0.4); display:flex; align-items:center; justify-content:center; flex-shrink:0; font-family:'Space Grotesk',sans-serif; font-weight:900; font-size:0.75rem; color:#6f5900;">
                            {{ $idx + 1 }}
                        </div>
                        <span style="font-size:0.9rem; font-weight:600;">{{ $step }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Right: Form panel --}}
        <div style="padding:3rem; background:#fff; display:flex; flex-direction:column; justify-content:center;">
            <h2 style="font-family:'Space Grotesk',sans-serif; font-weight:900; font-size:1.8rem; text-transform:uppercase; color:#191b23; margin-bottom:0.5rem;">Lupa Kata Sandi</h2>
            <p style="color:#6b7280; font-size:0.9rem; margin-bottom:2rem;">Kami akan kirimkan link reset ke emailmu.</p>

            {{-- Session Status (success message) --}}
            @if (session('status'))
                <div style="background:#d1fae5; border:3px solid #059669; padding:12px 16px; margin-bottom:1.5rem; display:flex; align-items:center; gap:10px;">
                    <span class="material-symbols-outlined" style="color:#059669; font-size:20px; font-variation-settings:'FILL' 1;">check_circle</span>
                    <p style="color:#065f46; font-size:0.9rem; font-weight:600; margin:0;">{{ session('status') }}</p>
                </div>
            @endif

            {{-- Errors --}}
            @if($errors->any())
                <div style="background:#fee2e2; border:3px solid #ef4444; padding:12px 16px; margin-bottom:1.5rem;">
                    @foreach($errors->all() as $error)
                        <p style="color:#ef4444; font-size:0.85rem; font-weight:600; margin:0;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                {{-- Email --}}
                <div style="margin-bottom:1.75rem;">
                    <label for="email" style="display:block; font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:0.75rem; text-transform:uppercase; letter-spacing:.05em; color:#191b23; margin-bottom:6px;">Email</label>
                    <div style="position:relative;">
                        <span class="material-symbols-outlined" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#6b7280; font-size:18px;">email</span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="nama@email.com"
                               style="width:100%; padding:12px 12px 12px 40px; border:3px solid #000; background:#FDFCF6; font-family:'Plus Jakarta Sans',sans-serif; font-size:1rem; color:#191b23; outline:none; box-sizing:border-box; transition:border-color .15s, box-shadow .15s;"
                               onfocus="this.style.borderColor='#0058be'; this.style.boxShadow='3px 3px 0 #0058be';"
                               onblur="this.style.borderColor='#000'; this.style.boxShadow='none';">
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        style="width:100%; background:#0058be; color:#fff; border:3px solid #000; padding:14px; font-family:'Space Grotesk',sans-serif; font-size:1rem; font-weight:900; text-transform:uppercase; letter-spacing:0.05em; cursor:pointer; box-shadow:4px 4px 0 #000; transition:all .1s;"
                        onmouseover="this.style.background='#2170e4';"
                        onmouseout="this.style.background='#0058be';"
                        onmousedown="this.style.transform='translate(2px,2px)'; this.style.boxShadow='2px 2px 0 #000';"
                        onmouseup="this.style.transform=''; this.style.boxShadow='4px 4px 0 #000';">
                    KIRIM LINK RESET PASSWORD
                </button>
            </form>
        </div>
    </div>
</main>

{{-- Responsive: hide left panel on mobile --}}
<style>
    @media (max-width: 700px) {
        main > div { grid-template-columns: 1fr !important; }
        main > div > div:first-child { display: none !important; }
    }
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>

</body>
</html>
