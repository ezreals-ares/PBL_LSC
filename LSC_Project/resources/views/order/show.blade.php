@extends('layouts.customer')

@section('title', 'Detail Pesanan')

@section('content')

@php
    $statusLabel = ['pending'=>'Menunggu Konfirmasi','diproses'=>'Sedang Diproses','selesai'=>'Selesai','dibatalkan'=>'Dibatalkan'][$order->status] ?? $order->status;
    $statusBadge = ['pending'=>'badge-pending','diproses'=>'badge-diproses','selesai'=>'badge-selesai','dibatalkan'=>'badge-dibatalkan'][$order->status] ?? 'badge-pending';
@endphp

{{-- ── Back + Header ───────────────────────────────────────────── --}}
<div class="mb-8">
    <a href="{{ route('order.history') }}" class="inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary transition-colors mb-4 uppercase">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Kembali
    </a>
    <h1 class="font-grotesk font-black uppercase tracking-tighter" style="font-size: clamp(1.5rem, 4vw, 2.5rem);">
        Detail Pesanan
    </h1>
    <p class="text-on-surface-variant mt-1">{{ $order->jenis_sepatu ? 'Sepatu: '.$order->jenis_sepatu : 'Lihat progres pesananmu.' }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

    {{-- ── Left: Timeline ──────────────────────────────────────── --}}
    <section class="lg:col-span-8 space-y-6">

        {{-- Progress Timeline --}}
        @php
            $steps = [
                ['pending',    'check',          'bg-secondary-container',   'Pesanan Diterima',    'Pesanan kamu sudah kami terima dan sedang menunggu konfirmasi admin.'],
                ['diproses',   'cleaning_services', 'bg-primary-container', 'Sedang Diproses',     'Tim teknisi kami sedang memproses dan membersihkan sepatumu.'],
                ['selesai',    'verified',        'bg-success',              'Selesai & Siap',      'Sepatu sudah selesai diproses dan siap untuk diambil/dikirim.'],
            ];
            $currentIdx = match($order->status) {
                'pending'    => 0,
                'diproses'   => 1,
                'selesai'    => 2,
                'dibatalkan' => -1,
                default      => 0,
            };
        @endphp

        @if($order->status === 'dibatalkan')
            <div class="neo-card bg-error-container border-danger p-8 flex items-start gap-4">
                <span class="material-symbols-outlined text-danger text-4xl shrink-0" style="font-variation-settings:'FILL' 1">cancel</span>
                <div>
                    <h3 class="font-grotesk font-bold uppercase text-danger text-xl">Pesanan Dibatalkan</h3>
                    <p class="text-sm text-danger mt-1">Pesanan ini telah dibatalkan dan tidak dapat diproses lebih lanjut.</p>
                </div>
            </div>
        @else
            <div class="space-y-0">
                @foreach($steps as $stepIdx => [$key, $icon, $circleBg, $title, $desc])
                    @php
                        $isDone   = $stepIdx < $currentIdx;
                        $isActive = $stepIdx === $currentIdx;
                        $isPending = $stepIdx > $currentIdx;
                    @endphp
                    <div class="flex gap-5">
                        {{-- Timeline indicator --}}
                        <div class="flex flex-col items-center">
                            @php $stepFillStyle = $isDone ? "font-variation-settings:'FILL' 1" : ''; @endphp
                            <div class="w-12 h-12 rounded-full border-[3px] border-stroke flex items-center justify-center z-10
                                {{ $isDone ? 'bg-secondary-container' : ($isActive ? $circleBg.' '.'animate-pulse' : 'bg-surface-container opacity-40') }}">
                                <span class="material-symbols-outlined text-xl font-black
                                    {{ $isDone ? 'text-stroke' : ($isActive ? 'text-on-primary-container' : 'text-on-surface-variant') }}"
                                      style="{{ $stepFillStyle }}">
                                    {{ $isDone ? 'check' : $icon }}
                                </span>
                            </div>
                            @if(!$loop->last)
                                <div class="w-[3px] flex-1 my-1 {{ $isDone || $isActive ? 'bg-stroke' : 'bg-outline-variant' }}"></div>
                            @endif
                        </div>

                        {{-- Step Content --}}
                        <div class="pb-8 flex-grow {{ $isPending ? 'opacity-50' : '' }}">
                            <div class="neo-card {{ $isActive ? 'bg-primary-container border-primary neo-shadow' : ($isDone ? 'bg-white' : 'bg-surface-container-low border-dashed') }} p-6">
                                <div class="flex flex-wrap justify-between items-start gap-2 mb-3">
                                    <span class="text-xs font-bold uppercase {{ $isActive ? 'bg-white text-primary' : 'bg-secondary-container text-on-secondary-container' }} px-3 py-1 border-[2px] border-stroke">
                                        Langkah {{ $stepIdx + 1 }}{{ $isActive ? ' (Aktif)' : '' }}
                                    </span>
                                    @if($isDone)
                                        <span class="text-xs text-on-surface-variant font-bold">✓ Selesai</span>
                                    @elseif($isPending)
                                        <span class="text-xs text-on-surface-variant font-bold">Menunggu</span>
                                    @endif
                                </div>
                                <h3 class="font-grotesk font-bold text-xl mb-1 {{ $isActive ? 'text-on-primary-container' : 'text-on-surface' }}">
                                    {{ $title }}
                                </h3>
                                <p class="text-sm {{ $isActive ? 'text-on-primary-container/80' : 'text-on-surface-variant' }}">{{ $desc }}</p>

                                @if($isActive && $order->status === 'diproses')
                                    <div class="mt-4">
                                        <div class="w-full bg-white/20 h-4 border-[2px] border-stroke overflow-hidden">
                                            <div class="bg-secondary-container h-full w-2/3 border-r-[2px] border-stroke"></div>
                                        </div>
                                        <div class="flex justify-between mt-1 text-xs font-bold text-on-primary-container">
                                            <span>Processing — 65%</span>
                                            @if($order->estimated_finish)
                                                <span>Est: {{ \Carbon\Carbon::parse($order->estimated_finish)->format('d M Y') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- ── Order Items ────────────────────────────────────── --}}
        <div class="neo-card bg-white p-8">
            <h2 class="font-grotesk font-bold uppercase text-on-surface text-xl mb-5 border-b-[3px] border-stroke pb-4">Detail Layanan</h2>
            <div class="space-y-3">
                @foreach($order->orderDetails as $detail)
                    <div class="flex items-center justify-between p-4 bg-surface-container-low border-[2px] border-stroke rounded-lg">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings:'FILL' 1">cleaning_services</span>
                            <div>
                                <p class="font-bold text-on-surface text-sm">{{ $detail->service?->service_name ?? 'Layanan' }}</p>
                                <p class="text-xs text-on-surface-variant">×{{ $detail->quantity }}</p>
                            </div>
                        </div>
                        <span class="font-grotesk font-black text-on-surface">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach

                {{-- Notes --}}
                @if($order->catatan)
                    <div class="p-4 bg-secondary-container border-[2px] border-stroke rounded-lg">
                        <p class="text-xs font-bold uppercase text-on-secondary-container mb-1">Catatan</p>
                        <p class="text-sm text-on-secondary-container">{{ $order->catatan }}</p>
                    </div>
                @endif

                {{-- Total --}}
                <div class="flex justify-between items-center border-t-[3px] border-stroke pt-4 mt-2">
                    <span class="font-grotesk font-bold uppercase text-on-surface">Total</span>
                    <span class="font-grotesk font-black text-2xl text-on-surface">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Review Section --}}
        @if($order->status === 'selesai')
            <div class="neo-card-yellow p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="font-grotesk font-bold uppercase text-on-secondary-container">
                        {{ $order->review ? '⭐ Ulasanmu' : '📝 Bagikan Pengalamanmu' }}
                    </h3>
                    @if($order->review)
                        <div class="flex gap-1 mt-1">
                            @for($i = 1; $i <= 5; $i++)
                                @php $starFill = ($i <= $order->review->rating) ? "font-variation-settings:'FILL' 1" : ''; @endphp
                                <span class="material-symbols-outlined text-sm {{ $i <= $order->review->rating ? 'text-on-secondary-container' : 'text-outline-variant' }}"
                                      style="{{ $starFill }}">star</span>
                            @endfor
                        </div>
                        <p class="text-sm text-on-secondary-container mt-1 italic">"{{ Str::limit($order->review->comment, 80) }}"</p>
                    @else
                        <p class="text-sm text-on-secondary-container mt-1">Pesanan selesai! Bagikan ulasan untuk membantu kami berkembang.</p>
                    @endif
                </div>
                @if(!$order->review)
                    <a href="{{ route('review.create', $order->order_id) }}" class="neo-btn-white shrink-0">
                        <span class="material-symbols-outlined text-sm">star_rate</span>
                        Tulis Ulasan
                    </a>
                @else
                    <a href="{{ route('review.edit', $order->order_id) }}" class="neo-btn-white shrink-0">
                        <span class="material-symbols-outlined text-sm">edit</span>
                        Edit Ulasan
                    </a>
                @endif
            </div>
        @endif

    </section>

    {{-- ── Right: Summary Sidebar ──────────────────────────────── --}}
    <aside class="lg:col-span-4 space-y-4">

        {{-- Order Summary Card --}}
        <div class="neo-card bg-white p-6">
            <h2 class="font-grotesk font-bold uppercase text-on-surface border-b-[2px] border-stroke pb-3 mb-4">Info Pesanan</h2>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-on-surface-variant">Status</span>
                    <span class="{{ $statusBadge }}">{{ $statusLabel }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-on-surface-variant">Tanggal Pesan</span>
                    <span class="font-bold text-on-surface">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</span>
                </div>
                @if($order->estimated_finish)
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Est. Selesai</span>
                        <span class="font-bold text-on-surface">{{ \Carbon\Carbon::parse($order->estimated_finish)->format('d M Y') }}</span>
                    </div>
                @endif
                <div class="flex justify-between text-sm">
                    <span class="text-on-surface-variant">Pickup</span>
                    <span class="font-bold text-on-surface uppercase">{{ $order->pickup_method }}</span>
                </div>
                @if($order->material_sepatu)
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Material</span>
                        <span class="font-bold text-on-surface">{{ $order->material_sepatu }}</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Payment Status Card --}}
        <div class="neo-card bg-white p-6">
            <h2 class="font-grotesk font-bold uppercase text-on-surface border-b-[2px] border-stroke pb-3 mb-4">Status Pembayaran</h2>

            @if($order->payment)
                <div class="space-y-3">
                    <div class="flex justify-between items-center p-3 {{ $order->payment->status === 'verified' ? 'bg-success' : ($order->payment->status === 'rejected' ? 'bg-error-container' : 'bg-secondary-container') }} border-[3px] border-stroke">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-black" style="font-variation-settings:'FILL' 1">
                                {{ $order->payment->status === 'verified' ? 'verified' : 'pending' }}
                            </span>
                            <span class="font-bold text-sm uppercase text-black">
                                {{ ['verified'=>'Terverifikasi','unverified'=>'Menunggu Verifikasi','rejected'=>'Ditolak'][$order->payment->status] ?? $order->payment->status }}
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Tanggal Bayar</span>
                        <span class="font-bold">{{ \Carbon\Carbon::parse($order->payment->payment_date)->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Jumlah</span>
                        <span class="font-grotesk font-black">Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</span>
                    </div>

                    @if($order->payment->status === 'unverified')
                        <a href="{{ route('payment.show', $order->order_id) }}" class="neo-btn-yellow w-full justify-center text-sm mt-2">
                            <span class="material-symbols-outlined text-sm">upload</span>
                            Ganti Bukti Bayar
                        </a>
                    @endif
                </div>
            @else
                @if($order->status !== 'dibatalkan')
                    <div class="text-center py-4">
                        <span class="material-symbols-outlined text-4xl text-outline mb-2 block">payments</span>
                        <p class="text-sm text-on-surface-variant mb-4">Belum ada pembayaran.</p>
                        <a href="{{ route('payment.show', $order->order_id) }}" class="neo-btn-primary w-full justify-center text-sm">
                            <span class="material-symbols-outlined text-sm">upload</span>
                            Unggah Bukti Bayar
                        </a>
                    </div>
                @else
                    <p class="text-sm text-on-surface-variant text-center py-4">Pembayaran tidak tersedia untuk pesanan yang dibatalkan.</p>
                @endif
            @endif
        </div>

        {{-- Cancel Button --}}
        @if($order->status === 'pending')
            <form method="POST" action="{{ route('order.cancel', $order->order_id) }}"
                  onsubmit="return confirm('Yakin ingin membatalkan pesanan ini? Tindakan ini tidak dapat diurungkan.')">
                @csrf @method('DELETE')
                <button type="submit" class="neo-btn-danger w-full justify-center text-sm">
                    <span class="material-symbols-outlined text-sm">cancel</span>
                    Batalkan Pesanan
                </button>
            </form>
        @endif

    </aside>
</div>

@endsection
