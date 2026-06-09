{{-- ── Neo-Brutalism Landing Navbar ─────────────────────────────── --}}
<header class="bg-white sticky top-0 z-50 border-b-[3px] border-stroke shadow-[0px_6px_0px_0px_rgba(0,0,0,1)]">
    <nav class="flex justify-between items-center w-full px-4 md:px-8 py-4 max-w-screen-xl mx-auto">

        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex items-center gap-3 group">
            <div class="h-10 md:h-12 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('decoration/logo_fix.png') }}" alt="Lose ShoesCare logo" class="h-full w-auto object-contain">
            </div>
            <span class="font-grotesk font-extrabold text-on-surface uppercase tracking-tighter text-lg">Lose ShoesCare</span>
        </a>

        {{-- Desktop Nav --}}
        <div class="hidden md:flex items-center gap-1" id="desktop-nav">
            <a href="{{ request()->is('/') ? '#beranda' : url('/#beranda') }}"    class="nav-link text-sm font-bold uppercase tracking-wide transition-all px-4 py-1.5 rounded-[20px] border-[2px] border-transparent text-on-surface-variant hover:text-primary">Beranda</a>
            <a href="{{ request()->is('/') ? '#layanan' : url('/#layanan') }}"    class="nav-link text-sm font-bold uppercase tracking-wide transition-all px-4 py-1.5 rounded-[20px] border-[2px] border-transparent text-on-surface-variant hover:text-primary">Layanan</a>
            <a href="{{ request()->is('/') ? '#cara-kerja' : url('/#cara-kerja') }}" class="nav-link text-sm font-bold uppercase tracking-wide transition-all px-4 py-1.5 rounded-[20px] border-[2px] border-transparent text-on-surface-variant hover:text-primary">Cara Kerja</a>
            <a href="{{ request()->is('/') ? '#ulasan' : url('/#ulasan') }}"     class="nav-link text-sm font-bold uppercase tracking-wide transition-all px-4 py-1.5 rounded-[20px] border-[2px] border-transparent text-on-surface-variant hover:text-primary">Ulasan</a>
            <a href="{{ request()->is('/') ? '#lokasi' : url('/#lokasi') }}"     class="nav-link text-sm font-bold uppercase tracking-wide transition-all px-4 py-1.5 rounded-[20px] border-[2px] border-transparent text-on-surface-variant hover:text-primary">Lokasi</a>
        </div>

        {{-- Auth Buttons --}}
        <div class="flex items-center gap-3">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ url('/admin') }}" class="neo-btn-primary text-sm py-2 px-4">
                        <span class="material-symbols-outlined text-sm">admin_panel_settings</span>
                        Admin Panel
                    </a>
                @else
                    <a href="{{ route('order.create') }}" class="neo-btn-yellow text-sm h-[42px] px-4 hidden sm:inline-flex">
                        <span class="material-symbols-outlined text-sm">shopping_cart</span>
                        Pesan Sekarang
                    </a>
                    {{-- User Dropdown --}}
                    <div class="relative" id="nav-user-dropdown">
                        <button onclick="document.getElementById('nav-drop-menu').classList.toggle('hidden'); document.getElementById('nav-chevron').style.transform = document.getElementById('nav-drop-menu').classList.contains('hidden') ? '' : 'rotate(180deg)'"
                            class="flex items-center justify-between gap-2 border-[3px] border-stroke bg-[#0058be] px-4 h-[42px] shadow-[4px_4px_0_0_#000] active:translate-y-[2px] active:translate-x-[2px] active:shadow-[2px_2px_0_0_#000] transition-all cursor-pointer">
                            <span class="font-grotesk font-bold text-white text-sm truncate max-w-[150px]">{{ auth()->user()->name }}</span>
                            <span class="material-symbols-outlined text-white text-sm transition-transform" id="nav-chevron">expand_more</span>
                        </button>
                        <div id="nav-drop-menu" class="hidden absolute top-[calc(100%+8px)] right-0 bg-white border-[3px] border-stroke neo-shadow min-w-[200px] z-50">
                            <div class="px-4 py-3 border-b-[2px] border-stroke bg-surface-container-low">
                                <p class="font-grotesk font-bold text-on-surface text-sm truncate">{{ auth()->user()->name }}</p>
                                <p class="text-on-surface-variant text-xs truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ route('order.history') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-on-surface hover:bg-secondary-container transition-colors">
                                <span class="material-symbols-outlined text-primary text-base">receipt_long</span> Pesanan Saya
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-on-surface hover:bg-secondary-container transition-colors">
                                <span class="material-symbols-outlined text-primary text-base">manage_accounts</span> Profil Saya
                            </a>
                            <div class="border-t-[2px] border-stroke">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-sm font-semibold text-danger hover:bg-red-50 transition-colors">
                                        <span class="material-symbols-outlined text-danger text-base">logout</span> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <a href="{{ route('login') }}" class="text-sm font-bold text-on-surface hover:text-primary transition-colors uppercase">Masuk</a>
                <a href="{{ route('register') }}" class="neo-btn-primary text-sm py-2 px-4">Daftar</a>
            @endauth

            {{-- Mobile toggle --}}
            <button onclick="document.getElementById('nav-mobile').classList.toggle('hidden')"
                class="md:hidden border-[3px] border-stroke p-2 bg-white neo-shadow-xs">
                <span class="material-symbols-outlined text-on-surface">menu</span>
            </button>
        </div>
    </nav>

    {{-- Mobile Menu --}}
    <div id="nav-mobile" class="hidden md:hidden border-t-[3px] border-stroke bg-surface px-4 py-4 space-y-2">
        <a href="{{ request()->is('/') ? '#beranda' : url('/#beranda') }}"    class="block py-2 px-4 font-bold uppercase text-sm text-on-surface hover:bg-secondary-container border-[2px] border-stroke transition-colors">Beranda</a>
        <a href="{{ request()->is('/') ? '#layanan' : url('/#layanan') }}"    class="block py-2 px-4 font-bold uppercase text-sm text-on-surface hover:bg-secondary-container border-[2px] border-stroke transition-colors">Layanan</a>
        <a href="{{ request()->is('/') ? '#cara-kerja' : url('/#cara-kerja') }}" class="block py-2 px-4 font-bold uppercase text-sm text-on-surface hover:bg-secondary-container border-[2px] border-stroke transition-colors">Cara Kerja</a>
        <a href="{{ request()->is('/') ? '#ulasan' : url('/#ulasan') }}"     class="block py-2 px-4 font-bold uppercase text-sm text-on-surface hover:bg-secondary-container border-[2px] border-stroke transition-colors">Ulasan</a>
        <a href="{{ request()->is('/') ? '#lokasi' : url('/#lokasi') }}"     class="block py-2 px-4 font-bold uppercase text-sm text-on-surface hover:bg-secondary-container border-[2px] border-stroke transition-colors">Lokasi</a>
        @guest
            <a href="{{ route('login') }}"    class="block py-2 px-4 font-bold uppercase text-sm text-on-surface hover:bg-secondary-container border-[2px] border-stroke transition-colors">Masuk</a>
            <a href="{{ route('register') }}" class="block py-2 px-4 font-bold uppercase text-sm bg-primary text-white border-[2px] border-stroke">Daftar</a>
        @endguest
        @auth
            @if(auth()->user()->role !== 'admin')
                <a href="{{ route('order.create') }}"  class="block py-2 px-4 font-bold uppercase text-sm bg-secondary-container text-on-secondary-container border-[2px] border-stroke">Pesan Sekarang</a>
                <a href="{{ route('order.history') }}" class="block py-2 px-4 font-bold uppercase text-sm text-on-surface hover:bg-secondary-container border-[2px] border-stroke transition-colors">Pesanan Saya</a>
            @endif
        @endauth
    </div>
</header>

{{-- Close dropdown on outside click --}}
<script>
document.addEventListener('click', function(e) {
    const c = document.getElementById('nav-user-dropdown');
    const m = document.getElementById('nav-drop-menu');
    if (c && m && !c.contains(e.target)) {
        m.classList.add('hidden');
        const ch = document.getElementById('nav-chevron');
        if (ch) ch.style.transform = '';
    }
});
</script>

<script>
    // Scroll Spy for Navbar
    window.initScrollSpy = function() {
        const navLinks = document.querySelectorAll('.nav-link');
        if (navLinks.length === 0) return;

        function updateActiveLink() {
            let current = 'beranda'; // Default
            
            const sections = document.querySelectorAll('header[id], section[id]');
            if (sections.length > 0) {
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    // Offset of 150px to trigger just before the section hits top
                    if (window.scrollY >= (sectionTop - 150)) {
                        current = section.getAttribute('id');
                    }
                });

                // Edge case for reaching the bottom
                const scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
                if (scrollableHeight > 0 && window.scrollY >= scrollableHeight - 50) {
                    current = 'lokasi';
                }
            } else {
                // If not on landing page, we can highlight beranda or nothing. 
                // We'll leave it as 'beranda' so the Home link is active.
            }

            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && href.endsWith('#' + current)) {
                    link.classList.remove('border-transparent', 'text-on-surface-variant', 'hover:text-primary');
                    link.classList.add('bg-[#fed01b]', 'border-black', 'text-black', 'shadow-[3px_3px_0_0_#000]', '-translate-y-[2px]');
                } else {
                    link.classList.add('border-transparent', 'text-on-surface-variant', 'hover:text-primary');
                    link.classList.remove('bg-[#fed01b]', 'border-black', 'text-black', 'shadow-[3px_3px_0_0_#000]', '-translate-y-[2px]');
                }
            });
        }
        
        // Remove old listener if exists to prevent duplicates during Barba transitions
        window.removeEventListener('scroll', window.scrollSpyHandler);
        window.scrollSpyHandler = updateActiveLink;
        window.addEventListener('scroll', window.scrollSpyHandler);
        
        // Initial call
        updateActiveLink();
    };

    // Run on load
    window.initScrollSpy();
</script>
