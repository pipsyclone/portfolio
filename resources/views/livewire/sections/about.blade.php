<section id="about" class="py-24 bg-slate-900/50">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ __('About') }} <span class="text-sky-400">{{ __('Me') }}</span></h2>
            <div class="w-24 h-1 bg-sky-500 mx-auto rounded-full"></div>
        </div>

        <div class="flex flex-col md:flex-row items-center gap-12">
            <!-- Image Side -->
            <div class="w-full md:w-1/2" data-aos="fade-right">
                <div class="relative rounded-2xl overflow-hidden glass-panel p-2">
                    <img src="{{ safe_image_url($user->about_image) }}" alt="Coding workspace" class="w-full h-auto rounded-xl object-cover hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-slate-900/20 hover:bg-transparent transition-colors duration-500"></div>
                </div>
            </div>

            <!-- Content Side -->
            <div class="w-full md:w-1/2 space-y-6" data-aos="fade-left">
                <h3 class="text-2xl font-semibold text-slate-200">{{ translate_text($user->about_title) }}</h3>
                <p class="text-slate-400 leading-relaxed text-lg whitespace-pre-line">
                    {{ str_replace('"', ' ', translate_text($user->about_description)) }}
                </p>
                
                <div class="grid grid-cols-2 gap-4 pt-4">
                    @if(!empty($user->about_extra_information) && is_array($user->about_extra_information))
                        @foreach ($user->about_extra_information as $item)
                            <div data-aos="fade-right" data-aos-delay="{{ $loop->iteration * 100 }}" class="flex items-center space-x-3 text-slate-300">
                                <i class="fas fa-check-circle text-sky-400"></i>
                                <span>{{ translate_text($item['information'] ?? '') }}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
