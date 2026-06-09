{{-- ── Location Section — Neo-Brutalism ────────────────────────── --}}
<section id="lokasi" class="py-16 max-w-screen-xl mx-auto px-4 md:px-8">

    <h2 class="font-grotesk font-bold text-3xl mb-16 uppercase tracking-tighter flex items-center gap-4 gsap-fade-up">
        <span style="display:block;width:3rem;height:0.25rem;background:#000;flex-shrink:0;"></span>
        Temukan Outlet Kami
    </h2>

    @if($outlets->count() > 0)
        @foreach($outlets as $outlet)
            @php
                $phone   = $outlet->phone ?? null;
                // Format phone for WhatsApp: strip non-digits, replace leading 0 with 62
                $waNum   = $phone ? preg_replace('/[^0-9]/', '', $phone) : null;
                if ($waNum && str_starts_with($waNum, '0')) $waNum = '62' . substr($waNum, 1);
                $mapsLink = $outlet->google_maps_link ?? null;
                // Build embed URL from Google Maps link
                $embedUrl = null;
                if ($mapsLink) {
                    $encodedAddr = urlencode($outlet->address ?? $outlet->outlet_name);
                    $embedUrl = "https://www.google.com/maps?q={$encodedAddr}&output=embed";
                }
            @endphp

            <div class="overflow-hidden grid grid-cols-1 lg:grid-cols-2 mb-6 border-[3px] border-black gsap-fade-up" style="background-color: #0058be; box-shadow: 6px 6px 0px 0px #000000;">

                {{-- Left: Info --}}
                <div class="p-8 md:p-12">
                    <div class="flex items-start gap-4 mb-6">
                        <div class="w-14 h-14 bg-white border-[3px] border-stroke neo-shadow-xs flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings:'FILL' 1">store</span>
                        </div>
                        <div>
                            <h3 class="font-grotesk font-black uppercase text-2xl text-white">{{ strtoupper($outlet->outlet_name) }}</h3>
                            @if($outlet->address)
                                <p class="text-white/80 text-sm mt-1">{{ $outlet->address }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- Contact --}}
                    @if($phone)
                        <div class="flex items-center gap-3 mb-3 text-white">
                            <span class="material-symbols-outlined text-white text-base" style="font-variation-settings:'FILL' 1">call</span>
                            <span class="text-sm font-semibold">{{ $phone }}</span>
                        </div>
                    @endif

                    {{-- Operational Hours --}}
                    @if($outlet->operationalHours && $outlet->operationalHours->count() > 0)
                        <div class="mb-6 text-white">
                            <h4 class="font-grotesk font-bold uppercase text-sm text-white/80 mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1">schedule</span>
                                Jam Operasional
                            </h4>
                            <div class="space-y-2 border-t-[2px] border-white/30 pt-3">
                                @foreach($outlet->operationalHours as $hour)
                                    <div class="flex justify-between items-center py-1.5 border-b-[2px] border-white/20 last:border-0">
                                        <span class="font-bold text-base">{{ $hour->day }}</span>
                                        <span class="text-base text-white/80">
                                            {{ \Carbon\Carbon::parse($hour->open_time)->format('H:i') }}
                                            –
                                            {{ \Carbon\Carbon::parse($hour->close_time)->format('H:i') }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-3 mt-8">
                        <a href="{{ route('order.create') }}"
                           class="flex items-center justify-center gap-2 border-[3px] border-stroke px-5 py-3 font-grotesk font-bold uppercase text-sm neo-shadow-xs hover:opacity-90 transition-opacity flex-1 text-black neo-press-sm"
                           style="background-color: #fed01b;">
                            <span class="material-symbols-outlined text-base">add_circle</span>
                            Pesan Sekarang
                        </a>
                        @if($waNum)
                            <a href="https://wa.me/{{ $waNum }}?text=Halo+Lose+ShoesCare%2C+saya+ingin+bertanya..."
                               target="_blank"
                               class="flex items-center justify-center gap-2 border-[3px] border-stroke px-5 py-3 font-grotesk font-bold uppercase text-sm neo-shadow-xs hover:opacity-90 transition-opacity flex-1 text-black neo-press-sm"
                               style="background-color: #25D366;">
                                {{-- WhatsApp SVG icon --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" class="w-5 h-5">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.534 5.86L.058 23.486a.5.5 0 0 0 .614.614l5.637-1.476A11.952 11.952 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.831 9.831 0 0 1-5.018-1.374l-.36-.214-3.727.977.997-3.645-.235-.374A9.865 9.865 0 0 1 2.182 12C2.182 6.578 6.578 2.182 12 2.182S21.818 6.578 21.818 12 17.422 21.818 12 21.818z"/>
                                </svg>
                                WhatsApp
                            </a>
                        @endif
                        @if($mapsLink)
                            <a href="{{ $mapsLink }}" target="_blank"
                               class="flex items-center justify-center gap-2 border-[3px] border-stroke px-5 py-3 font-grotesk font-bold uppercase text-sm neo-shadow-xs hover:opacity-90 transition-opacity flex-1 text-black neo-press-sm"
                               style="background-color: #ffffff;">
                                <span class="material-symbols-outlined text-base">open_in_new</span>
                                Maps
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Right: Map Embed --}}
                <div class="h-72 lg:h-auto min-h-[320px] relative overflow-hidden border-l-[3px] border-stroke">
                    @if($embedUrl)
                        <iframe
                            src="{{ $embedUrl }}"
                            width="100%"
                            height="100%"
                            style="border:0; min-height: 320px;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi Outlet {{ $outlet->outlet_name }}">
                        </iframe>
                    @else
                        <div class="w-full h-full bg-surface-container flex items-center justify-center">
                            <div class="text-center p-8">
                                <span class="material-symbols-outlined text-7xl text-primary mb-3 block" style="font-variation-settings:'FILL' 1">location_on</span>
                                <p class="font-grotesk font-bold uppercase text-black">{{ $outlet->address }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        {{-- Fallback --}}
        <div class="border-[3px] border-black p-12 text-center gsap-fade-up" style="background-color: #0058be; box-shadow: 6px 6px 0px 0px #000000;">
            <span class="material-symbols-outlined text-7xl text-white/50 mb-4 block" style="font-variation-settings:'FILL' 1">store</span>
            <h3 class="font-grotesk font-bold uppercase text-xl mb-2 text-white">Belum Ada Outlet</h3>
            <p class="text-white/80">Hubungi kami untuk informasi lokasi terdekat.</p>
        </div>
    @endif

</section>
