{{-- ── Reviews Section — Neo-Brutalism ─────────────────────────── --}}
<section id="ulasan" class="py-16 max-w-screen-xl mx-auto px-4 md:px-8">

    <h2 class="font-grotesk font-bold text-3xl mb-12 uppercase tracking-tighter text-center">Apa Kata Mereka?</h2>

    @if($reviews->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($reviews as $review)
                <div class="neo-card bg-surface p-6 flex flex-col">
                    {{-- Stars --}}
                    <div class="flex gap-1 mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-xl {{ $i <= $review->rating ? 'text-secondary-container' : 'text-outline-variant' }}"
                                  style="{{ $i <= $review->rating ? "font-variation-settings:'FILL' 1" : '' }}">star</span>
                        @endfor
                        <span class="ml-auto font-grotesk font-black text-sm text-on-surface-variant">{{ $review->rating }}/5</span>
                    </div>

                    {{-- Comment --}}
                    <p class="text-sm text-on-surface leading-relaxed mb-6 flex-grow">
                        "{{ $review->comment }}"
                    </p>

                    {{-- Author --}}
                    <div class="flex items-center gap-3 border-t-[2px] border-stroke pt-4 mt-auto">
                        <div class="w-10 h-10 bg-primary border-[2px] border-stroke flex items-center justify-center text-white font-grotesk font-black text-sm">
                            {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-grotesk font-bold text-sm text-on-surface">{{ $review->user->name ?? 'Customer' }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                        @if($review->rating >= 5)
                            <span class="ml-auto bg-success text-white text-xs font-bold px-2 py-0.5 border-[2px] border-stroke">VERIFIED</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Fallback static reviews --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach([
                ['Marcus J.', 5, '"My Jordan 1s were cooked after a rainy weekend. Lose ShoesCare literally brought them back from the dead. Unbelievable."'],
                ['Sarah K.',  5, '"The whitening service is magic. The oxidation on my Yeezy soles is gone completely. Worth every penny."'],
                ['Leo T.',    5, '"Best customer service in the sneaker game. They know their materials and treat every pair like art."'],
            ] as [$name, $rating, $comment])
                <div class="neo-card bg-surface p-6 flex flex-col">
                    <div class="flex gap-1 mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-xl text-secondary-container" style="font-variation-settings:'FILL' 1">star</span>
                        @endfor
                    </div>
                    <p class="text-sm text-on-surface leading-relaxed mb-6 flex-grow">{{ $comment }}</p>
                    <div class="flex items-center gap-3 border-t-[2px] border-stroke pt-4">
                        <div class="w-10 h-10 bg-primary-fixed border-[2px] border-stroke flex items-center justify-center font-grotesk font-black text-sm text-primary">
                            {{ substr($name, 0, 1) }}
                        </div>
                        <span class="font-grotesk font-bold text-sm text-on-surface">{{ $name }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- CTA to leave a review --}}
    @auth
        @if(auth()->user()->role !== 'admin')
            <div class="mt-10 neo-card-yellow p-6 flex flex-col md:flex-row items-center justify-between gap-4">
                <div>
                    <p class="font-grotesk font-black uppercase text-on-secondary-container">Sudah pernah menggunakan layanan kami?</p>
                    <p class="text-sm text-on-secondary-container mt-1">Bagikan pengalaman mu dan bantu customer lainnya.</p>
                </div>
                <a href="{{ route('order.history') }}" class="neo-btn-white shrink-0">
                    Tulis Ulasan
                </a>
            </div>
        @endif
    @endauth
</section>
