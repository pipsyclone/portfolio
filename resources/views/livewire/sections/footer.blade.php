<footer class="relative pt-20 pb-8 border-t border-slate-100 dark:border-slate-800/50">
    <!-- Gradient accent -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/2 h-px bg-gradient-to-r from-transparent via-sky-400/50 to-transparent"></div>

    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <div class="flex flex-col md:flex-row justify-between items-center md:items-start mb-12">
            <!-- Brand -->
            <div class="mb-8 md:mb-0 text-center md:text-left">
                <a href="#" class="text-xl font-bold text-slate-800 dark:text-white tracking-tight inline-block mb-4">
                    PORT<span style="color: var(--primary);">FOLIO</span>
                </a>
                <p class="text-slate-500 dark:text-slate-400 text-sm max-w-xs mx-auto md:mx-0 leading-relaxed">
                    {{ __('Building digital experiences that combine beautiful design with elegant code.') }}
                </p>
            </div>

            <!-- Social Links -->
            @if ($setting->instagram_link || $setting->github_link || $setting->linkedin_link)
                <div class="text-center md:text-right">
                    <h4 class="text-slate-800 dark:text-white font-bold mb-4 text-sm uppercase tracking-wider">{{ __('Connect') }}</h4>
                    <div class="flex space-x-3 justify-center md:justify-end">
                        @if($setting->github_link)
                            <a href="{{ $setting->github_link }}" target="_blank" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 dark:text-slate-400 hover:text-white transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg" style="hover:background-color: var(--primary);" onmouseenter="this.style.backgroundColor='var(--primary)'" onmouseleave="this.style.backgroundColor=''">
                                <i class="fab fa-github"></i>
                            </a>
                        @endif
                        @if($setting->instagram_link)
                            <a href="{{ $setting->instagram_link }}" target="_blank" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 dark:text-slate-400 hover:text-white transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg" onmouseenter="this.style.backgroundColor='var(--primary)'" onmouseleave="this.style.backgroundColor=''">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if($setting->linkedin_link)
                            <a href="{{ $setting->linkedin_link }}" target="_blank" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 dark:text-slate-400 hover:text-white transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg" onmouseenter="this.style.backgroundColor='var(--primary)'" onmouseleave="this.style.backgroundColor=''">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Copyright -->
        <div class="border-t border-slate-100 dark:border-slate-800/50 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-slate-400 dark:text-slate-500">
            <p>&copy; {{ date('Y') }} {{ $user->name }}. {{ __('All Rights Reserved.') }}</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-slate-600 dark:hover:text-slate-300 transition-colors">{{ __('Privacy Policy') }}</a>
                <a href="#" class="hover:text-slate-600 dark:hover:text-slate-300 transition-colors">{{ __('Terms of Service') }}</a>
            </div>
        </div>
    </div>
</footer>
