<section id="projects" class="py-28 relative">
    <!-- Background -->
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-slate-50/80 to-transparent dark:via-slate-900/40 z-0"></div>

    <div class="container mx-auto px-6 md:px-12 lg:px-24 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold uppercase tracking-widest rounded-full bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 border border-purple-100 dark:border-purple-500/20 mb-4">{{ __('Projects') }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">
                {{ __('Featured') }} <span class="text-gradient">{{ __('Projects') }}</span>
            </h2>
            <p class="text-slate-500 dark:text-slate-400 mt-4 max-w-2xl mx-auto">{{ __('Here are some of my recent works that showcase my skills and experience.') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $index => $project)
            <div class="glass-panel rounded-2xl overflow-hidden group hover:shadow-xl hover:shadow-slate-200/50 dark:hover:shadow-black/20 transition-all duration-500 hover:-translate-y-2" data-aos="zoom-in" data-aos-delay="{{ ($index % 3 + 1) * 100 }}">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ safe_image_url($project->image) }}" alt="{{ $project->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-start p-5 space-x-3">
                        @if($project->url)
                            <a href="{{ $project->url }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/30 transition-colors">
                                <i class="fas fa-link text-sm"></i>
                            </a>
                        @endif
                        @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/30 transition-colors">
                                <i class="fab fa-github text-sm"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-2 group-hover:text-sky-600 dark:group-hover:text-sky-400 transition-colors">{{ $project->name }}</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mb-4 line-clamp-2 leading-relaxed">{{ translate_text($project->description) }}</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->techStacks as $techIndex => $tech)
                            @php
                                $colors = [
                                    ['bg' => 'bg-sky-50 dark:bg-sky-500/10', 'text' => 'text-sky-600 dark:text-sky-400'],
                                    ['bg' => 'bg-emerald-50 dark:bg-emerald-500/10', 'text' => 'text-emerald-600 dark:text-emerald-400'],
                                    ['bg' => 'bg-indigo-50 dark:bg-indigo-500/10', 'text' => 'text-indigo-600 dark:text-indigo-400'],
                                    ['bg' => 'bg-amber-50 dark:bg-amber-500/10', 'text' => 'text-amber-600 dark:text-amber-400'],
                                    ['bg' => 'bg-orange-50 dark:bg-orange-500/10', 'text' => 'text-orange-600 dark:text-orange-400'],
                                    ['bg' => 'bg-pink-50 dark:bg-pink-500/10', 'text' => 'text-pink-600 dark:text-pink-400'],
                                ];
                                $color = $colors[$techIndex % count($colors)];
                            @endphp
                            <span class="px-3 py-1 text-xs font-medium {{ $color['bg'] }} {{ $color['text'] }} rounded-lg">{{ $tech->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
