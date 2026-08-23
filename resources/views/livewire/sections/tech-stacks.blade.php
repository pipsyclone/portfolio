<section id="tech" class="py-24 md:py-28">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="mb-14" data-aos="fade-up">
            <p class="eyebrow mb-2">{!! bt('Skills') !!}</p>
            <h2 class="text-3xl md:text-4xl font-semibold" style="color: var(--ink);">
                {!! bt('Tech') !!} {!! bt('Stack') !!}
            </h2>
            <p class="mt-3 max-w-2xl text-base md:text-lg" style="color: var(--ink-soft);">{!! bt('Tools and technologies I use to build modern applications.') !!}</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($techStacks as $index => $stack)
                <div class="card card-hover rounded-2xl p-6 flex flex-col items-center justify-center space-y-3 cursor-pointer" data-aos="fade-up" data-aos-delay="{{ ($index % 6) * 40 }}">
                    <div class="w-14 h-14 flex items-center justify-center rounded-2xl" style="background-color: var(--surface-alt);">
                        <i class="{{ $stack->icon ?: 'fas fa-code' }} text-2xl" style="color: var(--primary);"></i>
                    </div>
                    <span class="text-sm font-semibold text-center" style="color: var(--ink);">{{ $stack->name }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
