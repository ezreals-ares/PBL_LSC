<section id="lokasi" class="location-section">

    {{-- Section header --}}
    <div class="location-header">
        <h2 class="section-title">Temukan Kami</h2>
        <p class="section-subtitle">Kunjungi outlet kami langsung atau hubungi kami untuk layanan jemput.</p>
    </div>

    @if(isset($outlets) && $outlets->count() > 0)
        @foreach($outlets as $outlet)
        <div class="location-wrapper">

            {{-- Left: Info card --}}
            <div class="location-info-col">

                {{-- Outlet name badge --}}
                <div class="outlet-name-badge">
                    <span class="outlet-dot"></span>
                    {{ $outlet->outlet_name }}
                </div>

                {{-- Info items --}}
                <div class="info-item-row">
                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="info-label">Alamat</div>
                        <div class="info-value">{{ $outlet->address }}</div>
                    </div>
                </div>

                <div class="info-item-row">
                    <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                    <div>
                        <div class="info-label">Telepon</div>
                        <div class="info-value">
                            <a href="tel:{{ $outlet->phone }}" style="color:var(--primary);">{{ $outlet->phone }}</a>
                        </div>
                    </div>
                </div>

                {{-- Operational hours --}}
                @if($outlet->operationalHours->isNotEmpty())
                <div class="info-item-row" style="align-items:flex-start;">
                    <div class="info-icon" style="margin-top:0.2rem;"><i class="fas fa-clock"></i></div>
                    <div style="flex:1;">
                        <div class="info-label">Jam Operasional</div>
                        <div class="hours-table">
                            @foreach($outlet->operationalHours as $hour)
                            <div class="hours-row">
                                <span class="hours-day">{{ $hour->day }}</span>
                                <span class="hours-time">
                                    {{ \Carbon\Carbon::parse($hour->open_time)->format('H:i') }} –
                                    {{ \Carbon\Carbon::parse($hour->close_time)->format('H:i') }} WIB
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- CTA buttons --}}
                <div class="location-ctas">
                    @if($outlet->google_maps_link)
                    <a href="{{ $outlet->google_maps_link }}" target="_blank" rel="noopener noreferrer"
                       class="btn-loc btn-loc-primary">
                        <i class="fas fa-directions"></i> Petunjuk Arah
                    </a>
                    @endif
                    <a href="https://wa.me/6282233654589" target="_blank" rel="noopener noreferrer"
                       class="btn-loc btn-loc-whatsapp">
                        <i class="fab fa-whatsapp"></i> Chat WhatsApp
                    </a>
                </div>

            </div>

            {{-- Right: Map embed --}}
            <div class="location-map-col">
                <div class="map-embed-wrap">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.123456789!2d112.789012!3d-7.901234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6294000000001%3A0x0!2zN8KwNTQnMDQuNCJTIDExMsKwNDcnMjAuNCJF!5e0!3m2!1sid!2sid!4v1714890000000!5m2!1sid!2sid"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi {{ $outlet->outlet_name }}">
                    </iframe>
                </div>
            </div>

        </div>
        @endforeach
    @else
        {{-- Fallback if no outlet in DB yet --}}
        <div class="location-wrapper">
            <div class="location-info-col">
                <div class="outlet-name-badge">
                    <span class="outlet-dot"></span>
                    LSC — Lose ShoesCare
                </div>
                <div class="info-item-row">
                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="info-label">Alamat</div>
                        <div class="info-value">Jl. Begawan, Dusun Begawan, Pandansari Lor, Kec. Jabung, Kabupaten Malang</div>
                    </div>
                </div>
                <div class="info-item-row">
                    <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                    <div>
                        <div class="info-label">Telepon / WhatsApp</div>
                        <div class="info-value">
                            <a href="tel:+6282233654589" style="color:var(--primary);">0822-3365-4589</a>
                        </div>
                    </div>
                </div>
                <div class="info-item-row">
                    <div class="info-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <div class="info-label">Jam Operasional</div>
                        <div class="hours-table">
                            <div class="hours-row"><span class="hours-day">Senin – Jumat</span><span class="hours-time">08:00 – 20:00 WIB</span></div>
                            <div class="hours-row"><span class="hours-day">Sabtu</span><span class="hours-time">08:00 – 18:00 WIB</span></div>
                            <div class="hours-row"><span class="hours-day">Minggu</span><span class="hours-time">09:00 – 16:00 WIB</span></div>
                        </div>
                    </div>
                </div>
                <div class="location-ctas">
                    <a href="https://wa.me/6282233654589" target="_blank" class="btn-loc btn-loc-whatsapp">
                        <i class="fab fa-whatsapp"></i> Chat WhatsApp
                    </a>
                </div>
            </div>
            <div class="location-map-col">
                <div class="map-embed-wrap">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.123456789!2d112.789012!3d-7.901234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6294000000001%3A0x0!2zN8KwNTQnMDQuNCJTIDExMsKwNDcnMjAuNCJF!5e0!3m2!1sid!2sid!4v1714890000000!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    @endif

</section>
