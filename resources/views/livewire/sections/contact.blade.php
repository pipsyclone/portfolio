<section id="contact" class="py-24 bg-slate-900/50">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Get In <span class="text-sky-400">Touch</span></h2>
            <div class="w-24 h-1 bg-sky-500 mx-auto rounded-full"></div>
            <p class="text-slate-400 mt-6 max-w-2xl mx-auto">Have a project in mind or just want to say hi? Feel free to reach out!</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Contact Info -->
            <div class="w-full lg:w-1/3 space-y-8" data-aos="fade-right">
                <div class="glass-panel p-6 rounded-2xl flex items-start space-x-4">
                    <div class="w-12 h-12 bg-sky-500/20 text-sky-400 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fas fa-envelope text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-lg mb-1">Email Address</h4>
                        <p class="text-slate-400 text-sm">{{ $email ?? '-' }}</p>
                    </div>
                </div>

                <div class="glass-panel p-6 rounded-2xl flex items-start space-x-4">
                    <div class="w-12 h-12 bg-indigo-500/20 text-indigo-400 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-location-dot text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-lg mb-1">Address</h4>
                        <p class="text-slate-400 text-sm">{{ $address ?? '-' }}</p>
                    </div>
                </div>

                <div class="glass-panel p-6 rounded-2xl flex items-start space-x-4">
                    <div class="w-12 h-12 bg-emerald-500/20 text-emerald-400 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-brands fa-whatsapp text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-lg mb-1">Phone Number</h4>
                        <p class="text-slate-400 text-sm">{{ $phone ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="w-full lg:w-2/3" data-aos="fade-left">
                <form class="glass-panel p-8 rounded-2xl space-y-6" onsubmit="event.preventDefault(); alert('Message sent placeholder!');">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="text-slate-300 text-sm font-medium">Full Name</label>
                            <input type="text" id="name" class="w-full bg-slate-800/50 border border-slate-700 focus:border-sky-500 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-sky-500 transition-colors" placeholder="Insert your name">
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="text-slate-300 text-sm font-medium">Email Address</label>
                            <input type="email" id="email" class="w-full bg-slate-800/50 border border-slate-700 focus:border-sky-500 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-sky-500 transition-colors" placeholder="Insert your email">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="subject" class="text-slate-300 text-sm font-medium">Subject</label>
                        <input type="text" id="subject" class="w-full bg-slate-800/50 border border-slate-700 focus:border-sky-500 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-sky-500 transition-colors" placeholder="Project details">
                    </div>
                    <div class="space-y-2">
                        <label for="message" class="text-slate-300 text-sm font-medium">Message</label>
                        <textarea id="message" rows="5" class="w-full bg-slate-800/50 border border-slate-700 focus:border-sky-500 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-sky-500 transition-colors resize-none" placeholder="Write your project details..."></textarea>
                    </div>
                    <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-sky-500 hover:bg-sky-400 text-white font-bold rounded-lg shadow-lg shadow-sky-500/30 transition-all duration-300 flex items-center justify-center">
                        Send Message <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
