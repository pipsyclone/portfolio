<section id="hero" class="relative flex items-center pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
    <div class="container mx-auto px-6 md:px-12 lg:px-24 relative z-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-16">

            <!-- Text Content -->
            <div class="w-full md:w-3/5 text-center md:text-left" data-aos="fade-up">
                <div class="inline-flex items-center px-3.5 py-1.5 rounded-full mb-6" style="background-color: color-mix(in srgb, var(--primary) 10%, transparent); border: 1px solid color-mix(in srgb, var(--primary) 22%, transparent);">
                    <span class="w-1.5 h-1.5 rounded-full mr-2 animate-pulse" style="background-color: var(--primary);"></span>
                    <span class="text-sm font-medium" style="color: var(--primary);">
                        <span class="i18n-en">Available for work</span><span class="i18n-id">Tersedia untuk bekerja</span>
                    </span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-[1.12] tracking-tight" style="color: var(--ink);">
                    {{ $user->name ?? 'Jhon Doe' }}
                    <br>
                    <span style="color: var(--primary);">{{ $user->specialis ?? 'Developer' }}</span>
                </h1>

                <p class="text-lg md:text-xl mb-10 max-w-xl leading-relaxed" style="color: var(--ink-soft);">
                    {!! bt_dynamic($user->headline ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.') !!}
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-4">
                    <a href="#projects" class="btn-primary w-full sm:w-auto px-7 py-3.5 rounded-xl text-center">
                        {!! bt('View My Work') !!}
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                    @if($setting->github_link)
                        <a href="{{ $setting->github_link }}" target="_blank" class="btn-secondary w-full sm:w-auto px-7 py-3.5 rounded-xl flex items-center justify-center">
                            <i class="fab fa-github mr-2"></i> {!! bt('GitHub Profile') !!}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Portrait -->
            <div class="w-full md:w-2/5 flex justify-center" data-aos="fade-up" data-aos-delay="120">
                <div class="card rounded-3xl p-2 w-64 h-64 md:w-80 md:h-80 shadow-sm">
                    <img src="{{ safe_image_url($user->foto) }}" alt="{{ $user->name ?? 'Profile' }}" class="w-full h-full rounded-[1.35rem] object-cover">
                </div>
            </div>

        </div>
    </div>
</section>
