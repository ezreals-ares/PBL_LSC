<nav>
    <div class="logo">LSC.</div>
    <div class="nav-links">
        <a href="#beranda">Beranda</a>
        <a href="#layanan">Layanan</a>
        <a href="#cara-kerja">Cara Kerja</a>
        <a href="#ulasan">Ulasan</a>
        <a href="#lokasi">Lokasi</a>
    </div>
    <div class="auth-buttons">
        @auth
            @if(auth()->user()->role === 'admin')
                {{-- Admin: redirect to Filament admin panel --}}
                <a href="{{ url('/admin') }}" class="btn btn-primary">Dashboard Admin</a>
            @else
                {{-- Customer: show order history and profile dropdown --}}
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <a href="{{ route('order.history') }}" class="btn btn-outline" style="padding: 0.5rem 1.2rem; font-size: 0.9rem;">Pesanan Saya</a>
                    <div class="user-dropdown">
                        <button class="user-dropdown-btn" style="padding-left: 0.25rem;">
                            <div class="user-avatar">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <i class="fas fa-chevron-down" style="margin-left: 0.25rem;"></i>
                        </button>
                        <div class="user-dropdown-menu">
                            <a href="{{ route('profile.edit') }}"><i class="fas fa-user-circle"></i> Profil Saya</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-outline" style="margin-right: 0.5rem;">Masuk</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
        @endauth
    </div>
</nav>
