{{-- ── Footer — Premium Light Neo-Brutalism ───────────────────────────────────── --}}
<footer class="bg-[#e6e8eb] border-t-[3px] border-black mt-16 font-sans">
    <div class="max-w-[1400px] mx-auto px-6 md:px-12 pt-16 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            {{-- Brand & Info --}}
            <div class="flex flex-col justify-between">
                <div>
                    <h3 class="font-grotesk font-black text-black text-xl md:text-2xl mb-6 uppercase tracking-tight">Lose Shoescare</h3>
                    <p class="text-[#4b4d52] text-[15px] leading-relaxed mb-8 max-w-sm">
                        Solusi perawatan sepatu terpercaya untuk menjaga koleksi sepatumu selalu bersih dan terawat.
                    </p>
                </div>
                <div class="text-[11px] md:text-xs font-bold text-[#4b4d52] uppercase tracking-widest hidden lg:block">
                    © {{ date('Y') }} LOSE SHOESCARE. JAGA SEPATUMU TETAP BERSIH.
                </div>
            </div>

            {{-- Pintasan (Tengah) --}}
            <div class="lg:flex lg:flex-col lg:items-center">
                <div>
                    <h4 class="font-grotesk font-black text-black uppercase text-lg mb-6 tracking-tight">Pintasan</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('landing') }}#" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Beranda</a></li>
                        <li><a href="{{ route('landing') }}#layanan" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Layanan</a></li>
                        <li><a href="{{ route('landing') }}#ulasan" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Ulasan</a></li>
                        <li><a href="{{ route('landing') }}#lokasi" class="text-[15px] font-medium text-[#4b4d52] hover:text-black hover:underline underline-offset-4 decoration-2 transition-all">Lokasi</a></li>
                    </ul>
                </div>
            </div>

            {{-- Dukungan: Social Media --}}
            <div>
                <h4 class="font-grotesk font-black text-black uppercase text-lg mb-6 tracking-tight">Sosial Media</h4>
                <div class="flex gap-3">
                    {{-- WhatsApp --}}
                    @php
                        $footerOutlet = isset($outlets) ? $outlets->first() : \App\Models\Outlet::first();
                        $footerWaNum  = null;
                        if ($footerOutlet && $footerOutlet->phone) {
                            $footerWaNum = preg_replace('/[^0-9]/', '', $footerOutlet->phone);
                            if (str_starts_with($footerWaNum, '0')) $footerWaNum = '62' . substr($footerWaNum, 1);
                        }
                    @endphp
                    <a href="https://wa.me/6285748618712?text=Halo+Lose+ShoesCare%2C+saya+ingin+cuci+sepatu..."
                       target="_blank"
                       title="WhatsApp"
                       class="w-12 h-12 bg-[#25D366] border-[3px] border-black flex items-center justify-center hover:-translate-y-1 hover:-translate-x-1 active:translate-y-0 active:translate-x-0 transition-all shadow-[3px_3px_0_0_#000] hover:shadow-[5px_5px_0_0_#000] active:shadow-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" class="w-5 h-5">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.534 5.86L.058 23.486a.5.5 0 0 0 .614.614l5.637-1.476A11.952 11.952 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.831 9.831 0 0 1-5.018-1.374l-.36-.214-3.727.977.997-3.645-.235-.374A9.865 9.865 0 0 1 2.182 12C2.182 6.578 6.578 2.182 12 2.182S21.818 6.578 21.818 12 17.422 21.818 12 21.818z"/>
                        </svg>
                    </a>

                    {{-- Instagram --}}
                    <a href="https://www.instagram.com/lose.shoescare?igsh=YjloaGVsaXFndDg3" target="_blank" title="Instagram"
                       class="w-12 h-12 border-[3px] border-black flex items-center justify-center hover:-translate-y-1 hover:-translate-x-1 active:translate-y-0 active:translate-x-0 transition-all shadow-[3px_3px_0_0_#000] hover:shadow-[5px_5px_0_0_#000] active:shadow-none"
                       style="background-color:#E1306C;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-5 h-5">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>

                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/share/1UofHmq8wY/?mibextid=wwXIfr" target="_blank" title="Facebook"
                       class="w-12 h-12 border-[3px] border-black flex items-center justify-center hover:-translate-y-1 hover:-translate-x-1 active:translate-y-0 active:translate-x-0 transition-all shadow-[3px_3px_0_0_#000] hover:shadow-[5px_5px_0_0_#000] active:shadow-none"
                       style="background-color:#1877F2;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-5 h-5">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
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
        </div>
    </div>
</footer>
