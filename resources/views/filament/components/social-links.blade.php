@php
    $links = [
        'youtube' => $setting?->youtube_link,
        'linkedin' => $setting?->linkedin_link,
        'instagram' => $setting?->instagram_link,
        'github' => $setting?->github_link,
        'tiktok' => $setting?->tiktok_link,
        'facebook' => $setting?->facebook_link,
        'x' => $setting?->x_twitter_link,
    ];

    $hasAny = collect($links)->filter()->isNotEmpty();

    $socialItems = [
        'youtube'   => ['icon' => 'fa-youtube',    'color' => '#FF0000', 'label' => 'YouTube'],
        'linkedin'  => ['icon' => 'fa-linkedin',   'color' => '#0A66C2', 'label' => 'LinkedIn'],
        'instagram' => ['icon' => 'fa-instagram',  'color' => '#E1306C', 'label' => 'Instagram'],
        'github'    => ['icon' => 'fa-github',      'color' => '#6e40c9', 'label' => 'GitHub'],
        'tiktok'    => ['icon' => 'fa-tiktok',      'color' => '#00f2ea', 'label' => 'TikTok'],
        'facebook'  => ['icon' => 'fa-facebook',    'color' => '#1877F2', 'label' => 'Facebook'],
        'x'         => ['icon' => 'fa-x-twitter',   'color' => '#1DA1F2', 'label' => 'X'],
    ];
@endphp

@if ($hasAny)
    <style>
        .social-links-wrapper {
            margin-top: 1.25rem;
            text-align: center;
        }

        .social-links-label {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin-bottom: 0.75rem;
        }

        .social-links-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .social-link-item {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .social-link-item::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 10px;
            opacity: 0;
            transition: opacity 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .social-link-item:hover {
            transform: translateY(-3px);
        }

        .social-link-item:hover::before {
            opacity: 1;
        }

        .social-link-item:active {
            transform: translateY(-1px) scale(0.97);
        }

        .social-link-item i {
            position: relative;
            z-index: 1;
            font-size: 1.1rem;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .social-link-item .social-tooltip {
            position: absolute;
            bottom: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%) translateY(4px);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 10;
        }

        .social-link-item:hover .social-tooltip {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        /* ── Light Mode ── */
        .social-links-label {
            color: #94a3b8;
        }

        .social-link-item {
            color: #94a3b8;
            background: rgba(148, 163, 184, 0.08);
        }

        .social-link-item:hover {
            background: transparent;
            box-shadow: 0 4px 15px -3px var(--social-color-shadow);
        }

        .social-link-item:hover i {
            color: var(--social-color);
        }

        .social-link-item::before {
            background: var(--social-color-bg);
        }

        .social-link-item .social-tooltip {
            background: var(--social-color);
            color: #fff;
            box-shadow: 0 2px 8px -2px var(--social-color-shadow);
        }

        /* ── Dark Mode ── */
        .dark .social-links-label {
            color: #64748b;
        }

        .dark .social-link-item {
            color: #64748b;
            background: rgba(255, 255, 255, 0.04);
        }

        .dark .social-link-item:hover {
            background: transparent;
            box-shadow: 0 4px 20px -3px var(--social-color-shadow);
        }

        .dark .social-link-item:hover i {
            color: var(--social-color);
            filter: brightness(1.2);
        }

        .dark .social-link-item .social-tooltip {
            background: rgba(30, 41, 59, 0.95);
            color: var(--social-color);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>

    <div class="social-links-wrapper">
        <p class="social-links-label">Ikuti Saya</p>

        <div class="social-links-row">
            @foreach ($socialItems as $key => $item)
                @if (!empty($links[$key]))
                    <a
                        href="{{ $links[$key] }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="social-link-item"
                        style="
                            --social-color: {{ $item['color'] }};
                            --social-color-bg: {{ $item['color'] }}15;
                            --social-color-shadow: {{ $item['color'] }}40;
                        "
                        aria-label="{{ $item['label'] }}"
                    >
                        <span class="social-tooltip">{{ $item['label'] }}</span>
                        <i class="fa-brands {{ $item['icon'] }}"></i>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
@endif