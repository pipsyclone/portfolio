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
                        ['bg' => 'bg-sky-50 dark:bg-sky-500/10', 'icon' => 'text-sky-500 dark:text-sky-400', 'border' => 'hover:border-sky-300 dark:hover:border-sky-500/50', 'glow' => 'hover:shadow-sky-500/20'],
                        ['bg' => 'bg-indigo-50 dark:bg-indigo-500/10', 'icon' => 'text-indigo-500 dark:text-indigo-400', 'border' => 'hover:border-indigo-300 dark:hover:border-indigo-500/50', 'glow' => 'hover:shadow-indigo-500/20'],
                        ['bg' => 'bg-emerald-50 dark:bg-emerald-500/10', 'icon' => 'text-emerald-500 dark:text-emerald-400', 'border' => 'hover:border-emerald-300 dark:hover:border-emerald-500/50', 'glow' => 'hover:shadow-emerald-500/20'],
                        ['bg' => 'bg-purple-50 dark:bg-purple-500/10', 'icon' => 'text-purple-500 dark:text-purple-400', 'border' => 'hover:border-purple-300 dark:hover:border-purple-500/50', 'glow' => 'hover:shadow-purple-500/20'],
                        ['bg' => 'bg-amber-50 dark:bg-amber-500/10', 'icon' => 'text-amber-500 dark:text-amber-400', 'border' => 'hover:border-amber-300 dark:hover:border-amber-500/50', 'glow' => 'hover:shadow-amber-500/20'],
                        ['bg' => 'bg-rose-50 dark:bg-rose-500/10', 'icon' => 'text-rose-500 dark:text-rose-400', 'border' => 'hover:border-rose-300 dark:hover:border-rose-500/50', 'glow' => 'hover:shadow-rose-500/20'],
                    ];
                    $color = $colors[$index % count($colors)];
                    $delay = ($index % 3 + 1) * 100;
                @endphp
                <div class="glass-panel relative p-8 rounded-2xl group transition-all duration-500 transform hover:-translate-y-2 border border-transparent {{ $color['border'] }} hover:shadow-xl {{ $color['glow'] }} overflow-hidden cursor-pointer" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                    <div class="absolute top-0 right-0 w-32 h-32 rounded-bl-full {{ $color['bg'] }} opacity-0 group-hover:opacity-100 transition-all duration-500 -mr-16 -mt-16 group-hover:mr-0 group-hover:mt-0"></div>
                    
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="w-16 h-16 {{ $color['bg'] }} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-sm">
                            <i class="{{ $specialization->icon ?? 'fas fa-star' }} {{ $color['icon'] }} text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-4 group-hover:text-slate-900 dark:group-hover:text-sky-300 transition-colors duration-300">{{ $specialization->name }}</h3>
                        
                        <a href="#projects" class="mt-auto pt-4 flex items-center text-sm font-semibold {{ $color['icon'] }} opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                            <span>{{ __('Explore Projects') }}</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
