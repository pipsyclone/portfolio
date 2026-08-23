<section id="careers" class="py-24 md:py-28">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="mb-14" data-aos="fade-up">
            <p class="eyebrow mb-2">{!! bt('Careers') !!}</p>
            <h2 class="text-3xl md:text-4xl font-semibold" style="color: var(--ink);">{!! bt('Careers') !!}</h2>
            <p class="mt-3 max-w-2xl text-base md:text-lg" style="color: var(--ink-soft);">{!! bt('My professional journey and experiences.') !!}</p>
        </div>

        @php
            $careers = is_array($user->careers) ? $user->careers : [];
        @endphp

        @if(count($careers) > 0)
            <div class="relative max-w-3xl">
                <!-- Timeline vertical line -->
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
                            <!-- Timeline dot -->
                            <div class="absolute left-6 w-3.5 h-3.5 rounded-full transform -translate-x-1/2 top-8 z-20" style="background-color: var(--primary);">
                                @if($isOngoing)
                                    <span class="absolute inset-0 rounded-full animate-ping opacity-40" style="background-color: var(--primary);"></span>
                                @endif
                            </div>

                            <!-- Content card -->
                            <div class="pl-14">
                                <div class="card card-hover rounded-2xl p-6 md:p-7">
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                        <!-- Logo & Info -->
                                        <div class="flex items-center sm:items-start gap-4">
                                            @if(!empty($career['logo']))
                                                <div class="w-14 h-14 rounded-xl flex items-center justify-center p-2 flex-shrink-0" style="background-color: var(--surface-alt); border: 1px solid var(--hairline);">
                                                    <img src="{{ safe_image_url($career['logo'], 'careers-logo') }}" alt="{{ $career['company'] ?? '' }}" class="max-w-full max-h-full object-contain rounded-md">
                                                </div>
                                            @else
                                                <div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color: color-mix(in srgb, var(--primary) 10%, transparent);">
                                                    <i class="fas fa-building text-xl" style="color: var(--primary);"></i>
                                                </div>
                                            @endif

                                            <div class="min-w-0 flex-1">
                                                <h3 class="text-lg font-semibold leading-snug" style="color: var(--ink);">{{ $career['position'] ?? '' }}</h3>
                                                <p class="text-sm font-medium mt-0.5" style="color: var(--primary);">{{ $career['company'] ?? '' }}</p>
                                            </div>
                                        </div>

                                        <!-- Date badge -->
                                        <div class="flex flex-wrap sm:flex-col items-center sm:items-end gap-2 sm:gap-1.5 flex-shrink-0">
                                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-medium" style="background-color: var(--surface-alt); color: var(--ink-soft); border: 1px solid var(--hairline);">
                                                <i class="far fa-calendar-alt"></i>
                                                <span class="i18n-en">{{ $startDateEn }} — {{ $endDateEn }}</span>
                                                <span class="i18n-id">{{ $startDateId }} — {{ $endDateId }}</span>
                                            </div>
                                            @if($isOngoing)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-semibold" style="background-color: color-mix(in srgb, #10b981 12%, transparent); color: #059669;">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                    {!! bt('Active') !!}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    @if(!empty($career['description']))
                                        <div class="text-sm leading-relaxed mt-4 [&>p]:mb-2 [&>p:last-child]:mb-0 [&>ul]:list-disc [&>ul]:pl-5 [&>ul]:mb-2 [&>ol]:list-decimal [&>ol]:pl-5 [&>ol]:mb-2 [&_li]:mb-1" style="color: var(--ink-soft);">
                                            {!! bt_dynamic($career['description'], html: true) !!}
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
