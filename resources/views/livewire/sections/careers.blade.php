<section id="careers" class="py-28 relative">
    <!-- Background accent -->
    <div class="absolute inset-0 bg-gradient-to-b from-slate-50/50 via-transparent to-slate-50/50 dark:from-slate-900/30 dark:via-transparent dark:to-slate-900/30 z-0"></div>

    <div class="container mx-auto px-6 md:px-12 lg:px-24 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold uppercase tracking-widest rounded-full bg-sky-50 dark:bg-sky-500/10 text-sky-600 dark:text-sky-400 border border-sky-100 dark:border-sky-500/20 mb-4">{{ __('Careers') }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">
                <span class="text-gradient">{{ __('Careers') }}</span>
            </h2>
            <p class="mt-4 text-slate-500 dark:text-slate-400 max-w-xl mx-auto">
                {{ __('My professional journey and experiences.') }}
            </p>
        </div>

        @php
            $careers = is_array($user->careers) ? $user->careers : [];
        @endphp

        @if(count($careers) > 0)
            <div class="relative max-w-3xl mx-auto">
                <!-- Timeline vertical line -->
                <div class="absolute left-6 top-0 bottom-0 w-0.5" style="background: linear-gradient(to bottom, var(--primary), #818cf8, var(--primary));"></div>

                <div class="space-y-10">
                    @foreach($careers as $index => $career)
                        @php
                            $startDate = !empty($career['start_date']) ? \Carbon\Carbon::parse($career['start_date'])->translatedFormat('M Y') : '';
                            $endDate = !empty($career['on_going']) ? __('Present') : (!empty($career['end_date']) ? \Carbon\Carbon::parse($career['end_date'])->translatedFormat('M Y') : '');
                            $isOngoing = !empty($career['on_going']);
                        @endphp

                        <div class="relative group" data-aos="fade-up" data-aos-delay="{{ $index * 80 }}">
                            <!-- Timeline dot -->
                            <div class="absolute left-6 w-4 h-4 rounded-full transform -translate-x-1/2 top-8 z-20 transition-all duration-300 group-hover:scale-150 {{ $isOngoing ? 'ring-4 ring-green-400/30 dark:ring-green-400/20' : '' }}" style="background: var(--primary); box-shadow: 0 0 12px color-mix(in srgb, var(--primary) 40%, transparent);">
                                @if($isOngoing)
                                    <span class="absolute inset-0 rounded-full animate-ping opacity-40" style="background: var(--primary);"></span>
                                @endif
                            </div>

                            <!-- Content card -->
                            <div class="pl-14">
                                <div class="glass-panel rounded-2xl p-6 md:p-7 relative overflow-hidden hover:-translate-y-1 transition-all duration-300 hover:shadow-lg hover:shadow-slate-200/30 dark:hover:shadow-black/20">
                                    <!-- Decorative corner glow -->
                                    <div class="absolute -top-8 -right-8 w-28 h-28 rounded-full blur-2xl opacity-20" style="background: var(--primary);"></div>

                                    <!-- Header: Logo + Info + Date -->
                                    <div class="flex items-start gap-4 relative z-10">
                                        @if(!empty($career['logo']))
                                            <div class="w-14 h-14 rounded-xl bg-white dark:bg-slate-800 flex items-center justify-center shadow-sm p-2 border border-slate-100 dark:border-slate-700/80 flex-shrink-0">
                                                <img src="{{ asset('storage/' . $career['logo']) }}" alt="{{ $career['company'] ?? '' }}" class="max-w-full max-h-full object-contain rounded-md">
                                            </div>
                                        @else
                                            <div class="w-14 h-14 rounded-xl flex items-center justify-center shadow-sm flex-shrink-0 border border-slate-100 dark:border-slate-700/80" style="background: linear-gradient(135deg, color-mix(in srgb, var(--primary) 15%, white), color-mix(in srgb, var(--primary) 5%, white));">
                                                <i class="fas fa-building text-xl" style="color: var(--primary);"></i>
                                            </div>
                                        @endif

                                        <div class="min-w-0 flex-1">
                                            <h3 class="text-lg font-bold text-slate-800 dark:text-white leading-snug">{{ $career['position'] ?? '' }}</h3>
                                            <p class="text-sm font-semibold mt-0.5" style="color: var(--primary);">{{ $career['company'] ?? '' }}</p>
                                        </div>

                                        <!-- Date badge (top right) -->
                                        <div class="flex flex-col items-end gap-1.5 flex-shrink-0">
                                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold {{ $isOngoing ? 'bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 border border-green-100 dark:border-green-500/20' : 'bg-slate-100 dark:bg-slate-800/80 text-slate-600 dark:text-slate-300 border border-slate-200/50 dark:border-slate-700/50' }}">
                                                <i class="far fa-calendar-alt"></i>
                                                <span>{{ $startDate }} — {{ $endDate }}</span>
                                            </div>
                                            @if($isOngoing)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-bold bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 border border-green-100 dark:border-green-500/20">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                                    {{ __('Active') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    @if(!empty($career['description']))
                                        <div class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed mt-4 relative z-10 [&>p]:mb-2 [&>p:last-child]:mb-0 [&>ul]:list-disc [&>ul]:pl-5 [&>ul]:mb-2 [&>ol]:list-decimal [&>ol]:pl-5 [&>ol]:mb-2 [&_li]:mb-1">
                                            {!! translate_text($career['description']) !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-20 h-20 rounded-2xl bg-slate-100 dark:bg-slate-800/60 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-briefcase text-2xl text-slate-400 dark:text-slate-500"></i>
                </div>
                <p class="text-slate-500 dark:text-slate-400">{{ __('No career history available yet.') }}</p>
            </div>
        @endif
    </div>
</section>
