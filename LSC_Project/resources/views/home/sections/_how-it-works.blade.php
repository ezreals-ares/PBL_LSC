{{-- ── How It Works Section ─────────────────────────────────────── --}}
<section id="cara-kerja" class="py-20 border-y-[3px] border-stroke" style="background-color: #f2f3fd;">
    <div class="max-w-screen-xl mx-auto px-4 md:px-8">

        <h2 class="font-grotesk font-bold text-3xl mb-4 uppercase tracking-tighter flex items-center gap-4 gsap-fade-up">
            <span style="display:block;width:3rem;height:0.25rem;background:#000;flex-shrink:0;"></span>
            Cara Kerja
        </h2>
        <p class="text-sm mb-14 gsap-fade-up" style="color:#424754; max-width:520px;">
            <!-- Dari pemesanan hingga ulasan — semua bisa dilakukan secara online dengan mudah, cepat, dan transparan. -->
        </p>

        {{-- ── Row 1: Steps 01–03 ── --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-6 relative z-10 gsap-stagger-container items-stretch mb-8">

            {{-- ── Step 1 ── --}}
            <div class="flex flex-col items-center gsap-stagger-item h-full">
                <div class="w-16 h-16 rounded-full border-[3px] border-black flex items-center justify-center font-grotesk font-black text-lg relative z-20"
                     style="background-color:#fed01b; color:#000; box-shadow:3px 3px 0 0 #000; flex-shrink:0;">
                    01
                </div>
                <div class="w-full h-full mt-[-2rem] border-[3px] border-black bg-white flex flex-col items-center text-center p-8 pt-14 relative z-10"
                     style="border-radius:16px; box-shadow:6px 6px 0 0 #000;">
                    <span class="material-symbols-outlined mb-5" style="font-size:3rem;color:#0058be;font-variation-settings:'FILL' 0;">person_add</span>
                    <h3 class="font-grotesk font-bold text-xl mb-4" style="color:#191b23;">Daftar & Masuk Akun</h3>
                    <p class="text-sm leading-relaxed" style="color:#424754;">
                        Buat akun baru atau masuk ke akun Anda. Hanya pelanggan yang sudah login yang dapat membuat pesanan.
                    </p>
                </div>
            </div>

            {{-- ── Step 2 (Featured — Blue) ── --}}
            <div class="flex flex-col items-center gsap-stagger-item h-full">
                <div class="w-16 h-16 rounded-full border-[3px] border-black flex items-center justify-center font-grotesk font-black text-lg relative z-20"
                     style="background-color:#fed01b; color:#000; box-shadow:3px 3px 0 0 #000; flex-shrink:0;">
                    02
                </div>
                <div class="w-full h-full mt-[-2rem] border-[3px] border-black flex flex-col items-center text-center p-8 pt-14 relative z-10"
                     style="background-color:#0058be; border-radius:16px; box-shadow:6px 6px 0 0 #000;">
                    <span class="material-symbols-outlined mb-5" style="font-size:3rem;color:#fed01b;font-variation-settings:'FILL' 0;">add_shopping_cart</span>
                    <h3 class="font-grotesk font-bold text-xl mb-4" style="color:#fff;">Buat Pesanan</h3>
                    <p class="text-sm leading-relaxed" style="color:rgba(255,255,255,0.85);">
                        Pilih layanan cuci, restorasi, atau proteksi. Tentukan jumlah sepatu, jenis material, metode pengiriman (antar langsung ke outlet atau dijemput), dan tambahkan catatan jika perlu.
                    </p>
                </div>
            </div>

            {{-- ── Step 3 ── --}}
            <div class="flex flex-col items-center gsap-stagger-item h-full">
                <div class="w-16 h-16 rounded-full border-[3px] border-black flex items-center justify-center font-grotesk font-black text-lg relative z-20"
                     style="background-color:#fed01b; color:#000; box-shadow:3px 3px 0 0 #000; flex-shrink:0;">
                    03
                </div>
                <div class="w-full h-full mt-[-2rem] border-[3px] border-black bg-white flex flex-col items-center text-center p-8 pt-14 relative z-10"
                     style="border-radius:16px; box-shadow:6px 6px 0 0 #000;">
                    <span class="material-symbols-outlined mb-5" style="font-size:3rem;color:#F59E0B;font-variation-settings:'FILL' 0;">receipt_long</span>
                    <h3 class="font-grotesk font-bold text-xl mb-4" style="color:#191b23;">Upload Bukti Pembayaran</h3>
                    <p class="text-sm leading-relaxed" style="color:#424754;">
                        Lakukan pembayaran via QRIS atau transfer bank, lalu upload bukti pembayaran Anda. Admin akan memverifikasi dan pesanan Anda segera diproses.
                    </p>
                </div>
            </div>

        </div>

        {{-- ── Row 2: Steps 04–05 centered ── --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-6 relative z-10 gsap-stagger-container items-stretch md:max-w-2xl md:mx-auto">

            {{-- ── Step 4 ── --}}
            <div class="flex flex-col items-center gsap-stagger-item h-full">
                <div class="w-16 h-16 rounded-full border-[3px] border-black flex items-center justify-center font-grotesk font-black text-lg relative z-20"
                     style="background-color:#fed01b; color:#000; box-shadow:3px 3px 0 0 #000; flex-shrink:0;">
                    04
                </div>
                <div class="w-full h-full mt-[-2rem] border-[3px] border-black bg-white flex flex-col items-center text-center p-8 pt-14 relative z-10"
                     style="border-radius:16px; box-shadow:6px 6px 0 0 #000;">
                    <span class="material-symbols-outlined mb-5" style="font-size:3rem;color:#0058be;font-variation-settings:'FILL' 0;">local_laundry_service</span>
                    <h3 class="font-grotesk font-bold text-xl mb-4" style="color:#191b23;">Pengerjaan & Pelacakan</h3>
                    <p class="text-sm leading-relaxed" style="color:#424754;">
                        Tim kami mengerjakan sepatu Anda. Pantau status pesanan secara real-time — mulai dari <em>pending</em>, <em>diproses</em>, hingga <em>siap dikirim</em> — langsung dari halaman pesanan Anda.
                    </p>
                </div>
            </div>

            {{-- ── Step 5 (Featured — Blue) ── --}}
            <div class="flex flex-col items-center gsap-stagger-item h-full">
                <div class="w-16 h-16 rounded-full border-[3px] border-black flex items-center justify-center font-grotesk font-black text-lg relative z-20"
                     style="background-color:#fed01b; color:#000; box-shadow:3px 3px 0 0 #000; flex-shrink:0;">
                    05
                </div>
                <div class="w-full h-full mt-[-2rem] border-[3px] border-black flex flex-col items-center text-center p-8 pt-14 relative z-10"
                     style="background-color:#0058be; border-radius:16px; box-shadow:6px 6px 0 0 #000;">
                    <span class="material-symbols-outlined mb-5" style="font-size:3rem;color:#fed01b;font-variation-settings:'FILL' 0;">star</span>
                    <h3 class="font-grotesk font-bold text-xl mb-4" style="color:#fff;">Terima & Beri Ulasan</h3>
                    <p class="text-sm leading-relaxed" style="color:rgba(255,255,255,0.85);">
                        Setelah pesanan selesai, terima sepatu Anda kembali bersih seperti baru. Berikan rating bintang dan ulasan pengalaman Anda — ulasan bisa disertai foto dan dapat diedit kapan saja.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>
