@extends('layouts.customer')

@section('title', 'Riwayat Pesanan')

@section('extra-styles')
<style>
    .history-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        width: 100%;
    }
    .history-header h1 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-dark);
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

    /* ── Stepper Mini (Visual Progress) ── */
    .stepper-wrap {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 0;
        margin-top: 1rem;
        padding: 1rem;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 14px;
        border: 1px solid var(--border);
        width: 100%;
        flex: 1 1 100%;
    }
    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        flex: 1;
        position: relative;
    }
    .step-item:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 16px; /* Center of 32px circle */
        left: calc(50% + 16px);
        width: calc(100% - 32px);
        height: 3px;
        background: var(--border);
        z-index: 0;
        border-radius: 2px;
    }
    .step-item.done:not(:last-child)::after {
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
    }
    .step-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--white);
        border: 2px solid var(--border);
        color: var(--text-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.85rem;
        position: relative;
        z-index: 1;
        transition: all 0.3s;
    }
    .step-item.done .step-circle {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        border-color: var(--primary);
        color: white;
    }
    .step-item.current .step-circle {
        background: var(--primary);
        border-color: var(--primary-light);
        color: white;
        box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.2);
        animation: pulse-ring-mini 2s infinite;
    }
    .step-item.cancelled .step-circle {
        background: #ef4444;
        border-color: #fca5a5;
        color: white;
    }
    @keyframes pulse-ring-mini {
        0%   { box-shadow: 0 0 0 0 rgba(2, 132, 199, 0.4); }
        70%  { box-shadow: 0 0 0 8px rgba(2, 132, 199, 0); }
        100% { box-shadow: 0 0 0 0 rgba(2, 132, 199, 0); }
    }
    .step-label {
        font-size: 0.75rem;
        color: var(--text-light);
        text-align: center;
        font-weight: 700;
        transition: all 0.2s;
    }
    .step-item.done .step-label { color: var(--text-dark); }
    .step-item.current .step-label { color: var(--primary); font-size: 0.8rem; }
    .step-item.cancelled .step-label { color: #ef4444; }
</style>
@endsection

@section('content')

<div class="history-header" style="margin-bottom: 2rem;">
    <h1>Riwayat Pesanan Saya</h1>
    <a href="{{ route('order.create') }}" class="btn btn-primary" style="margin-left:auto;">
        <i class="fas fa-plus"></i> Buat Pesanan
    </a>
</div>

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

        {{-- Right: price + action --}}
        <div class="order-card-right">
            <span class="order-card-price">
                Rp {{ number_format($order->total_price, 0, ',', '.') }}
            </span>
            <a href="{{ route('order.show', $order->order_id) }}" class="btn btn-outline btn-sm">
                Lihat Detail
            </a>
        </div>

        {{-- Bottom: Visual Progress --}}
        @php
            $statusFlow = ['pending', 'diproses', 'selesai'];
            $currentStatus = $order->status;
            $isCancelled = $currentStatus === 'dibatalkan';

            $stepLabels = [
                'pending'   => 'Menunggu',
                'diproses'  => 'Diproses',
                'selesai'   => 'Selesai',
                'dibatalkan'=> 'Dibatalkan',
            ];
            $currentIndex = array_search($currentStatus, $statusFlow);
        @endphp
        <div class="stepper-wrap">
            @if(!$isCancelled)
                @foreach($statusFlow as $i => $step)
                    @php
                        $stepIndex = array_search($step, $statusFlow);
                        if ($currentIndex === false) $cls = 'future';
                        elseif ($stepIndex < $currentIndex) $cls = 'done';
                        elseif ($stepIndex === $currentIndex) $cls = 'current';
                        else $cls = 'future';
                    @endphp
                    <div class="step-item {{ $cls }}">
                        <div class="step-circle">
                            @if($cls === 'done')
                                <i class="fas fa-check" style="font-size:0.7rem;"></i>
                            @elseif($cls === 'current')
                                <i class="fas fa-circle-dot" style="font-size:0.75rem;"></i>
                            @else
                                {{ $i + 1 }}
                            @endif
                        </div>
                        <span class="step-label">{{ $stepLabels[$step] }}</span>
                    </div>
                @endforeach
            @else
                @foreach(['pending', 'diproses'] as $i => $step)
                    <div class="step-item future">
                        <div class="step-circle">{{ $i + 1 }}</div>
                        <span class="step-label">{{ $stepLabels[$step] }}</span>
                    </div>
                @endforeach
                <div class="step-item cancelled">
                    <div class="step-circle"><i class="fas fa-ban" style="font-size:0.7rem;"></i></div>
                    <span class="step-label">Dibatalkan</span>
                </div>
            @endif
        </div>
    </div>
    @endforeach
@endif

@endsection
