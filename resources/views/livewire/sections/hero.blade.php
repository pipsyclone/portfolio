<section id="hero" class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-sky-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
        <div class="absolute top-1/3 right-1/4 w-96 h-96 bg-indigo-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-1/2 w-96 h-96 bg-purple-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-6 md:px-12 lg:px-24 z-10">
        <div class="flex flex-col-reverse md:flex-row items-center justify-between gap-12">
            
            <!-- Text Content -->
            <div class="w-full md:w-3/5 text-center md:text-left" data-aos="fade-up" data-aos-duration="1000">
                <p class="text-sky-400 font-semibold tracking-wide uppercase mb-4 animate__animated animate__fadeInDown animate__delay-1s">
                    <i class="fas fa-terminal mr-2"></i> Hello World, {{ __('I am') }}
                </p>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight animate__animated animate__fadeInLeft">
                    {{ $user->name ?? 'Jhon Doe' }} <br>
                    <span class="text-gradient">{{ translate_text($user->specialis ?? 'Developer') }}</span>
                </h1>
                <p class="text-slate-400 text-lg md:text-xl mb-10 max-w-2xl animate__animated animate__fadeInUp animate__delay-1s">
                    {{ translate_text($user->headline ?? 'I build exceptional and accessible digital experiences for the web. Turning complex problems into beautiful, intuitive, and highly functional solutions.') }}
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center md:justify-start space-y-4 sm:space-y-0 sm:space-x-6 animate__animated animate__fadeInUp animate__delay-2s">
                    <a href="#projects" class="w-full sm:w-auto px-8 py-3.5 bg-sky-500 hover:bg-sky-400 text-white font-semibold rounded-lg shadow-lg shadow-sky-500/30 transition-all duration-300 transform hover:-translate-y-1 text-center">
                        {{ __('View My Work') }}
                    </a>
                    @if($setting->github_link)
                        <a href="{{ $setting->github_link }}" target="_blank" class="w-full sm:w-auto px-8 py-3.5 bg-transparent border border-slate-600 hover:border-slate-400 text-slate-300 hover:text-white font-semibold rounded-lg transition-all duration-300 flex items-center justify-center">
                            <i class="fab fa-github mr-2"></i> {{ __('GitHub Profile') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Image/Avatar -->
            <div class="w-full md:w-2/5 flex justify-center mt-12 md:mt-0" data-aos="zoom-in" data-aos-duration="1200">
                <div class="relative w-64 h-64 md:w-80 md:h-80 group">
                    <!-- Elegant Soft Glow Behind -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-sky-400 to-indigo-500 rounded-3xl blur-2xl opacity-20 group-hover:opacity-40 transition-opacity duration-700 rotate-3 group-hover:rotate-6"></div>
                    
                    <!-- Main Image Container -->
                    <div class="relative w-full h-full rounded-3xl p-2 bg-gradient-to-tr from-slate-800 to-slate-700 shadow-2xl transition-transform duration-500 group-hover:-translate-y-2">
                        <img src="{{ safe_image_url($user->foto) }}" alt="Profile" class="w-full h-full rounded-2xl object-cover border-4 border-slate-900 transition-transform duration-500">
                    </div>
                    
                    <!-- Minimalist Floating Badges -->
                    <div class="absolute -right-4 top-12 bg-slate-800/90 backdrop-blur-sm border border-slate-700/50 p-3 rounded-2xl shadow-xl animate-bounce" style="animation-duration: 3s;">
                        <i class="fab fa-laravel text-red-500 text-2xl"></i>
                    </div>
                    <div class="absolute -left-4 bottom-12 bg-slate-800/90 backdrop-blur-sm border border-slate-700/50 p-3 rounded-2xl shadow-xl animate-bounce" style="animation-duration: 4s; animation-delay: 1s;">
                        <i class="fa-solid fa-database text-emerald-500 text-2xl"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
