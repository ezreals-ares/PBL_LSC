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
                {{-- Customer: show order history + logout --}}
                <a href="{{ route('order.history') }}" class="btn btn-outline" style="margin-right: 0.5rem;">Pesanan Saya</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Keluar</button>
                </form>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-outline" style="margin-right: 0.5rem;">Masuk</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
        @endauth
    </div>
</nav>
