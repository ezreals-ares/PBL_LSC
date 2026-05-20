@extends('layouts.customer')

@section('title', 'Pesan Layanan')

@section('content')

{{-- ── Header ──────────────────────────────────────────────────── --}}
<header class="mb-12">
    <a href="{{ route('order.history') }}" class="inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary transition-colors mb-4 uppercase">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Riwayat Pesanan
    </a>
    <h1 class="font-grotesk font-black uppercase tracking-tighter mb-3" style="font-size: clamp(2rem, 5vw, 3rem);">
        Pilih <span class="text-primary">Layananmu</span>
    </h1>
    <p class="text-body-lg text-on-surface-variant max-w-2xl">
        Pilih layanan pembersihan yang tepat untuk koleksi sepatumu. Kami siap menangani dari daily beaters hingga luxury grails.
    </p>
</header>

<form method="POST" action="{{ route('order.store') }}" id="order-form">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        {{-- ── Left: Service Selection ─────────────────────────── --}}
        <div class="lg:col-span-8 space-y-6">

            {{-- Error summary --}}
            @if($errors->any())
                <div class="bg-error-container border-[3px] border-danger p-4 neo-shadow-sm">
                    <p class="font-grotesk font-bold text-danger uppercase mb-2">Ada yang salah:</p>
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-sm text-danger flex items-start gap-2">
                                <span class="material-symbols-outlined text-sm mt-0.5">error</span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Service Cards --}}
            <div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($services as $service)
                        @php
                            $name = strtolower($service->service_name);
                            $icon = 'cleaning_services';
                            if (str_contains($name, 'white') || str_contains($name, 'putih')) $icon = 'auto_fix_high';
                            elseif (str_contains($name, 'reglue') || str_contains($name, 'lem') || str_contains($name, 'sol')) $icon = 'build';
                            elseif (str_contains($name, 'deep') || str_contains($name, 'cuci')) $icon = 'soap';
                            elseif (str_contains($name, 'repaint') || str_contains($name, 'cat')) $icon = 'format_paint';
                            elseif (str_contains($name, 'protect') || str_contains($name, 'proteksi')) $icon = 'shield';
                            $isOld = in_array((string)$service->service_id, (array)(old('services') ?? []));
                        @endphp
                        <div class="service-card border-[3px] border-stroke rounded-xl p-6 flex flex-col transition-all duration-100 bg-white"
                             style="box-shadow: 6px 6px 0px 0px #000;"
                             data-service-id="{{ $service->service_id }}"
                             data-service-name="{{ $service->service_name }}"
                             data-service-price="{{ $service->price }}">

                            <div class="flex justify-between items-start mb-5">
                                <div class="w-12 h-12 border-[3px] border-stroke flex items-center justify-center" style="background-color:#dce8ff;">
                                    <span class="material-symbols-outlined text-2xl" style="color:#0058be;">{{ $icon }}</span>
                                </div>
                                <div class="font-grotesk font-black text-on-surface text-xl selected-price-display">
                                    Rp {{ number_format($service->price, 0, ',', '.') }}
                                </div>
                            </div>

                            <h3 class="font-grotesk font-bold text-on-surface uppercase mb-2">{{ $service->service_name }}</h3>
                            <p class="text-sm text-on-surface-variant leading-relaxed mb-4 flex-grow">
                                {{ $service->description ?? 'Layanan perawatan sepatu profesional.' }}
                            </p>

                            <div class="mt-auto border-t-[2px] border-stroke pt-4 flex items-center justify-between">
                                @if($service->estimated_days)
                                    <div class="flex items-center gap-2 text-xs font-bold text-on-surface-variant">
                                        <span class="material-symbols-outlined text-sm">schedule</span>
                                        Estimasi: {{ $service->estimated_days }} hari kerja
                                    </div>
                                @else
                                    <div></div>
                                @endif
                                
                                {{-- Initial Add Button --}}
                                <button type="button" 
                                    class="add-service-btn w-10 h-10 bg-[#fed01b] text-black border-[3px] border-black flex justify-center items-center shadow-[4px_4px_0_0_#000] active:translate-y-[2px] active:translate-x-[2px] active:shadow-[2px_2px_0_0_#000] transition-all" 
                                    title="Tambah Layanan"
                                    onclick="window.toggleService(this.closest('.service-card'), 'select')">
                                    <span class="material-symbols-outlined text-xl font-black">add</span>
                                </button>
                            </div>

                            {{-- Hidden checkbox + quantity --}}
                            <input type="checkbox" name="services[]" value="{{ $service->service_id }}"
                                class="service-checkbox hidden" {{ $isOld ? 'checked' : '' }}>
                            <div class="qty-control hidden items-center justify-between mt-4 border-t-[2px] border-stroke pt-4 w-full">
                                <div class="flex items-center gap-3">
                                    <span class="text-xs font-bold uppercase text-on-surface-variant">Jumlah:</span>
                                    <button type="button" onclick="event.stopPropagation(); changeQty(this, -1)"
                                        class="w-10 h-10 bg-white text-black border-[3px] border-black flex items-center justify-center font-black text-xl shadow-[4px_4px_0_0_#000] active:translate-y-[2px] active:translate-x-[2px] active:shadow-[2px_2px_0_0_#000] transition-all">−</button>
                                    <input type="number" name="quantities[{{ $service->service_id }}]"
                                        value="{{ old('quantities.'.$service->service_id, 1) }}"
                                        min="1" max="99"
                                        class="qty-input w-12 h-10 text-center border-[3px] border-black font-grotesk font-black text-on-surface bg-white focus:outline-none shadow-[4px_4px_0_0_#000] pointer-events-none"
                                        readonly>
                                    <button type="button" onclick="event.stopPropagation(); changeQty(this, 1)"
                                        class="w-10 h-10 bg-white text-black border-[3px] border-black flex items-center justify-center font-black text-xl shadow-[4px_4px_0_0_#000] active:translate-y-[2px] active:translate-x-[2px] active:shadow-[2px_2px_0_0_#000] transition-all">+</button>
                                </div>
                                
                                {{-- Cancel Button (Neo-Brutalism Style) --}}
                                <button type="button" 
                                    class="selected-check hidden bg-[#EF4444] text-white border-[3px] border-black w-10 h-10 flex justify-center items-center shadow-[4px_4px_0_0_#000] active:translate-y-[2px] active:translate-x-[2px] active:shadow-[2px_2px_0_0_#000] transition-all" 
                                    title="Batalkan Pesanan" 
                                    onclick="event.stopPropagation(); window.toggleService(this.closest('.service-card'), 'deselect')">
                                    <span class="material-symbols-outlined text-xl" style="font-variation-settings:'FILL' 1;">close</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('services')
                    <p class="text-sm text-danger font-bold mt-2 flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">error</span> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Shoe Details --}}
            <div class="neo-card bg-surface-container-low p-8">
                <h2 class="font-grotesk font-bold uppercase text-on-surface text-xl mb-6 flex items-center gap-3">
                    <span class="w-8 h-1 bg-stroke block"></span>
                    Detail Sepatu
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="neo-label">Jenis Sepatu</label>
                        <input type="text" name="jenis_sepatu" value="{{ old('jenis_sepatu') }}"
                            placeholder="contoh: Nike Air Max, Adidas Yeezy..."
                            class="neo-input">
                        @error('jenis_sepatu')
                            <p class="text-xs text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="neo-label">Material Sepatu</label>
                        <select name="material_sepatu" class="neo-select">
                            <option value="">-- Pilih Material --</option>
                            @foreach(['Kanvas', 'Kulit', 'Suede', 'Nubuck', 'Mesh / Flyknit', 'Synthetic', 'Rubber', 'Lainnya'] as $mat)
                                <option value="{{ $mat }}" {{ old('material_sepatu') === $mat ? 'selected' : '' }}>{{ $mat }}</option>
                            @endforeach
                        </select>
                        @error('material_sepatu')
                            <p class="text-xs text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="neo-label">Metode Pengambilan <span class="text-danger">*</span></label>
                        <select name="pickup_method" required class="neo-select" id="pickup-method" onchange="toggleOutletChoice()">
                            <option value="">-- Pilih Metode --</option>
                            <option value="pickup"         {{ old('pickup_method') === 'pickup' ? 'selected' : '' }}>Jemput ke Lokasi</option>
                            <option value="antar langsung" {{ old('pickup_method') === 'antar langsung' ? 'selected' : '' }}>Antar ke Outlet</option>
                        </select>
                        @error('pickup_method')
                            <p class="text-xs text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @if(isset($outlets) && $outlets->count())
                        <div id="outlet-choice" class="{{ old('pickup_method') === 'antar langsung' ? '' : 'hidden' }}">
                            <label class="neo-label">Outlet Tujuan</label>
                            <select name="outlet_id" class="neo-select">
                                <option value="">-- Pilih Outlet --</option>
                                @foreach($outlets as $outlet)
                                    <option value="{{ $outlet->outlet_id }}" {{ (string) old('outlet_id') === (string) $outlet->outlet_id ? 'selected' : '' }}>
                                        {{ $outlet->outlet_name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-on-surface-variant mt-1">Pilihan outlet akan ikut tercatat di catatan pesanan.</p>
                            @error('outlet_id')
                                <p class="text-xs text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                    <div>
                        <label class="neo-label">Catatan Tambahan</label>
                        <textarea name="catatan" rows="3"
                            placeholder="Instruksi khusus, kondisi sepatu, dll..."
                            class="neo-textarea">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <p class="text-xs text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Right: Order Summary Sidebar ─────────────────────── --}}
        <aside class="lg:col-span-4 sticky top-24">
            <div class="neo-card bg-surface-container p-8">
                <h2 class="font-grotesk font-bold uppercase text-on-surface border-b-[3px] border-stroke pb-4 mb-6">Ringkasan Pesanan</h2>

                {{-- Selected services list --}}
                <div id="order-summary-list" class="space-y-3 mb-6 min-h-[60px]">
                    <p class="text-sm text-on-surface-variant italic" id="no-service-msg">Belum ada layanan dipilih.</p>
                </div>

                {{-- Total --}}
                <div class="border-t-[2px] border-stroke pt-4 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="font-grotesk font-bold uppercase text-on-surface">Total</span>
                        <span class="font-grotesk font-black text-2xl text-on-surface" id="order-total">Rp 0</span>
                    </div>
                </div>

                {{-- Promo note --}}
                <div class="neo-card-yellow p-4 flex items-center gap-3 mb-6">
                    <span class="material-symbols-outlined text-on-secondary-container text-2xl" style="font-variation-settings:'FILL' 1">local_offer</span>
                    <div>
                        <p class="font-bold text-xs uppercase text-on-secondary-container">Info Pembayaran</p>
                        <p class="text-xs text-on-secondary-container mt-0.5">Upload bukti bayar setelah pesanan dikonfirmasi.</p>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full neo-btn-primary py-4 text-base font-grotesk font-black uppercase tracking-tight">
                    <span class="material-symbols-outlined">check_circle</span>
                    Kirim Pesanan
                </button>

                <p class="text-xs text-center text-on-surface-variant mt-4 flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-sm">lock</span>
                    Pesanan aman dan terlindungi
                </p>
            </div>
        </aside>

    </div>
</form>

@endsection

@section('scripts')
<script>
    // Track selected services globally to avoid redeclaration errors with Barba
    window.selectedServicesMap = window.selectedServicesMap || {};

    window.toggleService = function(card, action = 'toggle') {
        const id    = card.dataset.serviceId;
        const name  = card.dataset.serviceName;
        const price = parseInt(card.dataset.servicePrice);
        const cb    = card.querySelector('.service-checkbox');
        const check = card.querySelector('.selected-check');
        const qty   = card.querySelector('.qty-control');
        const addBtn = card.querySelector('.add-service-btn');

        if (action === 'toggle') {
            action = window.selectedServicesMap[id] ? 'deselect' : 'select';
        }

        if (action === 'deselect' && window.selectedServicesMap[id]) {
            // Deselect
            delete window.selectedServicesMap[id];
            cb.checked = false;
            card.style.borderColor = '';
            card.style.backgroundColor = '#fff';
            card.style.boxShadow = '6px 6px 0px 0px #000';
            check.classList.add('hidden');
            qty.classList.remove('flex');
            qty.classList.add('hidden');
            if (addBtn) { addBtn.classList.remove('hidden'); addBtn.classList.add('flex'); }
        } else if (action === 'select' && !window.selectedServicesMap[id]) {
            // Select
            const qtyInput = card.querySelector('.qty-input');
            window.selectedServicesMap[id] = { name, price, qty: parseInt(qtyInput?.value || 1) };
            cb.checked = true;
            card.style.borderColor = '#0058be';
            card.style.backgroundColor = '#dce8ff';
            card.style.boxShadow = '6px 6px 0px 0px #0058be';
            check.classList.remove('hidden');
            qty.classList.remove('hidden');
            qty.classList.add('flex');
            if (addBtn) { addBtn.classList.add('hidden'); addBtn.classList.remove('flex'); }
        }
        updateSummary();
    }

    window.changeQty = function(btn, delta) {
        const card  = btn.closest('.service-card');
        const id    = card.dataset.serviceId;
        const input = card.querySelector('.qty-input');
        let val = parseInt(input.value) + delta;
        if (val < 1) val = 1;
        if (val > 99) val = 99;
        input.value = val;
        if (window.selectedServicesMap[id]) {
            window.selectedServicesMap[id].qty = val;
        }
        updateSummary();
    }

    window.syncQty = function(input) {
        const card = input.closest('.service-card');
        const id = card.dataset.serviceId;
        let val = parseInt(input.value || 1);
        if (val < 1) val = 1;
        if (val > 99) val = 99;
        input.value = val;
        if (window.selectedServicesMap[id]) {
            window.selectedServicesMap[id].qty = val;
        }
        updateSummary();
    }

    window.toggleOutletChoice = function() {
        const method = document.getElementById('pickup-method');
        const outlet = document.getElementById('outlet-choice');
        if (!method || !outlet) return;
        outlet.classList.toggle('hidden', method.value !== 'antar langsung');
    }

    window.updateSummary = function() {
        const list   = document.getElementById('order-summary-list');
        const totalEl = document.getElementById('order-total');

        const entries = Object.entries(window.selectedServicesMap);
        if (entries.length === 0) {
            list.innerHTML = '<p class="text-sm text-on-surface-variant italic" id="no-service-msg">Belum ada layanan dipilih.</p>';
            totalEl.textContent = 'Rp 0';
            return;
        }

        let total = 0;
        let html  = '';
        entries.forEach(([id, s]) => {
            const sub = s.price * s.qty;
            total += sub;
            html += `<div class="flex justify-between items-center text-sm">
                <span class="text-on-surface font-semibold">${s.name} ×${s.qty}</span>
                <span class="font-grotesk font-bold">Rp ${sub.toLocaleString('id-ID')}</span>
            </div>`;
        });
        list.innerHTML = html;
        totalEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    // Restore old state on validation error
    document.querySelectorAll('.service-checkbox:checked').forEach(cb => {
        const card = cb.closest('.service-card');
        if (card) window.toggleService(card);
    });
    window.toggleOutletChoice();
</script>
@endsection
