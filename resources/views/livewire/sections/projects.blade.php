<section id="projects" class="py-24 bg-slate-800/30">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ __('Featured') }} <span class="text-sky-400">{{ __('Projects') }}</span></h2>
            <div class="w-24 h-1 bg-sky-500 mx-auto rounded-full"></div>
            <p class="text-slate-400 mt-6 max-w-2xl mx-auto">{{ __('Here are some of my recent works that showcase my skills and experience.') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $index => $project)
            <div class="glass-panel rounded-2xl overflow-hidden group" data-aos="zoom-in" data-aos-delay="{{ ($index % 3 + 1) * 100 }}">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ safe_image_url($project->image) }}" alt="{{ $project->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center space-x-4">
                        @if($project->url)
                            <a href="{{ $project->url }}" target="_blank" class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-400 transition-colors transform hover:scale-110">
                                <i class="fas fa-link"></i>
                            </a>
                        @endif
                        @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" class="w-10 h-10 rounded-full bg-slate-800 text-white flex items-center justify-center hover:bg-slate-700 transition-colors transform hover:scale-110">
                                <i class="fab fa-github"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-sky-400 transition-colors">{{ $project->name }}</h3>
                    <p class="text-slate-400 text-sm mb-4 line-clamp-3">{{ translate_text($project->description) }}</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->techStacks as $techIndex => $tech)
                            @php
                                $colors = [
                                    ['bg' => 'bg-sky-500/10', 'text' => 'text-sky-400'],
                                    ['bg' => 'bg-emerald-500/10', 'text' => 'text-emerald-400'],
                                    ['bg' => 'bg-indigo-500/10', 'text' => 'text-indigo-400'],
                                    ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400'],
                                    ['bg' => 'bg-orange-500/10', 'text' => 'text-orange-400'],
                                    ['bg' => 'bg-pink-500/10', 'text' => 'text-pink-400'],
                                ];
                                $color = $colors[$techIndex % count($colors)];
                            @endphp
                            <span class="px-3 py-1 text-xs font-medium {{ $color['bg'] }} {{ $color['text'] }} rounded-full">{{ $tech->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- <div class="text-center mt-12" data-aos="fade-up">
            <a href="#" class="inline-flex items-center px-6 py-3 bg-slate-800 hover:bg-slate-700 text-white font-medium rounded-lg transition-colors border border-slate-700 hover:border-slate-600">
                View More Projects <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div> -->
    </div>
</section>
