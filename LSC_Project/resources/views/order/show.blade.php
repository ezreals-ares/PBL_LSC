@extends('layouts.customer')

@section('title', 'Detail Pesanan')

@section('extra-styles')
<style>
    /* Page header */
    .order-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .order-header h1 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-dark);
    }
    .order-id-badge {
        font-size: 0.9rem;
        color: var(--text-light);
        background: var(--background);
        border: 1px solid var(--border);
        border-radius: 9999px;
        padding: 0.35rem 0.9rem;
        font-family: monospace;
        letter-spacing: 1px;
    }

    /* ── Stepper (Visual Progress) ── */
    .stepper-wrap {
        display: flex;
        align-items: flex-start;
        justify-content: space-between; /* Spread evenly */
        gap: 0;
        margin: 1rem 0 2rem;
        padding: 2rem 1.5rem;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 20px;
        border: 1px solid var(--border);
        overflow-x: auto;
    }
    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
        position: relative;
    }
    .step-item:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 25px; /* Center of the 50px circle */
        left: calc(50% + 25px);
        width: calc(100% - 50px);
        height: 4px;
        background: var(--border);
        z-index: 0;
        border-radius: 2px;
    }
    .step-item.done:not(:last-child)::after {
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
    }
    .step-circle {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: var(--white);
        border: 3px solid var(--border);
        color: var(--text-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.25rem;
        position: relative;
        z-index: 1;
        flex-shrink: 0;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .step-item.done .step-circle {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        border-color: var(--primary);
        color: white;
        box-shadow: 0 6px 15px rgba(2, 132, 199, 0.3);
    }
    .step-item.current .step-circle {
        background: var(--primary);
        border-color: var(--primary-light);
        color: white;
        box-shadow: 0 0 0 6px rgba(2, 132, 199, 0.2);
        animation: pulse-ring-large 2s infinite;
        transform: scale(1.1);
    }
    .step-item.cancelled .step-circle {
        background: #ef4444;
        border-color: #fca5a5;
        color: white;
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(239, 68, 68, 0.3);
    }
    @keyframes pulse-ring-large {
        0%   { box-shadow: 0 0 0 0 rgba(2, 132, 199, 0.4); }
        70%  { box-shadow: 0 0 0 15px rgba(2, 132, 199, 0); }
        100% { box-shadow: 0 0 0 0 rgba(2, 132, 199, 0); }
    }
    .step-label {
        font-size: 0.9rem;
        color: var(--text-light);
        text-align: center;
        font-weight: 700;
        max-width: 120px;
        transition: all 0.3s;
    }
    .step-item.done .step-label { color: var(--text-dark); }
    .step-item.current .step-label { color: var(--primary); font-size: 0.95rem; transform: translateY(2px); }
    .step-item.cancelled .step-label { color: #ef4444; font-size: 0.95rem; }

    /* Info grid */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    @media (max-width: 600px) { .info-grid { grid-template-columns: 1fr; } }
    .info-item label {
        font-size: 0.78rem;
        color: var(--text-light);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 0.25rem;
    }
    .info-item .info-val {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    /* Services table */
    .services-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }
    .services-table th {
        background: var(--background);
        padding: 0.75rem 1rem;
        text-align: left;
        font-weight: 700;
        color: var(--text-dark);
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .services-table th:last-child,
    .services-table td:last-child { text-align: right; }
    .services-table td {
        padding: 0.85rem 1rem;
        border-top: 1px solid var(--border);
        color: var(--text-dark);
    }
    .services-table tfoot td {
        font-weight: 800;
        border-top: 2px solid var(--border);
        padding-top: 1rem;
    }

    /* Status alert blocks */
    .alert-block {
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .alert-warning { background: #fef3c7; border: 1px solid #fde68a; }
    .alert-info    { background: #e0f2fe; border: 1px solid #bae6fd; }
    .alert-success { background: #dcfce7; border: 1px solid #bbf7d0; }
    .alert-danger  { background: #fee2e2; border: 1px solid #fecaca; }
    .alert-cyan    { background: linear-gradient(135deg, #e0f2fe, #f0f9ff); border: 1px solid var(--primary-light); }
    .alert-icon { font-size: 1.5rem; flex-shrink: 0; margin-top: 0.1rem; }
    .alert-body { flex: 1; }
    .alert-body h3 { font-size: 1rem; font-weight: 700; margin-bottom: 0.4rem; }
    .alert-body p  { font-size: 0.9rem; color: var(--text-light); }

    /* Proof thumbnail */
    .proof-thumb {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid var(--border);
    }

    /* Star rating display */
    .stars-display { display: flex; gap: 4px; }
    .star-filled { color: #f59e0b; font-size: 1.2rem; }
    .star-empty  { color: var(--border); font-size: 1.2rem; }

    /* Sections gap */
    .sections-stack > * + * { margin-top: 1.5rem; }

    /* Back link — top left */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        color: var(--text-light);
        font-weight: 600;
        font-size: 0.88rem;
        margin-bottom: 1.25rem;
        transition: color 0.2s;
        text-decoration: none;
    }
    .back-link:hover { color: var(--primary); }

    /* Cancel button */
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.55rem 1.2rem;
        border-radius: 9999px;
        border: 2px solid #ef4444;
        color: #ef4444;
        background: transparent;
        font-weight: 700;
        font-size: 0.88rem;
        cursor: pointer;
        font-family: 'Outfit', sans-serif;
        transition: all 0.2s;
    }
    .btn-cancel:hover { background: #ef4444; color: white; }
</style>
@endsection

@section('content')

{{-- Back to history (top left) --}}
<a href="{{ route('order.history') }}" class="back-link">
    <i class="fas fa-arrow-left"></i> Kembali ke Riwayat Pesanan
</a>

{{-- Header --}}
<div class="order-header">
    <div>
        <h1>Detail Pesanan</h1>
        <span class="order-id-badge">#{{ strtoupper(substr(str_pad($order->order_id, 8, '0', STR_PAD_LEFT), -8)) }}</span>
    </div>
    <div style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;">
        <span class="badge badge-{{ $order->status }}">
            @switch($order->status)
                @case('pending')    Menunggu Konfirmasi @break
                @case('diproses')   Sedang Diproses     @break
                @case('selesai')    Selesai             @break
                @case('dibatalkan') Dibatalkan          @break
            @endswitch
        </span>
        {{-- Cancel button: only if pending --}}
        @if($order->status === 'pending')
        <form method="POST" action="{{ route('order.cancel', $order->order_id) }}"
              onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-cancel">
                <i class="fas fa-times"></i> Batalkan Pesanan
            </button>
        </form>
        @endif
    </div>
</div>

<div class="sections-stack">

    {{-- ── SECTION 1: Status Stepper ── --}}
    <div class="card">
        <div class="section-heading">Status Pesanan</div>

        @php
            $statusFlow = ['pending', 'diproses', 'selesai'];
            $currentStatus = $order->status;
            $isCancelled = $currentStatus === 'dibatalkan';

            // Map each step to its display label
            $stepLabels = [
                'pending'   => 'Menunggu Konfirmasi',
                'diproses'  => 'Sedang Diproses',
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
                        if ($currentIndex === false) {
                            $cls = 'future';
                        } elseif ($stepIndex < $currentIndex) {
                            $cls = 'done';
                        } elseif ($stepIndex === $currentIndex) {
                            $cls = 'current';
                        } else {
                            $cls = 'future';
                        }
                    @endphp
                    <div class="step-item {{ $cls }}">
                        <div class="step-circle">
                            @if($cls === 'done')
                                <i class="fas fa-check" style="font-size:0.8rem;"></i>
                            @elseif($cls === 'current')
                                <i class="fas fa-circle-dot" style="font-size:0.85rem;"></i>
                            @else
                                {{ $i + 1 }}
                            @endif
                        </div>
                        <span class="step-label">{{ $stepLabels[$step] }}</span>
                    </div>
                @endforeach
            @else
                {{-- Cancelled path --}}
                @foreach(['pending', 'diproses'] as $i => $step)
                    <div class="step-item future">
                        <div class="step-circle">{{ $i + 1 }}</div>
                        <span class="step-label">{{ $stepLabels[$step] }}</span>
                    </div>
                @endforeach
                <div class="step-item cancelled">
                    <div class="step-circle"><i class="fas fa-ban" style="font-size:0.8rem;"></i></div>
                    <span class="step-label">Dibatalkan</span>
                </div>
            @endif
        </div>
    </div>

    {{-- ── SECTION 2: Order Info ── --}}
    <div class="card">
        <div class="section-heading">Informasi Pesanan</div>
        <div class="info-grid">
            <div class="info-item">
                <label>Tanggal Pesanan</label>
                <span class="info-val">
                    {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}
                </span>
            </div>
            <div class="info-item">
                <label>Metode Pengambilan</label>
                <span class="info-val">
                    @if($order->pickup_method === 'pickup')
                        <i class="fas fa-car" style="color:var(--primary);margin-right:0.3rem;"></i> Jemput ke Lokasi
                    @else
                        <i class="fas fa-store" style="color:var(--primary);margin-right:0.3rem;"></i> Antar Langsung
                    @endif
                </span>
            </div>
            <div class="info-item">
                <label>Estimasi Selesai</label>
                <span class="info-val">
                    {{ $order->estimated_finish ? \Carbon\Carbon::parse($order->estimated_finish)->translatedFormat('d F Y') : '—' }}
                </span>
            </div>
            <div class="info-item">
                <label>Total Harga</label>
                <span class="info-val price-text">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </span>
            </div>
            @if($order->jenis_sepatu)
            <div class="info-item">
                <label>Merek Sepatu</label>
                <span class="info-val">{{ $order->jenis_sepatu }}</span>
            </div>
            @endif
            @if($order->material_sepatu)
            <div class="info-item">
                <label>Material</label>
                <span class="info-val">{{ $order->material_sepatu }}</span>
            </div>
            @endif
            @if($order->catatan)
            <div class="info-item" style="grid-column: 1/-1;">
                <label>Catatan</label>
                <span class="info-val">{{ $order->catatan }}</span>
            </div>
            @endif
        </div>
    </div>

    {{-- ── SECTION 3: Services Table ── --}}
    <div class="card">
        <div class="section-heading">Layanan Dipesan</div>
        <div style="overflow-x:auto;">
            <table class="services-table">
                <thead>
                    <tr>
                        <th>Layanan</th>
                        <th style="text-align:center;">Qty</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->service ? $detail->service->service_name : '—' }}</td>
                        <td style="text-align:center;">{{ $detail->quantity }}</td>
                        <td>Rp {{ $detail->service ? number_format($detail->service->price, 0, ',', '.') : '—' }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td class="price-text">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- ── SECTION 4: Payment Status ── --}}
    <div class="card">
        <div class="section-heading">Status Pembayaran</div>

        @if(in_array($order->status, ['pending', 'diproses', 'selesai']) && !$order->payment)
            <div class="alert-block alert-cyan">
                <span class="alert-icon"><i class="fas fa-credit-card"></i></span>
                <div class="alert-body">
                    <h3>Lakukan Pembayaran Sekarang</h3>
                    <p>Silakan lakukan pembayaran sebesar
                       <strong class="price-text">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                       untuk memproses pesanan Anda.
                    </p>
                    <a href="{{ route('payment.show', $order->order_id) }}" class="btn btn-primary btn-sm" style="margin-top:1rem;">
                        Bayar Sekarang
                    </a>
                </div>
            </div>

        @elseif($order->payment && $order->payment->status === 'unverified')
            <div class="alert-block alert-warning">
                <span class="alert-icon"><i class="fas fa-search"></i></span>
                <div class="alert-body">
                    <h3>Bukti Pembayaran Sedang Diverifikasi</h3>
                    <p>Bukti transfer Anda sedang ditinjau oleh admin. Proses verifikasi maksimal 1&times;24 jam.</p>
                    @if($order->payment->payment_proof)
                        @php $ext = strtolower(pathinfo($order->payment->payment_proof, PATHINFO_EXTENSION)); @endphp
                        @if(in_array($ext, ['jpg','jpeg','png']))
                            <img src="{{ asset('storage/' . $order->payment->payment_proof) }}"
                                 alt="Bukti Transfer" class="proof-thumb" style="margin-top:0.75rem;">
                        @else
                            <p style="margin-top:0.5rem;"><i class="fas fa-file-pdf" style="color:#ef4444;"></i> File PDF terlampir</p>
                        @endif
                    @endif
                    <a href="{{ route('payment.show', $order->order_id) }}" class="btn btn-outline btn-sm" style="margin-top:0.75rem;">
                        Ganti Bukti
                    </a>
                </div>
            </div>

        @elseif($order->payment && $order->payment->status === 'verified')
            <div class="alert-block alert-success">
                <span class="alert-icon"><i class="fas fa-circle-check"></i></span>
                <div class="alert-body">
                    <h3>Pembayaran Telah Dikonfirmasi</h3>
                    <p>
                        Jumlah: <strong class="price-text">Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</strong>
                        &mdash; Metode: Transfer Bank
                    </p>
                </div>
            </div>

        @elseif($order->status === 'dibatalkan')
            <div class="alert-block alert-danger">
                <span class="alert-icon"><i class="fas fa-circle-xmark"></i></span>
                <div class="alert-body">
                    <h3>Pesanan Ini Telah Dibatalkan</h3>
                    <p>Jika Anda memiliki pertanyaan, hubungi kami melalui WhatsApp atau Instagram.</p>
                </div>
            </div>
        @endif

    </div>

    {{-- ── SECTION 5: Review (only if selesai) ── --}}
    @if($order->status === 'selesai')
    <div class="card">
        <div class="section-heading">Ulasan Anda</div>

        @if(!$order->review)
            <div class="alert-block alert-info">
                <span class="alert-icon"><i class="fas fa-star"></i></span>
                <div class="alert-body">
                    <h3>Bagaimana Pengalaman Anda?</h3>
                    <p>Bantu kami berkembang dengan memberikan ulasan untuk pesanan ini.</p>
                    <a href="{{ route('review.create', $order->order_id) }}" class="btn btn-primary btn-sm" style="margin-top:0.75rem;">
                        Tulis Ulasan
                    </a>
                </div>
            </div>
        @else
            @php $review = $order->review; @endphp
            <div style="display:flex;gap:1.5rem;flex-wrap:wrap;">
                <div style="flex:1;min-width:200px;">
                    {{-- Stars --}}
                    <div class="stars-display" style="margin-bottom:0.75rem;">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                <span class="star-filled">★</span>
                            @else
                                <span class="star-empty">★</span>
                            @endif
                        @endfor
                    </div>
                    <p style="color:var(--text-dark);font-size:0.95rem;margin-bottom:0.5rem;">{{ $review->comment }}</p>
                    <p style="color:var(--text-light);font-size:0.8rem;">
                        Dikirim: {{ \Carbon\Carbon::parse($review->created_at)->translatedFormat('d F Y') }}
                    </p>
                    <a href="{{ route('review.edit', $order->order_id) }}" class="btn btn-outline btn-sm" style="margin-top:0.75rem;">
                        Edit Ulasan
                    </a>
                </div>
                @if($review->photo)
                <div>
                    <a href="{{ asset('storage/' . $review->photo) }}" target="_blank">
                        <img src="{{ asset('storage/' . $review->photo) }}"
                             alt="Foto Ulasan"
                             style="width:100px;height:100px;object-fit:cover;border-radius:14px;border:2px solid var(--border);">
                    </a>
                </div>
                @endif
            </div>
        @endif
    </div>
    @endif

</div>

@endsection
