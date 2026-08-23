{{-- Shared career card body, included from both the mobile (stacked) and
     desktop (zigzag) timeline layouts in careers.blade.php so the markup only
     lives in one place. Expects: $career, $isOngoing, $startDateEn, $startDateId,
     $endDateEn, $endDateId. --}}
<div class="card card-hover rounded-2xl p-6 md:p-7">
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
        <!-- Logo & Info -->
        <div class="flex items-center sm:items-start gap-4">
            @if(!empty($career['logo']))
                <div class="w-14 h-14 rounded-xl flex items-center justify-center p-2 flex-shrink-0" style="background-color: var(--surface-alt); border: 1px solid var(--hairline);">
                    <img src="{{ safe_image_url($career['logo'], 'careers-logo') }}" alt="{{ $career['company'] ?? '' }}" loading="lazy" class="max-w-full max-h-full object-contain rounded-md">
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
            <div class="mono inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-medium" style="background-color: var(--surface-alt); color: var(--ink-soft); border: 1px solid var(--hairline);">
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
        <div class="prose-content text-sm mt-4">
            {!! bt_dynamic($career['description'], html: true) !!}
        </div>
    @endif
</div>
