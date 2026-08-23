<section id="contact" class="py-24 md:py-28" style="background-color: var(--surface-alt);">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="mb-14" data-aos="fade-up">
            <p class="eyebrow mb-2">{!! bt('Contact') !!}</p>
            <h2 class="text-3xl md:text-4xl font-semibold" style="color: var(--ink);">
                {!! bt('Get In') !!} {!! bt('Touch') !!}
            </h2>
            <p class="mt-3 max-w-2xl text-base md:text-lg" style="color: var(--ink-soft);">{!! bt('Have a project in mind or just want to say hi? Feel free to reach out!') !!}</p>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('contact-success'))
            <div class="max-w-3xl mb-8" x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300ms>
                <div class="flex items-center justify-between p-4 rounded-2xl" style="background-color: color-mix(in srgb, #10b981 10%, transparent); border: 1px solid color-mix(in srgb, #10b981 25%, transparent);">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background-color: color-mix(in srgb, #10b981 18%, transparent);">
                            <i class="fas fa-check-circle text-emerald-600"></i>
                        </div>
                        <p class="text-sm font-medium text-emerald-700 dark:text-emerald-300">{{ session('contact-success') }}</p>
                    </div>
                    <button type="button" @click="show = false" class="w-8 h-8 flex items-center justify-center rounded-lg text-emerald-600 dark:text-emerald-300 hover:opacity-70 transition-opacity shrink-0 ml-4">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session()->has('contact-error'))
            <div class="max-w-3xl mb-8" x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300ms>
                <div class="flex items-center justify-between p-4 rounded-2xl" style="background-color: color-mix(in srgb, #ef4444 10%, transparent); border: 1px solid color-mix(in srgb, #ef4444 25%, transparent);">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background-color: color-mix(in srgb, #ef4444 18%, transparent);">
                            <i class="fas fa-exclamation-circle text-red-600"></i>
                        </div>
                        <p class="text-sm font-medium text-red-700 dark:text-red-300">{{ session('contact-error') }}</p>
                    </div>
                    <button type="button" @click="show = false" class="w-8 h-8 flex items-center justify-center rounded-lg text-red-600 dark:text-red-300 hover:opacity-70 transition-opacity shrink-0 ml-4">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Contact Info -->
            <div class="w-full lg:w-1/3 space-y-4">
                <div class="card card-hover p-6 rounded-2xl flex items-start space-x-4">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0" style="background-color: color-mix(in srgb, var(--primary) 10%, transparent);">
                        <i class="fas fa-envelope text-lg" style="color: var(--primary);"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-base mb-1" style="color: var(--ink);">{!! bt('Email Address') !!}</h4>
                        <p class="text-sm" style="color: var(--ink-soft);">{{ $email ?? '-' }}</p>
                    </div>
                </div>

                <div class="card card-hover p-6 rounded-2xl flex items-start space-x-4">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0" style="background-color: color-mix(in srgb, var(--primary) 10%, transparent);">
                        <i class="fa-solid fa-location-dot text-lg" style="color: var(--primary);"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-base mb-1" style="color: var(--ink);">{!! bt('Address') !!}</h4>
                        <p class="text-sm" style="color: var(--ink-soft);">{{ $address ?? '-' }}</p>
                    </div>
                </div>

                <div class="card card-hover p-6 rounded-2xl flex items-start space-x-4">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0" style="background-color: color-mix(in srgb, var(--primary) 10%, transparent);">
                        <i class="fa-brands fa-whatsapp text-lg" style="color: var(--primary);"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-base mb-1" style="color: var(--ink);">{!! bt('Phone Number') !!}</h4>
                        <p class="text-sm" style="color: var(--ink-soft);">{{ $phone ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="w-full lg:w-2/3">
                <form wire:submit="sendMessage" class="card p-8 md:p-10 rounded-2xl space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="contact-name" class="text-sm font-medium" style="color: var(--ink);">{!! bt('Name') !!}</label>
                            <input wire:model="name" type="text" id="contact-name" class="w-full rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 transition-all i18n-placeholder" data-ph-en="{{ bt_variant('Insert your name', 'en') }}" data-ph-id="{{ bt_variant('Insert your name', 'id') }}" style="background-color: var(--surface-alt); border: 1px solid {{ $errors->has('name') ? '#f87171' : 'var(--hairline)' }}; color: var(--ink); --tw-ring-color: color-mix(in srgb, var(--primary) 25%, transparent);" placeholder="{{ __('Insert your name') }}">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="contact-email" class="text-sm font-medium" style="color: var(--ink);">{!! bt('Email Address') !!}</label>
                            <input wire:model="senderEmail" type="email" id="contact-email" class="w-full rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 transition-all i18n-placeholder" data-ph-en="{{ bt_variant('Insert your email', 'en') }}" data-ph-id="{{ bt_variant('Insert your email', 'id') }}" style="background-color: var(--surface-alt); border: 1px solid {{ $errors->has('senderEmail') ? '#f87171' : 'var(--hairline)' }}; color: var(--ink); --tw-ring-color: color-mix(in srgb, var(--primary) 25%, transparent);" placeholder="{{ __('Insert your email') }}">
                            @error('senderEmail')
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="contact-subject" class="text-sm font-medium" style="color: var(--ink);">{!! bt('Subject') !!}</label>
                        <input wire:model="subject" type="text" id="contact-subject" class="w-full rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 transition-all i18n-placeholder" data-ph-en="{{ bt_variant('Project details', 'en') }}" data-ph-id="{{ bt_variant('Project details', 'id') }}" style="background-color: var(--surface-alt); border: 1px solid {{ $errors->has('subject') ? '#f87171' : 'var(--hairline)' }}; color: var(--ink); --tw-ring-color: color-mix(in srgb, var(--primary) 25%, transparent);" placeholder="{{ __('Project details') }}">
                        @error('subject')
                            <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="contact-message" class="text-sm font-medium" style="color: var(--ink);">{!! bt('Message') !!}</label>
                        <textarea wire:model="message" id="contact-message" rows="5" class="w-full rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 transition-all resize-none i18n-placeholder" data-ph-en="{{ bt_variant('Write your project details...', 'en') }}" data-ph-id="{{ bt_variant('Write your project details...', 'id') }}" style="background-color: var(--surface-alt); border: 1px solid {{ $errors->has('message') ? '#f87171' : 'var(--hairline)' }}; color: var(--ink); --tw-ring-color: color-mix(in srgb, var(--primary) 25%, transparent);" placeholder="{{ __('Write your project details...') }}"></textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-[10px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <button type="submit" class="btn-primary w-full sm:w-auto px-8 py-4 rounded-xl inline-flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed cursor-pointer" wire:loading.attr="disabled">
                        <svg wire:loading wire:target="sendMessage" class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="sendMessage">{!! bt('Send Message') !!}</span>
                        <span wire:loading wire:target="sendMessage">{!! bt('Sending...') !!}</span>
                        <i wire:loading.remove wire:target="sendMessage" class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
