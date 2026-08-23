<section id="certifications" class="py-24 md:py-28">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="mb-14" data-aos="fade-up">
            <p class="eyebrow mb-2">{!! bt('Certifications') !!}</p>
            <h2 class="text-3xl md:text-4xl font-semibold" style="color: var(--ink);">{!! bt('Certifications') !!}</h2>
            <p class="mt-3 max-w-2xl text-base md:text-lg" style="color: var(--ink-soft);">{!! bt('Licenses and certificates earned along the way.') !!}</p>
        </div>

        @if(count($certifications) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($certifications as $index => $cert)
                    @php
                        $issuedEn = !empty($cert['issued_at']) ? \Carbon\Carbon::parse($cert['issued_at'])->locale('en')->translatedFormat('F Y') : '';
                        $issuedId = !empty($cert['issued_at']) ? \Carbon\Carbon::parse($cert['issued_at'])->locale('id')->translatedFormat('F Y') : '';

                        $noExpiry = !empty($cert['no_expiry']) || empty($cert['expired_at']);
                        $isExpired = !$noExpiry && \Carbon\Carbon::parse($cert['expired_at'])->isPast();
                        $expiredEn = !$noExpiry ? \Carbon\Carbon::parse($cert['expired_at'])->locale('en')->translatedFormat('F Y') : '';
                        $expiredId = !$noExpiry ? \Carbon\Carbon::parse($cert['expired_at'])->locale('id')->translatedFormat('F Y') : '';

                        $ext = !empty($cert['file']) ? strtolower(pathinfo($cert['file'], PATHINFO_EXTENSION)) : null;
                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                    @endphp
                    <div class="card card-hover rounded-2xl p-6 flex gap-5" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 50 }}">
                        @if(!empty($cert['file']) && $isImage)
                            <div class="w-14 h-14 rounded-2xl flex-shrink-0 overflow-hidden" style="border: 1px solid var(--hairline);">
                                <img src="{{ safe_image_url($cert['file']) }}" alt="{{ $cert['title'] ?? '' }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0" style="background-color: color-mix(in srgb, var(--primary) 10%, transparent);">
                                <i class="{{ $ext === 'pdf' ? 'fas fa-file-pdf' : 'fas fa-certificate' }} text-2xl" style="color: var(--primary);"></i>
                            </div>
                        @endif

                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="text-base font-semibold leading-snug mb-1" style="color: var(--ink);">{{ $cert['title'] ?? '' }}</h3>
                                @if($isExpired)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-semibold flex-shrink-0" style="background-color: color-mix(in srgb, #ef4444 12%, transparent); color: #dc2626;">
                                        {!! bt('Expired') !!}
                                    </span>
                                @endif
                            </div>
                            <p class="text-sm font-medium mb-3" style="color: var(--primary);">{{ $cert['issuer'] ?? '' }}</p>

                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1.5 text-xs" style="color: var(--ink-soft);">
                                @if(!empty($cert['issued_at']))
                                    <span class="inline-flex items-center gap-1.5">
                                        <i class="far fa-calendar-alt"></i>
                                        <span class="i18n-en">{!! bt('Issued') !!} {{ $issuedEn }}</span>
                                        <span class="i18n-id">{!! bt('Issued') !!} {{ $issuedId }}</span>
                                    </span>
                                @endif
                                <span class="inline-flex items-center gap-1.5">
                                    <i class="far fa-clock"></i>
                                    @if($noExpiry)
                                        {!! bt('No Expiry') !!}
                                    @else
                                        <span class="i18n-en">{!! bt('Expires') !!} {{ $expiredEn }}</span>
                                        <span class="i18n-id">{!! bt('Expires') !!} {{ $expiredId }}</span>
                                    @endif
                                </span>
                                @if(!empty($cert['credential_id']))
                                    <span class="inline-flex items-center gap-1.5">
                                        <i class="fas fa-hashtag"></i>
                                        {{ $cert['credential_id'] }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-3">
                                @if(!empty($cert['file']))
                                    <a href="{{ safe_image_url($cert['file']) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-semibold" style="color: var(--primary);">
                                        {!! bt('View Certificate') !!}
                                        <i class="fas fa-arrow-up-right-from-square text-[10px]"></i>
                                    </a>
                                @endif
                                @if(!empty($cert['credential_url']))
                                    <a href="{{ $cert['credential_url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-semibold" style="color: var(--primary);">
                                        {!! bt('View Credential') !!}
                                        <i class="fas fa-arrow-up-right-from-square text-[10px]"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background-color: var(--surface-alt);">
                    <i class="fas fa-certificate text-xl" style="color: var(--ink-soft);"></i>
                </div>
                <p style="color: var(--ink-soft);">
                    <span class="i18n-en">No certifications added yet.</span><span class="i18n-id">Belum ada sertifikasi.</span>
                </p>
            </div>
        @endif
    </div>
</section>
