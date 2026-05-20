<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar — Lose ShoesCare</title>
    <meta name="description" content="Buat akun Lose ShoesCare dan mulai perjalanan perawatan sneakermu.">
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
        Sudah punya akun? Masuk →
    </a>
</div>

{{-- ── Main Auth Layout ────────────────────────────────────────── --}}
<main style="flex:1; display:flex; align-items:center; justify-content:center; padding: 3rem 1rem;">
    <div style="display:grid; grid-template-columns:1fr 1fr; max-width:960px; width:100%; border:3px solid #000; box-shadow: 8px 8px 0px 0px #000; overflow:hidden; background:#fff;">

        {{-- Left: Brand panel (yellow theme for register) --}}
        <div style="background:#fed01b; padding:3rem; display:flex; flex-direction:column; justify-content:space-between; min-height:600px;">
            <div>
                <div style="background:#0058be; border:3px solid #000; display:inline-block; padding:4px 14px; font-family:'Space Grotesk',sans-serif; font-weight:900; font-size:0.7rem; text-transform:uppercase; letter-spacing:.1em; color:#fff; margin-bottom:2rem;">
                    Bergabung Sekarang
                </div>
                <h1 style="font-family:'Space Grotesk',sans-serif; font-weight:900; font-size:2.4rem; text-transform:uppercase; color:#191b23; line-height:1; margin-bottom:1.5rem;">
                    FRESH<br>START.<br><span style="color:#0058be;">FRESH<br>KICKS.</span>
                </h1>
                <p style="color:#6f5900; font-size:0.9rem; line-height:1.6; font-weight:500;">
                    Daftarkan diri dan nikmati kemudahan layanan sneaker laundry profesional kami.
                </p>
            </div>
            {{-- Steps --}}
            <div style="display:flex; flex-direction:column; gap:16px; margin-top:2rem;">
                @foreach([
                    ['1', 'Daftar akun gratis'],
                    ['2', 'Pilih layanan & pesan'],
                    ['3', 'Bayar & pantau progres'],
                ] as [$num, $step])
                    <div style="display:flex; align-items:center; gap:12px;">
                        <div style="width:32px; height:32px; background:#191b23; border:2px solid #000; display:flex; align-items:center; justify-content:center; font-family:'Space Grotesk',sans-serif; font-weight:900; color:#fed01b; font-size:0.85rem; flex-shrink:0;">
                            {{ $num }}
                        </div>
                        <span style="font-size:0.9rem; font-weight:700; color:#191b23;">{{ $step }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Right: Form panel --}}
        <div style="padding:3rem; background:#fff; display:flex; flex-direction:column; justify-content:center;">
            <h2 style="font-family:'Space Grotesk',sans-serif; font-weight:900; font-size:1.8rem; text-transform:uppercase; color:#191b23; margin-bottom:0.5rem;">Buat Akun</h2>
            <p style="color:#6b7280; font-size:0.9rem; margin-bottom:1.75rem;">Isi formulir berikut untuk mendaftar.</p>

            {{-- Errors --}}
            @if($errors->any())
                <div style="background:#fee2e2; border:3px solid #ef4444; padding:12px 16px; margin-bottom:1.5rem;">
                    @foreach($errors->all() as $error)
                        <p style="color:#ef4444; font-size:0.85rem; font-weight:600; margin:2px 0;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Input helper style --}}
                @php
                    $inputStyle = "width:100%; padding:12px 12px 12px 40px; border:3px solid #000; background:#FDFCF6; font-family:'Plus Jakarta Sans',sans-serif; font-size:1rem; color:#191b23; outline:none; box-sizing:border-box;";
                    $labelStyle = "display:block; font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:0.75rem; text-transform:uppercase; letter-spacing:.05em; color:#191b23; margin-bottom:6px;";
                @endphp

                {{-- Name --}}
                <div style="margin-bottom:1.1rem;">
                    <label for="name" style="{{ $labelStyle }}">Nama Lengkap</label>
                    <div style="position:relative;">
                        <span class="material-symbols-outlined" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#6b7280; font-size:18px;">person</span>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                               placeholder="John Smith"
                               style="{{ $inputStyle }}"
                               onfocus="this.style.borderColor='#0058be'; this.style.boxShadow='3px 3px 0 #0058be';"
                               onblur="this.style.borderColor='#000'; this.style.boxShadow='none';">
                    </div>
                    @error('name') <p style="color:#ef4444; font-size:0.8rem; margin-top:4px; font-weight:600;">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div style="margin-bottom:1.1rem;">
                    <label for="email" style="{{ $labelStyle }}">Email</label>
                    <div style="position:relative;">
                        <span class="material-symbols-outlined" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#6b7280; font-size:18px;">email</span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               placeholder="nama@email.com"
                               style="{{ $inputStyle }}"
                               onfocus="this.style.borderColor='#0058be'; this.style.boxShadow='3px 3px 0 #0058be';"
                               onblur="this.style.borderColor='#000'; this.style.boxShadow='none';">
                    </div>
                    @error('email') <p style="color:#ef4444; font-size:0.8rem; margin-top:4px; font-weight:600;">{{ $message }}</p> @enderror
                </div>

                {{-- Password --}}
                <div style="margin-bottom:1.1rem;">
                    <label for="password" style="{{ $labelStyle }}">Kata Sandi</label>
                    <div style="position:relative;">
                        <span class="material-symbols-outlined" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#6b7280; font-size:18px;">lock</span>
                        <input type="password" id="password" name="password" required
                               placeholder="Min. 8 karakter"
                               style="{{ $inputStyle }}"
                               onfocus="this.style.borderColor='#0058be'; this.style.boxShadow='3px 3px 0 #0058be';"
                               onblur="this.style.borderColor='#000'; this.style.boxShadow='none';">
                    </div>
                    @error('password') <p style="color:#ef4444; font-size:0.8rem; margin-top:4px; font-weight:600;">{{ $message }}</p> @enderror
                </div>

                {{-- Confirm Password --}}
                <div style="margin-bottom:1.75rem;">
                    <label for="password_confirmation" style="{{ $labelStyle }}">Konfirmasi Kata Sandi</label>
                    <div style="position:relative;">
                        <span class="material-symbols-outlined" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#6b7280; font-size:18px;">lock_check</span>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               placeholder="Ulangi kata sandi"
                               style="{{ $inputStyle }}"
                               onfocus="this.style.borderColor='#0058be'; this.style.boxShadow='3px 3px 0 #0058be';"
                               onblur="this.style.borderColor='#000'; this.style.boxShadow='none';">
                    </div>
                    @error('password_confirmation') <p style="color:#ef4444; font-size:0.8rem; margin-top:4px; font-weight:600;">{{ $message }}</p> @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                        style="width:100%; background:#fed01b; color:#191b23; border:3px solid #000; padding:14px; font-family:'Space Grotesk',sans-serif; font-size:1rem; font-weight:900; text-transform:uppercase; letter-spacing:0.05em; cursor:pointer; box-shadow:4px 4px 0 #000; transition:all .1s;"
                        onmouseover="this.style.background='#eec200';"
                        onmouseout="this.style.background='#fed01b';"
                        onmousedown="this.style.transform='translate(2px,2px)'; this.style.boxShadow='2px 2px 0 #000';"
                        onmouseup="this.style.transform=''; this.style.boxShadow='4px 4px 0 #000';">
                    DAFTAR SEKARANG
                </button>
            </form>
        </div>
    </div>
</main>

<style>
    @media (max-width: 700px) {
        main > div { grid-template-columns: 1fr !important; }
        main > div > div:first-child { display: none !important; }
    }
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>

</body>
</html>
