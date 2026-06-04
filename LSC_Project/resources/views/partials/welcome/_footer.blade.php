{{-- ── Footer — Premium Light Neo-Brutalism ───────────────────────────────────── --}}
<footer class="bg-[#e6e8eb] border-t-[3px] border-black mt-16 font-sans">
    <div class="max-w-[1400px] mx-auto px-6 md:px-12 pt-16 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8">
            
            {{-- Brand & Info (Col-span-4) --}}
            <div class="md:col-span-12 lg:col-span-4 flex flex-col justify-between">
                <div>
                    <h3 class="font-grotesk font-black text-black text-xl md:text-2xl mb-6 uppercase tracking-tight">Lose Shoescare</h3>
                    <p class="text-[#4b4d52] text-[15px] leading-relaxed mb-8 max-w-sm">
                        Solusi perawatan sneaker terpercaya untuk menjaga koleksi sepatumu selalu bersih dan terawat.
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
                    © {{ date('Y') }} LOSE SHOESCARE. JAGA SEPATUMU TETAP BERSIH.
                </div>
            </div>

            {{-- Links section (Col-span-8) --}}
            <div class="md:col-span-12 lg:col-span-8 grid grid-cols-2 sm:grid-cols-3 gap-8">
                
                {{-- Services --}}
                <div>
                    <h4 class="font-grotesk font-black text-black uppercase text-lg mb-6 tracking-tight">Layanan</h4>
                    <ul class="space-y-4">
                        <li><a href="#layanan" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Cuci Dalam</a></li>
                        <li><a href="#layanan" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Restorasi</a></li>
                        <li><a href="#layanan" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Pewarnaan Ulang</a></li>
                        <li><a href="#layanan" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Penghilang Bau</a></li>
                    </ul>
                </div>

                {{-- Company --}}
                <div>
                    <h4 class="font-grotesk font-black text-black uppercase text-lg mb-6 tracking-tight">Perusahaan</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Tentang Kami</a></li>
                        <li><a href="#lokasi" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Lokasi</a></li>
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Keberlanjutan</a></li>
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Karir</a></li>
                    </ul>
                </div>

                {{-- Support --}}
                <div>
                    <h4 class="font-grotesk font-black text-black uppercase text-lg mb-6 tracking-tight">Dukungan</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Harga</a></li>
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Hubungi Kami</a></li>
                    </ul>
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
                    <span class="text-xs font-bold text-[#0058be] uppercase tracking-wide">Restorasi Bersertifikat</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#10b981] text-[20px] font-medium">eco</span>
                    <span class="text-xs font-bold text-[#10b981] uppercase tracking-wide">Proses Ramah Lingkungan</span>
                </div>
            </div>
            <span class="text-xs font-bold text-[#4b4d52] uppercase tracking-widest">
                Dirancang untuk jalanan.
            </span>
        </div>
    </div>
</footer>
