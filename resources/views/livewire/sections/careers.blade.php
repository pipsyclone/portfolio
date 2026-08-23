<section id="careers" class="py-24 md:py-28">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="mb-14" data-aos="fade-up">
            <p class="eyebrow mb-2"><span class="section-num">04</span> {!! bt('Careers') !!}</p>
            <h2 class="text-3xl md:text-4xl font-semibold" style="color: var(--ink);">{!! bt('Careers') !!}</h2>
            <p class="mt-3 max-w-2xl text-base md:text-lg" style="color: var(--ink-soft);">{!! bt('My professional journey and experiences.') !!}</p>
        </div>

        @php
            $careers = is_array($user->careers) ? $user->careers : [];
        @endphp

        @if(count($careers) > 0)
            <div class="relative">
                <!-- Center timeline line (desktop only — mobile uses its own left-aligned line) -->
                <div class="hidden md:block absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-px" style="background-color: var(--hairline);"></div>

                <!-- Mobile: left-aligned stacked line, unchanged from before (zigzag needs room) -->
                <div class="md:hidden relative">
                    <div class="absolute left-6 top-0 bottom-0 w-px" style="background-color: var(--hairline);"></div>
                    <div class="space-y-8">
                        @foreach($careers as $index => $career)
                            @php
                                $isOngoing = !empty($career['on_going']);
                                $fmt = fn ($date, $locale) => $date ? \Carbon\Carbon::parse($date)->locale($locale)->translatedFormat('M Y') : '';
                                $startDateEn = $fmt($career['start_date'] ?? null, 'en');
                                $startDateId = $fmt($career['start_date'] ?? null, 'id');
                                $endDateEn = $isOngoing ? 'Present' : $fmt($career['end_date'] ?? null, 'en');
                                $endDateId = $isOngoing ? 'Sekarang' : $fmt($career['end_date'] ?? null, 'id');
                            @endphp
                            <div class="relative" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 60 }}">
                                <div class="absolute left-6 w-3.5 h-3.5 rounded-full transform -translate-x-1/2 top-8 z-20" style="background-color: var(--primary);">
                                    @if($isOngoing)
                                        <span class="absolute inset-0 rounded-full animate-ping opacity-40" style="background-color: var(--primary);"></span>
                                    @endif
                                </div>
                                <div class="pl-14">
                                    @include('livewire.sections.partials.career-card', compact('career', 'isOngoing', 'startDateEn', 'startDateId', 'endDateEn', 'endDateId'))
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Desktop: symmetric zigzag, alternating sides of the center line -->
                <div class="hidden md:block space-y-10">
                    @foreach($careers as $index => $career)
                        @php
                            $isOngoing = !empty($career['on_going']);
                            $fmt = fn ($date, $locale) => $date ? \Carbon\Carbon::parse($date)->locale($locale)->translatedFormat('M Y') : '';
                            $startDateEn = $fmt($career['start_date'] ?? null, 'en');
                            $startDateId = $fmt($career['start_date'] ?? null, 'id');
                            $endDateEn = $isOngoing ? 'Present' : $fmt($career['end_date'] ?? null, 'en');
                            $endDateId = $isOngoing ? 'Sekarang' : $fmt($career['end_date'] ?? null, 'id');
                            $isLeft = $index % 2 === 0;
                        @endphp
                        <div class="flex items-start gap-8 {{ $isLeft ? '' : 'flex-row-reverse' }}" data-aos="{{ $isLeft ? 'fade-right' : 'fade-left' }}" data-aos-delay="{{ ($index % 4) * 60 }}">
                            <!-- Card side -->
                            <div class="flex-1">
                                @include('livewire.sections.partials.career-card', compact('career', 'isOngoing', 'startDateEn', 'startDateId', 'endDateEn', 'endDateId'))
                            </div>

                            <!-- Center dot -->
                            <div class="flex flex-col items-center flex-shrink-0 pt-8">
                                <div class="relative w-3.5 h-3.5 rounded-full z-20" style="background-color: var(--primary);">
                                    @if($isOngoing)
                                        <span class="absolute inset-0 rounded-full animate-ping opacity-40" style="background-color: var(--primary);"></span>
                                    @endif
                                </div>
                            </div>

                            <!-- Empty opposite side, keeps the card at exactly half width -->
                            <div class="flex-1"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background-color: var(--surface-alt);">
                    <i class="fas fa-briefcase text-xl" style="color: var(--ink-soft);"></i>
                </div>
                <p style="color: var(--ink-soft);">
                    <span class="i18n-en">No career history available yet.</span><span class="i18n-id">Belum ada riwayat karier.</span>
                </p>
            </div>
        @endif
    </div>
</section>
