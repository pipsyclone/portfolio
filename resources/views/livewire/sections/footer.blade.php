<footer class="bg-slate-900 border-t border-slate-800 pt-16 pb-8">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <div class="flex flex-col md:flex-row justify-between items-center md:items-start mb-12">
            <!-- Brand -->
            <div class="mb-8 md:mb-0 text-center md:text-left">
                <a href="#" class="text-2xl font-bold text-white tracking-wider inline-block mb-4">
                    PORT<span class="text-sky-400">FOLIO</span>
                </a>
                <p class="text-slate-400 text-sm max-w-xs mx-auto md:mx-0">
                    Building digital experiences that combine beautiful design with elegant code.
                </p>
            </div>

            <!-- Social Links -->
            @if ($setting->instagram_link || $setting->github_link || $setting->linkedin_link)
                <div class="text-center md:text-right">
                    <h4 class="text-white font-bold mb-4">Connect</h4>
                    <div class="flex space-x-4 justify-center md:justify-end">
                        <a href="{{ $setting->github_link }}" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-sky-500 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="{{ $setting->instagram_link }}" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-sky-500 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{ $setting->linkedin_link }}" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-sky-500 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Copyright -->
        <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-slate-500">
            <p>&copy; {{ date('Y') }} {{ $user->name }}. All rights reserved.</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-sky-400 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-sky-400 transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
