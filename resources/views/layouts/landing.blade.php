@php
    $user = \App\Models\User::first();
    $settings = \App\Models\Setting::first();
    $primaryColor = $settings ? ($settings->app_color ?? '#38bdf8') : '#38bdf8';
    $currentLocale = app()->getLocale();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
        // Prevent FOUC - apply theme before render
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <title>{{ $user->name ?? 'Portfolio' }} | {{ $user->specialis ?? 'Fullstack Web Developer' }}</title>
    <link rel="icon" href="{{ safe_image_url($settings->app_favicon) }}">

    <!-- Primary Meta Tags -->
    <meta name="title" content="{{ $user->name ?? 'Portfolio' }} | {{ $user->specialis ?? 'Fullstack Web Developer' }}">
    <meta name="description" content="{{ $user->headline ?? 'Portfolio of John Doe, a passionate Fullstack Web Developer specializing in Laravel, Vue.js, and Tailwind CSS. Building robust, scalable, and beautifully designed web applications.' }}">
    <meta name="keywords" content="{{ $user->keywords }}">
    <meta name="author" content="{{ $user->name }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $user->name ?? config('app.name', 'Portfolio') }} | {{ $user->specialis ?? 'Fullstack Web Developer' }}">
    <meta property="og:description" content="{{ $user->headline ?? 'Portfolio of John Doe, a passionate Fullstack Web Developer specializing in Laravel, Vue.js, and Tailwind CSS.' }}">
    <meta property="og:image" content="{{ safe_image_url($user->foto ?? 'images/seo-banner.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $user->name ?? config('app.name', 'Portfolio') }} | {{ $user->specialis ?? 'Fullstack Web Developer' }}">
    <meta property="twitter:description" content="{{ $user->headline ?? 'Portfolio of John Doe, a passionate Fullstack Web Developer specializing in Laravel, Vue.js, and Tailwind CSS.' }}">
    <meta property="twitter:image" content="{{ safe_image_url($user->foto ?? 'images/seo-banner.jpg') }}">

    <!-- Google Fonts: Inter + Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Vite / Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

    <style>
        :root {
            --primary: {{ $primaryColor }};
        }
        html, body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }

        /* Light mode default */
        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            background-color: #fafbff;
            color: #1e293b;
            transition: background-color 0.4s cubic-bezier(0.4,0,0.2,1), color 0.4s cubic-bezier(0.4,0,0.2,1);
        }
        .dark body {
            background-color: #0c111b;
            color: #e2e8f0;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #c7d2e0; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .dark ::-webkit-scrollbar-thumb { background: #334155; }
        .dark ::-webkit-scrollbar-thumb:hover { background: #475569; }

        /* Glass panels */
        .glass-panel {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.04);
        }
        .dark .glass-panel {
            background: rgba(15, 23, 42, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
        }

        /* Text gradient */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, #818cf8 50%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Vanta background container */
        #vanta-bg {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 0;
            pointer-events: none;
            opacity: 0.4;
        }

        /* Smooth section transitions */
        section {
            position: relative;
            z-index: 1;
        }

        /* Nav active link indicator */
        .nav-link {
            position: relative;
            padding-bottom: 2px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%) scaleX(0);
            width: 100%;
            height: 2px;
            background: var(--primary);
            border-radius: 99px;
            transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .nav-link:hover::after {
            transform: translateX(-50%) scaleX(1);
        }

        /* Theme toggle */
        .theme-toggle-btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .theme-toggle-btn:hover {
            transform: rotate(15deg) scale(1.1);
        }
        .theme-toggle-btn .theme-icon {
            transition: transform 0.4s cubic-bezier(0.4,0,0.2,1), opacity 0.3s ease;
        }
    </style>
</head>
<body class="antialiased selection:bg-indigo-500/30 selection:text-indigo-900 dark:selection:bg-indigo-400/30 dark:selection:text-white">

    <!-- Vanta.js Background -->
    <div id="vanta-bg"></div>

    <!-- Navbar -->
    <nav class="fixed w-full z-50 py-5 transition-all duration-500" id="navbar">
        <div class="container mx-auto px-6 md:px-12 lg:px-24">
            <div class="glass-panel rounded-2xl px-6 py-3 flex justify-between items-center">
                <a href="#" class="text-xl font-bold text-slate-800 dark:text-white tracking-tight">
                    PORT<span style="color: var(--primary);">FOLIO</span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#hero" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white px-3 py-2 rounded-lg hover:bg-slate-100/60 dark:hover:bg-white/5 transition-all">{{ __('Home') }}</a>
                    <a href="#about" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white px-3 py-2 rounded-lg hover:bg-slate-100/60 dark:hover:bg-white/5 transition-all">{{ __('About') }}</a>
                    <a href="#tech" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white px-3 py-2 rounded-lg hover:bg-slate-100/60 dark:hover:bg-white/5 transition-all">{{ __('Skills') }}</a>
                    <a href="#specialis" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white px-3 py-2 rounded-lg hover:bg-slate-100/60 dark:hover:bg-white/5 transition-all">{{ __('Specialties') }}</a>
                    <a href="#careers" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white px-3 py-2 rounded-lg hover:bg-slate-100/60 dark:hover:bg-white/5 transition-all">{{ __('Careers') }}</a>
                    <a href="#projects" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white px-3 py-2 rounded-lg hover:bg-slate-100/60 dark:hover:bg-white/5 transition-all">{{ __('Projects') }}</a>
                    <a href="#contact" class="nav-link text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white px-3 py-2 rounded-lg hover:bg-slate-100/60 dark:hover:bg-white/5 transition-all">{{ __('Contact') }}</a>

                    <!-- Divider -->
                    <div class="w-px h-6 bg-slate-200 dark:bg-slate-700 mx-2"></div>

                    <!-- Lang Toggle -->
                    <div class="flex items-center bg-slate-100/80 dark:bg-slate-800/60 rounded-xl p-1 border border-slate-200/50 dark:border-slate-700/30">
                        <a href="{{ route('lang.switch', 'id') }}" wire:navigate
                           class="px-3 py-1.5 text-xs font-bold rounded-lg transition-all duration-300 {{ $currentLocale == 'id' ? 'text-white shadow-md' : 'text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white' }}"
                           @if($currentLocale == 'id') style="background-color: var(--primary);" @endif>
                            ID
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}" wire:navigate
                           class="px-3 py-1.5 text-xs font-bold rounded-lg transition-all duration-300 {{ $currentLocale == 'en' ? 'text-white shadow-md' : 'text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white' }}"
                           @if($currentLocale == 'en') style="background-color: var(--primary);" @endif>
                            EN
                        </a>
                    </div>

                    <!-- Theme Toggle -->
                    <button id="theme-toggle" class="theme-toggle-btn bg-slate-100/80 dark:bg-slate-800/60 text-slate-500 dark:text-slate-400 hover:text-amber-500 dark:hover:text-amber-400 border border-slate-200/50 dark:border-slate-700/30 focus:outline-none">
                        <i class="fas fa-moon text-sm theme-icon" id="theme-icon-desktop"></i>
                    </button>

                    <a href="{{ route('download.cv') }}"
                        class="hidden lg:flex items-center gap-2 px-5 py-2 rounded-xl text-white shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5 focus:outline-none" style="background: linear-gradient(135deg, var(--primary), #818cf8);">
                        <i class="fas fa-download text-sm"></i>
                        <span class="text-sm font-bold">{{ __('Download CV') }}</span>
                    </a>
                </div>

                <!-- Mobile Actions -->
                <div class="md:hidden flex items-center space-x-3">
                    <button id="theme-toggle-mobile" class="theme-toggle-btn w-9 h-9 bg-slate-100/80 dark:bg-slate-800/60 text-slate-500 dark:text-slate-400 hover:text-amber-500 dark:hover:text-amber-400 border border-slate-200/50 dark:border-slate-700/30 focus:outline-none">
                        <i class="fas fa-moon text-sm theme-icon" id="theme-icon-mobile"></i>
                    </button>
                    <button class="w-9 h-9 rounded-xl bg-slate-100/80 dark:bg-slate-800/60 text-slate-600 dark:text-slate-300 border border-slate-200/50 dark:border-slate-700/30 flex items-center justify-center focus:outline-none" id="mobile-menu-btn">
                        <i class="fas fa-bars text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="fixed inset-0 z-[60] bg-white/98 dark:bg-slate-950/98 backdrop-blur-2xl hidden flex-col items-center justify-center space-y-5 transition-all" id="mobile-menu">
        <button class="absolute top-6 right-6 w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 flex items-center justify-center focus:outline-none z-50" id="mobile-close-btn">
            <i class="fas fa-times"></i>
        </button>

        <!-- Lang Toggle Mobile -->
        <div class="flex items-center bg-slate-100 dark:bg-slate-800/80 rounded-xl p-1.5 border border-slate-200/50 dark:border-slate-700/30 mb-4">
            <a href="{{ route('lang.switch', 'id') }}" wire:navigate
               class="px-5 py-2 text-sm font-bold rounded-lg transition-all duration-300 {{ $currentLocale == 'id' ? 'text-white shadow-md' : 'text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white' }}"
               @if($currentLocale == 'id') style="background-color: var(--primary);" @endif>
                ID
            </a>
            <a href="{{ route('lang.switch', 'en') }}" wire:navigate
               class="px-5 py-2 text-sm font-bold rounded-lg transition-all duration-300 {{ $currentLocale == 'en' ? 'text-white shadow-md' : 'text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white' }}"
               @if($currentLocale == 'en') style="background-color: var(--primary);" @endif>
                EN
            </a>
        </div>

        <a href="#hero" class="text-lg font-medium text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white transition-colors mobile-link">{{ __('Home') }}</a>
        <a href="#about" class="text-lg font-medium text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white transition-colors mobile-link">{{ __('About') }}</a>
        <a href="#tech" class="text-lg font-medium text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white transition-colors mobile-link">{{ __('Skills') }}</a>
        <a href="#specialis" class="text-lg font-medium text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white transition-colors mobile-link">{{ __('Specialties') }}</a>
        <a href="#careers" class="text-lg font-medium text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white transition-colors mobile-link">{{ __('Careers') }}</a>
        <a href="#projects" class="text-lg font-medium text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white transition-colors mobile-link">{{ __('Projects') }}</a>
        <a href="#contact" class="text-lg font-medium text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white transition-colors mobile-link">{{ __('Contact') }}</a>

        <a href="{{ route('download.cv') }}"
            class="flex items-center gap-2 px-8 py-3.5 mt-2 text-white font-bold rounded-xl shadow-lg transition-all duration-300 hover:-translate-y-0.5 hover:shadow-xl focus:outline-none" style="background: linear-gradient(135deg, var(--primary), #818cf8);">
            <i class="fas fa-download text-sm"></i>
            <span>{{ __('Download CV') }}</span>
        </a>
    </div>

    <main>
        @yield('content')
    </main>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Vanta.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.globe.min.js"></script>

    <script data-navigate-once>
        let vantaEffect = null;

        // Inisialisasi AOS
        function initAOS() {
            AOS.init({
                once: true,
                offset: 50,
                duration: 800,
                easing: 'ease-in-out-cubic',
            });
            setTimeout(() => AOS.refresh(), 100);
        }

        // Inisialisasi / update Vanta.js
        function initVanta() {
            if (vantaEffect) vantaEffect.destroy();

            const isDark = document.documentElement.classList.contains('dark');
            const primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--primary').trim() || '#38bdf8';

            // Convert hex ke int untuk Vanta
            function hexToInt(hex) {
                return parseInt(hex.replace('#', ''), 16);
            }

            vantaEffect = VANTA.GLOBE({
                el: "#vanta-bg",
                mouseControls: true,
                touchControls: true,
                gyroControls: false,
                minHeight: 200.00,
                minWidth: 200.00,
                scale: 1.00,
                scaleMobile: 1.00,
                color: hexToInt(primaryColor),
                color2: hexToInt(isDark ? "fafbff" : "0c111b"),
                backgroundColor: isDark ? 0x0c111b : 0xfafbff,
                points: 8.00,
                maxDistance: 22.00,
                spacing: 18.00,
                showDots: true,
            })
        }

        // Sync icon toggle (satu icon bergantian)
        function syncThemeIcon() {
            const isDark = document.documentElement.classList.contains('dark');
            const iconD = document.getElementById('theme-icon-desktop');
            const iconM = document.getElementById('theme-icon-mobile');

            [iconD, iconM].forEach(icon => {
                if (!icon) return;
                if (isDark) {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                } else {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                }
            });
        }

        function handleThemeToggle() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('color-theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            syncThemeIcon();
            initVanta();
        }

        document.addEventListener('livewire:navigated', () => {
            initAOS();
            initVanta();
            syncThemeIcon();

            // Mobile menu
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const closeBtn = document.getElementById('mobile-close-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileLinks = document.querySelectorAll('.mobile-link');

            function toggleMenu() {
                if (mobileMenu) {
                    mobileMenu.classList.toggle('hidden');
                    mobileMenu.classList.toggle('flex');
                    document.body.classList.toggle('overflow-hidden');
                }
            }

            if (mobileBtn) {
                mobileBtn.removeEventListener('click', toggleMenu);
                mobileBtn.addEventListener('click', toggleMenu);
            }
            if (closeBtn) {
                closeBtn.removeEventListener('click', toggleMenu);
                closeBtn.addEventListener('click', toggleMenu);
            }
            mobileLinks.forEach(link => {
                link.removeEventListener('click', toggleMenu);
                link.addEventListener('click', toggleMenu);
            });

            // Bind theme toggle buttons
            const toggleD = document.getElementById('theme-toggle');
            const toggleM = document.getElementById('theme-toggle-mobile');

            if (toggleD) {
                toggleD.removeEventListener('click', handleThemeToggle);
                toggleD.addEventListener('click', handleThemeToggle);
            }
            if (toggleM) {
                toggleM.removeEventListener('click', handleThemeToggle);
                toggleM.addEventListener('click', handleThemeToggle);
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (!nav) return;
            if (window.scrollY > 50) {
                nav.classList.add('py-2');
                nav.classList.remove('py-5');
            } else {
                nav.classList.remove('py-2');
                nav.classList.add('py-5');
            }
        });
    </script>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
