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
                        'text-red-500', 'text-indigo-500', 'text-emerald-500', 'text-sky-500', 'text-amber-500', 'text-orange-500', 'text-purple-500', 'text-pink-500'
                    ];
                    $color = $colors[$index % count($colors)];
                    $delay = ($index % 6 + 1) * 80;
                @endphp
                <div class="glass-panel rounded-2xl p-6 flex flex-col items-center justify-center space-y-3 hover:shadow-lg hover:shadow-slate-200/50 dark:hover:shadow-black/20 transition-all duration-300 transform hover:-translate-y-2 cursor-pointer group" data-aos="zoom-in" data-aos-delay="{{ $delay }}">
                    @if($stack->icon)
                        <i class="{{ $stack->icon }} text-4xl {{ $color }} group-hover:scale-110 transition-transform duration-300"></i>
                    @else
                        <i class="fas fa-code text-4xl {{ $color }} group-hover:scale-110 transition-transform duration-300"></i>
                    @endif
                    <span class="text-slate-600 dark:text-slate-300 font-medium text-sm text-center">{{ $stack->name }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
