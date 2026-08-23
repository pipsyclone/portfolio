<section id="tech" class="py-24 md:py-28 overflow-hidden">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="mb-14" data-aos="fade-up">
            <p class="eyebrow mb-2"><span class="section-num">02</span> {!! bt('Skills') !!}</p>
            <h2 class="text-3xl md:text-4xl font-semibold" style="color: var(--ink);">
                {!! bt('Tech') !!} {!! bt('Stack') !!}
            </h2>
            <p class="mt-3 max-w-2xl text-base md:text-lg" style="color: var(--ink-soft);">{!! bt('Tools and technologies I use to build modern applications.') !!}</p>
        </div>
    </div>

    @if(count($techStacks) > 0)
        @php
            // Duplicated once so the strip can loop seamlessly at -50%.
            $marqueeItems = array_merge($techStacks->all(), $techStacks->all());
        @endphp
        <div class="marquee-row" data-aos="fade-up">
            <div class="marquee-track marquee-track--left">
                @foreach($marqueeItems as $stack)
                    <div class="card card-hover rounded-2xl p-5 flex flex-col items-center justify-center gap-3 flex-shrink-0 w-32">
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl" style="background-color: var(--surface-alt);">
                            <i class="{{ $stack->icon ?: 'fas fa-code' }} text-xl" style="color: var(--primary);"></i>
                        </div>
                        <span class="text-xs font-semibold text-center" style="color: var(--ink);">{{ $stack->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>

<style>
    .marquee-row {
        position: relative;
        overflow: hidden;
        -webkit-mask-image: linear-gradient(to right, transparent, black 8%, black 92%, transparent);
        mask-image: linear-gradient(to right, transparent, black 8%, black 92%, transparent);
    }
    .marquee-track {
        display: flex;
        gap: 1rem;
        width: max-content;
        animation: marquee-scroll 32s linear infinite;
        padding: 0.25rem 0 1rem;
    }
    .marquee-row:hover .marquee-track { animation-play-state: paused; }
    @keyframes marquee-scroll {
        from { transform: translateX(0); }
        to { transform: translateX(-50%); }
    }
    @media (prefers-reduced-motion: reduce) {
        .marquee-track { animation: none; }
        .marquee-row { overflow-x: auto; }
    }
</style>
