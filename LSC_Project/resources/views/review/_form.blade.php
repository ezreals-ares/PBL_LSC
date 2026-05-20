{{-- Review form partial — used by create.blade.php and edit.blade.php --}}
@php
    $existingRating  = $review?->rating ?? old('rating', 0);
    $existingComment = $review?->comment ?? old('comment', '');
    $existingPhoto   = $review?->photo ?? null;
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" id="review-form">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        {{-- ── Left: Form ─────────────────────────────────────── --}}
        <div class="lg:col-span-7 space-y-6">

            {{-- Errors --}}
            @if($errors->any())
                <div class="bg-error-container border-[3px] border-danger p-4">
                    @foreach($errors->all() as $e)
                        <p class="text-sm text-danger font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">error</span> {{ $e }}
                        </p>
                    @endforeach
                </div>
            @endif

            {{-- Star Rating --}}
            <div class="neo-card bg-white p-8">
                <h2 class="font-grotesk font-bold uppercase text-on-surface text-xl mb-6 border-b-[3px] border-stroke pb-4">Beri Rating</h2>

                <div class="flex flex-col items-center gap-4 mb-6">
                    <div class="flex gap-3" id="star-container">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button"
                                class="star-btn text-5xl transition-all duration-100 {{ $i <= $existingRating ? 'text-secondary-container' : 'text-outline-variant' }}"
                                data-star="{{ $i }}"
                                onmouseover="hoverStar({{ $i }})"
                                onmouseout="unhoverStar()"
                                onclick="setStar({{ $i }})">
                                ★
                            </button>
                        @endfor
                    </div>
                    <p class="font-grotesk font-bold uppercase text-on-surface text-sm" id="star-label">
                        @php $labels = ['','Sangat Buruk','Buruk','Cukup','Baik','Sangat Baik ✨']; @endphp
                        {{ $existingRating > 0 ? $labels[$existingRating] : 'Klik bintang untuk beri rating' }}
                    </p>
                    <input type="hidden" name="rating" id="rating-value" value="{{ $existingRating }}">
                </div>

                @error('rating')
                    <p class="text-xs text-danger text-center font-bold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Comment --}}
            <div class="neo-card bg-white p-8">
                <h2 class="font-grotesk font-bold uppercase text-on-surface text-xl mb-6 border-b-[3px] border-stroke pb-4">Tulis Ulasan</h2>
                <label class="neo-label">Ceritakan Pengalamanmu <span class="text-danger">*</span></label>
                <textarea name="comment" id="comment" rows="5"
                    placeholder="Bagaimana hasil pembersihan sepatumu? Apakah tim kami responsif? ..."
                    class="neo-textarea">{{ $existingComment }}</textarea>
                <div class="flex justify-between mt-2">
                    @error('comment')
                        <p class="text-xs text-danger font-bold">{{ $message }}</p>
                    @else
                        <p class="text-xs text-on-surface-variant">Min. 10, maks. 500 karakter</p>
                    @enderror
                    <span class="text-xs text-on-surface-variant font-bold" id="comment-counter">0 / 500</span>
                </div>
            </div>

            {{-- Photo Upload --}}
            <div class="neo-card bg-white p-8">
                <h2 class="font-grotesk font-bold uppercase text-on-surface text-xl mb-6 border-b-[3px] border-stroke pb-4">Foto (Opsional)</h2>

                @if($existingPhoto)
                    <div class="mb-4 border-[3px] border-stroke p-3 bg-surface-container-low">
                        <p class="text-xs font-bold uppercase text-on-surface-variant mb-2">Foto Saat Ini</p>
                        <img src="{{ asset('storage/'.$existingPhoto) }}" alt="Review photo" class="max-h-48 object-cover border-[2px] border-stroke">
                    </div>
                @endif

                <label for="photo-input"
                    class="border-[3px] border-dashed border-stroke p-8 flex flex-col items-center justify-center bg-surface-container-low cursor-pointer hover:bg-primary-fixed hover:border-primary transition-all group">
                    <span class="material-symbols-outlined text-4xl text-outline mb-2 group-hover:text-primary transition-colors" id="photo-icon">add_photo_alternate</span>
                    <p class="font-grotesk font-bold text-sm text-on-surface" id="photo-text">
                        {{ $existingPhoto ? 'Ganti foto' : 'Tambah foto hasil bersih' }}
                    </p>
                    <p class="text-xs text-on-surface-variant mt-1">JPG, PNG, WEBP (maks 2MB)</p>
                    <input type="file" id="photo-input" name="photo" accept=".jpg,.jpeg,.png,.webp" class="hidden" onchange="previewPhoto(this)">
                </label>

                {{-- Photo preview --}}
                <div id="new-photo-preview" class="hidden mt-4 border-[3px] border-stroke p-3 bg-surface-container-low flex items-center gap-4">
                    <img id="new-photo-img" src="" alt="Preview" class="w-20 h-20 object-cover border-[2px] border-stroke">
                    <div>
                        <p id="photo-filename" class="font-bold text-sm text-on-surface"></p>
                        <button type="button" onclick="clearPhoto()" class="text-danger text-xs font-bold mt-1 hover:underline">Hapus</button>
                    </div>
                </div>

                @error('photo')
                    <p class="text-xs text-danger mt-2 font-bold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- ── Right: Order Summary Sidebar ─────────────────────── --}}
        <aside class="lg:col-span-5 sticky top-24 space-y-4">
            {{-- Order Info --}}
            <div class="neo-card bg-white p-6">
                <h2 class="font-grotesk font-bold uppercase text-on-surface border-b-[2px] border-stroke pb-3 mb-4">Pesanan yang Diulas</h2>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">No. Pesanan</span>
                        <span class="font-bold text-on-surface">#{{ $order->order_id }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Tanggal</span>
                        <span class="font-bold text-on-surface">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</span>
                    </div>
                    @if($order->jenis_sepatu)
                        <div class="flex justify-between text-sm">
                            <span class="text-on-surface-variant">Sepatu</span>
                            <span class="font-bold text-on-surface">{{ $order->jenis_sepatu }}</span>
                        </div>
                    @endif
                </div>
                <div class="mt-4 space-y-2">
                    @foreach($order->orderDetails as $detail)
                        <div class="flex justify-between text-sm border-t-[1px] border-stroke pt-2">
                            <span class="text-on-surface-variant">{{ $detail->service?->service_name }}</span>
                            <span class="font-bold text-on-surface">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Tips card --}}
            <div class="neo-card-yellow p-6">
                <h3 class="font-grotesk font-bold uppercase text-on-secondary-container mb-3">Tips Ulasan</h3>
                <ul class="space-y-2">
                    @foreach(['Ceritakan kondisi sebelum & sesudah', 'Sebutkan layanan yang paling membantu', 'Foto hasil akan sangat membantu pengguna lain', 'Ulasan jujur = komunitas lebih baik'] as $tip)
                        <li class="flex items-start gap-2 text-sm text-on-secondary-container">
                            <span class="material-symbols-outlined text-xs mt-1" style="font-variation-settings:'FILL' 1">check_circle</span>
                            {{ $tip }}
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="neo-btn-primary w-full justify-center py-4 text-base font-grotesk font-black uppercase">
                <span class="material-symbols-outlined">send</span>
                {{ $submitLabel }}
            </button>
        </aside>
    </div>
</form>
