<section id="specialis" class="py-24 bg-slate-900/50">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">My <span class="text-sky-400">Specialties</span></h2>
            <div class="w-24 h-1 bg-sky-500 mx-auto rounded-full"></div>
            <p class="text-slate-400 mt-6 max-w-2xl mx-auto">Areas of expertise where I deliver the most value and creative solutions.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($specializations as $index => $specialization)
                @php
                    $colors = [
                        ['bg' => 'bg-sky-500/10', 'bgHover' => 'group-hover:bg-sky-500/20', 'iconBg' => 'bg-sky-500/20', 'text' => 'text-sky-400', 'textHover' => 'group-hover:text-sky-300'],
                        ['bg' => 'bg-indigo-500/10', 'bgHover' => 'group-hover:bg-indigo-500/20', 'iconBg' => 'bg-indigo-500/20', 'text' => 'text-indigo-400', 'textHover' => 'group-hover:text-indigo-300'],
                        ['bg' => 'bg-emerald-500/10', 'bgHover' => 'group-hover:bg-emerald-500/20', 'iconBg' => 'bg-emerald-500/20', 'text' => 'text-emerald-400', 'textHover' => 'group-hover:text-emerald-300'],
                    ];
                    $color = $colors[$index % count($colors)];
                    $delay = ($index % 3 + 1) * 100;
                @endphp
                <div class="glass-panel p-8 rounded-2xl relative overflow-hidden group hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                    <div class="absolute top-0 right-0 w-32 h-32 {{ $color['bg'] }} rounded-bl-full -z-10 {{ $color['bgHover'] }} transition-colors"></div>
                    <div class="w-14 h-14 {{ $color['iconBg'] }} rounded-lg flex items-center justify-center mb-6">
                        <i class="{{ $specialization->icon ?? 'fas fa-star' }} {{ $color['text'] }} text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">{{ $specialization->name }}</h3>
                </div>
            @endforeach
        </div>
    </div>
</section>
