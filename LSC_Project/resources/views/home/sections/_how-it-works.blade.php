{{-- ── How It Works Section ─────────────────────────────────────── --}}
<section id="cara-kerja" class="py-20 border-y-[3px] border-stroke" style="background-color: #f2f3fd;">
    <div class="max-w-screen-xl mx-auto px-4 md:px-8">

        <h2 class="font-grotesk font-bold text-3xl mb-16 uppercase tracking-tighter flex items-center gap-4 gsap-fade-up">
            <span style="display:block;width:3rem;height:0.25rem;background:#000;flex-shrink:0;"></span>
            Cara Kerja
        </h2>

        {{-- Steps grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-6 relative z-10 gsap-stagger-container items-stretch">


            {{-- ── Step 1 ── --}}
            <div class="flex flex-col items-center gsap-stagger-item h-full">
                {{-- Yellow badge --}}
                <div class="w-16 h-16 rounded-full border-[3px] border-black flex items-center justify-center font-grotesk font-black text-lg relative z-20"
                     style="background-color:#fed01b; color:#000; box-shadow:3px 3px 0 0 #000; flex-shrink:0;">
                    01
                </div>
                {{-- Card --}}
                <div class="w-full h-full mt-[-2rem] border-[3px] border-black bg-white flex flex-col items-center text-center p-8 pt-14 relative z-10"
                     style="border-radius:16px; box-shadow:6px 6px 0 0 #000;">
                    <span class="material-symbols-outlined mb-5" style="font-size:3rem;color:#0058be;font-variation-settings:'FILL' 0;">cleaning_services</span>
                    <h3 class="font-grotesk font-bold text-xl mb-4" style="color:#191b23;">Pilih Perawatan Anda</h3>
                    <p class="text-sm leading-relaxed" style="color:#424754;">
                        Pilih dari berbagai layanan pembersihan, restorasi, atau proteksi kami yang disesuaikan khusus untuk bahan sepatu Anda.
                    </p>
                </div>
            </div>

            {{-- ── Step 2 (Featured — Blue) ── --}}
            <div class="flex flex-col items-center gsap-stagger-item h-full">
                {{-- Yellow badge --}}
                <div class="w-16 h-16 rounded-full border-[3px] border-black flex items-center justify-center font-grotesk font-black text-lg relative z-20"
                     style="background-color:#fed01b; color:#000; box-shadow:3px 3px 0 0 #000; flex-shrink:0;">
                    02
                </div>
                {{-- Card — Blue featured --}}
                <div class="w-full h-full mt-[-2rem] border-[3px] border-black flex flex-col items-center text-center p-8 pt-14 relative z-10"
                     style="background-color:#0058be; border-radius:16px; box-shadow:6px 6px 0 0 #000;">
                    <span class="material-symbols-outlined mb-5" style="font-size:3rem;color:#fff;font-variation-settings:'FILL' 0;">location_on</span>
                    <h3 class="font-grotesk font-bold text-xl mb-4" style="color:#fff;">Drop-off atau Antar Jemput</h3>
                    <p class="text-sm leading-relaxed" style="color:rgba(255,255,255,0.85);">
                        Kunjungi salah satu outlet kami atau jadwalkan penjemputan langsung di depan pintu Anda. Kami menangani seluruh logistiknya agar Anda tidak perlu repot.
                    </p>
                </div>
            </div>

            {{-- ── Step 3 ── --}}
            <div class="flex flex-col items-center gsap-stagger-item h-full">
                {{-- Yellow badge --}}
                <div class="w-16 h-16 rounded-full border-[3px] border-black flex items-center justify-center font-grotesk font-black text-lg relative z-20"
                     style="background-color:#fed01b; color:#000; box-shadow:3px 3px 0 0 #000; flex-shrink:0;">
                    03
                </div>
                {{-- Card --}}
                <div class="w-full h-full mt-[-2rem] border-[3px] border-black bg-white flex flex-col items-center text-center p-8 pt-14 relative z-10"
                     style="border-radius:16px; box-shadow:6px 6px 0 0 #000;">
                    <span class="material-symbols-outlined mb-5" style="font-size:3rem;color:#10B981;font-variation-settings:'FILL' 0;">inventory_2</span>
                    <h3 class="font-grotesk font-bold text-xl mb-4" style="color:#191b23;">Sepatu Bersih Siap Dikirim</h3>
                    <p class="text-sm leading-relaxed" style="color:#424754;">
                        Pantau pesanan Anda secara real-time dan terima sepatu Anda kembali dalam kondisi seperti baru, dikirim langsung ke pintu Anda dengan kemasan premium.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>
