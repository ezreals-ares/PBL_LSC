{{-- ── Services Section — Bento Grid ──────────────────────────────── --}}
<section id="layanan" class="py-16 max-w-screen-xl mx-auto px-4 md:px-8">

    <h2 class="font-grotesk font-bold text-3xl mb-16 uppercase tracking-tighter flex items-center gap-4 gsap-fade-up">
        <span style="display:block;width:3rem;height:0.25rem;background:#000;flex-shrink:0;"></span>
        Layanan Kami
    </h2>

    @if($services->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 gsap-stagger-container" id="services-grid">
            @foreach($services as $index => $service)
                @php
                    $isFeatured = $index === 1;
                    $isThird = $index === 2;
                    $bgClass    = $isFeatured ? 'bg-secondary-container' : 'bg-surface-container-lowest';
                    $iconBg     = $isFeatured ? 'bg-white border-stroke' : ($isThird ? 'bg-tertiary-fixed border-stroke' : 'bg-primary-container border-stroke');
                    $iconColor  = $isFeatured ? 'text-on-surface' : ($isThird ? 'text-on-tertiary-fixed' : 'text-on-primary-container');
                    $priceColor = $isFeatured ? 'text-on-secondary-container' : 'text-primary';
                    // Pick icon by service name keywords
                    $name = strtolower($service->service_name);
                    $icon = 'cleaning_services';
                    if (str_contains($name, 'white') || str_contains($name, 'putih')) $icon = 'auto_fix_high';
                    elseif (str_contains($name, 'reglue') || str_contains($name, 'lem') || str_contains($name, 'sol')) $icon = 'build';
                    elseif (str_contains($name, 'deep') || str_contains($name, 'cuci')) $icon = 'soap';
                    elseif (str_contains($name, 'repaint') || str_contains($name, 'cat')) $icon = 'format_paint';
                    elseif (str_contains($name, 'protect') || str_contains($name, 'proteksi')) $icon = 'shield';
                    $isHidden = $index >= 3;
                @endphp
                <div class="gsap-stagger-item {{ $isHidden ? 'hidden hidden-service' : '' }}">
                    <div class="neo-card {{ $bgClass }} flex flex-col h-full group hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[8px_8px_0px_0px_#000] transition-all duration-100 overflow-hidden">
                        {{-- Image / Icon box --}}
                        @if($service->gambar)
                            <div class="w-full h-64 border-b-[3px] border-stroke overflow-hidden bg-white shrink-0">
                                <img src="{{ Storage::url($service->gambar) }}" alt="{{ $service->service_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                        @else
                            <div class="p-8 flex flex-col flex-grow">
                                <div class="w-16 h-16 {{ $iconBg }} border-[3px] flex items-center justify-center mb-6 shrink-0">
                                    <span class="material-symbols-outlined {{ $iconColor }} text-4xl">{{ $icon }}</span>
                                </div>
                        @endif

                                {{-- Title --}}
                                <h3 class="font-grotesk font-black text-black text-2xl uppercase tracking-tight leading-none mb-4">{{ $service->service_name }}</h3>

                                <p class="text-sm text-on-surface-variant leading-relaxed mb-6 flex-grow">
                                    {{ $service->description ?? 'Layanan perawatan sepatu profesional dengan hasil terbaik dan terjamin.' }}
                                </p>

                                <div class="flex flex-col gap-4 mt-auto">
                                    <div class="flex flex-wrap items-center justify-between gap-2">
                                        {{-- Price Box (Yellow) --}}
                                        <div class="bg-[#fed01b] border-[3px] border-stroke px-4 py-2 text-black font-grotesk font-black text-lg" style="box-shadow: 3px 3px 0 0 #000;">
                                            Rp {{ number_format($service->price, 0, ',', '.') }}
                                        </div>
                                        
                                        @if($service->estimated_days)
                                            <span class="text-xs font-bold text-black uppercase border-[2px] border-stroke px-2 py-1 bg-white" style="box-shadow: 2px 2px 0 0 #000;">
                                                ~{{ $service->estimated_days }} hari
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Order Button (Blue Box) --}}
                                    <a href="{{ route('order.create', ['service' => $service->service_id]) }}" class="bg-[#0058be] text-white border-[3px] border-black px-4 py-3 font-grotesk font-bold text-base uppercase flex justify-center items-center gap-2 shadow-[4px_4px_0_0_#000] active:translate-y-[2px] active:translate-x-[2px] active:shadow-[2px_2px_0_0_#000] transition-all">
                                        <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">shopping_cart</span>
                                        Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>
            @endforeach

            {{-- Custom Needs CTA card --}}
            @php
                $isHiddenCTA = $services->count() >= 3;
                $ctaOutlet   = $outlets->first();
                $ctaWaNum    = null;
                if ($ctaOutlet && $ctaOutlet->phone) {
                    $ctaWaNum = preg_replace('/[^0-9]/', '', $ctaOutlet->phone);
                    if (str_starts_with($ctaWaNum, '0')) $ctaWaNum = '62' . substr($ctaWaNum, 1);
                }
            @endphp
            <div class="gsap-stagger-item {{ $isHiddenCTA ? 'hidden hidden-service' : '' }}">
                <div class="neo-card bg-surface p-8 flex flex-col h-full items-center justify-center text-center">
                    <span class="material-symbols-outlined text-6xl text-primary mb-4">add_circle</span>
                    <h3 class="font-grotesk font-bold text-xl uppercase mb-2">Kebutuhan Lain?</h3>
                    <p class="text-sm text-on-surface-variant mb-6">Kami siap membantu repaint, sole swap, dan perawatan khusus lainnya.</p>
                    @if($ctaWaNum)
                        <a href="https://wa.me/{{ $ctaWaNum }}?text=Halo+Lose+ShoesCare%2C+saya+ingin+bertanya+tentang+layanan+khusus..."
                           target="_blank"
                           class="flex items-center justify-center gap-2 border-[3px] border-black px-5 py-3 font-grotesk font-bold uppercase text-sm text-black w-full shadow-[4px_4px_0_0_#000] active:translate-y-[2px] active:translate-x-[2px] active:shadow-[2px_2px_0_0_#000] transition-all"
                           style="background-color: #25D366;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" class="w-5 h-5">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.534 5.86L.058 23.486a.5.5 0 0 0 .614.614l5.637-1.476A11.952 11.952 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.831 9.831 0 0 1-5.018-1.374l-.36-.214-3.727.977.997-3.645-.235-.374A9.865 9.865 0 0 1 2.182 12C2.182 6.578 6.578 2.182 12 2.182S21.818 6.578 21.818 12 17.422 21.818 12 21.818z"/>
                            </svg>
                            Hubungi Kami
                        </a>
                    @else
                        <a href="{{ route('order.create') }}" class="font-grotesk font-bold text-sm uppercase underline decoration-[3px] underline-offset-4 hover:text-primary transition-colors">
                            PESAN SEKARANG →
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @else
        {{-- Fallback static cards if no services in DB --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 gsap-stagger-container" id="services-grid">
            @foreach([
                ['Deep Clean','soap','Cuci menyeluruh setiap bagian sepatu dengan bahan ramah lingkungan.','bg-surface-container-lowest','text-primary'],
                ['Whitening','auto_fix_high','Kembalikan sole putihmu dengan treatment UV khusus.','bg-secondary-container','text-on-secondary-container'],
                ['Reglue','build','Reattachment sol dengan lem industrial — sol tidak akan lepas lagi.','bg-surface-container-lowest','text-primary'],
            ] as [$title, $icon, $desc, $bg, $price])
                <div class="gsap-stagger-item">
                    <div class="neo-card {{ $bg }} p-8 flex flex-col h-full">
                        <div class="w-16 h-16 bg-primary-container border-[3px] border-stroke flex items-center justify-center mb-6 shrink-0">
                            <span class="material-symbols-outlined text-on-primary-container text-4xl">{{ $icon }}</span>
                        </div>
                        
                        {{-- Title --}}
                        <h3 class="font-grotesk font-black text-black text-2xl uppercase tracking-tight leading-none mb-4">{{ $title }}</h3>

                        <p class="text-sm text-on-surface-variant leading-relaxed mb-6 flex-grow">{{ $desc }}</p>

                        <div class="flex flex-col gap-4 mt-auto">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                {{-- Price Box (Yellow) --}}
                                <div class="bg-[#fed01b] border-[3px] border-stroke px-4 py-2 text-black font-grotesk font-black text-lg" style="box-shadow: 3px 3px 0 0 #000;">
                                    Rp 0
                                </div>
                            </div>

                            {{-- Order Button (Blue Box) --}}
                            <a href="{{ route('order.create') }}" class="bg-[#0058be] text-white border-[3px] border-black px-4 py-3 font-grotesk font-bold text-base uppercase flex justify-center items-center gap-2 shadow-[4px_4px_0_0_#000] active:translate-y-[2px] active:translate-x-[2px] active:shadow-[2px_2px_0_0_#000] transition-all">
                                <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">shopping_cart</span>
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Show More Button --}}
    @if($services->count() + 1 > 3)
    <div class="mt-12 flex justify-center gsap-fade-up" id="show-more-container">
        <button id="btn-show-more-services" class="neo-btn-primary py-4 px-10 text-base font-grotesk font-bold uppercase tracking-tight cursor-pointer">
            <span class="material-symbols-outlined">expand_more</span>
            Lihat Semua Layanan
        </button>
    </div>
    @endif
</section>
