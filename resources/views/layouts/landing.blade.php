<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $appSetting->app_name ?? 'Portfolio')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Plus Jakarta Sans', 'DM Sans', 'sans-serif'],
                        'heading': ['Sora', 'Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        'primary': '{{ $appSetting->theme_color ?? '#6366f1' }}',
                        'primary-dark': '#4f46e5',
                        'secondary': '#0f172a',
                        'accent': '#f59e0b',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    @stack('styles')
</head>
<body class="font-sans text-slate-600 leading-relaxed bg-white antialiased">
    <!-- Header -->
    <header id="header" class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-xl border-b border-black/5 transition-all duration-300">
        <nav class="max-w-7xl mx-auto flex justify-between items-center py-4 lg:py-5 px-4 sm:px-6">
            <a href="#home" class="font-heading text-2xl sm:text-3xl font-bold text-primary">{{ $appSetting->app_name ?? config('app.name') }}</a>
            
            <!-- Desktop Navigation -->
            <ul class="hidden lg:flex list-none gap-8 xl:gap-10">
                <li><a href="#home" class="nav-link-underline relative text-slate-600 font-medium text-[15px] transition-colors duration-300 hover:text-primary">Beranda</a></li>
                <li><a href="#about" class="nav-link-underline relative text-slate-600 font-medium text-[15px] transition-colors duration-300 hover:text-primary">Tentang</a></li>
                <li><a href="#skills" class="nav-link-underline relative text-slate-600 font-medium text-[15px] transition-colors duration-300 hover:text-primary">Keahlian</a></li>
                <li><a href="#projects" class="nav-link-underline relative text-slate-600 font-medium text-[15px] transition-colors duration-300 hover:text-primary">Proyek</a></li>
                <li><a href="#contact" class="bg-primary text-white px-7 py-3 rounded-full font-semibold transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-primary/40 hover:bg-primary-dark">Kontak</a></li>
            </ul>
            
            <!-- Mobile Menu Toggle -->
            <button id="menu-toggle" class="flex lg:hidden flex-col justify-center items-center w-10 h-10 cursor-pointer rounded-lg hover:bg-slate-100 transition-colors" aria-label="Toggle menu">
                <span class="hamburger-line w-6 h-0.5 bg-secondary transition-all duration-300 origin-center"></span>
                <span class="hamburger-line w-6 h-0.5 bg-secondary transition-all duration-300 mt-1.5"></span>
                <span class="hamburger-line w-6 h-0.5 bg-secondary transition-all duration-300 mt-1.5 origin-center"></span>
            </button>
        </nav>
        
        <!-- Mobile Navigation -->
        <div id="mobile-nav" class="lg:hidden mobile-nav-closed overflow-hidden transition-all duration-300 ease-in-out bg-white border-t border-slate-100">
            <ul class="flex flex-col px-4 sm:px-6 py-4 gap-1">
                <li><a href="#home" class="mobile-nav-link block py-3 px-4 text-slate-600 font-medium text-base rounded-lg hover:bg-primary/5 hover:text-primary transition-all duration-200">Beranda</a></li>
                <li><a href="#about" class="mobile-nav-link block py-3 px-4 text-slate-600 font-medium text-base rounded-lg hover:bg-primary/5 hover:text-primary transition-all duration-200">Tentang</a></li>
                <li><a href="#skills" class="mobile-nav-link block py-3 px-4 text-slate-600 font-medium text-base rounded-lg hover:bg-primary/5 hover:text-primary transition-all duration-200">Keahlian</a></li>
                <li><a href="#projects" class="mobile-nav-link block py-3 px-4 text-slate-600 font-medium text-base rounded-lg hover:bg-primary/5 hover:text-primary transition-all duration-200">Proyek</a></li>
                <li class="mt-2"><a href="#contact" class="block text-center bg-primary text-white py-3 px-6 rounded-full font-semibold hover:bg-primary-dark transition-all duration-300">Kontak</a></li>
            </ul>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-secondary text-white pt-20 pb-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-16 mb-16">
                <!-- Brand -->
                <div class="lg:col-span-1">
                    <a href="#" class="font-heading text-3xl font-bold text-primary inline-block mb-5">{{ $appSetting->app_name ?? config('app.name') }}</a>
                    <p class="text-white/70 mb-6 leading-relaxed">Membuat pengalaman digital dengan penuh semangat dan presisi. Mari bangun sesuatu yang luar biasa bersama.</p>
                    <div class="flex gap-3">
                        <a href="#" aria-label="GitHub" class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center text-white transition-all duration-300 hover:bg-primary hover:-translate-y-1">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" aria-label="LinkedIn" class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center text-white transition-all duration-300 hover:bg-primary hover:-translate-y-1">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" aria-label="Twitter" class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center text-white transition-all duration-300 hover:bg-primary hover:-translate-y-1">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" aria-label="Instagram" class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center text-white transition-all duration-300 hover:bg-primary hover:-translate-y-1">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-base font-semibold mb-6 text-white">Tautan Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="#home" class="text-white/70 transition-colors duration-300 hover:text-primary">Beranda</a></li>
                        <li><a href="#about" class="text-white/70 transition-colors duration-300 hover:text-primary">Tentang</a></li>
                        <li><a href="#skills" class="text-white/70 transition-colors duration-300 hover:text-primary">Keahlian</a></li>
                        <li><a href="#projects" class="text-white/70 transition-colors duration-300 hover:text-primary">Proyek</a></li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div>
                    <h4 class="text-base font-semibold mb-6 text-white">Layanan</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-white/70 transition-colors duration-300 hover:text-primary">Web Development</a></li>
                        <li><a href="#" class="text-white/70 transition-colors duration-300 hover:text-primary">Web Hosting</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="text-base font-semibold mb-6 text-white">Kontak</h4>
                    <ul class="space-y-3">
                        <li><a href="mailto:hello@example.com" class="text-white/70 transition-colors duration-300 hover:text-primary">hello@example.com</a></li>
                        <li><a href="#" class="text-white/70 transition-colors duration-300 hover:text-primary">+62 812 3456 7890</a></li>
                        <li><a href="#" class="text-white/70 transition-colors duration-300 hover:text-primary">Jakarta, Indonesia</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-white/50 text-sm">
                <p>&copy; 2026 {{ $appSetting->app_name ?? config('app.name') }}. All rights reserved.</p>
                <p>Designed with <i class="fas fa-heart text-red-500"></i> by Me</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/landing.js') }}"></script>
    @stack('scripts')
</body>
</html>