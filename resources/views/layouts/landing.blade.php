@php
    $user = \App\Models\User::first();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Primary Meta Tags -->
    <title>{{ $user->name ?? 'Portfolio' }} | {{ $user->specialis ?? 'Fullstack Web Developer' }}</title>
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

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0f172a; /* Slate 900 */
            color: #f8fafc; /* Slate 50 */
            overflow-x: hidden;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
        
        .glass-panel {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .text-gradient {
            background: linear-gradient(to right, #38bdf8, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navbar / Header Menu -->
    <nav class="fixed w-full z-50 glass-panel border-b-0 border-slate-700/50 py-4 transition-all duration-300" id="navbar">
        <div class="container mx-auto px-6 md:px-12 lg:px-24 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-white tracking-wider">
                PORT<span class="text-sky-400">FOLIO</span>
            </a>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-8">
                <a href="#hero" class="text-sm font-medium text-slate-300 hover:text-sky-400 transition-colors">Home</a>
                <a href="#about" class="text-sm font-medium text-slate-300 hover:text-sky-400 transition-colors">About</a>
                <a href="#tech" class="text-sm font-medium text-slate-300 hover:text-sky-400 transition-colors">Skills</a>
                <a href="#specialis" class="text-sm font-medium text-slate-300 hover:text-sky-400 transition-colors">Specialties</a>
                <a href="#projects" class="text-sm font-medium text-slate-300 hover:text-sky-400 transition-colors">Projects</a>
                <a href="#contact" class="text-sm font-medium text-slate-300 hover:text-sky-400 transition-colors">Contact</a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button class="text-slate-300 hover:text-white focus:outline-none" id="mobile-menu-btn">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu (Hidden by default) -->
    <div class="fixed inset-0 z-40 bg-slate-900/95 backdrop-blur-md hidden flex-col items-center justify-center space-y-8 transition-opacity" id="mobile-menu">
        <button class="absolute top-6 right-6 text-slate-300 hover:text-white focus:outline-none" id="mobile-close-btn">
            <i class="fas fa-times text-2xl"></i>
        </button>
        <a href="#hero" class="text-xl font-medium text-slate-300 hover:text-sky-400 transition-colors mobile-link">Home</a>
        <a href="#about" class="text-xl font-medium text-slate-300 hover:text-sky-400 transition-colors mobile-link">About</a>
        <a href="#tech" class="text-xl font-medium text-slate-300 hover:text-sky-400 transition-colors mobile-link">Skills</a>
        <a href="#specialis" class="text-xl font-medium text-slate-300 hover:text-sky-400 transition-colors mobile-link">Specialties</a>
        <a href="#projects" class="text-xl font-medium text-slate-300 hover:text-sky-400 transition-colors mobile-link">Projects</a>
        <a href="#contact" class="text-xl font-medium text-slate-300 hover:text-sky-400 transition-colors mobile-link">Contact</a>
    </div>

    <main>
        @yield('content')
    </main>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 50,
            duration: 800,
            easing: 'ease-in-out-cubic',
        });

        // Mobile menu toggle logic
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const closeBtn = document.getElementById('mobile-close-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileLinks = document.querySelectorAll('.mobile-link');

        function toggleMenu() {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
            document.body.classList.toggle('overflow-hidden');
        }

        mobileBtn.addEventListener('click', toggleMenu);
        closeBtn.addEventListener('click', toggleMenu);
        
        mobileLinks.forEach(link => {
            link.addEventListener('click', toggleMenu);
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-lg', 'shadow-indigo-500/10');
                nav.classList.remove('py-4');
                nav.classList.add('py-2');
            } else {
                nav.classList.remove('shadow-lg', 'shadow-indigo-500/10');
                nav.classList.add('py-4');
                nav.classList.remove('py-2');
            }
        });
    </script>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
