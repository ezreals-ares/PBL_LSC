<section id="beranda" class="hero">
    <!-- Realistic Foam Images -->
    <img src="{{ asset('images/bubbles.png') }}" alt="Soap Foam" class="foam-image">
    <img src="{{ asset('images/bubbles.png') }}" alt="Soap Foam" class="foam-image-2">

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

    <div class="hero-content">
        <span class="tagline">Premium Shoe Care</span>
        <h1>Bawa Kembali Kilau <span>Sepatu Kesayangan</span> Anda</h1>
        <p>Layanan cuci sepatu profesional dengan perawatan premium. Cepat, bersih, dan wangi seperti baru lagi. Serahkan masalah sepatu kotor Anda kepada kami.</p>
        <div style="display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap;">
            @auth
                <a href="{{ route('order.create') }}" class="btn btn-primary">Pesan Sekarang</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Pesan Sekarang</a>
            @endauth
            <a href="#cara-kerja" class="btn btn-outline">Pelajari Lebih Lanjut</a>
        </div>
    </div>

    <div class="hero-image">
        <img src="{{ asset('images/hero.png') }}" alt="Premium Shoe Cleaning">
    </div>
</section>
