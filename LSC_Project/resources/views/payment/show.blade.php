@extends('layouts.customer')
@section('title', 'Pembayaran Pesanan #' . $order->order_id)
@section('content')

@php
    $isUpdate   = $order->payment && $order->payment->status !== 'verified';
    $formAction = $isUpdate ? route('payment.upload', $order->order_id) : route('payment.store', $order->order_id);
    $hasQris    = $qrisSetting && $qrisSetting->is_active;
    $hasBank    = $bankSetting  && $bankSetting->is_active;
    $prevMethod = $order->payment?->payment_method === 'e-wallet' ? 'qris'
                : ($order->payment?->payment_method ?? ($hasQris ? 'qris' : 'bank-transfer'));
    // Helper display: label untuk QRIS
    $qrisLabel = $qrisSetting?->label_name ?? 'Lose ShoesCare';
@endphp

{{-- Header --}}
<div class="mb-8">
    <a href="{{ route('order.show', $order->order_id) }}"
       class="inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary transition-colors mb-4 uppercase">
        <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Detail Pesanan
    </a>
    <h1 class="font-grotesk font-black uppercase tracking-tighter" style="font-size:clamp(1.5rem,4vw,2.5rem)">
        Unggah Bukti Bayar
    </h1>
    <p class="text-on-surface-variant mt-1">
        Pesanan #{{ $order->order_id }} — <span class="font-black text-on-surface">Rp {{ number_format($order->total_price,0,',','.') }}</span>
    </p>
</div>

{{-- Errors --}}
@if($errors->any())
    <div class="bg-error-container border-[3px] border-danger p-4 space-y-1 mb-5">
        @foreach($errors->all() as $e)
            <p class="text-sm text-danger font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">error</span> {{ $e }}
            </p>
        @endforeach
    </div>
@endif

@if(session('success'))
    <div class="bg-success border-[3px] border-stroke p-4 flex items-center gap-3 mb-5">
        <span class="material-symbols-outlined text-black" style="font-variation-settings:'FILL' 1">check_circle</span>
        <p class="text-sm font-bold text-black">{{ session('success') }}</p>
    </div>
@endif

@if(!$order->payment || $order->payment->status !== 'verified')

<form method="POST" action="{{ $formAction }}" enctype="multipart/form-data" id="payment-form">
    @csrf
    @if($isUpdate) @method('PUT') @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        {{-- ── Kiri: Ringkasan + Metode + Info Panel ─────────────── --}}
        <div class="lg:col-span-6 space-y-5">

            {{-- Ringkasan Pesanan --}}
            <div class="neo-card bg-white p-6">
                <h2 class="font-grotesk font-bold uppercase text-on-surface border-b-[3px] border-stroke pb-3 mb-4">
                    Ringkasan Pesanan
                </h2>
                <div class="space-y-3 mb-5">
                    @foreach($order->orderDetails as $detail)
                        <div class="flex justify-between text-sm">
                            <span class="text-on-surface-variant">{{ $detail->service?->service_name }} ×{{ $detail->quantity }}</span>
                            <span class="font-bold text-on-surface">Rp {{ number_format($detail->subtotal,0,',','.') }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="border-t-[3px] border-stroke pt-4 flex justify-between items-center">
                    <span class="font-grotesk font-bold uppercase">Total</span>
                    <span class="font-grotesk font-black text-2xl">Rp {{ number_format($order->total_price,0,',','.') }}</span>
                </div>
            </div>

            {{-- Pilih Metode Pembayaran --}}
            <div class="neo-card bg-white p-6">
                <h2 class="font-grotesk font-bold uppercase text-on-surface border-b-[3px] border-stroke pb-3 mb-5">
                    Pilih Metode Pembayaran
                </h2>

                <div class="grid grid-cols-2 gap-4">

                    {{-- QRIS --}}
                    @if($hasQris)
                    <label for="method_qris" id="lbl_qris"
                           class="method-card cursor-pointer border-[3px] border-stroke bg-white p-5 flex flex-col items-center justify-center gap-3 transition-all duration-100"
                           style="box-shadow: 6px 6px 0px 0px #000;">
                        <input type="radio" id="method_qris" name="payment_method" value="qris"
                               class="sr-only" {{ $prevMethod==='qris' ? 'checked' : '' }}>
                        <span class="material-symbols-outlined text-5xl text-black" style="font-variation-settings:'FILL' 0">scan</span>
                        <p class="font-grotesk font-black uppercase text-base text-black">QRIS</p>
                    </label>
                    @endif

                    {{-- Bank Transfer --}}
                    @if($hasBank)
                    <label for="method_bank" id="lbl_bank"
                           class="method-card cursor-pointer border-[3px] border-stroke bg-white p-5 flex flex-col items-center justify-center gap-3 transition-all duration-100"
                           style="box-shadow: 6px 6px 0px 0px #000;">
                        <input type="radio" id="method_bank" name="payment_method" value="bank-transfer"
                               class="sr-only" {{ $prevMethod==='bank-transfer' ? 'checked' : '' }}>
                        <span class="material-symbols-outlined text-5xl text-black" style="font-variation-settings:'FILL' 0">account_balance</span>
                        <p class="font-grotesk font-black uppercase text-base text-black">Transfer Bank</p>
                    </label>
                    @endif

                </div>

                @error('payment_method')
                    <p class="text-xs text-danger mt-3 font-bold flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">error</span> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Panel QRIS --}}
            @if($hasQris)
            <div id="panel_qris" class="neo-card-yellow p-6" {{ $prevMethod!=='qris' ? 'style=display:none' : '' }}>
                <h3 class="font-grotesk font-bold uppercase text-on-secondary-container mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">scan</span>
                    Scan QR Code Berikut
                </h3>
                @if($qrisSetting->payment_image)
                    <div class="bg-white border-[3px] border-stroke p-3 flex items-center justify-center mb-4">
                        <img src="{{ asset('storage/'.$qrisSetting->payment_image) }}" alt="QRIS"
                             class="max-w-xs w-full h-auto object-contain mx-auto">
                    </div>
                @else
                    <div class="bg-white border-[3px] border-stroke p-8 flex flex-col items-center gap-3 mb-4">
                        <span class="material-symbols-outlined text-6xl text-outline-variant">scan</span>
                        <p class="text-xs text-on-surface-variant text-center">QR Code dikonfigurasi oleh admin.</p>
                    </div>
                @endif
                <div class="bg-white border-[2px] border-stroke p-3 flex justify-between items-center mb-3">
                    <span class="text-xs font-bold uppercase text-on-surface-variant">Nominal</span>
                    <span class="font-grotesk font-black text-primary text-xl">Rp {{ number_format($order->total_price,0,',','.') }}</span>
                </div>
                @if($qrisSetting->notes)
                    <p class="text-xs text-on-secondary-container flex items-start gap-1.5">
                        <span class="material-symbols-outlined text-sm shrink-0 mt-0.5">info</span>
                        {{ $qrisSetting->notes }}
                    </p>
                @endif
            </div>
            @endif

            {{-- Panel Bank --}}
            @if($hasBank)
            <div id="panel_bank" class="neo-card-yellow p-6" {{ $prevMethod!=='bank-transfer' ? 'style=display:none' : '' }}>
                <h3 class="font-grotesk font-bold uppercase text-on-secondary-container mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">account_balance</span>
                    Informasi Rekening Tujuan
                </h3>
                <div class="space-y-3">
                    @if($bankSetting->provider_name)
                    <div class="flex justify-between">
                        <span class="text-xs font-bold uppercase text-on-secondary-container">Nama Bank</span>
                        <span class="font-grotesk font-black text-on-secondary-container">{{ $bankSetting->provider_name }}</span>
                    </div>
                    @endif
                    @if($bankSetting->account_number)
                    <div class="flex justify-between items-center border-t-[2px] border-stroke/40 pt-3">
                        <span class="text-xs font-bold uppercase text-on-secondary-container">No. Rekening</span>
                        <div class="flex items-center gap-2">
                            <span class="font-grotesk font-black text-on-secondary-container" id="norek-text">{{ $bankSetting->account_number }}</span>
                            <button type="button" onclick="copyNorek()"
                                    class="text-on-secondary-container opacity-60 hover:opacity-100 transition-opacity p-0.5 cursor-pointer">
                                <span class="material-symbols-outlined text-base" id="copy-icon">content_copy</span>
                            </button>
                        </div>
                    </div>
                    @endif
                    @if($bankSetting->account_name)
                    <div class="flex justify-between border-t-[2px] border-stroke/40 pt-3">
                        <span class="text-xs font-bold uppercase text-on-secondary-container">Atas Nama</span>
                        <span class="font-bold text-on-secondary-container">{{ $bankSetting->account_name }}</span>
                    </div>
                    @endif
                    <div class="bg-white border-[2px] border-stroke p-3 flex justify-between items-center">
                        <span class="text-xs font-bold uppercase text-on-surface-variant">Nominal Transfer</span>
                        <span class="font-grotesk font-black text-primary text-xl">Rp {{ number_format($order->total_price,0,',','.') }}</span>
                    </div>
                    @if($bankSetting->notes)
                        <p class="text-xs text-on-secondary-container flex items-start gap-1.5">
                            <span class="material-symbols-outlined text-sm shrink-0 mt-0.5">info</span>
                            {{ $bankSetting->notes }}
                        </p>
                    @endif
                </div>
            </div>
            @endif

        </div>

        {{-- ── Kanan: Upload + Bukti Sebelumnya ───────────────────── --}}
        <div class="lg:col-span-6 space-y-5 sticky top-24">

            {{-- Upload Box --}}
            <div class="neo-card bg-white p-7">
                <h2 class="font-grotesk font-black uppercase text-on-surface text-lg mb-5 border-b-[3px] border-stroke pb-3">
                    Unggah Bukti Pembayaran
                </h2>

                <label for="payment_proof" id="upload-zone"
                       class="border-[3px] border-dashed border-stroke p-10 flex flex-col items-center justify-center bg-surface-container-low cursor-pointer hover:bg-primary-fixed hover:border-primary transition-all group">
                    <span class="material-symbols-outlined text-5xl text-outline mb-3 group-hover:text-primary transition-colors" id="upload-icon">upload_file</span>
                    <p class="font-grotesk font-bold text-on-surface text-center" id="upload-text">Klik untuk pilih file atau drag & drop</p>
                    <p class="text-xs text-on-surface-variant mt-2">JPG, PNG, PDF (maks 2MB)</p>
                    <input type="file" id="payment_proof" name="payment_proof"
                           accept=".jpg,.jpeg,.png,.pdf" class="hidden" onchange="previewFile(this)">
                </label>

                <div id="file-preview" class="hidden mt-4 border-[3px] border-stroke bg-surface-container-low p-4 flex items-center gap-4">
                    <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings:'FILL' 1">image</span>
                    <div class="flex-grow">
                        <p id="file-name" class="font-bold text-sm text-on-surface"></p>
                        <p id="file-size" class="text-xs text-on-surface-variant"></p>
                    </div>
                    <button type="button" onclick="clearFile()" class="text-danger">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                @error('payment_proof')
                    <p class="text-xs text-danger mt-2 font-bold flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">error</span> {{ $message }}
                    </p>
                @enderror

                <button type="submit" class="neo-btn-primary w-full justify-center py-4 text-base font-grotesk font-black uppercase mt-6">
                    <span class="material-symbols-outlined">upload</span>
                    {{ $isUpdate ? 'Perbarui Bukti Bayar' : 'Kirim Bukti Bayar' }}
                </button>
                <p class="text-xs text-center text-on-surface-variant mt-3 flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-sm">lock</span> File kamu aman dan terenkripsi
                </p>
            </div>

            {{-- Bukti Sebelumnya --}}
            @if($isUpdate && $order->payment->payment_proof)
                <div class="neo-card bg-surface-container-low p-6">
                    <h3 class="font-grotesk font-bold uppercase text-sm text-on-surface mb-3">Bukti Sebelumnya</h3>
                    @php $ext = pathinfo($order->payment->payment_proof, PATHINFO_EXTENSION); @endphp
                    @if(in_array(strtolower($ext), ['jpg','jpeg','png','webp']))
                        <img src="{{ asset('storage/'.$order->payment->payment_proof) }}"
                             alt="Bukti" class="max-h-64 border-[3px] border-stroke object-contain bg-white mx-auto block">
                    @else
                        <a href="{{ asset('storage/'.$order->payment->payment_proof) }}" target="_blank"
                           class="neo-btn-outline text-sm justify-center w-full">
                            <span class="material-symbols-outlined text-sm">open_in_new</span> Lihat Dokumen
                        </a>
                    @endif
                </div>
            @endif

        </div>
    </div>
</form>

@else

{{-- Sudah Verified --}}
<div class="neo-card bg-white p-10 text-center max-w-lg mx-auto">
    <span class="material-symbols-outlined text-7xl text-success mb-4 block" style="font-variation-settings:'FILL' 1">task_alt</span>
    <h3 class="font-grotesk font-bold text-on-surface uppercase text-xl mb-2">Pembayaran Terverifikasi</h3>
    <p class="text-sm text-on-surface-variant mb-6">Pembayaranmu telah dikonfirmasi. Pesanan sedang diproses!</p>
    <a href="{{ route('order.show', $order->order_id) }}" class="neo-btn-primary text-sm justify-center">
        <span class="material-symbols-outlined text-sm">visibility</span> Lihat Status Pesanan
    </a>
</div>

@endif

@endsection

@section('scripts')
<script>
// ── Method selector — same style as service card selection ────────────
const radios = document.querySelectorAll('input[name="payment_method"]');

function updateMethodUI() {
    radios.forEach(r => {
        const id    = r.value === 'qris' ? 'qris' : 'bank';
        const lbl   = document.getElementById('lbl_' + id);
        const panel = document.getElementById('panel_' + id);
        if (!lbl) return;

        if (r.checked) {
            lbl.style.borderColor     = '#0058be';
            lbl.style.backgroundColor = '#dce8ff';
            lbl.style.boxShadow       = '6px 6px 0px 0px #0058be';
            if (panel) panel.style.display = 'block';
        } else {
            lbl.style.borderColor     = '#000';
            lbl.style.backgroundColor = '#fff';
            lbl.style.boxShadow       = '6px 6px 0px 0px #000';
            if (panel) panel.style.display = 'none';
        }
    });
}

radios.forEach(r => r.addEventListener('change', updateMethodUI));
updateMethodUI();

// ── Copy norek ───────────────────────────────────────────────────────
function copyNorek() {
    const txt  = document.getElementById('norek-text')?.textContent?.trim();
    const icon = document.getElementById('copy-icon');
    if (!txt) return;
    navigator.clipboard.writeText(txt).then(() => {
        if (icon) { icon.textContent = 'check'; setTimeout(() => icon.textContent = 'content_copy', 2000); }
    });
}

// ── File preview ─────────────────────────────────────────────────────
function previewFile(input) {
    const file = input.files[0];
    if (!file) return;
    document.getElementById('file-name').textContent = file.name;
    document.getElementById('file-size').textContent = (file.size/1024).toFixed(1) + ' KB';
    document.getElementById('file-preview').classList.remove('hidden');
    const icon = document.getElementById('upload-icon');
    icon.style.fontVariationSettings = "'FILL' 1";
    icon.className = 'material-symbols-outlined text-5xl text-primary mb-3 transition-colors';
    document.getElementById('upload-text').textContent = 'File dipilih!';
}

function clearFile() {
    document.getElementById('payment_proof').value = '';
    document.getElementById('file-preview').classList.add('hidden');
    document.getElementById('upload-text').textContent = 'Klik untuk pilih file atau drag & drop';
    const icon = document.getElementById('upload-icon');
    icon.style.fontVariationSettings = "'FILL' 0";
    icon.className = 'material-symbols-outlined text-5xl text-outline mb-3 transition-colors';
}

// ── Drag & drop ──────────────────────────────────────────────────────
const zone = document.getElementById('upload-zone');
if (zone) {
    zone.addEventListener('dragover',  e => { e.preventDefault(); zone.classList.add('border-primary','bg-primary-fixed'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('border-primary','bg-primary-fixed'));
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.classList.remove('border-primary','bg-primary-fixed');
        const input = document.getElementById('payment_proof');
        const dt = new DataTransfer();
        dt.items.add(e.dataTransfer.files[0]);
        input.files = dt.files;
        previewFile(input);
    });
}
</script>
@endsection
