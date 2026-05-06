@extends('layouts.customer')

@section('title', 'Riwayat Pesanan')

@section('extra-styles')
<style>
    .history-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1.25rem;
        margin-bottom: 1.25rem;
        width: 100%;
    }
    .history-header h1 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-dark);
    }
    .history-subtext {
        color: var(--text-light);
        font-size: 0.9rem;
        margin-bottom: 2.5rem;
    }

    /* Flash messages */
    .flash-success {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #166534;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
    }
    .flash-error {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #991b1b;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }
    .empty-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 1.5rem;
        color: var(--border);
    }
    .empty-state h2 { font-size: 1.4rem; color: var(--text-dark); margin-bottom: 0.5rem; }
    .empty-state p  { color: var(--text-light); margin-bottom: 1.5rem; }

    /* Order cards */
    .order-card {
        background: var(--white);
        border-radius: 18px;
        border: 1px solid var(--border);
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex-wrap: wrap;
        transition: all 0.25s ease;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .order-card:hover {
        border-color: var(--primary-light);
        box-shadow: 0 6px 20px rgba(2,132,199,0.1);
        transform: translateY(-2px);
    }
    .order-card-left {
        flex: 0 0 auto;
        min-width: 140px;
    }
    .order-card-id {
        font-family: monospace;
        font-size: 0.85rem;
        color: var(--text-light);
        margin-bottom: 0.25rem;
        letter-spacing: 1px;
    }
    .order-card-date {
        font-size: 0.8rem;
        color: var(--text-light);
        margin-bottom: 0.5rem;
    }
    .order-card-pickup {
        font-size: 0.8rem;
        color: var(--text-light);
    }
    .order-card-mid {
        flex: 1;
        min-width: 150px;
    }
    .order-card-services {
        font-size: 0.9rem;
        color: var(--text-dark);
        font-weight: 600;
        line-height: 1.5;
    }
    .order-card-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 0.5rem;
        min-width: 140px;
    }
    .order-card-price {
        font-size: 1.05rem;
        font-weight: 800;
        color: var(--primary-light);
    }
</style>
@endsection

@section('content')

<div class="history-header">
    <h1>Riwayat Pesanan Saya</h1>
    <a href="{{ route('order.create') }}" class="btn btn-primary" style="margin-left:auto;">
        + Buat Pesanan Baru
    </a>
</div>
<p class="history-subtext">Kelola dan pantau semua pesanan Anda di sini.</p>

@if(session('success'))
    <div class="flash-success">
        <i class="fas fa-circle-check"></i> {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="flash-error">
        <i class="fas fa-circle-xmark"></i> {{ session('error') }}
    </div>
@endif

@if($orders->isEmpty())
    {{-- Empty state --}}
    <div class="card empty-state">
        <svg class="empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4m8-7v7"/>
        </svg>
        <h2>Belum ada pesanan</h2>
        <p>Anda belum pernah membuat pesanan. Yuk, coba layanan premium kami!</p>
        <a href="{{ route('order.create') }}" class="btn btn-primary">
            Buat Pesanan Pertama →
        </a>
    </div>
@else
    @foreach($orders as $order)
    <div class="order-card">
        {{-- Left: ID + date + pickup --}}
        <div class="order-card-left">
            <div class="order-card-id">
                #{{ strtoupper(substr(str_pad($order->order_id, 8, '0', STR_PAD_LEFT), -8)) }}
            </div>
            <div class="order-card-date">
                {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}
            </div>
            <div class="order-card-pickup">
                @if($order->pickup_method === 'pickup')
                    <i class="fas fa-car" style="color:var(--primary);"></i> Jemput
                @else
                    <i class="fas fa-store" style="color:var(--primary);"></i> Antar Langsung
                @endif
            </div>
        </div>

        {{-- Mid: services --}}
        <div class="order-card-mid">
            <div class="order-card-services">
                @php
                    $serviceNames = $order->orderDetails
                        ->map(fn($d) => $d->service ? $d->service->service_name : '—')
                        ->join(', ');
                @endphp
                {{ $serviceNames ?: '—' }}
            </div>
        </div>

        {{-- Right: status + price + action --}}
        <div class="order-card-right">
            <span class="badge badge-{{ $order->status }}">
                @switch($order->status)
                    @case('pending')    Menunggu @break
                    @case('diproses')   Diproses @break
                    @case('selesai')    Selesai  @break
                    @case('dibatalkan') Dibatalkan @break
                @endswitch
            </span>
            <span class="order-card-price">
                Rp {{ number_format($order->total_price, 0, ',', '.') }}
            </span>
            <a href="{{ route('order.show', $order->order_id) }}" class="btn btn-outline btn-sm">
                Lihat Detail
            </a>
        </div>
    </div>
    @endforeach
@endif

@endsection
