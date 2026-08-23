<section id="projects" class="py-24 md:py-28">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="mb-10" data-aos="fade-up">
            <p class="eyebrow mb-2"><span class="section-num">06</span> {!! bt('Projects') !!}</p>
            <h2 class="text-3xl md:text-4xl font-semibold" style="color: var(--ink);">
                {!! bt('Featured') !!} {!! bt('Projects') !!}
            </h2>
            <p class="mt-3 max-w-2xl text-base md:text-lg" style="color: var(--ink-soft);">{!! bt('Here are some of my recent works that showcase my skills and experience.') !!}</p>
        </div>

        @php
            $allTechNames = $projects->flatMap->techStacks->pluck('name')->unique()->sort()->values();
        @endphp

        @if($allTechNames->count() > 1)
            <!-- Filter chips -->
            <div class="flex flex-wrap gap-2 mb-10" data-aos="fade-up" id="project-filters">
                <button type="button" class="project-filter-chip active px-4 py-2 rounded-lg text-sm font-medium" data-filter="all">
                    <span class="i18n-en">All</span><span class="i18n-id">Semua</span>
                </button>
                @foreach($allTechNames as $techName)
                    <button type="button" class="project-filter-chip px-4 py-2 rounded-lg text-sm font-medium" data-filter="{{ Str::slug($techName) }}">{{ $techName }}</button>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="project-grid">
            @foreach($projects as $index => $project)
            <div class="project-card card card-hover rounded-2xl overflow-hidden group" data-tech="{{ $project->techStacks->pluck('name')->map(fn ($n) => Str::slug($n))->implode(' ') }}" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 60 }}">
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
                    <div class="prose-content fade-clip text-sm mb-4" style="max-height: 3rem;">
                        {!! bt_dynamic($project->description, html: true) !!}
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->techStacks as $tech)
                            <span class="px-3 py-1 text-xs font-medium rounded-lg" style="background-color: var(--surface); color: var(--ink-soft); border: 1px solid var(--hairline);">{{ $tech->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('livewire:navigated', () => {
        const filterBar = document.getElementById('project-filters');
        if (!filterBar || filterBar.dataset.bound) return;
        filterBar.dataset.bound = '1';

        filterBar.addEventListener('click', (e) => {
            const chip = e.target.closest('.project-filter-chip');
            if (!chip) return;

            filterBar.querySelectorAll('.project-filter-chip').forEach(c => c.classList.remove('active'));
            chip.classList.add('active');

            const filter = chip.dataset.filter;
            document.querySelectorAll('#project-grid .project-card').forEach(card => {
                const matches = filter === 'all' || card.dataset.tech.split(' ').includes(filter);
                card.style.display = matches ? '' : 'none';
            });
        });
    });
</script>
