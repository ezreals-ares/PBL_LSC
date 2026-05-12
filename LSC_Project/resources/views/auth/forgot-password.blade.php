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
            max-width: 480px;
            min-height: auto;
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
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .auth-logo i {
            color: var(--primary);
            font-size: 2rem;
        }
        .auth-desc {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 2rem;
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
        
        /* (Image section removed) */
        
        .error-msg {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: block;
        }

        @media (max-width: 768px) {
            .auth-container {
                border-radius: 20px;
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

        <div class="auth-desc">
            Lupa kata sandi Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan reset kata sandi melalui email.
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" style="color: #059669; font-weight: 500; margin-bottom: 1rem;" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="johnsmith001@gmail.com">
                <i class="far fa-envelope"></i>
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login">Kirim Link Reset Password</button>
        </form>

        <div class="auth-footer">
            Kembali ke <a href="{{ route('login') }}">Masuk</a>
        </div>
    </div>
</div>

</body>
</html>
