<section id="hero" class="relative min-h-screen flex items-center justify-center pt-24 pb-16 overflow-hidden">
    <!-- Background blobs -->
    <!-- <div class="absolute inset-0 z-0">
        <div class="absolute top-1/4 left-1/4 w-[500px] h-[500px] bg-sky-400/10 dark:bg-sky-500/10 rounded-full filter blur-[100px] animate-blob"></div>
        <div class="absolute top-1/3 right-1/4 w-[400px] h-[400px] bg-indigo-400/10 dark:bg-indigo-500/10 rounded-full filter blur-[100px] animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-1/2 w-[500px] h-[500px] bg-purple-400/8 dark:bg-purple-500/8 rounded-full filter blur-[100px] animate-blob animation-delay-4000"></div>
    </div> -->

    <!-- Grid pattern overlay for light mode -->
    <div class="absolute inset-0 z-0 opacity-[0.03] dark:opacity-[0.02]" style="background-image: radial-gradient(circle, #64748b 1px, transparent 1px); background-size: 24px 24px;"></div>

    <div class="container mx-auto px-6 md:px-12 lg:px-24 z-10 relative">
        <div class="flex flex-col-reverse md:flex-row items-center justify-between gap-16">

            <!-- Text Content -->
            <div class="w-full md:w-3/5 text-center md:text-left" data-aos="fade-up" data-aos-duration="1000">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 mb-6 animate__animated animate__fadeInDown animate__delay-1s">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 mr-2 animate-pulse"></span>
                    <span class="text-sm font-medium text-sky-700 dark:text-sky-400">
                        {{ __('I am') }} {{ $user->specialis ?? 'Developer' }}
                    </span>
                </div>

                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-slate-900 dark:text-white mb-6 leading-[1.1] tracking-tight animate__animated animate__fadeInLeft">
                    {{ $user->name ?? 'Jhon Doe' }}
                    <br>
                    <span class="text-gradient">{{ $user->specialis ?? 'Developer' }}</span>
                </h1>

                <p class="text-slate-500 dark:text-slate-400 text-lg md:text-xl mb-10 max-w-xl leading-relaxed animate__animated animate__fadeInUp animate__delay-1s">
                    {{ translate_text($user->headline ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.') }}
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center md:justify-start space-y-4 sm:space-y-0 sm:space-x-4 animate__animated animate__fadeInUp animate__delay-2s">
                    <a href="#projects" class="w-full sm:w-auto px-8 py-4 text-white font-semibold rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-1 text-center hover:shadow-xl" style="background-color: var(--primary); box-shadow: 0 8px 30px rgba(56, 189, 248, 0.25);">
                        {{ __('View My Work s') }}
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    @if($setting->github_link)
                        <a href="{{ $setting->github_link }}" target="_blank" class="w-full sm:w-auto px-8 py-4 bg-white dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/50 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white font-semibold rounded-xl transition-all duration-300 flex items-center justify-center hover:border-slate-300 dark:hover:border-slate-600 hover:shadow-lg">
                            <i class="fab fa-github mr-2"></i> {{ __('GitHub Profile') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Avatar -->
            <!-- <div class="w-full md:w-2/5 flex justify-center mt-8 md:mt-0" data-aos="zoom-in" data-aos-duration="1200">
                <div class="relative w-64 h-64 md:w-80 md:h-80 group">
                    
                    <div class="absolute -inset-4 rounded-3xl opacity-20 dark:opacity-30 group-hover:opacity-40 transition-opacity duration-700 blur-2xl" style="background: linear-gradient(135deg, var(--primary), #818cf8, #c084fc);"></div>

                    
                    <div class="relative w-full h-full rounded-3xl p-1 bg-gradient-to-tr from-sky-400/20 via-indigo-400/20 to-purple-400/20 dark:from-sky-500/30 dark:via-indigo-500/30 dark:to-purple-500/30 shadow-2xl transition-transform duration-500 group-hover:-translate-y-2">
                        <img src="{{ safe_image_url($user->foto) }}" alt="Profile" class="w-full h-full rounded-[1.35rem] object-cover">
                    </div>

                    
                    <div class="absolute -right-3 top-10 bg-white dark:bg-slate-800 backdrop-blur-sm border border-slate-100 dark:border-slate-700/50 p-3 rounded-2xl shadow-lg shadow-slate-200/50 dark:shadow-black/20 animate-bounce" style="animation-duration: 3s;">
                        <i class="fab fa-laravel text-red-500 text-2xl"></i>
                    </div>
                    <div class="absolute -left-3 bottom-10 bg-white dark:bg-slate-800 backdrop-blur-sm border border-slate-100 dark:border-slate-700/50 p-3 rounded-2xl shadow-lg shadow-slate-200/50 dark:shadow-black/20 animate-bounce" style="animation-duration: 4s; animation-delay: 1s;">
                        <i class="fa-solid fa-database text-emerald-500 text-2xl"></i>
                    </div>
                </div>
            </div> -->

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
    .animate-blob { animation: blob 7s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
</style>
