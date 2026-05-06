{{--
    Shared review form PARTIAL (no @extends — used via @include).
    Variables expected from parent view:
      $order        — Order model (eager loaded with orderDetails.service)
      $review       — Review model or null
      $action       — form action URL
      $method       — 'POST' or 'PUT'
      $submitLabel  — submit button text
--}}

{{-- Order context (collapsed style) --}}
<div style="background:var(--background);border:1px solid var(--border);border-radius:16px;padding:1.25rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;margin-bottom:1.5rem;">
    <span style="font-family:monospace;font-weight:700;color:var(--primary);font-size:0.95rem;letter-spacing:1px;">
        #{{ strtoupper(substr(str_pad($order->order_id, 8, '0', STR_PAD_LEFT), -8)) }}
    </span>
    <span style="font-size:0.88rem;color:var(--text-light);flex:1;margin:0 1rem;">
        @php
            $names = $order->orderDetails
                ->map(fn($d) => $d->service ? $d->service->service_name : '—')
                ->join(', ');
        @endphp
        {{ $names ?: '—' }}
    </span>
    <span class="badge badge-selesai">Selesai</span>
</div>

<div class="card">
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data" id="review-form">
        @csrf
        @if($method === 'PUT')
            @method('PUT')
        @endif

        {{-- Hidden rating input --}}
        <input type="hidden" name="rating" id="rating-value"
               value="{{ old('rating', isset($review) && $review ? $review->rating : '') }}">

        {{-- Star Rating --}}
        <div class="form-group">
            <label class="form-label">
                Penilaian Anda <span style="color:var(--danger)">*</span>
            </label>

            <div class="star-rating-widget" id="star-widget">
                @for($i = 1; $i <= 5; $i++)
                    <button type="button" class="star-btn" data-star="{{ $i }}"
                            onclick="setRating({{ $i }})"
                            onmouseenter="hoverRating({{ $i }})"
                            onmouseleave="unhoverRating()">★</button>
                @endfor
            </div>

            <div class="star-label" id="star-label">
                @php $initialRating = old('rating', isset($review) && $review ? $review->rating : 0); @endphp
                @if($initialRating == 1) Sangat Buruk
                @elseif($initialRating == 2) Buruk
                @elseif($initialRating == 3) Cukup
                @elseif($initialRating == 4) Baik
                @elseif($initialRating == 5) Sangat Baik ✨
                @endif
            </div>

            @error('rating')
                <p class="form-error" style="display:block;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Comment --}}
        <div class="form-group">
            <label class="form-label" for="comment">
                Ceritakan Pengalaman Anda <span style="color:var(--danger)">*</span>
            </label>
            <textarea name="comment" id="comment" class="form-control"
                      rows="5" maxlength="500"
                      placeholder="Bagaimana hasil perawatan sepatu Anda? Apakah sesuai harapan? ...">{{ old('comment', isset($review) && $review ? $review->comment : '') }}</textarea>
            <div class="char-counter" id="comment-counter">0 / 500 karakter</div>

            @error('comment')
                <p class="form-error" style="display:block;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Photo upload --}}
        <div class="form-group">
            <label class="form-label">
                Foto Hasil <span style="color:var(--text-light);font-weight:400;">(Opsional)</span>
            </label>

            {{-- Show existing photo on edit --}}
            @if(isset($review) && $review && $review->photo)
                <div style="margin-bottom:0.75rem;">
                    <p style="font-size:0.82rem;color:var(--text-light);margin-bottom:0.5rem;">Foto saat ini:</p>
                    <a href="{{ asset('storage/' . $review->photo) }}" target="_blank">
                        <img src="{{ asset('storage/' . $review->photo) }}"
                             alt="Foto Ulasan"
                             style="width:100px;height:100px;object-fit:cover;border-radius:14px;border:2px solid var(--border);">
                    </a>
                </div>
                <p style="font-size:0.82rem;color:var(--text-light);margin-bottom:0.5rem;">Ganti foto (kosongkan jika tidak ingin mengubah):</p>
            @endif

            <div class="photo-upload-area" id="photo-upload-area">
                <input type="file" name="photo" id="photo-input"
                       accept="image/jpeg,image/png,image/webp"
                       onchange="previewPhoto(this)">
                <div style="font-size:2rem;">📷</div>
                <p style="font-weight:700;color:var(--text-dark);">Klik untuk memilih foto</p>
                <p>Format: JPG, PNG, WEBP. Maks. 2MB.</p>
            </div>

            <div id="new-photo-preview" style="display:none;margin-top:0.75rem;position:relative;display:inline-block;">
                <img id="new-photo-img" src="" alt="Preview"
                     style="width:100px;height:100px;object-fit:cover;border-radius:14px;border:2px solid var(--border);">
                <button type="button" onclick="clearPhoto()"
                        style="position:absolute;top:-8px;right:-8px;width:24px;height:24px;border-radius:50%;background:var(--danger);color:white;border:none;cursor:pointer;font-size:0.75rem;font-weight:700;">
                    ✕
                </button>
            </div>

            @error('photo')
                <p class="form-error" style="display:block;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Actions --}}
        <div style="display:flex;gap:0.75rem;flex-wrap:wrap;margin-top:1.5rem;">
            <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
            <a href="{{ route('order.show', $order->order_id) }}" class="btn btn-outline">Batal</a>
        </div>

    </form>
</div>
