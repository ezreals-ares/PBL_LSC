@extends('layouts.customer')

@section('title', 'Edit Ulasan — Pesanan #' . $order->order_id)

@section('content')

{{-- Back --}}
<div class="mb-8">
    <a href="{{ route('order.show', $order->order_id) }}" class="inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary transition-colors mb-4 uppercase">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Kembali ke Pesanan
    </a>
    <h1 class="font-grotesk font-black uppercase tracking-tighter" style="font-size: clamp(1.5rem, 4vw, 2.5rem);">
        Edit Ulasan
    </h1>
    <p class="text-on-surface-variant mt-1">Perbarui ulasanmu untuk pesanan #{{ $order->order_id }}</p>
</div>

@php
    $action      = route('review.update', $order->order_id);
    $method      = 'PUT';
    $submitLabel = 'Perbarui Ulasan';
    // $review is passed from controller
@endphp

@include('review._form')

@endsection

@section('scripts')
@include('review._scripts')
@endsection
