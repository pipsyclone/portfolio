<section id="about" class="py-28 relative">
    <!-- Background accent -->
    <div class="absolute inset-0 bg-gradient-to-b from-slate-50/50 via-transparent to-slate-50/50 dark:from-slate-900/30 dark:via-transparent dark:to-slate-900/30 z-0"></div>

    <div class="container mx-auto px-6 md:px-12 lg:px-24 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold uppercase tracking-widest rounded-full bg-sky-50 dark:bg-sky-500/10 text-sky-600 dark:text-sky-400 border border-sky-100 dark:border-sky-500/20 mb-4">{{ __('About') }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">
                {{ __('About') }} <span class="text-gradient">{{ __('Me') }}</span>
            </h2>
        </div>

        <div class="flex flex-col md:flex-row items-center gap-16">
            <!-- Image Side -->
            <div class="w-full md:w-1/2" data-aos="fade-right">
                <div class="relative rounded-3xl overflow-hidden group">
                    <div class="absolute -inset-1 rounded-3xl opacity-20 blur-xl" style="background: linear-gradient(135deg, var(--primary), #818cf8);"></div>
                    <div class="relative glass-panel rounded-3xl p-2">
                        <img src="{{ safe_image_url($user->about_image) }}" alt="Coding workspace" class="w-full h-auto rounded-2xl object-cover group-hover:scale-[1.02] transition-transform duration-700">
                    </div>
                </div>
            </div>

            <!-- Content Side -->
            <div class="w-full md:w-1/2 space-y-6" data-aos="fade-left">
                <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-200">{{ translate_text($user->about_title) }}</h3>
                <p class="text-slate-500 dark:text-slate-400 leading-relaxed text-lg whitespace-pre-line">
                    {{ str_replace('"', ' ', translate_text($user->about_description)) }}
                </p>

                <div class="grid grid-cols-2 gap-4 pt-4">
                    @if(!empty($user->about_extra_information) && is_array($user->about_extra_information))
                        @foreach ($user->about_extra_information as $item)
                            <div data-aos="fade-right" data-aos-delay="{{ $loop->iteration * 100 }}" class="flex items-center space-x-3 text-slate-600 dark:text-slate-300">
                                <div class="w-6 h-6 rounded-full bg-sky-50 dark:bg-sky-500/10 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-xs" style="color: var(--primary);"></i>
                                </div>
                                <span class="text-sm font-medium">{{ translate_text($item['information'] ?? '') }}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
