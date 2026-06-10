@extends('layouts.customer')

@section('title', 'Dashboard')

@section('content')

@php
    $user   = auth()->user();
    $orders = $user->orders()->with(['orderDetails.service', 'payment'])->latest('order_date')->get();
    $total     = $orders->count();
    $pending   = $orders->where('status', 'pending')->count();
    $diproses  = $orders->where('status', 'diproses')->count();
    $selesai   = $orders->where('status', 'selesai')->count();
    $recentOrders = $orders->take(5);
@endphp

{{-- ── Header ──────────────────────────────────────────────────── --}}
<header class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
    <div>
        <h1 class="font-grotesk font-black text-on-surface uppercase tracking-tighter" style="font-size: clamp(1.8rem, 4vw, 3rem);">
            Welcome back, {{ explode(' ', $user->name)[0] }}.
        </h1>
        <p class="text-on-surface-variant text-lg mt-1">Your sneakers are in good hands.</p>
    </div>
    <a href="{{ route('order.create') }}" class="neo-btn-primary py-4 px-8 text-base shrink-0">
        <span class="material-symbols-outlined">add_circle</span>
        New Cleaning Order
    </a>
</header>

{{-- ── Stats Bento ─────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @foreach([
        [$total,    'Total Pesanan',  'bg-primary text-on-primary',               'receipt_long'],
        [$pending,  'Menunggu',       'bg-secondary-container text-on-secondary-container', 'pending'],
        [$diproses, 'Diproses',       'bg-primary-container text-on-primary-container',     'autorenew'],
        [$selesai,  'Selesai',        'bg-success text-white',                    'check_circle'],
    ] as [$count, $label, $bg, $icon])
        <div class="neo-card {{ $bg }} p-6 flex flex-col items-start">
            <span class="material-symbols-outlined text-3xl mb-2 opacity-80" style="font-variation-settings:'FILL' 1">{{ $icon }}</span>
            <span class="font-grotesk font-black text-4xl">{{ $count }}</span>
            <span class="font-bold uppercase text-xs tracking-wider opacity-80 mt-1">{{ $label }}</span>
        </div>
    @endforeach
</div>

{{-- ── Main Grid ────────────────────────────────────────────────── --}}
<div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

    {{-- Recent Orders (hero card) --}}
    <div class="lg:col-span-8 neo-card bg-surface-container-low p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-grotesk font-bold text-on-surface text-2xl uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">moped</span>
                Pesanan Terbaru
            </h2>
            <a href="{{ route('order.history') }}" class="font-bold text-sm underline decoration-[3px] underline-offset-4 text-primary hover:text-primary-container">Lihat Semua</a>
        </div>

        @if($recentOrders->count() > 0)
            <div class="space-y-4">
                @foreach($recentOrders as $order)
                    @php
                        $statusConf = [
                            'pending'    => ['badge-pending',    'Menunggu'],
                            'diproses'   => ['badge-diproses',   'Diproses'],
                            'selesai'    => ['badge-selesai',    'Selesai'],
                            'dibatalkan' => ['badge-dibatalkan', 'Dibatalkan'],
                        ][$order->status] ?? ['badge-pending', $order->status];
                        $firstService = $order->orderDetails->first()?->service;
                    @endphp
                    <a href="{{ route('order.show', $order->order_id) }}"
                       class="flex flex-col md:flex-row items-start md:items-center gap-4 bg-white border-[3px] border-stroke p-4 md:p-5 rounded-lg hover:bg-secondary-container/20 transition-colors group">

                        {{-- Icon / status indicator --}}
                        <div class="w-14 h-14 border-[2px] border-stroke bg-surface-container flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings:'FILL' 1">cleaning_services</span>
                        </div>

                        <div class="grow">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <span class="font-grotesk font-bold text-xs text-on-surface-variant uppercase">#{{ $order->order_id }}</span>
                                @if($firstService)
                                    <span class="bg-primary text-on-primary text-[10px] font-black uppercase px-2 py-0.5 border-[1px] border-stroke">{{ $firstService->service_name }}</span>
                                @endif
                            </div>
                            <p class="font-grotesk font-bold text-on-surface">
                                {{ $order->jenis_sepatu ?: 'Pesanan Layanan' }}
                                @if($order->orderDetails->count() > 1)
                                    <span class="text-xs text-on-surface-variant font-normal">+{{ $order->orderDetails->count() - 1 }} layanan</span>
                                @endif
                            </p>
                            <p class="text-xs text-on-surface-variant mt-0.5">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</p>
                        </div>

                        <div class="flex items-center gap-3 shrink-0">
                            <span class="{{ $statusConf[0] }}">{{ $statusConf[1] }}</span>
                            <span class="font-grotesk font-black text-on-surface">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">chevron_right</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="border-[3px] border-dashed border-stroke rounded-lg p-12 text-center">
                <span class="material-symbols-outlined text-6xl text-outline mb-4 block">cleaning_services</span>
                <p class="font-grotesk font-bold text-on-surface-variant uppercase">Belum ada pesanan</p>
                <p class="text-sm text-on-surface-variant mt-1 mb-6">Mulai perjalanan sneakermu sekarang!</p>
                <a href="{{ route('order.create') }}" class="neo-btn-primary text-sm">
                    <span class="material-symbols-outlined text-sm">add_circle</span>
                    Pesan Sekarang
                </a>
            </div>
        @endif
    </div>

    {{-- Quick Actions & Stats sidebar --}}
    <div class="lg:col-span-4 flex flex-col gap-4">

        {{-- Quick Stats --}}
        <div class="neo-card-yellow p-6">
            <h2 class="font-grotesk font-bold uppercase tracking-tight text-on-secondary-container mb-5">Your Stats</h2>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-white border-[2px] border-stroke p-4 flex flex-col items-center text-center">
                    <span class="font-grotesk font-black text-3xl text-on-surface">{{ $selesai }}</span>
                    <span class="text-xs font-bold uppercase text-on-surface-variant mt-1">Selesai</span>
                </div>
                <div class="bg-white border-[2px] border-stroke p-4 flex flex-col items-center text-center">
                    <span class="font-grotesk font-black text-3xl text-on-surface">{{ $total }}</span>
                    <span class="text-xs font-bold uppercase text-on-surface-variant mt-1">Total</span>
                </div>
            </div>
            <div class="mt-4 bg-stroke text-white border-[2px] border-white p-3 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-secondary-container">Member Aktif</p>
                    <p class="font-bold text-sm">{{ $user->name }}</p>
                </div>
                <span class="material-symbols-outlined text-secondary-container" style="font-variation-settings:'FILL' 1">stars</span>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="neo-card bg-surface-container-high p-6">
            <h2 class="font-grotesk font-bold uppercase tracking-tight text-on-surface mb-4">Menu</h2>
            <div class="space-y-2">
                <a href="{{ route('order.create') }}"
                   class="w-full bg-white border-[2px] border-stroke p-3 flex justify-between items-center font-bold text-sm text-on-surface hover:bg-secondary-container hover:text-on-secondary-container transition-colors">
                    <span>Buat Pesanan Baru</span>
                    <span class="material-symbols-outlined text-base">add_circle</span>
                </a>
                <a href="{{ route('order.history') }}"
                   class="w-full bg-white border-[2px] border-stroke p-3 flex justify-between items-center font-bold text-sm text-on-surface hover:bg-secondary-container hover:text-on-secondary-container transition-colors">
                    <span>Riwayat Pesanan</span>
                    <span class="material-symbols-outlined text-base">receipt_long</span>
                </a>
                <a href="{{ route('profile.edit') }}"
                   class="w-full bg-white border-[2px] border-stroke p-3 flex justify-between items-center font-bold text-sm text-on-surface hover:bg-secondary-container hover:text-on-secondary-container transition-colors">
                    <span>Profil Saya</span>
                    <span class="material-symbols-outlined text-base">manage_accounts</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-danger text-white border-[2px] border-stroke p-3 flex justify-between items-center font-bold text-sm hover:opacity-90 transition-opacity">
                        <span>Keluar</span>
                        <span class="material-symbols-outlined text-base">logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

{{-- ── Quick Links Bento ────────────────────────────────────────── --}}
<section class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
    <a href="{{ route('order.create') }}"
       class="neo-card bg-primary-container text-on-primary-container p-8 group hover:bg-primary hover:text-on-primary transition-colors cursor-pointer">
        <span class="material-symbols-outlined text-5xl mb-4 block" style="font-variation-settings:'FILL' 1">auto_awesome</span>
        <h3 class="font-grotesk font-bold text-xl mb-2 uppercase">Pesan Layanan</h3>
        <p class="text-sm opacity-80 mb-6">Pilih layanan terbaik untuk sepatumu.</p>
        <span class="font-bold text-xs uppercase bg-white text-stroke px-4 py-2 border-[2px] border-stroke inline-block">MULAI SEKARANG</span>
    </a>
    <a href="{{ route('order.history') }}"
       class="neo-card bg-tertiary-fixed text-on-tertiary-fixed p-8 group hover:bg-tertiary-fixed-dim transition-colors cursor-pointer"
       style="background-color: #ffdcc6; color: #311400">
        <span class="material-symbols-outlined text-5xl mb-4 block" style="font-variation-settings:'FILL' 1">local_shipping</span>
        <h3 class="font-grotesk font-bold text-xl mb-2 uppercase">Track Pesanan</h3>
        <p class="text-sm opacity-80 mb-6">Pantau status dan progres pesananmu.</p>
        <span class="font-bold text-xs uppercase bg-white text-stroke px-4 py-2 border-[2px] border-stroke inline-block">LIHAT STATUS</span>
    </a>
    <div class="neo-card bg-surface-container-highest p-8 cursor-pointer hover:bg-outline-variant transition-colors">
        <span class="material-symbols-outlined text-5xl mb-4 block" style="font-variation-settings:'FILL' 1">star_rate</span>
        <h3 class="font-grotesk font-bold text-xl mb-2 uppercase">Beri Ulasan</h3>
        <p class="text-sm text-on-surface-variant mb-6">Bantu kami dengan ulasan jujurmu.</p>
        <a href="{{ route('order.history') }}" class="font-bold text-xs uppercase bg-stroke text-white px-4 py-2 border-[2px] border-stroke inline-block">TULIS SEKARANG</a>
    </div>
</section>

@endsection
