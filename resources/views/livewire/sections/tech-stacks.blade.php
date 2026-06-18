<section id="tech" class="py-28 relative">
    <!-- Background -->
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-slate-50/80 to-transparent dark:via-slate-900/40 z-0"></div>

    <div class="container mx-auto px-6 md:px-12 lg:px-24 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold uppercase tracking-widest rounded-full bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-500/20 mb-4">{{ __('Skills') }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">
                {{ __('Tech') }} <span class="text-gradient">{{ __('Stack') }}</span>
            </h2>
            <p class="text-slate-500 dark:text-slate-400 mt-4 max-w-2xl mx-auto">{{ __('Tools and technologies I use to build modern applications.') }}</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
            @foreach($techStacks as $index => $stack)
                @php
                    $colors = [
                        ['text' => 'text-red-500', 'bg' => 'bg-red-50 dark:bg-red-500/10', 'glow' => 'hover:shadow-red-500/30', 'border' => 'hover:border-red-300 dark:hover:border-red-500/50'],
                        ['text' => 'text-indigo-500', 'bg' => 'bg-indigo-50 dark:bg-indigo-500/10', 'glow' => 'hover:shadow-indigo-500/30', 'border' => 'hover:border-indigo-300 dark:hover:border-indigo-500/50'],
                        ['text' => 'text-emerald-500', 'bg' => 'bg-emerald-50 dark:bg-emerald-500/10', 'glow' => 'hover:shadow-emerald-500/30', 'border' => 'hover:border-emerald-300 dark:hover:border-emerald-500/50'],
                        ['text' => 'text-sky-500', 'bg' => 'bg-sky-50 dark:bg-sky-500/10', 'glow' => 'hover:shadow-sky-500/30', 'border' => 'hover:border-sky-300 dark:hover:border-sky-500/50'],
                        ['text' => 'text-amber-500', 'bg' => 'bg-amber-50 dark:bg-amber-500/10', 'glow' => 'hover:shadow-amber-500/30', 'border' => 'hover:border-amber-300 dark:hover:border-amber-500/50'],
                        ['text' => 'text-purple-500', 'bg' => 'bg-purple-50 dark:bg-purple-500/10', 'glow' => 'hover:shadow-purple-500/30', 'border' => 'hover:border-purple-300 dark:hover:border-purple-500/50'],
                        ['text' => 'text-pink-500', 'bg' => 'bg-pink-50 dark:bg-pink-500/10', 'glow' => 'hover:shadow-pink-500/30', 'border' => 'hover:border-pink-300 dark:hover:border-pink-500/50']
                    ];
                    $color = $colors[$index % count($colors)];
                    $delay = ($index % 6 + 1) * 80;
                @endphp
                <div class="glass-panel relative rounded-2xl p-6 flex flex-col items-center justify-center space-y-4 transition-all duration-500 transform hover:-translate-y-2 hover:shadow-xl cursor-pointer group border border-transparent {{ $color['border'] }} {{ $color['glow'] }}" data-aos="zoom-in" data-aos-delay="{{ $delay }}">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/40 to-transparent dark:from-white/5 dark:to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative w-16 h-16 flex items-center justify-center rounded-2xl {{ $color['bg'] }} group-hover:scale-110 transition-transform duration-500">
                        @if($stack->icon)
                            <i class="{{ $stack->icon }} text-3xl {{ $color['text'] }} transition-transform duration-500 group-hover:rotate-[360deg]"></i>
                        @else
                            <i class="fas fa-code text-3xl {{ $color['text'] }} transition-transform duration-500 group-hover:rotate-[360deg]"></i>
                        @endif
                    </div>
                    <span class="relative text-slate-700 dark:text-slate-200 font-bold text-sm text-center tracking-wide group-hover:{{ $color['text'] }} transition-colors duration-300">{{ $stack->name }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
