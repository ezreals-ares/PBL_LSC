<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — Lose ShoesCare</title>
    <meta name="description" content="Masuk ke akun Lose ShoesCare dan kelola pesanan laundry sepatumu.">
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
        {{-- Logo perusahaan --}}
        <img src="{{ asset('decoration/logo_fix.png') }}" alt="Lose ShoesCare Logo"
             style="height:38px; width:auto; object-fit:contain;">
    </a>
    <a href="{{ route('register') }}" style="font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:0.85rem; text-transform:uppercase; color:#191b23; text-decoration:none; border:3px solid #000; padding:6px 16px; background:#FDFCF6; box-shadow:2px 2px 0 #000;">
        Belum punya akun? Daftar →
    </a>
</div>

{{-- ── Main Auth Layout ────────────────────────────────────────── --}}
<main style="flex:1; display:flex; align-items:center; justify-content:center; padding: 3rem 1rem;">
    <div style="display:grid; grid-template-columns:1fr 1fr; max-width:960px; width:100%; border:3px solid #000; box-shadow: 8px 8px 0px 0px #000; overflow:hidden; background:#fff;">

        {{-- Left: Brand panel --}}
        <div style="background:#0058be; padding:3rem; display:flex; flex-direction:column; justify-content:space-between; min-height:560px;">
            <div>
                {{-- Logo besar di panel kiri --}}
                <div style="margin-bottom:2rem;">
                    <img src="{{ asset('decoration/logo_fix.png') }}" alt="Lose ShoesCare"
                         style="height:52px; width:auto; object-fit:contain;">
                </div>
                <h1 style="font-family:'Space Grotesk',sans-serif; font-weight:900; font-size:2.4rem; text-transform:uppercase; color:#fff; line-height:1; margin-bottom:1.5rem;">
                    LOSE THE<br>DIRT.<br><span style="color:#fed01b;">KEEP THE<br>SOUL.</span>
                </h1>
                <p style="color:rgba(255,255,255,0.75); font-size:0.9rem; line-height:1.6;">
                    Masuk untuk melihat pesanan, mengunggah bukti bayar, dan memantau status sepatumu.
                </p>
            </div>
            {{-- Bottom features --}}
            <div style="display:flex; flex-direction:column; gap:12px; margin-top:2rem;">
                @foreach(['Pembersihan Mendalam & Pemutihan', 'Pantau Pesanan Secara Langsung', 'Garansi Hasil Bersih'] as $feat)
                    <div style="display:flex; align-items:center; gap:10px; color:#fff;">
                        <div style="width:24px; height:24px; background:#fed01b; border:2px solid rgba(255,255,255,0.4); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <span class="material-symbols-outlined" style="font-size:14px; color:#6f5900; font-variation-settings:'FILL' 1">check</span>
                        </div>
                        <span style="font-size:0.9rem; font-weight:600;">{{ $feat }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Right: Form panel --}}
        <div style="padding:3rem; background:#fff; display:flex; flex-direction:column; justify-content:center;">
            <h2 style="font-family:'Space Grotesk',sans-serif; font-weight:900; font-size:1.8rem; text-transform:uppercase; color:#191b23; margin-bottom:0.5rem;">Selamat Datang</h2>
            <p style="color:#6b7280; font-size:0.9rem; margin-bottom:2rem;">Masuk dengan akun yang sudah terdaftar.</p>

            {{-- Session Status --}}
            <x-auth-session-status class="mb-4" :status="session('status')" style="color: #059669; font-weight: 600; margin-bottom: 1rem;" />

            {{-- Errors --}}
            @if($errors->any())
                <div style="background:#fee2e2; border:3px solid #ef4444; padding:12px 16px; margin-bottom:1.5rem;">
                    @foreach($errors->all() as $error)
                        <p style="color:#ef4444; font-size:0.85rem; font-weight:600;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Pol-el (Email) --}}
                <div style="margin-bottom:1.25rem;">
                    <label for="email" style="display:block; font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:0.75rem; text-transform:uppercase; letter-spacing:.05em; color:#191b23; margin-bottom:6px;">Pol-el</label>
                    <div style="position:relative;">
                        <span class="material-symbols-outlined" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#6b7280; font-size:18px;">email</span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="emailsaya@gmail.com"
                               style="width:100%; padding:12px 12px 12px 40px; border:3px solid #000; background:#FDFCF6; font-family:'Plus Jakarta Sans',sans-serif; font-size:1rem; color:#191b23; outline:none; box-sizing:border-box; transition:border-color .15s, box-shadow .15s;"
                               onfocus="this.style.borderColor='#0058be'; this.style.boxShadow='3px 3px 0 #0058be';"
                               onblur="this.style.borderColor='#000'; this.style.boxShadow='none';">
                    </div>
                </div>

                {{-- Kata Sandi --}}
                <div style="margin-bottom:1.25rem;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                        <label for="password" style="font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:0.75rem; text-transform:uppercase; letter-spacing:.05em; color:#191b23;">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-size:0.8rem; color:#0058be; font-weight:600; text-decoration:none;">Lupa Kata Sandi?</a>
                        @endif
                    </div>
                    <div style="position:relative;">
                        <span class="material-symbols-outlined" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#6b7280; font-size:18px;">lock</span>
                        <input type="password" id="password" name="password" required
                               placeholder="Masukkan kata sandi"
                               style="width:100%; padding:12px 40px 12px 40px; border:3px solid #000; background:#FDFCF6; font-family:'Plus Jakarta Sans',sans-serif; font-size:1rem; color:#191b23; outline:none; box-sizing:border-box; transition:border-color .15s, box-shadow .15s;"
                               onfocus="this.style.borderColor='#0058be'; this.style.boxShadow='3px 3px 0 #0058be';"
                               onblur="this.style.borderColor='#000'; this.style.boxShadow='none';">
                        <button type="button" onclick="togglePass('password', this)"
                                style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; padding:0; color:#6b7280; line-height:0;">
                            <span class="material-symbols-outlined" style="font-size:18px;">visibility</span>
                        </button>
                    </div>
                </div>

                {{-- Ingat Saya --}}
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:1.75rem;">
                    <input type="checkbox" id="remember_me" name="remember"
                           style="width:16px; height:16px; accent-color:#0058be; border:2px solid #000; cursor:pointer;">
                    <label for="remember_me" style="font-size:0.9rem; color:#191b23; cursor:pointer;">Ingat Saya</label>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        style="width:100%; background:#0058be; color:#fff; border:3px solid #000; padding:14px; font-family:'Space Grotesk',sans-serif; font-size:1rem; font-weight:900; text-transform:uppercase; letter-spacing:0.05em; cursor:pointer; box-shadow:4px 4px 0 #000; transition:all .1s;"
                        onmouseover="this.style.background='#2170e4';"
                        onmouseout="this.style.background='#0058be';"
                        onmousedown="this.style.transform='translate(2px,2px)'; this.style.boxShadow='2px 2px 0 #000';"
                        onmouseup="this.style.transform=''; this.style.boxShadow='4px 4px 0 #000';">
                    MASUK
                </button>
            </form>

            {{-- Divider --}}
            <div style="display:flex; align-items:center; gap:12px; margin:1.5rem 0;">
                <div style="flex:1; height:3px; background:#000;"></div>
                <span style="font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:0.75rem; text-transform:uppercase; letter-spacing:.1em; color:#191b23; white-space:nowrap; background:#fed01b; border:3px solid #000; padding:2px 10px;">ATAU</span>
                <div style="flex:1; height:3px; background:#000;"></div>
            </div>

            {{-- Google Login Button --}}
            <a href="{{ route('auth.google') }}"
               id="btn-google-login"
               style="display:flex; align-items:center; justify-content:center; gap:12px; width:100%; background:#FDFCF6; color:#191b23; border:3px solid #000; padding:13px; font-family:'Space Grotesk',sans-serif; font-size:0.95rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; cursor:pointer; box-shadow:4px 4px 0 #000; transition:all .1s; text-decoration:none; box-sizing:border-box;"
               onmouseover="this.style.background='#fff8dc'; this.style.boxShadow='6px 6px 0 #000';"
               onmouseout="this.style.background='#FDFCF6'; this.style.boxShadow='4px 4px 0 #000';"
               onmousedown="this.style.transform='translate(2px,2px)'; this.style.boxShadow='2px 2px 0 #000';"
               onmouseup="this.style.transform=''; this.style.boxShadow='4px 4px 0 #000';">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48" style="flex-shrink:0;">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.31-8.16 2.31-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                    <path fill="none" d="M0 0h48v48H0z"/>
                </svg>
                Masuk dengan Google
            </a>
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

<script>
    function togglePass(fieldId, btn) {
        const input = document.getElementById(fieldId);
        const icon = btn.querySelector('.material-symbols-outlined');
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>

</body>
</html>
