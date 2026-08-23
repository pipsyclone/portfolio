<section id="about" class="py-24 md:py-28" style="background-color: var(--surface-alt);">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="mb-14" data-aos="fade-up">
            <p class="eyebrow mb-2">{!! bt('About') !!}</p>
            <h2 class="text-3xl md:text-4xl font-semibold" style="color: var(--ink);">
                {!! bt('About') !!} {!! bt('Me') !!}
            </h2>
        </div>

        <div class="flex flex-col md:flex-row items-center gap-16">
            <!-- Image Side -->
            <div class="w-full md:w-1/2" data-aos="fade-up">
                <div class="relative">
                    <div class="card rounded-3xl p-2 shadow-sm">
                        <img src="{{ safe_image_url($user->about_image) }}" alt="{{ $user->name ?? 'About' }}" class="w-full h-auto rounded-[1.35rem] object-cover">
                    </div>

                    <!-- Experience Card -->
                    @if($user->experience)
                    <div class="card absolute -bottom-6 -right-2 md:-right-6 p-4 rounded-2xl shadow-sm flex items-center gap-4 z-20">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-xl" style="background-color: var(--primary);">
                            {{ $user->experience }}+
                        </div>
                        <div class="text-left">
                            <p class="text-xs font-medium uppercase tracking-wider mb-0.5" style="color: var(--ink-soft);">{!! bt('Years of') !!}</p>
                            <p class="text-sm font-bold leading-none" style="color: var(--ink);">{!! bt('Experience') !!}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Content Side -->
            <div class="w-full md:w-1/2 space-y-6" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-2xl font-semibold" style="color: var(--ink);">{!! bt_dynamic($user->about_title) !!}</h3>
                <p class="leading-relaxed text-lg whitespace-pre-line" style="color: var(--ink-soft);">
                    {!! bt_dynamic(str_replace('"', ' ', (string) $user->about_description)) !!}
                </p>

                <div class="grid grid-cols-2 gap-4 pt-4">
                    @if(!empty($user->about_extra_information) && is_array($user->about_extra_information))
                        @foreach ($user->about_extra_information as $item)
                            <div class="flex items-center space-x-3" style="color: var(--ink);">
                                <div class="w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0" style="background-color: color-mix(in srgb, var(--primary) 12%, transparent);">
                                    <i class="fas fa-check text-xs" style="color: var(--primary);"></i>
                                </div>
                                <span class="text-sm font-medium">{!! bt_dynamic($item['information'] ?? '') !!}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
