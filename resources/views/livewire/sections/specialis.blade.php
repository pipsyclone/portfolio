<section id="specialis" class="py-28 relative">
    <div class="container mx-auto px-6 md:px-12 lg:px-24 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold uppercase tracking-widest rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20 mb-4">{{ __('Specialties') }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">
                <span class="text-gradient">{{ __('Specialties') }}</span>
            </h2>
            <p class="text-slate-500 dark:text-slate-400 mt-4 max-w-2xl mx-auto">{{ __('Areas of expertise where I deliver the most value and creative solutions.') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($specializations as $index => $specialization)
                @php
                    $colors = [
                        ['iconBg' => 'bg-sky-50 dark:bg-sky-500/10', 'iconColor' => 'text-sky-500 dark:text-sky-400', 'border' => 'hover:border-sky-200 dark:hover:border-sky-500/30'],
                        ['iconBg' => 'bg-indigo-50 dark:bg-indigo-500/10', 'iconColor' => 'text-indigo-500 dark:text-indigo-400', 'border' => 'hover:border-indigo-200 dark:hover:border-indigo-500/30'],
                        ['iconBg' => 'bg-emerald-50 dark:bg-emerald-500/10', 'iconColor' => 'text-emerald-500 dark:text-emerald-400', 'border' => 'hover:border-emerald-200 dark:hover:border-emerald-500/30'],
                    ];
                    $color = $colors[$index % count($colors)];
                    $delay = ($index % 3 + 1) * 100;
                @endphp
                <div class="glass-panel p-8 rounded-2xl group hover:-translate-y-2 transition-all duration-300 {{ $color['border'] }} hover:shadow-lg hover:shadow-slate-200/50 dark:hover:shadow-black/20" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                    <div class="w-14 h-14 {{ $color['iconBg'] }} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="{{ $specialization->icon ?? 'fas fa-star' }} {{ $color['iconColor'] }} text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">{{ $specialization->name }}</h3>
                </div>
            @endforeach
        </div>
    </div>
</section>
