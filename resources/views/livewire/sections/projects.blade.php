<section id="projects" class="py-24 md:py-28" style="background-color: var(--surface-alt);">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="mb-14" data-aos="fade-up">
            <p class="eyebrow mb-2">{!! bt('Projects') !!}</p>
            <h2 class="text-3xl md:text-4xl font-semibold" style="color: var(--ink);">
                {!! bt('Featured') !!} {!! bt('Projects') !!}
            </h2>
            <p class="mt-3 max-w-2xl text-base md:text-lg" style="color: var(--ink-soft);">{!! bt('Here are some of my recent works that showcase my skills and experience.') !!}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $index => $project)
            <div class="card card-hover rounded-2xl overflow-hidden group" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 60 }}">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ safe_image_url($project->image) }}" alt="{{ $project->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-colors duration-300 flex items-end justify-start p-5 gap-3">
                        @if($project->url)
                            <a href="{{ $project->url }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/90 text-neutral-900 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <i class="fas fa-link text-sm"></i>
                            </a>
                        @endif
                        @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/90 text-neutral-900 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <i class="fab fa-github text-sm"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-2" style="color: var(--ink);">{{ $project->name }}</h3>
                    <p class="text-sm mb-4 line-clamp-2 leading-relaxed" style="color: var(--ink-soft);">{!! bt_dynamic($project->description) !!}</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->techStacks as $tech)
                            <span class="px-3 py-1 text-xs font-medium rounded-lg" style="background-color: var(--surface-alt); color: var(--ink-soft); border: 1px solid var(--hairline);">{{ $tech->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
