<section id="ulasan" class="reviews-section">
    <h2 class="section-title">Apa Kata Pelanggan Kami</h2>
    <p class="section-subtitle">Kepuasan pelanggan adalah prioritas utama kami.</p>

    @if(isset($reviews) && $reviews->count() > 0)

    {{-- Average rating summary bar --}}
    @php
        $avgRating = round($reviews->avg('rating'), 1);
        $totalReviews = $reviews->count();
    @endphp
    <div class="rating-summary">
        <div class="rating-big">{{ number_format($avgRating, 1) }}</div>
        <div class="rating-stars-big">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= floor($avgRating))
                    <span class="star-filled">★</span>
                @elseif($i == ceil($avgRating) && ($avgRating - floor($avgRating)) >= 0.5)
                    <span class="star-half">★</span>
                @else
                    <span class="star-empty">★</span>
                @endif
            @endfor
        </div>
        <div class="rating-count">Berdasarkan {{ $totalReviews }} ulasan</div>
    </div>

    <div class="reviews-grid">
        @foreach($reviews as $review)
        <div class="review-card">
            {{-- Stars --}}
            <div class="review-stars">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $review->rating)
                        <span class="star-filled">★</span>
                    @else
                        <span class="star-empty">★</span>
                    @endif
                @endfor
            </div>

            {{-- Comment --}}
            <p class="review-comment">"{{ $review->comment }}"</p>

            {{-- Reviewer --}}
            <div class="review-author">
                <div class="review-avatar">
                    {{ strtoupper(substr($review->user->name, 0, 1)) }}
                </div>
                <div>
                    <div class="review-name">
                        {{-- Anonymized: "Budi S." --}}
                        {{ \Illuminate\Support\Str::before($review->user->name, ' ') }}
                        @php
                            $afterFirst = \Illuminate\Support\Str::after($review->user->name, ' ');
                        @endphp
                        {{ $afterFirst ? strtoupper(substr($afterFirst, 0, 1)) . '.' : '' }}
                    </div>
                    <div class="review-date">
                        {{ \Carbon\Carbon::parse($review->created_at)->translatedFormat('d F Y') }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @else
    <p style="text-align:center; color: var(--text-light); margin-top: 2rem;">
        Belum ada ulasan. Jadilah yang pertama!
    </p>
    @endif
</section>
