<section id="contact" class="py-28 relative">
    <div class="container mx-auto px-6 md:px-12 lg:px-24 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold uppercase tracking-widest rounded-full bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-100 dark:border-rose-500/20 mb-4">{{ __('Contact') }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">
                {{ __('Get In') }} <span class="text-gradient">{{ __('Touch') }}</span>
            </h2>
            <p class="text-slate-500 dark:text-slate-400 mt-4 max-w-2xl mx-auto">{{ __('Have a project in mind or just want to say hi? Feel free to reach out!') }}</p>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('contact-success'))
            <div class="max-w-3xl mx-auto mb-8" x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300ms>
                <div class="flex items-center justify-between p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-300 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-500/20 rounded-xl flex items-center justify-center shrink-0">
                            <i class="fas fa-check-circle text-emerald-500 dark:text-emerald-400"></i>
                        </div>
                        <p class="text-sm font-medium">{{ session('contact-success') }}</p>
                    </div>
                    <button type="button" @click="show = false" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-emerald-200/50 dark:hover:bg-emerald-500/20 transition-colors focus:outline-none shrink-0 ml-4 text-emerald-600 dark:text-emerald-400">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session()->has('contact-error'))
            <div class="max-w-3xl mx-auto mb-8" x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300ms>
                <div class="flex items-center justify-between p-4 rounded-2xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-700 dark:text-red-300 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-red-100 dark:bg-red-500/20 rounded-xl flex items-center justify-center shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500 dark:text-red-400"></i>
                        </div>
                        <p class="text-sm font-medium">{{ session('contact-error') }}</p>
                    </div>
                    <button type="button" @click="show = false" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-red-200/50 dark:hover:bg-red-500/20 transition-colors focus:outline-none shrink-0 ml-4 text-red-600 dark:text-red-400">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Contact Info -->
            <div class="w-full lg:w-1/3 space-y-5">
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
            <div class="w-full lg:w-2/3">
                <form wire:submit="sendMessage" class="glass-panel p-8 md:p-10 rounded-2xl space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="contact-name" class="text-slate-600 dark:text-slate-300 text-sm font-medium">{{ __('Name') }}</label>
                            <input wire:model="name" type="text" id="contact-name" class="w-full bg-white/60 dark:bg-slate-800/50 border {{ $errors->has('name') ? 'border-red-400 dark:border-red-500' : 'border-slate-200 dark:border-slate-700/50' }} focus:border-sky-400 dark:focus:border-sky-500 rounded-xl px-4 py-3.5 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20 transition-all" placeholder="{{ __('Insert your name') }}">
                            @error('name')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="contact-email" class="text-slate-600 dark:text-slate-300 text-sm font-medium">{{ __('Email Address') }}</label>
                            <input wire:model="senderEmail" type="email" id="contact-email" class="w-full bg-white/60 dark:bg-slate-800/50 border {{ $errors->has('senderEmail') ? 'border-red-400 dark:border-red-500' : 'border-slate-200 dark:border-slate-700/50' }} focus:border-sky-400 dark:focus:border-sky-500 rounded-xl px-4 py-3.5 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20 transition-all" placeholder="{{ __('Insert your email') }}">
                            @error('senderEmail')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="contact-subject" class="text-slate-600 dark:text-slate-300 text-sm font-medium">{{ __('Subject') }}</label>
                        <input wire:model="subject" type="text" id="contact-subject" class="w-full bg-white/60 dark:bg-slate-800/50 border {{ $errors->has('subject') ? 'border-red-400 dark:border-red-500' : 'border-slate-200 dark:border-slate-700/50' }} focus:border-sky-400 dark:focus:border-sky-500 rounded-xl px-4 py-3.5 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20 transition-all" placeholder="{{ __('Project details') }}">
                        @error('subject')
                            <p class="text-red-500 dark:text-red-400 text-xs mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="contact-message" class="text-slate-600 dark:text-slate-300 text-sm font-medium">{{ __('Message') }}</label>
                        <textarea wire:model="message" id="contact-message" rows="5" class="w-full bg-white/60 dark:bg-slate-800/50 border {{ $errors->has('message') ? 'border-red-400 dark:border-red-500' : 'border-slate-200 dark:border-slate-700/50' }} focus:border-sky-400 dark:focus:border-sky-500 rounded-xl px-4 py-3.5 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20 transition-all resize-none" placeholder="{{ __('Write your project details...') }}"></textarea>
                        @error('message')
                            <p class="text-red-500 dark:text-red-400 text-xs mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full sm:w-auto px-8 py-4 text-white font-bold rounded-xl shadow-lg transition-all duration-300 inline-flex items-center justify-center gap-2 hover:-translate-y-0.5 hover:shadow-xl disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:translate-y-0 cursor-pointer" style="background-color: var(--primary); box-shadow: 0 8px 30px rgba(56, 189, 248, 0.2);" wire:loading.attr="disabled">
                        <svg wire:loading wire:target="sendMessage" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="sendMessage">{{ __('Send Message') }}</span>
                        <span wire:loading wire:target="sendMessage">{{ __('Sending...') }}</span>
                        <i wire:loading.remove wire:target="sendMessage" class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
