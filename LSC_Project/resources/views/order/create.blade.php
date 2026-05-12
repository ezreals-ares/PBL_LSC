@extends('layouts.customer')

@section('title', 'Buat Pesanan Baru')

@section('extra-styles')
<style>
    .page-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    .page-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--text-dark);
    }
    .page-header p {
        color: var(--text-light);
        margin-top: 0.5rem;
    }

    /* Two-col layout */
    .order-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 2rem;
        align-items: start;
    }
    @media (max-width: 900px) {
        .order-layout { grid-template-columns: 1fr; }
        .order-summary-sticky { position: static !important; }
    }

    /* Service cards */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.25rem;
    }
    .service-select-card {
        background: var(--white);
        border: 2px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.25s ease;
        position: relative;
    }
    .service-select-card:hover {
        border-color: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(2,132,199,0.12);
    }
    .service-select-card.selected {
        border-color: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(56,189,248,0.2);
    }
    .service-select-card .check-icon {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        width: 28px;
        height: 28px;
        background: var(--primary-light);
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.85rem;
        z-index: 2;
        font-weight: 700;
    }
    .service-select-card.selected .check-icon {
        display: flex;
    }
    .service-img-wrap {
        height: 160px;
        overflow: hidden;
        background: linear-gradient(135deg, var(--secondary), var(--accent));
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .service-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .service-select-card:hover .service-img-wrap img { transform: scale(1.05); }
    .service-img-placeholder {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
    }
    .service-card-body {
        padding: 1rem 1.25rem 1.25rem;
    }
    .service-card-body h3 {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.3rem;
    }
    .service-card-body p {
        font-size: 0.85rem;
        color: var(--text-light);
        line-height: 1.5;
        /* 2-line clamp */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 0.75rem;
    }
    .service-card-price {
        font-size: 1rem;
        font-weight: 800;
        color: var(--primary-light);
    }

    /* Quantity stepper */
    .qty-stepper {
        display: flex;
        align-items: center;
        gap: 0;
        margin-top: 0.75rem;
        background: var(--background);
        border-radius: 9999px;
        overflow: hidden;
        border: 2px solid var(--border);
        width: fit-content;
    }
    .qty-btn {
        width: 36px;
        height: 36px;
        border: none;
        background: transparent;
        cursor: pointer;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary);
        transition: background 0.2s;
        font-family: 'Outfit', sans-serif;
    }
    .qty-btn:hover { background: var(--secondary); }
    .qty-display {
        min-width: 40px;
        text-align: center;
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--text-dark);
    }

    /* Pickup method */
    .pickup-options { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    @media (max-width: 500px) { .pickup-options { grid-template-columns: 1fr; } }
    .pickup-card {
        border: 2px solid var(--border);
        border-radius: 16px;
        padding: 1.25rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }
    .pickup-card:hover { border-color: var(--primary-light); }
    .pickup-card.selected { border-color: var(--primary-light); background: #f0f9ff; }
    .pickup-icon { font-size: 1.8rem; line-height: 1; }
    .pickup-label { font-weight: 700; color: var(--text-dark); font-size: 0.95rem; }
    .pickup-desc { font-size: 0.82rem; color: var(--text-light); margin-top: 0.2rem; }
    .pickup-card input[type="radio"] { display: none; }

    /* Brand quick-select chips */
    .brand-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.65rem;
    }
    .brand-chip {
        padding: 0.35rem 0.9rem;
        border-radius: 9999px;
        border: 2px solid var(--border);
        background: var(--white);
        color: var(--text-dark);
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        font-family: 'Outfit', sans-serif;
        transition: all 0.18s ease;
    }
    .brand-chip:hover {
        border-color: var(--primary-light);
        background: var(--secondary);
        color: var(--primary);
    }
    .brand-chip.active {
        border-color: var(--primary-light);
        background: var(--primary-light);
        color: white;
    }

    /* Char counter */
    .char-counter { font-size: 0.8rem; color: var(--text-light); text-align: right; margin-top: 0.3rem; }
    .char-counter.limit { color: var(--danger); }

    /* Summary card */
    .order-summary-sticky { position: sticky; top: 90px; }
    .summary-empty { text-align: center; color: var(--text-light); padding: 2rem 0; font-size: 0.9rem; }
    .summary-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.4rem 0;
        font-size: 0.9rem;
    }
    .summary-line .name { color: var(--text-dark); max-width: 180px; }
    .summary-line .val  { font-weight: 600; color: var(--text-dark); white-space: nowrap; }
    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 0.75rem;
    }
    .summary-total .label { font-weight: 700; font-size: 1.05rem; }
    .summary-total .amount { font-size: 1.4rem; font-weight: 800; color: var(--primary-light); }
    .summary-eta { font-size: 0.82rem; color: var(--text-light); margin-top: 0.25rem; text-align: right; }

    .inline-error { color: var(--danger); font-size: 0.82rem; margin-top: 0.5rem; display: none; }
    .card-section-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--border);
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1>Buat Pesanan Baru</h1>
    <p>Pilih layanan yang Anda butuhkan, lalu konfirmasi pesanan Anda.</p>
</div>

<form method="POST" action="{{ route('order.store') }}" id="order-form">
    @csrf

    <div class="order-layout">

        {{-- LEFT: Service selection + pickup + notes --}}
        <div>

            {{-- Service Selection --}}
            <div class="card" style="margin-bottom:1.5rem;">
                <div class="card-section-title">Pilih Layanan</div>

                @if($services->isEmpty())
                    <p style="text-align:center;color:var(--text-light);">Belum ada layanan yang tersedia.</p>
                @else
                    <div class="services-grid">
                        @foreach($services as $service)
                        <div class="service-select-card" id="card-{{ $service->service_id }}"
                             onclick="toggleService({{ $service->service_id }}, {{ $service->price }}, {{ $service->estimated_days }}, '{{ addslashes($service->service_name) }}')">
                            {{-- Hidden selection input --}}
                            <input type="checkbox"
                                   name="services[]"
                                   id="svc-{{ $service->service_id }}"
                                   value="{{ $service->service_id }}"
                                   style="display:none;">
                            {{-- Hidden quantity input (default 1) --}}
                            <input type="hidden"
                                   name="quantities[{{ $service->service_id }}]"
                                   id="qty-input-{{ $service->service_id }}"
                                   value="1">

                            {{-- Check icon --}}
                            <span class="check-icon">✓</span>

                            {{-- Image: same mapping as landing page --}}
                            @php
                                $name = strtolower($service->service_name);
                                if (str_contains($name, 'deep'))            $img = 'deep_clean.png';
                                elseif (str_contains($name, 'full white'))  $img = 'hero.png';
                                elseif (str_contains($name, 'suede'))       $img = 'hero.png';
                                elseif (str_contains($name, 'unyellow'))    $img = 'unyellow.png';
                                elseif (str_contains($name, 'repaint'))     $img = 'hero.png';
                                elseif (str_contains($name, 'sole'))        $img = 'hero.png';
                                elseif (str_contains($name, 'express'))     $img = 'hero.png';
                                else                                        $img = 'hero.png';

                                $imgSrc = !empty($service->gambar)
                                    ? asset('storage/' . $service->gambar)
                                    : asset('images/' . $img);
                            @endphp
                            <div class="service-img-wrap">
                                <img src="{{ $imgSrc }}" alt="{{ $service->service_name }}">
                            </div>

                            {{-- Body --}}
                            <div class="service-card-body">
                                <h3>{{ $service->service_name }}</h3>
                                <p>{{ $service->description }}</p>
                                <div class="service-card-price">
                                    Mulai Rp {{ number_format($service->price, 0, ',', '.') }}
                                </div>

                                {{-- Quantity stepper (hidden until selected) --}}
                                <div class="qty-stepper" id="qty-wrap-{{ $service->service_id }}"
                                     style="display:none;" onclick="event.stopPropagation()">
                                    <button type="button" class="qty-btn"
                                            onclick="changeQty({{ $service->service_id }}, -1, {{ $service->price }})">−</button>
                                    <span class="qty-display" id="qty-display-{{ $service->service_id }}">1</span>
                                    <button type="button" class="qty-btn"
                                            onclick="changeQty({{ $service->service_id }}, 1, {{ $service->price }})">+</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                <p class="inline-error" id="service-error">⚠ Pilih minimal satu layanan sebelum melanjutkan.</p>
            </div>

            {{-- Pickup Method --}}
            <div class="card" style="margin-bottom:1.5rem;">
                <div class="card-section-title">Metode Pengambilan</div>
                <div class="pickup-options">
                    <label class="pickup-card selected" id="pickup-pickup" onclick="selectPickup('pickup')">
                        <input type="radio" name="pickup_method" value="pickup" checked>
                        <span class="pickup-icon"><i class="fas fa-car"></i></span>
                        <div>
                            <div class="pickup-label">Jemput ke Lokasi Saya</div>
                            <div class="pickup-desc">Kurir kami akan menjemput sepatu Anda</div>
                        </div>
                    </label>
                    <label class="pickup-card" id="pickup-antar" onclick="selectPickup('antar langsung')">
                        <input type="radio" name="pickup_method" value="antar langsung">
                        <span class="pickup-icon"><i class="fas fa-store"></i></span>
                        <div>
                            <div class="pickup-label">Antar ke Outlet</div>
                            <div class="pickup-desc">Bawa langsung ke toko kami</div>
                        </div>
                    </label>
                </div>
                @error('pickup_method')
                    <p class="form-error" style="display:block;">{{ $message }}</p>
                @enderror
            </div>

            {{-- Shoe Info --}}
            <div class="card">
                <div class="card-section-title">Informasi Sepatu</div>

                {{-- Merek / Brand --}}
                <div class="form-group">
                    <label class="form-label" for="merek-input">
                        Merek Sepatu <span style="color:var(--danger);font-size:0.85rem;">*</span>
                    </label>
                    <input type="text"
                           name="jenis_sepatu"
                           id="merek-input"
                           class="form-control"
                           value="{{ old('jenis_sepatu') }}"
                           placeholder="Contoh: Nike, Adidas, Vans, New Balance..."
                           maxlength="100"
                           required>

                    {{-- Quick-select brand chips --}}
                    <div class="brand-chips">
                        @foreach(['Nike','Adidas','Vans','New Balance','Converse','Puma','Reebok','Jordan','Skechers'] as $brand)
                        <button type="button" class="brand-chip" onclick="selectBrand('{{ $brand }}')">{{ $brand }}</button>
                        @endforeach
                    </div>
                    <p class="inline-error" id="merek-error">⚠ Merek / jenis sepatu wajib diisi.</p>
                    @error('jenis_sepatu')
                        <p class="form-error" style="display:block;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Material --}}
                <div class="form-group">
                    <label class="form-label" for="material-select">
                        Material Sepatu <span style="color:var(--danger);font-size:0.85rem;">*</span>
                    </label>
                    <select name="material_sepatu" id="material-select" class="form-control"
                            onchange="handleMaterialChange(this.value)">
                        <option value="">-- Pilih Material --</option>
                        @foreach(['Kanvas','Kulit','Kulit Sintetis','Suede','Nubuck','Mesh / Rajut','Karet','Lainnya'] as $mat)
                            <option value="{{ $mat }}"
                                {{ old('material_sepatu') === $mat ? 'selected' : '' }}
                                {{ (old('material_sepatu') === null && !in_array(old('material_sepatu_lain'), ['', null]) && $mat === 'Lainnya') ? 'selected' : '' }}>
                                {{ $mat }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Custom input shown only when 'Lainnya' is selected --}}
                    <div id="material-custom-wrap" style="margin-top:0.75rem; display:{{ old('material_sepatu') === 'Lainnya' ? 'block' : 'none' }};">
                        <input type="text"
                               name="material_sepatu_lain"
                               id="material-custom-input"
                               class="form-control"
                               value="{{ old('material_sepatu_lain') }}"
                               placeholder="Tuliskan material sepatu Anda..."
                               maxlength="100">
                    </div>

                    <p class="inline-error" id="material-error">⚠ Material sepatu wajib dipilih.</p>
                    @error('material_sepatu')
                        <p class="form-error" style="display:block;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Catatan --}}
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="notes-textarea">
                        Catatan Tambahan <span style="color:var(--text-light);font-weight:400;">(Opsional)</span>
                    </label>
                    <textarea name="catatan"
                              id="notes-textarea"
                              class="form-control"
                              rows="3"
                              maxlength="500"
                              placeholder="Contoh: Sol kanan menguning, ada ornamen logam kecil yang harus dijaga..."
                              oninput="updateNotesCounter()">{{ old('catatan') }}</textarea>
                    <div class="char-counter" id="notes-counter">0 / 500 karakter</div>
                    @error('catatan')
                        <p class="form-error" style="display:block;">{{ $message }}</p>
                    @enderror
                </div>

            </div>

        </div>

        {{-- RIGHT: Sticky Order Summary --}}
        <div class="order-summary-sticky">
            <div class="card">
                <div class="card-section-title">Ringkasan Pesanan</div>

                <div id="summary-empty" class="summary-empty">
                    Belum ada layanan dipilih
                </div>

                <div id="summary-lines" style="display:none;">
                    {{-- Populated by JS --}}
                </div>

                <hr class="divider" id="summary-divider" style="display:none;">

                <div id="summary-eta" class="summary-eta" style="display:none;"></div>

                <div id="summary-total-row" class="summary-total" style="display:none;">
                    <span class="label">Total</span>
                    <span class="amount" id="summary-total-price">Rp 0</span>
                </div>

                <hr class="divider">

                <button type="submit" class="btn btn-primary btn-full" id="submit-btn">
                    Buat Pesanan →
                </button>

                <p style="font-size:0.8rem;color:var(--text-light);text-align:center;margin-top:0.75rem;">
                    Pembayaran dilakukan setelah pesanan dikonfirmasi admin
                </p>
            </div>
        </div>

    </div>
</form>
@endsection

@section('scripts')
<script>
// ── Service data from PHP ──────────────────────────────────────────────────────
const SERVICES = {
    @foreach($services as $service)
    {{ $service->service_id }}: {
        id: {{ $service->service_id }},
        name: "{{ addslashes($service->service_name) }}",
        price: {{ $service->price }},
        estimatedDays: {{ $service->estimated_days }},
    },
    @endforeach
};

// State
const selected = {}; // { serviceId: qty }

// ── Toggle service selection ──────────────────────────────────────────────────
function toggleService(id, price, days, name) {
    if (selected[id] !== undefined) {
        // Deselect
        delete selected[id];
        document.getElementById('svc-' + id).checked = false;
        document.getElementById('card-' + id).classList.remove('selected');
        document.getElementById('qty-wrap-' + id).style.display = 'none';
    } else {
        // Select
        selected[id] = 1;
        document.getElementById('svc-' + id).checked = true;
        document.getElementById('card-' + id).classList.add('selected');
        document.getElementById('qty-wrap-' + id).style.display = 'flex';
        document.getElementById('qty-display-' + id).textContent = 1;
        document.getElementById('qty-input-' + id).value = 1;
    }
    updateSummary();
}

// ── Change quantity ────────────────────────────────────────────────────────────
function changeQty(id, delta, price) {
    if (selected[id] === undefined) return;
    let qty = selected[id] + delta;
    if (qty < 1) qty = 1;
    if (qty > 99) qty = 99;
    selected[id] = qty;
    document.getElementById('qty-display-' + id).textContent = qty;
    document.getElementById('qty-input-' + id).value = qty;
    updateSummary();
}

// ── Update summary panel ───────────────────────────────────────────────────────
function updateSummary() {
    const ids = Object.keys(selected);
    const empty = document.getElementById('summary-empty');
    const lines = document.getElementById('summary-lines');
    const divider = document.getElementById('summary-divider');
    const totalRow = document.getElementById('summary-total-row');
    const etaDiv = document.getElementById('summary-eta');

    if (ids.length === 0) {
        empty.style.display = '';
        lines.style.display = 'none';
        divider.style.display = 'none';
        totalRow.style.display = 'none';
        etaDiv.style.display = 'none';
        return;
    }

    empty.style.display = 'none';
    lines.style.display = '';
    divider.style.display = '';
    totalRow.style.display = '';
    etaDiv.style.display = '';

    let html = '';
    let total = 0;
    let maxDays = 0;

    ids.forEach(function(id) {
        const svc = SERVICES[id];
        if (!svc) return;
        const qty = selected[id];
        const subtotal = svc.price * qty;
        total += subtotal;
        if (svc.estimatedDays > maxDays) maxDays = svc.estimatedDays;

        html += '<div class="summary-line">' +
            '<span class="name">' + escapeHtml(svc.name) + ' &times;' + qty + '</span>' +
            '<span class="val">Rp ' + numberFmt(subtotal) + '</span>' +
            '</div>';
    });

    lines.innerHTML = html;
    document.getElementById('summary-total-price').textContent = 'Rp ' + numberFmt(total);

    // Calculate ETA
    const eta = addDays(new Date(), maxDays);
    etaDiv.innerHTML = 'Estimasi selesai: <strong>' + formatDate(eta) + '</strong>';
}

// ── Pickup selection ───────────────────────────────────────────────────────────
function selectPickup(val) {
    document.getElementById('pickup-pickup').classList.toggle('selected', val === 'pickup');
    document.getElementById('pickup-antar').classList.toggle('selected', val === 'antar langsung');

    // Set radio value
    const radios = document.querySelectorAll('input[name="pickup_method"]');
    radios.forEach(r => { r.checked = (r.value === val); });
}

// ── Material 'Lainnya' toggle ─────────────────────────────────────────────────
function handleMaterialChange(val) {
    const wrap = document.getElementById('material-custom-wrap');
    const customInput = document.getElementById('material-custom-input');
    if (val === 'Lainnya') {
        wrap.style.display = 'block';
        customInput.setAttribute('required', 'required');
    } else {
        wrap.style.display = 'none';
        customInput.removeAttribute('required');
        customInput.value = '';
    }
}
// Init on page load (for old() repopulation)
handleMaterialChange(document.getElementById('material-select').value);

// ── Form submit validation ────────────────────────────────────────────────────
document.getElementById('order-form').addEventListener('submit', function(e) {
    let hasError = false;

    // 1) Service check
    if (Object.keys(selected).length === 0) {
        hasError = true;
        const err = document.getElementById('service-error');
        err.style.display = 'block';
        if (!hasError) err.scrollIntoView({ behavior: 'smooth', block: 'center' });
    } else {
        document.getElementById('service-error').style.display = 'none';
    }

    // 2) Merek check
    const merekVal = document.getElementById('merek-input').value.trim();
    if (!merekVal) {
        hasError = true;
        const err = document.getElementById('merek-error');
        err.style.display = 'block';
    } else {
        document.getElementById('merek-error').style.display = 'none';
    }

    // 3) Material check
    const matVal = document.getElementById('material-select').value;
    if (!matVal) {
        hasError = true;
        const err = document.getElementById('material-error');
        err.style.display = 'block';
    } else {
        document.getElementById('material-error').style.display = 'none';
    }

    if (hasError) {
        e.preventDefault();
        // Scroll to first visible error
        const first = document.querySelector('.inline-error[style*="block"]');
        if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});

// ── Brand quick-select ────────────────────────────────────────────────────────
function selectBrand(brand) {
    const input = document.getElementById('merek-input');
    const chips = document.querySelectorAll('.brand-chip');

    // Toggle active chip highlight
    chips.forEach(function(chip) {
        chip.classList.toggle('active', chip.textContent.trim() === brand);
    });

    // Deselect if same chip clicked again
    if (input.value === brand) {
        input.value = '';
        chips.forEach(c => c.classList.remove('active'));
    } else {
        input.value = brand;
    }
}

// ── Notes character counter ───────────────────────────────────────────────────
function updateNotesCounter() {
    const ta = document.getElementById('notes-textarea');
    const counter = document.getElementById('notes-counter');
    if (!ta || !counter) return;
    const len = ta.value.length;
    counter.textContent = len + ' / 500 karakter';
    counter.classList.toggle('limit', len > 450);
}
updateNotesCounter();

// Restore chip state from old() value on validation error
(function() {
    const merekVal = document.getElementById('merek-input').value.trim();
    if (!merekVal) return;
    document.querySelectorAll('.brand-chip').forEach(function(chip) {
        if (chip.textContent.trim() === merekVal) chip.classList.add('active');
    });
})();

// ── Utilities ─────────────────────────────────────────────────────────────────
function numberFmt(n) {
    return Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function escapeHtml(str) {
    return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function addDays(date, days) {
    const d = new Date(date);
    d.setDate(d.getDate() + days);
    return d;
}

function formatDate(date) {
    const months = ['Januari','Februari','Maret','April','Mei','Juni',
                    'Juli','Agustus','September','Oktober','November','Desember'];
    return date.getDate() + ' ' + months[date.getMonth()] + ' ' + date.getFullYear();
}
</script>
@endsection
