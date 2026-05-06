<section id="layanan" class="services">
    <h2 class="section-title">Layanan Premium Kami</h2>
    <p class="section-subtitle">Pilih perawatan terbaik yang sesuai dengan kondisi sepatu Anda.</p>

    <div class="services-grid">
        @if(isset($services) && $services->count() > 0)
            @foreach($services as $service)
            @php
                // Map service names from ServiceSeeder to the image files in /public/images/
                $name = strtolower($service->service_name);
                if (str_contains($name, 'deep'))        $img = 'deep_clean.png';
                elseif (str_contains($name, 'full white'))  $img = 'hero.png';
                elseif (str_contains($name, 'suede'))    $img = 'hero.png';
                elseif (str_contains($name, 'unyellow')) $img = 'unyellow.png';
                elseif (str_contains($name, 'repaint'))  $img = 'hero.png';
                elseif (str_contains($name, 'sole'))     $img = 'hero.png';
                elseif (str_contains($name, 'express'))  $img = 'hero.png';
                else                                     $img = 'hero.png';

                // If the service has its own uploaded image, use that instead
                if (!empty($service->gambar)) {
                    $imgSrc = asset('storage/' . $service->gambar);
                } else {
                    $imgSrc = asset('images/' . $img);
                }
            @endphp
            <div class="service-card">
                <img src="{{ $imgSrc }}" alt="{{ $service->service_name }}" class="service-img">
                <h3>{{ $service->service_name }}</h3>
                <p>{{ $service->description }}</p>
                <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:0.75rem; margin-top:auto;">
                    <div class="service-price">Mulai Rp {{ number_format($service->price, 0, ',', '.') }}</div>
                    @auth
                        <a href="{{ route('order.create') }}" class="btn btn-primary" style="font-size:0.85rem; padding:0.55rem 1.1rem;">Pesan Sekarang</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary" style="font-size:0.85rem; padding:0.55rem 1.1rem;">Pesan Sekarang</a>
                    @endauth
                </div>
            </div>
            @endforeach
        @else
            <p style="text-align: center; width: 100%; color: var(--text-light);">Belum ada layanan yang tersedia saat ini.</p>
        @endif
    </div>
</section>
