<section id="tech" class="py-24 bg-slate-800/30">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ __('Tech') }} <span class="text-sky-400">{{ __('Stack') }}</span></h2>
            <div class="w-24 h-1 bg-sky-500 mx-auto rounded-full"></div>
            <p class="text-slate-400 mt-6 max-w-2xl mx-auto">{{ __('Tools and technologies I use to build modern applications.') }}</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach($techStacks as $index => $stack)
                @php
                    $colors = [
                        'text-red-500', 'text-indigo-400', 'text-emerald-500', 'text-sky-400', 'text-yellow-400', 'text-orange-500', 'text-purple-500', 'text-pink-500'
                    ];
                    $color = $colors[$index % count($colors)];
                    $delay = ($index % 6 + 1) * 100;
                @endphp
                <div class="glass-panel rounded-xl p-6 flex flex-col items-center justify-center space-y-4 hover:bg-slate-700/50 transition-all duration-300 transform hover:-translate-y-2 cursor-pointer group" data-aos="zoom-in" data-aos-delay="{{ $delay }}">
                    @if($stack->icon)
                        <i class="{{ $stack->icon }} text-5xl {{ $color }} group-hover:scale-110 transition-transform"></i>
                    @else
                        <i class="fas fa-code text-5xl {{ $color }} group-hover:scale-110 transition-transform"></i>
                    @endif
                    <span class="text-slate-300 font-medium text-center">{{ $stack->name }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
