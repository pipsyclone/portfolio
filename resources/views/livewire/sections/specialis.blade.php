<section id="specialis" class="py-24 md:py-28" style="background-color: var(--surface-alt);">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="mb-14" data-aos="fade-up">
            <p class="eyebrow mb-2">{!! bt('Specialties') !!}</p>
            <h2 class="text-3xl md:text-4xl font-semibold" style="color: var(--ink);">{!! bt('Specialties') !!}</h2>
            <p class="mt-3 max-w-2xl text-base md:text-lg" style="color: var(--ink-soft);">{!! bt('Areas of expertise where I deliver the most value and creative solutions.') !!}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($specializations as $index => $specialization)
                <div class="card card-hover relative p-8 rounded-2xl group overflow-hidden" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 60 }}">
                    <div class="relative flex flex-col h-full">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6" style="background-color: color-mix(in srgb, var(--primary) 10%, transparent);">
                            <i class="{{ $specialization->icon ?? 'fas fa-star' }} text-xl" style="color: var(--primary);"></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-4" style="color: var(--ink);">{{ $specialization->name }}</h3>

                        <a href="#projects" class="mt-auto pt-4 flex items-center text-sm font-semibold" style="color: var(--primary);">
                            <span>{!! bt('Explore Projects') !!}</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
