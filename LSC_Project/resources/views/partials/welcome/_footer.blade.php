{{-- ── Footer — Premium Light Neo-Brutalism ───────────────────────────────────── --}}
<footer class="bg-[#e6e8eb] border-t-[3px] border-black mt-16 font-sans">
    <div class="max-w-[1400px] mx-auto px-6 md:px-12 pt-16 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8">
            
            {{-- Brand & Info (Col-span-4) --}}
            <div class="md:col-span-12 lg:col-span-4 flex flex-col justify-between">
                <div>
                    <h3 class="font-grotesk font-black text-black text-xl md:text-2xl mb-6 uppercase tracking-tight">Lose Shoescare</h3>
                    <p class="text-[#4b4d52] text-[15px] leading-relaxed mb-8 max-w-sm">
                        The world's first neo-brutalist sneaker maintenance facility. We treat every pair like a masterpiece, keeping your collection immortal.
                    </p>
                    <div class="flex gap-3 mb-12">
                        {{-- Discord / Forum --}}
                        <a href="#" class="w-12 h-12 bg-white border-[3px] border-black flex items-center justify-center hover:-translate-y-1 hover:-translate-x-1 active:translate-y-0 active:translate-x-0 transition-all shadow-[3px_3px_0_0_#000] hover:shadow-[5px_5px_0_0_#000] active:shadow-none">
                            <span class="material-symbols-outlined text-black font-bold" style="font-variation-settings:'FILL' 1">forum</span>
                        </a>
                        {{-- X / Close --}}
                        <a href="#" class="w-12 h-12 bg-white border-[3px] border-black flex items-center justify-center hover:-translate-y-1 hover:-translate-x-1 active:translate-y-0 active:translate-x-0 transition-all shadow-[3px_3px_0_0_#000] hover:shadow-[5px_5px_0_0_#000] active:shadow-none">
                            <span class="material-symbols-outlined text-black font-bold">close</span>
                        </a>
                        {{-- Instagram / Camera --}}
                        <a href="#" class="w-12 h-12 bg-white border-[3px] border-black flex items-center justify-center hover:-translate-y-1 hover:-translate-x-1 active:translate-y-0 active:translate-x-0 transition-all shadow-[3px_3px_0_0_#000] hover:shadow-[5px_5px_0_0_#000] active:shadow-none">
                            <span class="material-symbols-outlined text-black font-bold" style="font-variation-settings:'FILL' 1">photo_camera</span>
                        </a>
                    </div>
                </div>
                <div class="text-[11px] md:text-xs font-bold text-[#4b4d52] uppercase tracking-widest hidden lg:block">
                    © {{ date('Y') }} LOSE SHOESCARE. KEEP 'EM FRESH.
                </div>
            </div>

            {{-- Links section (Col-span-5) --}}
            <div class="md:col-span-12 lg:col-span-5 grid grid-cols-2 sm:grid-cols-3 gap-8">
                
                {{-- Services --}}
                <div>
                    <h4 class="font-grotesk font-black text-black uppercase text-lg mb-6 tracking-tight">Services</h4>
                    <ul class="space-y-4">
                        <li><a href="#layanan" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Deep Clean</a></li>
                        <li><a href="#layanan" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Restoration</a></li>
                        <li><a href="#layanan" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Repainting</a></li>
                        <li><a href="#layanan" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Deodorization</a></li>
                    </ul>
                </div>

                {{-- Company --}}
                <div>
                    <h4 class="font-grotesk font-black text-black uppercase text-lg mb-6 tracking-tight">Company</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">About Us</a></li>
                        <li><a href="#lokasi" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Locations</a></li>
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Sustainability</a></li>
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Careers</a></li>
                    </ul>
                </div>

                {{-- Support --}}
                <div>
                    <h4 class="font-grotesk font-black text-black uppercase text-lg mb-6 tracking-tight">Support</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Pricing</a></li>
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Privacy Policy</a></li>
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Terms of Service</a></li>
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Contact Support</a></li>
                    </ul>
                </div>

            </div>

            {{-- Newsletter (Col-span-3) --}}
            <div class="md:col-span-12 lg:col-span-3">
                <h4 class="font-grotesk font-black text-black uppercase text-lg mb-6 tracking-tight">Newsletter</h4>
                <p class="text-xs font-bold text-[#4b4d52] uppercase tracking-wider mb-4">
                    Get Maintenance Tips
                </p>
                <form class="flex flex-col gap-4">
                    <input type="email" placeholder="EMAIL ADDRESS" class="w-full h-12 px-4 bg-white border-[3px] border-black text-[13px] font-bold text-black uppercase placeholder-[#888] focus:outline-none focus:ring-0 shadow-[4px_4px_0_0_#000] transition-shadow">
                    <button type="button" class="w-full h-12 bg-[#0058be] text-white border-[3px] border-black font-bold uppercase text-[13px] tracking-widest flex justify-center items-center gap-2 hover:bg-[#004ca3] active:translate-y-[2px] active:translate-x-[2px] shadow-[4px_4px_0_0_#000] active:shadow-[2px_2px_0_0_#000] transition-all">
                        Join <span class="material-symbols-outlined text-sm font-bold">arrow_forward</span>
                    </button>
                </form>
                
                <div class="text-[11px] md:text-xs font-bold text-[#4b4d52] uppercase tracking-widest mt-12 block lg:hidden text-center md:text-left">
                    © {{ date('Y') }} LOSE SHOESCARE. KEEP 'EM FRESH.
                </div>
            </div>

        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="border-t-[2px] border-black/10 bg-[#e6e8eb]">
        <div class="max-w-[1400px] mx-auto px-6 md:px-12 py-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex flex-wrap justify-center items-center gap-6 md:gap-10">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#0058be] text-[20px] font-medium">verified</span>
                    <span class="text-xs font-bold text-[#0058be] uppercase tracking-wide">Certified Restoration</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#10b981] text-[20px] font-medium">eco</span>
                    <span class="text-xs font-bold text-[#10b981] uppercase tracking-wide">Eco-Friendly Process</span>
                </div>
            </div>
            <span class="text-xs font-bold text-[#4b4d52] uppercase tracking-widest">
                Designed for the streets.
            </span>
        </div>
    </div>
</footer>
