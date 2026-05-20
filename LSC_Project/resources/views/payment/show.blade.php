@extends('layouts.customer')

@section('title', 'Pembayaran Pesanan #' . $order->order_id)

@section('content')

{{-- ── Back + Header ───────────────────────────────────────────── --}}
<div class="mb-8">
    <a href="{{ route('order.show', $order->order_id) }}" class="inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary transition-colors mb-4 uppercase">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Kembali ke Detail Pesanan
    </a>
    <h1 class="font-grotesk font-black uppercase tracking-tighter" style="font-size: clamp(1.5rem, 4vw, 2.5rem);">
        Upload Bukti Bayar
    </h1>
    <p class="text-on-surface-variant mt-1">Pesanan #{{ $order->order_id }} — Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

    {{-- ── Left: Upload Form ───────────────────────────────────── --}}
    <div class="lg:col-span-7 space-y-6">

        {{-- Flash + Errors --}}
        @if($errors->any())
            <div class="bg-error-container border-[3px] border-danger p-4">
                @foreach($errors->all() as $error)
                    <p class="text-sm text-danger font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">error</span> {{ $error }}
                    </p>
                @endforeach
            </div>
        @endif

        {{-- Current Payment Status --}}
        @if($order->payment)
            <div class="neo-card {{ $order->payment->status === 'verified' ? 'bg-success border-success' : ($order->payment->status === 'rejected' ? 'bg-error-container border-danger' : 'bg-secondary-container') }} p-6">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-3xl {{ $order->payment->status === 'verified' ? 'text-white' : 'text-on-secondary-container' }}"
                          style="font-variation-settings:'FILL' 1">
                        {{ $order->payment->status === 'verified' ? 'verified' : ($order->payment->status === 'rejected' ? 'cancel' : 'pending') }}
                    </span>
                    <div>
                        <p class="font-grotesk font-bold uppercase {{ $order->payment->status === 'verified' ? 'text-white' : 'text-on-secondary-container' }}">
                            Status: {{ ['verified'=>'Terverifikasi','unverified'=>'Menunggu Verifikasi','rejected'=>'Ditolak'][$order->payment->status] ?? $order->payment->status }}
                        </p>
                        @if($order->payment->status === 'rejected')
                            <p class="text-sm text-danger mt-1">Bukti pembayaran ditolak. Silakan upload ulang bukti yang valid.</p>
                        @elseif($order->payment->status === 'verified')
                            <p class="text-sm text-white mt-1">Pembayaran kamu sudah diverifikasi.</p>
                        @else
                            <p class="text-sm text-on-secondary-container mt-1">Bukti sedang ditinjau oleh admin kami.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{-- Upload Form --}}
        @if(!$order->payment || $order->payment->status !== 'verified')
            @php
                $isUpdate = $order->payment && $order->payment->status !== 'verified';
                $formAction = $isUpdate
                    ? route('payment.upload', $order->order_id)
                    : route('payment.store', $order->order_id);
            @endphp
            <form method="POST" action="{{ $formAction }}" enctype="multipart/form-data" id="payment-form">
                @csrf
                @if($isUpdate) @method('PUT') @endif

                <div class="neo-card bg-white p-8">
                    <h2 class="font-grotesk font-bold uppercase text-on-surface text-xl mb-6 border-b-[3px] border-stroke pb-4">
                        {{ $isUpdate ? 'Upload Bukti Baru' : 'Upload Bukti Pembayaran' }}
                    </h2>

                    {{-- Upload Zone --}}
                    <div class="mb-6">
                        <label class="neo-label">Foto / Screenshot Bukti Transfer</label>
                        <label for="payment_proof"
                            class="border-[3px] border-dashed border-stroke rounded-lg p-10 flex flex-col items-center justify-center bg-surface-container-low cursor-pointer hover:bg-primary-fixed hover:border-primary transition-all group"
                            id="upload-zone">
                            <span class="material-symbols-outlined text-5xl text-outline mb-3 group-hover:text-primary transition-colors" id="upload-icon" style="font-variation-settings:'FILL' 0">upload_file</span>
                            <p class="font-grotesk font-bold text-on-surface text-center" id="upload-text">Klik untuk pilih file atau drag & drop</p>
                            <p class="text-xs text-on-surface-variant mt-2">JPG, PNG, PDF (maks 2MB)</p>
                            <input type="file" id="payment_proof" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf"
                                class="hidden" onchange="previewFile(this)">
                        </label>

                        {{-- Preview --}}
                        <div id="file-preview" class="hidden mt-4 border-[3px] border-stroke bg-surface-container-low p-4 flex items-center gap-4">
                            <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings:'FILL' 1">image</span>
                            <div class="flex-grow">
                                <p id="file-name" class="font-bold text-sm text-on-surface"></p>
                                <p id="file-size" class="text-xs text-on-surface-variant"></p>
                            </div>
                            <button type="button" onclick="clearFile()" class="text-danger hover:text-red-700">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                        @error('payment_proof')
                            <p class="text-xs text-danger mt-2 font-bold flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">error</span> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="neo-btn-primary w-full justify-center py-4 text-base font-grotesk font-black uppercase">
                        <span class="material-symbols-outlined">upload</span>
                        {{ $isUpdate ? 'Perbarui Bukti Bayar' : 'Kirim Bukti Bayar' }}
                    </button>

                    <p class="text-xs text-center text-on-surface-variant mt-4 flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        File kamu aman dan terenkripsi
                    </p>
                </div>
            </form>

            {{-- Existing proof --}}
            @if($isUpdate && $order->payment->payment_proof)
                <div class="neo-card bg-surface-container-low p-6">
                    <h3 class="font-grotesk font-bold uppercase text-sm text-on-surface mb-3">Bukti Sebelumnya</h3>
                    @php $ext = pathinfo($order->payment->payment_proof, PATHINFO_EXTENSION); @endphp
                    @if(in_array(strtolower($ext), ['jpg','jpeg','png','webp']))
                        <img src="{{ asset('storage/'.$order->payment->payment_proof) }}"
                             alt="Bukti Pembayaran"
                             class="max-h-64 border-[3px] border-stroke object-contain bg-white mx-auto block">
                    @else
                        <a href="{{ asset('storage/'.$order->payment->payment_proof) }}" target="_blank"
                           class="neo-btn-outline text-sm justify-center w-full">
                            <span class="material-symbols-outlined text-sm">open_in_new</span>
                            Lihat Dokumen
                        </a>
                    @endif
                </div>
            @endif
        @else
            {{-- Already verified --}}
            <div class="neo-card bg-white p-8 text-center">
                <span class="material-symbols-outlined text-6xl text-success mb-4 block" style="font-variation-settings:'FILL' 1">task_alt</span>
                <h3 class="font-grotesk font-bold text-on-surface uppercase text-xl mb-2">Pembayaran Terverifikasi</h3>
                <p class="text-sm text-on-surface-variant mb-6">Pembayaranmu telah dikonfirmasi. Pesanan sedang dalam proses!</p>
                <a href="{{ route('order.show', $order->order_id) }}" class="neo-btn-primary text-sm justify-center">
                    <span class="material-symbols-outlined text-sm">visibility</span>
                    Lihat Status Pesanan
                </a>
            </div>
        @endif

    </div>

    {{-- ── Right: Order Summary Sidebar ─────────────────────────── --}}
    <aside class="lg:col-span-5 space-y-4 sticky top-24">

        {{-- Order Summary --}}
        <div class="neo-card bg-white p-6">
            <h2 class="font-grotesk font-bold uppercase text-on-surface border-b-[2px] border-stroke pb-3 mb-4">Ringkasan Pesanan</h2>
            <div class="space-y-3 mb-6">
                @foreach($order->orderDetails as $detail)
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">{{ $detail->service?->service_name }} ×{{ $detail->quantity }}</span>
                        <span class="font-bold text-on-surface">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
            <div class="border-t-[3px] border-stroke pt-4 flex justify-between items-center">
                <span class="font-grotesk font-bold uppercase">Total</span>
                <span class="font-grotesk font-black text-2xl">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Bank Account Info --}}
        <div class="neo-card-yellow p-6">
            <h3 class="font-grotesk font-bold uppercase text-on-secondary-container mb-4">Info Rekening</h3>
            <div class="space-y-3">
                <div class="flex flex-col gap-1">
                    <span class="text-xs font-bold uppercase text-on-secondary-container">Bank Transfer</span>
                    <span class="font-grotesk font-black text-on-secondary-container text-lg">BCA — 1234-5678-90</span>
                    <span class="text-sm text-on-secondary-container">a.n. Lose ShoesCare</span>
                </div>
                <div class="bg-white border-[2px] border-stroke p-3">
                    <p class="text-xs text-on-surface-variant font-bold uppercase mb-1">Nominal Transfer</p>
                    <p class="font-grotesk font-black text-primary text-xl">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                </div>
                <p class="text-xs text-on-secondary-container">
                    <span class="material-symbols-outlined text-sm align-middle">info</span>
                    Transfer tepat sesuai nominal. Sertakan nomor pesanan sebagai keterangan.
                </p>
            </div>
        </div>

    </aside>
</div>

@endsection

@section('scripts')
<script>
    function previewFile(input) {
        const file = input.files[0];
        if (!file) return;
        const preview = document.getElementById('file-preview');
        const nameEl  = document.getElementById('file-name');
        const sizeEl  = document.getElementById('file-size');
        const iconEl  = document.getElementById('upload-icon');
        const textEl  = document.getElementById('upload-text');

        nameEl.textContent = file.name;
        sizeEl.textContent = (file.size / 1024).toFixed(1) + ' KB';
        preview.classList.remove('hidden');
        iconEl.style.fontVariationSettings = "'FILL' 1";
        iconEl.className = 'material-symbols-outlined text-5xl text-primary mb-3 transition-colors';
        textEl.textContent = 'File dipilih!';
    }

    function clearFile() {
        document.getElementById('payment_proof').value = '';
        document.getElementById('file-preview').classList.add('hidden');
        document.getElementById('upload-text').textContent = 'Klik untuk pilih file atau drag & drop';
        document.getElementById('upload-icon').style.fontVariationSettings = "'FILL' 0";
        document.getElementById('upload-icon').className = 'material-symbols-outlined text-5xl text-outline mb-3 transition-colors';
    }

    // Drag & drop support
    const zone = document.getElementById('upload-zone');
    if (zone) {
        zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('border-primary', 'bg-primary-fixed'); });
        zone.addEventListener('dragleave', () => zone.classList.remove('border-primary', 'bg-primary-fixed'));
        zone.addEventListener('drop', e => {
            e.preventDefault();
            zone.classList.remove('border-primary', 'bg-primary-fixed');
            const input = document.getElementById('payment_proof');
            const dt = new DataTransfer();
            dt.items.add(e.dataTransfer.files[0]);
            input.files = dt.files;
            previewFile(input);
        });
    }
</script>
@endsection
