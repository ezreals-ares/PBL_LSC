@extends('layouts.customer')

@section('title', 'Riwayat Pesanan')

@section('content')

{{-- ── Header ──────────────────────────────────────────────────── --}}
<header class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
    <div>
        <h1 class="font-grotesk font-black uppercase tracking-tighter" style="font-size: clamp(1.8rem, 4vw, 2.8rem);">
            Riwayat Pesanan
        </h1>
        <p class="text-on-surface-variant text-base mt-1">Pantau status dan progres semua pesananmu.</p>
    </div>
    <a href="{{ route('order.create') }}" class="neo-btn-primary py-3 px-6 shrink-0">
        <span class="material-symbols-outlined text-sm">add_circle</span>
        Pesan Baru
    </a>
</header>

@if($orders->count() > 0)

    {{-- ── Order Table / Cards ─────────────────────────────────── --}}
    {{-- Desktop Table --}}
    <div class="neo-card bg-surface overflow-hidden hidden md:block">
        <div class="p-6 border-b-[3px] border-stroke bg-surface-variant flex justify-between items-center">
            <h2 class="font-grotesk font-bold text-on-surface uppercase text-xl">Semua Pesanan</h2>
            <span class="bg-secondary-container border-[2px] border-stroke px-3 py-1 font-label-md text-on-secondary-container font-bold text-xs uppercase">
                {{ $orders->count() }} PESANAN
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white border-b-[3px] border-stroke">
                        <th class="p-5 font-grotesk font-bold uppercase text-sm text-on-surface">Tanggal</th>
                        <th class="p-5 font-grotesk font-bold uppercase text-sm text-on-surface">Layanan</th>
                        <th class="p-5 font-grotesk font-bold uppercase text-sm text-on-surface">Total</th>
                        <th class="p-5 font-grotesk font-bold uppercase text-sm text-on-surface">Status</th>
                        <th class="p-5 font-grotesk font-bold uppercase text-sm text-on-surface">Bayar</th>
                        <th class="p-5 font-grotesk font-bold uppercase text-sm text-on-surface">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-[2px] divide-stroke">
                    @foreach($orders as $order)
                        @php
                            $statusBadge = [
                                'pending'    => 'badge-pending',
                                'diproses'   => 'badge-diproses',
                                'selesai'    => 'badge-selesai',
                                'dibatalkan' => 'badge-dibatalkan',
                            ][$order->status] ?? 'badge-pending';
                            $statusLabel = [
                                'pending'    => 'Menunggu',
                                'diproses'   => 'Diproses',
                                'selesai'    => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                            ][$order->status] ?? $order->status;
                            $payBadge = match($order->payment?->status ?? 'none') {
                                'verified'   => 'badge-pay-verified',
                                'unverified' => 'badge-pay-unverified',
                                'rejected'   => 'badge-pay-rejected',
                                default      => '',
                            };
                            $payLabel = match($order->payment?->status ?? 'none') {
                                'verified'   => 'Terverifikasi',
                                'unverified' => 'Menunggu',
                                'rejected'   => 'Ditolak',
                                default      => '—',
                            };
                        @endphp
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="p-5 text-sm text-on-surface">
                                <div>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</div>
                            </td>
                            <td class="p-5">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-primary text-lg" style="font-variation-settings:'FILL' 1">cleaning_services</span>
                                    <div>
                                        <p class="font-bold text-sm text-on-surface">
                                            {{ $order->orderDetails->first()?->service?->service_name ?? 'Layanan' }}
                                        </p>
                                        @if($order->jenis_sepatu)
                                            <p class="text-xs text-on-surface-variant">{{ $order->jenis_sepatu }}</p>
                                        @endif
                                        @if($order->orderDetails->count() > 1)
                                            <p class="text-xs text-on-surface-variant">+{{ $order->orderDetails->count() - 1 }} layanan lain</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="p-5 font-grotesk font-black text-on-surface">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="p-5">
                                <span class="{{ $statusBadge }}">{{ $statusLabel }}</span>
                            </td>
                            <td class="p-5">
                                @if($payBadge)
                                    <span class="{{ $payBadge }}">{{ $payLabel }}</span>
                                @else
                                    <span class="text-xs text-on-surface-variant">—</span>
                                @endif
                            </td>
                            <td class="p-5">
                                <div class="flex items-center gap-2 flex-wrap">

                                    {{-- Detail --}}
                                    <a href="{{ route('order.show', $order->order_id) }}"
                                       class="neo-btn-white neo-press-sm inline-flex items-center gap-1 px-3 py-1.5 text-xs border-[2px]">
                                        <span class="material-symbols-outlined" style="font-size:0.9rem;">receipt_long</span>
                                        Detail
                                    </a>

                                    {{-- Pay --}}
                                    @if($order->status !== 'dibatalkan')
                                        @if(!$order->payment)
                                            <a href="{{ route('payment.show', $order->order_id) }}"
                                               class="neo-btn-white neo-press-sm inline-flex items-center gap-1 px-3 py-1.5 text-xs border-[2px]">
                                                <span class="material-symbols-outlined" style="font-size:0.9rem;">payment</span>
                                                Bayar
                                            </a>
                                        @elseif($order->payment->status === 'unverified')
                                            <a href="{{ route('payment.show', $order->order_id) }}"
                                               class="neo-btn-white neo-press-sm inline-flex items-center gap-1 px-3 py-1.5 text-xs border-[2px]">
                                                <span class="material-symbols-outlined" style="font-size:0.9rem;">upload_file</span>
                                                Ganti Bukti
                                            </a>
                                        @endif
                                    @endif

                                    {{-- Review --}}
                                    @if($order->status === 'selesai')
                                        @if(!$order->review)
                                            <a href="{{ route('review.create', $order->order_id) }}"
                                               class="neo-btn-white neo-press-sm inline-flex items-center gap-1 px-3 py-1.5 text-xs border-[2px]">
                                                <span class="material-symbols-outlined" style="font-size:0.9rem;">rate_review</span>
                                                Ulasan
                                            </a>
                                        @else
                                            <a href="{{ route('review.edit', $order->order_id) }}"
                                               class="neo-btn-white neo-press-sm inline-flex items-center gap-1 px-3 py-1.5 text-xs border-[2px]">
                                                <span class="material-symbols-outlined" style="font-size:0.9rem;">edit_note</span>
                                                Edit Ulasan
                                            </a>
                                        @endif
                                    @endif

                                    {{-- Cancel --}}
                                    @if($order->status === 'pending')
                                        <form method="POST" action="{{ route('order.cancel', $order->order_id) }}"
                                              onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="neo-btn-white neo-press-sm inline-flex items-center gap-1 px-3 py-1.5 text-xs border-[2px] cursor-pointer">
                                                <span class="material-symbols-outlined" style="font-size:0.9rem;">cancel</span>
                                                Batal
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mobile Cards --}}
    <div class="md:hidden space-y-4">
        @foreach($orders as $order)
            @php
                $statusBadge = ['pending'=>'badge-pending','diproses'=>'badge-diproses','selesai'=>'badge-selesai','dibatalkan'=>'badge-dibatalkan'][$order->status] ?? 'badge-pending';
                $statusLabel = ['pending'=>'Menunggu','diproses'=>'Diproses','selesai'=>'Selesai','dibatalkan'=>'Dibatalkan'][$order->status] ?? $order->status;
            @endphp
            <div class="neo-card bg-white p-5">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="font-grotesk font-bold text-on-surface">{{ $order->orderDetails->first()?->service?->service_name ?? 'Layanan' }}</p>
                        @if($order->jenis_sepatu)
                            <p class="text-xs text-on-surface-variant">{{ $order->jenis_sepatu }}</p>
                        @endif
                    </div>
                    <span class="{{ $statusBadge }}">{{ $statusLabel }}</span>
                </div>
                <div class="flex justify-between items-center border-t-[2px] border-stroke pt-4">
                    <div>
                        <p class="text-xs text-on-surface-variant">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</p>
                        <p class="font-grotesk font-black text-on-surface">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex gap-2 flex-wrap justify-end">

                        {{-- Detail --}}
                        <a href="{{ route('order.show', $order->order_id) }}"
                           class="neo-btn-white neo-press-sm inline-flex items-center gap-1 px-3 py-1.5 text-xs border-[2px]">
                            <span class="material-symbols-outlined" style="font-size:0.9rem;">receipt_long</span>
                            Detail
                        </a>

                        {{-- Pay --}}
                        @if($order->status !== 'dibatalkan')
                            @if(!$order->payment)
                                <a href="{{ route('payment.show', $order->order_id) }}"
                                   class="neo-btn-white neo-press-sm inline-flex items-center gap-1 px-3 py-1.5 text-xs border-[2px]">
                                    <span class="material-symbols-outlined" style="font-size:0.9rem;">payment</span>
                                    Bayar
                                </a>
                            @elseif($order->payment->status === 'unverified')
                                <a href="{{ route('payment.show', $order->order_id) }}"
                                   class="neo-btn-white neo-press-sm inline-flex items-center gap-1 px-3 py-1.5 text-xs border-[2px]">
                                    <span class="material-symbols-outlined" style="font-size:0.9rem;">upload_file</span>
                                    Ganti Bukti
                                </a>
                            @endif
                        @endif

                        {{-- Review --}}
                        @if($order->status === 'selesai')
                            @if(!$order->review)
                                <a href="{{ route('review.create', $order->order_id) }}"
                                   class="neo-btn-white neo-press-sm inline-flex items-center gap-1 px-3 py-1.5 text-xs border-[2px]">
                                    <span class="material-symbols-outlined" style="font-size:0.9rem;">rate_review</span>
                                    Ulasan
                                </a>
                            @else
                                <a href="{{ route('review.edit', $order->order_id) }}"
                                   class="neo-btn-white neo-press-sm inline-flex items-center gap-1 px-3 py-1.5 text-xs border-[2px]">
                                    <span class="material-symbols-outlined" style="font-size:0.9rem;">edit_note</span>
                                    Edit Ulasan
                                </a>
                            @endif
                        @endif

                        {{-- Cancel --}}
                        @if($order->status === 'pending')
                            <form method="POST" action="{{ route('order.cancel', $order->order_id) }}"
                                  onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="neo-btn-white neo-press-sm inline-flex items-center gap-1 px-3 py-1.5 text-xs border-[2px] cursor-pointer">
                                    <span class="material-symbols-outlined" style="font-size:0.9rem;">cancel</span>
                                    Batal
                                </button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>

@else

    {{-- Empty State --}}
    <div class="neo-card bg-surface p-16 text-center">
        <span class="material-symbols-outlined text-8xl text-outline mb-6 block" style="font-variation-settings:'FILL' 1">cleaning_services</span>
        <h2 class="font-grotesk font-black uppercase text-2xl text-on-surface mb-2">Belum Ada Pesanan</h2>
        <p class="text-on-surface-variant mb-8">Mulai perjalanan sneakermu dengan pesan layanan pertamamu!</p>
        <a href="{{ route('order.create') }}" class="neo-btn-primary py-4 px-8 text-base">
            <span class="material-symbols-outlined">add_circle</span>
            Pesan Sekarang
        </a>
    </div>

@endif

@endsection
