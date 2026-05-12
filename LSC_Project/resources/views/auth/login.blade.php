<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.welcome._head')
    <style>
        /* Auth specific styles */
        body {
            background: radial-gradient(circle at top right, var(--secondary) 0%, var(--white) 60%, var(--accent) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 2rem;
            font-family: 'Outfit', sans-serif;
            position: relative;
        }
        .auth-container {
            background: var(--white);
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(2, 132, 199, 0.1);
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            overflow: hidden;
            border: 1px solid rgba(224, 242, 254, 0.8);
        }
        .auth-form-section {
            flex: 1;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .auth-logo {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .auth-logo i {
            color: var(--primary);
            font-size: 2rem;
        }
        .input-group {
            margin-bottom: 2rem;
            position: relative;
        }
        .input-group label {
            display: block;
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .input-group input {
            width: 100%;
            border: none;
            border-bottom: 2px solid var(--accent);
            padding: 0.5rem 0;
            font-size: 1.05rem;
            color: var(--text-dark);
            outline: none;
            background: transparent;
            transition: border-color 0.3s;
        }
        .input-group input:focus {
            border-bottom-color: var(--primary);
        }
        .input-group i {
            position: absolute;
            right: 0;
            bottom: 10px;
            color: var(--primary-light);
            font-size: 1.2rem;
        }
        .auth-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            font-size: 0.95rem;
        }
        .auth-options label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            font-weight: 500;
            cursor: pointer;
        }
        .auth-options input[type="checkbox"] {
            accent-color: var(--primary);
            width: 16px;
            height: 16px;
        }
        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        .forgot-password:hover {
            color: var(--primary-hover);
        }
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 9999px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 20px -5px rgba(2, 132, 199, 0.4);
        }
        .btn-login:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 25px -5px rgba(2, 132, 199, 0.5);
        }
        .auth-footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 1rem;
            color: var(--text-light);
        }
        .auth-footer a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
            transition: color 0.3s;
        }
        .auth-footer a:hover {
            color: var(--primary-hover);
        }
        
        /* Right Side Illustration Area */
        .auth-image-section {
            flex: 1.2;
            background: transparent;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        /* Floating foam/bubbles effect to match project concept */
        .auth-image-section::before {
            display: none;
        }

        .auth-image-content {
            position: relative;
            z-index: 2;
            width: 90%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .auth-image-content img {
            max-width: 100%;
            filter: drop-shadow(0 20px 30px rgba(0,0,0,0.15));
            mix-blend-mode: multiply;
        }
        
        .error-msg {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: block;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                border-radius: 20px;
            }
            .auth-image-section {
                display: none;
            }
            .auth-form-section {
                padding: 2.5rem;
            }
        }
    </style>
</head>
<body>

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

<div class="auth-container relative z-10">
    <div class="auth-form-section">
        <a href="{{ route('landing') }}" style="text-decoration: none;">
            <div class="auth-logo">
                <i class="fas fa-shoe-prints"></i> LSC.
            </div>
        </a>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" style="color: #059669; font-weight: 500; margin-bottom: 1rem;" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="johnsmith001@gmail.com">
                <i class="far fa-user"></i>
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" required placeholder="••••••">
                <i class="fas fa-unlock-alt"></i>
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-options">
                <label>
                    <input type="checkbox" name="remember" id="remember_me">
                    Ingat Saya
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password">Lupa Kata Sandi?</a>
                @endif
            </div>

            <button type="submit" class="btn-login">MASUK</button>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </div>
    </div>
    
    <div class="auth-image-section">
        <div class="auth-image-content">
            <img src="{{ asset('images/hero-clean.png') }}" alt="Clean Shoes">
        </div>
    </div>
</div>

</body>
</html>
