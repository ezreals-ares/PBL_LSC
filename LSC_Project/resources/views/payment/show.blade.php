@extends('layouts.customer')

@section('title', 'Pembayaran Pesanan')

@section('extra-styles')
<style>
    .payment-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }
    .payment-header h1 { font-size: 1.8rem; font-weight: 800; color: var(--text-dark); }
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

    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; align-items: start; }
    @media (max-width: 800px) { .two-col { grid-template-columns: 1fr; } }

    /* Bank info table */
    .bank-table { width: 100%; border-collapse: collapse; }
    .bank-table tr td { padding: 0.65rem 0.5rem; border-bottom: 1px solid var(--border); }
    .bank-table tr:last-child td { border-bottom: none; }
    .bank-table td:first-child { color: var(--text-light); font-size: 0.85rem; width: 120px; }
    .bank-table td:last-child { font-weight: 700; color: var(--text-dark); font-size: 0.95rem; }
    .amount-highlight { color: var(--primary-light) !important; font-size: 1.1rem !important; }

    /* Copy button */
    .copy-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border: none;
        color: var(--primary);
        background: var(--secondary);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        margin-left: 0.5rem;
    }
    .copy-btn:hover { background: var(--primary); color: white; }

    /* Steps list */
    .steps-list { counter-reset: step; list-style: none; padding: 0; }
    .steps-list li {
        counter-increment: step;
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        padding: 0.6rem 0;
        font-size: 0.9rem;
        color: var(--text-dark);
    }
    .steps-list li::before {
        content: counter(step);
        flex-shrink: 0;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: white;
        font-weight: 800;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Upload area */
    .upload-area {
        border: 2px dashed var(--primary-light);
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        position: relative;
    }
    .upload-area:hover { border-color: var(--primary); background: var(--secondary); }
    .upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }
    .upload-icon { font-size: 2.5rem; margin-bottom: 0.5rem; }
    .upload-area p { color: var(--text-light); font-size: 0.85rem; margin-top: 0.4rem; }

    /* Proof preview */
    .proof-preview {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem;
        background: var(--background);
        border-radius: 12px;
        border: 1px solid var(--border);
        margin-top: 0.75rem;
    }
    .proof-thumb {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid var(--border);
    }

    /* Progress bar */
    .progress-bar-wrap { margin-top: 1.5rem; }
    .progress-steps {
        display: flex;
        align-items: center;
        gap: 0;
        font-size: 0.78rem;
        font-weight: 600;
    }
    .progress-step {
        flex: 1;
        text-align: center;
        padding: 0.5rem 0.25rem;
        color: var(--text-light);
        background: var(--background);
        border: 1px solid var(--border);
    }
    .progress-step:first-child { border-radius: 9999px 0 0 9999px; }
    .progress-step:last-child  { border-radius: 0 9999px 9999px 0; }
    .progress-step.active {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: white;
        border-color: var(--primary);
    }
    .progress-step.done { background: var(--secondary); color: var(--primary); border-color: var(--primary-light); }

    /* Collapsible re-upload */
    .collapsible-toggle {
        background: none;
        border: none;
        color: var(--primary);
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        text-decoration: underline;
        padding: 0;
        margin-top: 0.75rem;
    }
    .collapsible-body { display: none; margin-top: 1rem; }
    .collapsible-body.open { display: block; }

    .badge-unverified { background: #fef3c7; color: #92400e; }
    .badge-verified   { background: #dcfce7; color: #166534; }

    /* Back link */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-light);
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: color 0.2s;
        margin-bottom: 1rem;
    }
    .back-link:hover {
        color: var(--primary);
    }
</style>
@endsection

@section('content')

<a href="{{ route('order.show', $order->order_id) }}" class="back-link">
    <i class="fas fa-arrow-left"></i> Kembali ke Detail Pesanan
</a>

<div class="payment-header">
    <h1>Pembayaran Pesanan</h1>
    <span class="order-id-badge">
        #{{ strtoupper(substr(str_pad($order->order_id, 8, '0', STR_PAD_LEFT), -8)) }}
    </span>
</div>

<div class="two-col">

    {{-- LEFT --}}
    <div>

        {{-- Section 1: Order Summary --}}
        <div class="card" style="margin-bottom:1.5rem;">
            <div class="section-heading">Ringkasan Pesanan</div>
            @foreach($order->orderDetails as $detail)
            <div style="display:flex;justify-content:space-between;padding:0.4rem 0;font-size:0.9rem;">
                <span>{{ $detail->service ? $detail->service->service_name : '—' }} ×{{ $detail->quantity }}</span>
                <span style="font-weight:600;">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
            </div>
            @endforeach
            <hr class="divider">
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <span style="font-weight:700;font-size:1.05rem;">Total</span>
                <span class="price-text" style="font-size:1.4rem;font-weight:800;">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </span>
            </div>
            <div style="font-size:0.82rem;color:var(--text-light);margin-top:0.4rem;">
                Metode pengambilan: {{ $order->pickup_method === 'pickup' ? 'Jemput ke Lokasi' : 'Antar ke Outlet' }}
            </div>
        </div>

        {{-- Section 2: Bank Transfer Instructions --}}
        <div class="card">
            <div class="section-heading">Instruksi Pembayaran</div>

            <table class="bank-table">
                <tr>
                    <td>Bank</td>
                    <td>BCA</td>
                </tr>
                <tr>
                    <td>No. Rekening</td>
                    <td style="display: flex; align-items: center;">
                        <span id="rek-number" style="font-family: monospace; font-size: 1.1rem; letter-spacing: 1px;">1234567890</span>
                        <button type="button" class="copy-btn" id="copy-btn" onclick="copyRekening()" title="Salin Nomor">
                            <i class="far fa-copy"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Atas Nama</td>
                    <td>LSC (Lose ShoesCare)</td>
                </tr>
                <tr>
                    <td>Jumlah Transfer</td>
                    <td class="amount-highlight">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>
                </tr>
            </table>

            <hr class="divider">

            <p style="font-size:0.85rem;font-weight:700;color:var(--text-dark);margin-bottom:0.75rem;">Langkah Pembayaran:</p>
            <ol class="steps-list">
                <li>Transfer tepat <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong> ke rekening di atas</li>
                <li>Simpan bukti transfer (screenshot atau foto struk ATM)</li>
                <li>Upload bukti di bawah ini</li>
                <li>Tunggu verifikasi admin (maks. 1×24 jam)</li>
            </ol>
        </div>

    </div>

    {{-- RIGHT: Upload form --}}
    <div>
        <div class="card">
            <div class="section-heading">Upload Bukti Transfer</div>

            @if(!$order->payment)
                {{-- First upload --}}
                <form method="POST" action="{{ route('payment.store', $order->order_id) }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="upload-area" id="upload-area">
                        <input type="file"
                               name="payment_proof"
                               id="proof-input"
                               accept="image/*,application/pdf"
                               onchange="previewFile(this)">
                        <div class="upload-icon">📤</div>
                        <p style="font-weight:700;color:var(--text-dark);font-size:0.95rem;">
                            Klik atau seret file ke sini
                        </p>
                        <p>Format: JPG, PNG, atau PDF. Maks. 2MB.</p>
                    </div>

                    <div id="file-preview" style="display:none;" class="proof-preview">
                        <img id="preview-img" src="" alt="Preview" class="proof-thumb">
                        <div>
                            <p id="preview-name" style="font-weight:600;font-size:0.9rem;color:var(--text-dark);"></p>
                            <button type="button" onclick="clearFile()"
                                    style="background:none;border:none;cursor:pointer;color:var(--danger);font-size:0.8rem;font-weight:600;">
                                ✕ Hapus
                            </button>
                        </div>
                    </div>

                    @error('payment_proof')
                        <p class="form-error" style="display:block;margin-top:0.5rem;">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="btn btn-primary btn-full" style="margin-top:1.25rem;">
                        Kirim Bukti Pembayaran →
                    </button>
                </form>

            @elseif($order->payment->status === 'unverified')
                {{-- Already uploaded, waiting --}}
                <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:1rem;">
                    <span class="badge badge-unverified">⏳ Menunggu Verifikasi Admin</span>
                </div>

                @if($order->payment->payment_proof)
                    @php $ext = strtolower(pathinfo($order->payment->payment_proof, PATHINFO_EXTENSION)); @endphp
                    @if(in_array($ext, ['jpg','jpeg','png']))
                        <img src="{{ asset('storage/' . $order->payment->payment_proof) }}"
                             alt="Bukti Transfer"
                             style="width:100%;border-radius:14px;border:1px solid var(--border);max-height:280px;object-fit:cover;">
                    @else
                        <div style="padding:1.5rem;background:var(--background);border-radius:12px;border:1px solid var(--border);text-align:center;">
                            <p style="font-size:2rem;">📄</p>
                            <p style="color:var(--text-light);font-size:0.9rem;">File PDF terlampir</p>
                        </div>
                    @endif
                @endif

                <p style="font-size:0.85rem;color:var(--text-light);margin-top:0.75rem;">
                    Jika ada kesalahan pada bukti yang diunggah, Anda dapat menggantinya di bawah ini.
                </p>

                <button type="button" class="collapsible-toggle" onclick="toggleReupload()">
                    Ganti Bukti Transfer ↓
                </button>

                <div class="collapsible-body" id="reupload-body">
                    <form method="POST"
                          action="{{ route('payment.upload', $order->order_id) }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="upload-area" style="margin-top:0.5rem;">
                            <input type="file"
                                   name="payment_proof"
                                   accept="image/*,application/pdf"
                                   id="reupload-input"
                                   onchange="previewReupload(this)">
                            <div class="upload-icon">🔄</div>
                            <p style="font-weight:700;color:var(--text-dark);font-size:0.95rem;">Pilih file baru</p>
                            <p>Format: JPG, PNG, atau PDF. Maks. 2MB.</p>
                        </div>

                        <div id="reupload-preview" style="display:none;" class="proof-preview">
                            <img id="reupload-img" src="" alt="Preview" class="proof-thumb">
                            <p id="reupload-name" style="font-weight:600;font-size:0.9rem;"></p>
                        </div>

                        @error('payment_proof')
                            <p class="form-error" style="display:block;margin-top:0.5rem;">{{ $message }}</p>
                        @enderror

                        <button type="submit" class="btn btn-primary btn-full" style="margin-top:1rem;">
                            Kirim Bukti Baru
                        </button>
                    </form>
                </div>

            @elseif($order->payment->status === 'verified')
                {{-- Verified --}}
                <div style="text-align:center;padding:2rem 1rem;">
                    <div style="font-size:3rem;margin-bottom:0.75rem;">✅</div>
                    <h3 style="font-size:1.1rem;font-weight:700;color:var(--text-dark);margin-bottom:0.4rem;">
                        Pembayaran Telah Dikonfirmasi
                    </h3>
                    <p style="color:var(--text-light);font-size:0.9rem;">
                        Pembayaran sebesar
                        <strong class="price-text">Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</strong>
                        telah diverifikasi oleh admin.
                    </p>
                </div>
            @endif

            {{-- Progress bar --}}
            <div class="progress-bar-wrap">
                <div class="progress-steps">
                    <span class="progress-step {{ $order->payment ? 'done' : 'active' }}">
                        1. Upload Bukti
                    </span>
                    <span class="progress-step {{ ($order->payment && $order->payment->status === 'unverified') ? 'active' : (($order->payment && $order->payment->status === 'verified') ? 'done' : '') }}">
                        2. Verifikasi Admin
                    </span>
                    <span class="progress-step {{ ($order->payment && $order->payment->status === 'verified') ? 'active' : '' }}">
                        3. Dikonfirmasi
                    </span>
                </div>
            </div>

    </div>

</div>
@endsection

@section('scripts')
<script>
function copyRekening() {
    const rek = document.getElementById('rek-number').textContent.trim();
    navigator.clipboard.writeText(rek).then(function() {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check"></i>';
        btn.style.background = 'var(--success)';
        btn.style.color = 'white';
        setTimeout(function() {
            btn.innerHTML = '<i class="far fa-copy"></i>';
            btn.style.background = '';
            btn.style.color = '';
        }, 2000);
    });
}

function previewFile(input) {
    const file = input.files[0];
    if (!file) return;

    const preview = document.getElementById('file-preview');
    const previewImg = document.getElementById('preview-img');
    const previewName = document.getElementById('preview-name');
    const uploadArea = document.getElementById('upload-area');

    previewName.textContent = file.name;

    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewImg.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        previewImg.style.display = 'none';
    }
    preview.style.display = 'flex';
}

function clearFile() {
    document.getElementById('proof-input').value = '';
    document.getElementById('file-preview').style.display = 'none';
}

function previewReupload(input) {
    const file = input.files[0];
    if (!file) return;
    const preview = document.getElementById('reupload-preview');
    const img = document.getElementById('reupload-img');
    const name = document.getElementById('reupload-name');
    name.textContent = file.name;
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) { img.src = e.target.result; img.style.display = 'block'; };
        reader.readAsDataURL(file);
    } else {
        img.style.display = 'none';
    }
    preview.style.display = 'flex';
}

function toggleReupload() {
    const body = document.getElementById('reupload-body');
    body.classList.toggle('open');
}
</script>
@endsection
