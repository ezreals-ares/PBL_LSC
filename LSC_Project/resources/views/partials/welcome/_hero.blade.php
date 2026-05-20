{{-- ── Hero Section — Neo-Brutalism ──────────────────────────────── --}}
<section id="beranda" class="relative z-0 py-16 md:py-24 max-w-screen-xl mx-auto px-4 md:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

    {{-- ── Decorative Floating Shapes ──────────────────────────────── --}}
    <!-- Decoration 1 (Top Left) -->
    <img src="{{ asset('decoration/1.png') }}" alt="Decoration" class="gsap-deco absolute top-4 -left-10 md:left-[-10%] lg:left-[-15%] w-20 h-20 md:w-32 md:h-32 -z-10 opacity-80 md:opacity-100 object-contain" style="opacity: 0;">

    <!-- Decoration 2 (Bottom Left) -->
    <img src="{{ asset('decoration/2.png') }}" alt="Decoration" class="gsap-deco absolute bottom-8 -left-10 md:left-[-8%] lg:left-[-12%] w-24 h-24 md:w-36 md:h-36 -z-10 opacity-80 md:opacity-100 object-contain" style="opacity: 0;">

    <!-- Decoration 3 (Top Right) -->
    <img src="{{ asset('decoration/3.png') }}" alt="Decoration" class="gsap-deco absolute top-12 -right-10 md:right-[-10%] lg:right-[-15%] w-28 h-28 md:w-36 md:h-36 -z-10 opacity-80 md:opacity-100 object-contain" style="opacity: 0;">

    <!-- Decoration 4 (Bottom Right) -->
    <img src="{{ asset('decoration/4.png') }}" alt="Decoration" class="gsap-deco absolute bottom-12 -right-10 md:right-[-8%] lg:right-[-12%] w-20 h-20 md:w-28 md:h-28 -z-10 opacity-80 md:opacity-100 object-contain" style="opacity: 0;">

    {{-- Left: Content --}}
    <div class="order-2 lg:order-1">
        <span class="inline-block px-4 py-1 bg-secondary-container border-[3px] border-stroke font-grotesk font-bold uppercase tracking-wider text-on-secondary-container text-sm mb-6 neo-shadow-xs" style="opacity: 0;">
            Laundry Sepatu Premium
        </span>

        <h1 class="font-grotesk font-black uppercase tracking-tighter mb-6 leading-none text-on-surface" style="font-size: clamp(2.2rem, 6vw, 4rem); opacity: 0;">
            LOSE THE DIRT,<br>
            <span class="text-primary">KEEP THE SOUL.</span>
        </h1>

        <p class="text-on-surface-variant mb-10 max-w-lg leading-relaxed" style="font-size: 1.1rem; opacity: 0;">
            Kami tidak hanya membersihkan sepatu — kami memulihkan sejarahnya. Dari deep cleaning hingga whitening profesional, percayakan koleksimu kepada kami.
        </p>

        <div class="flex flex-col sm:flex-row gap-4">
            @auth
                <a href="{{ route('order.create') }}" class="neo-btn-primary py-4 px-8 text-base" style="opacity: 0;">
                    <span class="material-symbols-outlined">cleaning_services</span>
                    Pesan Sekarang
                </a>
                <a href="{{ route('order.history') }}" class="neo-btn-yellow py-4 px-8 text-base" style="opacity: 0;">
                    <span class="material-symbols-outlined">receipt_long</span>
                    Lacak Pesanan
                </a>
            @else
                <a href="{{ route('register') }}" class="neo-btn-primary py-4 px-8 text-base" style="opacity: 0;">
                    <span class="material-symbols-outlined">cleaning_services</span>
                    Mulai Pesan
                </a>
                <a href="#layanan" class="neo-btn-yellow py-4 px-8 text-base" style="opacity: 0;">
                    <span class="material-symbols-outlined">search</span>
                    Lihat Layanan
                </a>
            @endauth
        </div>

        {{-- Dynamic Stats --}}
        <div class="mt-12 flex flex-wrap gap-4" id="hero-stats">
            {{-- Total Orders --}}
            <div class="stat-card bg-white px-5 py-3 border-[3px] border-black flex items-center gap-4" style="box-shadow: 4px 4px 0 0 #000; opacity: 0;">
                <span class="material-symbols-outlined text-3xl" style="color: #0058be;">group</span>
                <div>
                    <p class="font-grotesk font-black text-2xl leading-none">{{ \App\Models\Order::count() }}<span class="text-primary">+</span></p>
                    <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mt-1">Pemesan</p>
                </div>
            </div>
            
            {{-- Total Reviews --}}
            <div class="stat-card bg-white px-5 py-3 border-[3px] border-black flex items-center gap-4" style="box-shadow: 4px 4px 0 0 #000; opacity: 0;">
                <span class="material-symbols-outlined text-3xl" style="color: #F97316; font-variation-settings: 'FILL' 1;">star</span>
                <div>
                    <p class="font-grotesk font-black text-2xl leading-none">{{ \App\Models\Review::count() }}<span class="text-primary">+</span></p>
                    <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mt-1">Ulasan</p>
                </div>
            </div>

            {{-- Total Services --}}
            <div class="stat-card bg-white px-5 py-3 border-[3px] border-black flex items-center gap-4" style="box-shadow: 4px 4px 0 0 #000; opacity: 0;">
                <span class="material-symbols-outlined text-3xl" style="color: #10B981;">cleaning_services</span>
                <div>
                    <p class="font-grotesk font-black text-2xl leading-none">{{ \App\Models\Service::count() }}</p>
                    <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mt-1">Layanan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="order-1 lg:order-2 flex justify-center items-center relative">
        <div class="absolute inset-0 bg-primary opacity-10 rounded-full blur-3xl scale-75 -z-10"></div>
        <img alt="Floating sneaker illustration with blue and yellow cleaning accents" class="w-full max-w-xl object-contain order-1-img" src="{{ asset('decoration/shose.png') }}" style="opacity: 0;" />
    </div>

</section>
