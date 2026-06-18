<section id="contact" class="py-28 relative">
    <div class="container mx-auto px-6 md:px-12 lg:px-24 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold uppercase tracking-widest rounded-full bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-100 dark:border-rose-500/20 mb-4">{{ __('Contact') }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">
                {{ __('Get In') }} <span class="text-gradient">{{ __('Touch') }}</span>
            </h2>
            <p class="text-slate-500 dark:text-slate-400 mt-4 max-w-2xl mx-auto">{{ __('Have a project in mind or just want to say hi? Feel free to reach out!') }}</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Contact Info -->
            <div class="w-full lg:w-1/3 space-y-5" data-aos="fade-right">
                <div class="glass-panel p-6 rounded-2xl flex items-start space-x-4 hover:shadow-lg hover:shadow-slate-200/50 dark:hover:shadow-black/20 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-sky-50 dark:bg-sky-500/10 text-sky-500 dark:text-sky-400 rounded-2xl flex items-center justify-center shrink-0">
                        <i class="fas fa-envelope text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-slate-800 dark:text-white font-bold text-base mb-1">{{ __('Email Address') }}</h4>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">{{ $email ?? '-' }}</p>
                    </div>
                </div>

                <div class="glass-panel p-6 rounded-2xl flex items-start space-x-4 hover:shadow-lg hover:shadow-slate-200/50 dark:hover:shadow-black/20 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-500 dark:text-indigo-400 rounded-2xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-location-dot text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-slate-800 dark:text-white font-bold text-base mb-1">{{ __('Address') }}</h4>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">{{ $address ?? '-' }}</p>
                    </div>
                </div>

                <div class="glass-panel p-6 rounded-2xl flex items-start space-x-4 hover:shadow-lg hover:shadow-slate-200/50 dark:hover:shadow-black/20 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 dark:text-emerald-400 rounded-2xl flex items-center justify-center shrink-0">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-slate-800 dark:text-white font-bold text-base mb-1">{{ __('Phone Number') }}</h4>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">{{ $phone ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="w-full lg:w-2/3" data-aos="fade-left">
                <form class="glass-panel p-8 md:p-10 rounded-2xl space-y-6" onsubmit="event.preventDefault(); alert('Message sent placeholder!');">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="text-slate-600 dark:text-slate-300 text-sm font-medium">{{ __('Name') }}</label>
                            <input type="text" id="name" class="w-full bg-white/60 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 focus:border-sky-400 dark:focus:border-sky-500 rounded-xl px-4 py-3.5 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20 transition-all" placeholder="{{ __('Insert your name') }}">
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="text-slate-600 dark:text-slate-300 text-sm font-medium">{{ __('Email Address') }}</label>
                            <input type="email" id="email" class="w-full bg-white/60 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 focus:border-sky-400 dark:focus:border-sky-500 rounded-xl px-4 py-3.5 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20 transition-all" placeholder="{{ __('Insert your email') }}">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="subject" class="text-slate-600 dark:text-slate-300 text-sm font-medium">{{ __('Subject') }}</label>
                        <input type="text" id="subject" class="w-full bg-white/60 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 focus:border-sky-400 dark:focus:border-sky-500 rounded-xl px-4 py-3.5 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20 transition-all" placeholder="{{ __('Project details') }}">
                    </div>
                    <div class="space-y-2">
                        <label for="message" class="text-slate-600 dark:text-slate-300 text-sm font-medium">{{ __('Message') }}</label>
                        <textarea id="message" rows="5" class="w-full bg-white/60 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 focus:border-sky-400 dark:focus:border-sky-500 rounded-xl px-4 py-3.5 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20 transition-all resize-none" placeholder="{{ __('Write your project details...') }}"></textarea>
                    </div>
                    <button type="submit" class="w-full sm:w-auto px-8 py-4 text-white font-bold rounded-xl shadow-lg transition-all duration-300 flex items-center justify-center hover:-translate-y-0.5 hover:shadow-xl" style="background: linear-gradient(135deg, var(--primary), #818cf8); box-shadow: 0 8px 30px rgba(56, 189, 248, 0.2);">
                        {{ __('Send Message') }} <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
