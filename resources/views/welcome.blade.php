@extends('layouts.landing')

@section('title', $profile->name ?? 'John Doe')

@section('content')
<!-- Hero Section -->
<section class="hero-bg min-h-screen flex items-center bg-slate-100 relative overflow-hidden pt-20" id="home">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <!-- Hero Content -->
            <div class="animate-fade-up text-center lg:text-left">
                <div class="inline-flex items-center gap-2.5 bg-white py-2.5 px-5 rounded-full shadow-md mb-6 text-base">
                    <span class="text-2xl">👋</span> Hallo, Saya
                </div>
                <h1 class="font-heading text-5xl md:text-6xl lg:text-7xl font-bold text-secondary leading-tight mb-6">
                    <span class="">{{ $profile->name ?? 'John Doe' }}</span>
                    <span class="">Seorang</span>
                    <span class="text-primary">{{ $profile->as ?? 'Developer' }}</span>
                </h1>
                <p class="text-lg text-slate-500 mb-9 leading-relaxed max-w-lg mx-auto lg:mx-0">
                    Selamat datang di portofolio saya! Saya {{ $profile->name ?? 'John Doe' }}, seorang pengembang web yang berdedikasi dengan pengalaman lebih dari {{ $profile->experience ?? '0' }} tahun dalam menciptakan solusi digital inovatif dan efisien.
                </p>
                <div class="flex flex-wrap gap-4 mb-12 justify-center lg:justify-start">
                    <a href="#projects" class="inline-flex items-center gap-2.5 py-4 px-9 rounded-full font-semibold text-base bg-primary text-white btn-primary-shadow transition-all duration-300 hover:-translate-y-1 hover:bg-primary-dark">
                        Jelajahi Proyek
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="#contact" class="inline-flex items-center gap-2.5 py-4 px-9 rounded-full font-semibold text-base bg-transparent text-secondary border-2 border-slate-200 transition-all duration-300 hover:border-primary hover:text-primary hover:-translate-y-1">
                        Hubungi Saya
                    </a>
                </div>
                <div class="flex gap-12 justify-center lg:justify-start">
                    <div class="text-center">
                        <span class="text-4xl font-bold text-secondary block">{{ $profile->experience ?? '0' }}+</span>
                        <span class="text-sm text-slate-500">Tahun Pengalaman</span>
                    </div>
                    <div class="text-center">
                        <span class="text-4xl font-bold text-secondary block">{{ $projects->where('status', 'completed')->count() ?? '0' }}+</span>
                        <span class="text-sm text-slate-500">Proyek Selesai</span>
                    </div>
                </div>
            </div>
            
            <!-- Hero Image -->
            <div class="animate-fade-up delay-300">
                <div class="relative w-80 h-80 lg:w-[450px] lg:h-[450px] mx-auto">
                    <div class="morphing-blob absolute inset-0 bg-primary"></div>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 lg:w-96 lg:h-96 rounded-full bg-slate-200 flex items-center justify-center text-8xl lg:text-9xl shadow-2xl">
                        <img src="{{ safe_image($profile->foto) }}" alt="{{ $profile->foto}}" class="w-full h-full object-cover rounded-full">
                    </div>
                    <!-- Floating Cards -->
                    <div class="floating hidden lg:flex absolute top-[10%] -right-5 bg-white rounded-2xl py-4 px-5 shadow-xl items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-primary/10 flex items-center justify-center text-xl text-primary">
                            <i class="fas fa-code"></i>
                        </div>
                        <div>
                            <strong class="block text-sm text-secondary">Web Development</strong>
                            <span class="text-xs text-slate-500">Full Stack</span>
                        </div>
                    </div>
                    <div class="floating floating-delay-1 hidden lg:flex absolute bottom-[15%] -left-8 bg-white rounded-2xl py-4 px-5 shadow-xl items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-primary/10 flex items-center justify-center text-xl text-primary">
                            <i class="fas fa-server"></i>
                        </div>
                        <div>
                            <strong class="block text-sm text-secondary">Web Services</strong>
                            <span class="text-xs text-slate-500">Server Management</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-24 bg-white" id="about">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <!-- About Image -->
            <div class="relative animate-on-scroll">
                <div class="max-w-md mx-auto lg:mx-0 rounded-3xl overflow-hidden shadow-2xl">
                    <img src="{{ safe_image($profile->foto) }}" alt="{{ $profile->name ?? 'John Doe' }}" class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-5 right-5 lg:right-20 bg-primary text-white py-6 px-8 rounded-2xl text-center experience-badge-shadow">
                    <span class="text-5xl font-bold block">{{ $profile->experience ?? '0' }}+</span>
                    <span class="text-sm opacity-90">Tahun Pengalaman</span>
                </div>
            </div>
            
            <!-- About Content -->
            <div class="animate-on-scroll">
                <span class="inline-block bg-primary/10 text-primary py-2 px-5 rounded-full text-sm font-semibold uppercase tracking-wider mb-4">Tentang Saya</span>
                <h2 class="font-heading text-4xl lg:text-5xl font-bold text-secondary mb-6">Pengembang yang Bersemangat & Pemecah Masalah Kreatif</h2>
                <p class="text-slate-500 text-lg leading-relaxed mb-6">
                    {{ $profile->bio }}
                </p>
                {{-- <p class="text-slate-500 text-lg leading-relaxed mb-8">
                    I believe in writing clean, maintainable code and creating intuitive interfaces that users love. When I'm not coding, you can find me exploring new technologies, contributing to open-source projects, or sharing knowledge with the developer community.
                </p> --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 bg-primary/10 text-primary rounded-full flex items-center justify-center text-xs">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="font-medium text-secondary">Clean Code Writing</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 bg-primary/10 text-primary rounded-full flex items-center justify-center text-xs">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="font-medium text-secondary">Modern Technologies</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 bg-primary/10 text-primary rounded-full flex items-center justify-center text-xs">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="font-medium text-secondary">Responsive Design</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 bg-primary/10 text-primary rounded-full flex items-center justify-center text-xs">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="font-medium text-secondary">Performance Optimized</span>
                    </div>
                </div>
                @if ($profile->cv_url)
                    <a href="{{ $profile->cv_url }}" target="_blank" class="inline-flex items-center gap-2.5 py-4 px-9 rounded-full font-semibold text-base bg-primary text-white btn-primary-shadow transition-all duration-300 hover:-translate-y-1 hover:bg-primary-dark" rel="noopener noreferrer">
                        Download CV
                        <i class="fas fa-download"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section class="py-24 bg-slate-50" id="skills">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="inline-block bg-primary/10 text-primary py-2 px-5 rounded-full text-sm font-semibold uppercase tracking-wider mb-4">Keahlian</span>
            <h2 class="font-heading text-4xl lg:text-5xl font-bold text-secondary mb-4">Keahlian & Teknologi</h2>
            <p class="text-slate-500 text-lg max-w-xl mx-auto">
                Saya mengkhususkan diri dalam membangun aplikasi web modern menggunakan teknologi terkini dan praktik terbaik industri.
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Skill Cards -->
            @foreach ($techStacks as $tech)
                <div class="skill-card bg-white p-10 rounded-3xl text-center border border-slate-100 transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl animate-on-scroll">
                    <div class="skill-icon w-20 h-20 mx-auto mb-6 bg-primary/10 rounded-2xl flex items-center justify-center text-4xl transition-all duration-500">
                        <i class="fab fa-html5 text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-secondary mb-3">{{ $tech->name }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Building responsive and interactive user interfaces with HTML, CSS, JavaScript, and modern frameworks</p>
                </div>
            @endforeach
            
            @foreach ($skills as $skill)
                <div class="skill-card bg-white p-10 rounded-3xl text-center border border-slate-100 transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl animate-on-scroll">
                    <div class="skill-icon w-20 h-20 mx-auto mb-6 bg-primary/10 rounded-2xl flex items-center justify-center text-4xl transition-all duration-500">
                        <i class="{{ $skill->icon ?? 'fa-solid fa-briefcase' }} text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-secondary mb-3">{{ $skill->name }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Creating robust server-side applications with PHP, Laravel, Node.js, and RESTful APIs</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Projects Section -->
<section class="py-24 bg-white" id="projects">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="inline-block bg-primary/10 text-primary py-2 px-5 rounded-full text-sm font-semibold uppercase tracking-wider mb-4">Proyek Unggulan</span>
            <h2 class="font-heading text-4xl lg:text-5xl font-bold text-secondary mb-4">Proyek Unggulan</h2>
            <p class="text-slate-500 text-lg max-w-xl mx-auto">
                Berikut adalah beberapa proyek terbaru saya yang menunjukkan keahlian dan kreativitas saya dalam pengembangan web.
            </p>
        </div>
        
        <!-- Filter Buttons -->
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button class="filter-btn bg-primary text-white py-3 px-7 rounded-full text-[15px] font-medium transition-all duration-300" data-filter="all">All</button>
            @foreach ($skills as $skill)
                <button class="filter-btn text-slate-500 hover:text-primary py-3 px-7 rounded-full text-[15px] font-medium transition-all duration-300" data-filter="skill-{{ $skill->id }}">{{ $skill->name }}</button>
            @endforeach
            @foreach ($techStacks as $tech)
                <button class="filter-btn text-slate-500 hover:text-primary py-3 px-7 rounded-full text-[15px] font-medium transition-all duration-300" data-filter="tech-{{ $tech->id }}">{{ $tech->name }}</button>
            @endforeach
        </div>
        
        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Project Card 1 -->
            @forelse ($projects as $project)
                @php
                    $categories = [];
                    foreach ($project->skills as $skill) {
                        $categories[] = 'skill-' . $skill->id;
                    }
                    foreach ($project->techStacks as $tech) {
                        $categories[] = 'tech-' . $tech->id;
                    }
                @endphp
                <div class="project-card bg-white rounded-3xl overflow-hidden shadow-lg transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl animate-on-scroll" data-category="{{ implode(' ', $categories) }}">
                    <div class="relative h-60 overflow-hidden">
                        <!-- Status Badge -->
                        <div class="absolute top-4 left-4 z-10">
                            @if($project->status === 'completed')
                                <span class="py-1.5 px-4 bg-green-500 text-white text-xs font-semibold rounded-full shadow-lg">
                                    <i class="fas fa-check-circle me-1"></i> Selesai
                                </span>
                            @elseif($project->status === 'ongoing')
                                <span class="py-1.5 px-4 bg-yellow-500 text-white text-xs font-semibold rounded-full shadow-lg">
                                    <i class="fas fa-spinner me-1"></i> Dalam Pengerjaan
                                </span>
                            @elseif($project->status === 'on-hold')
                                <span class="py-1.5 px-4 bg-orange-500 text-white text-xs font-semibold rounded-full shadow-lg">
                                    <i class="fas fa-wrench me-1"></i> Ditunda
                                </span>
                            @elseif($project->status === 'cancelled')
                                <span class="py-1.5 px-4 bg-red-500 text-white text-xs font-semibold rounded-full shadow-lg">
                                    <i class="fas fa-wrench me-1"></i> Dibatalkan
                                </span>
                            @else
                                <span class="py-1.5 px-4 bg-slate-500 text-white text-xs font-semibold rounded-full shadow-lg">
                                    {{ ucfirst($project->status) }}
                                </span>
                            @endif
                        </div>
                        @if($project->image)
                            <img src="{{ safe_image($project->image, 'projects') }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-slate-200 flex items-center justify-center text-5xl text-slate-400">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        <div class="project-overlay absolute inset-0 bg-primary/90 flex items-center justify-center gap-4">
                            <a href="{{ $project->url }}" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary hover:bg-secondary hover:text-white transition-all duration-300">
                                <i class="fas fa-link"></i>
                            </a>
                            {{-- <a href="#" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary hover:bg-secondary hover:text-white transition-all duration-300">
                                <i class="fab fa-github"></i>
                            </a> --}}
                        </div>
                    </div>
                    <div class="p-7">
                        <span class="text-xs text-slate-400 mb-3 block">
                            <i>Kesepakatan Dibuat Pada: {{ formatted_date($project->created_at, 'l, d M Y') }}</i>
                        </span>
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach ($project->techStacks as $tech)
                                <span class="py-1.5 px-4 bg-primary/10 text-primary text-xs font-semibold rounded-full">{{ $tech->name }}</span>
                            @endforeach
                            @foreach ($project->skills as $skill)
                                <span class="py-1.5 px-4 bg-primary/10 text-primary text-xs font-semibold rounded-full">
                                    <i class="{{ $skill->icon }} me-2"></i>
                                    {{ $skill->name }}
                                </span>
                            @endforeach
                        </div>
                        <h3 class="text-xl font-semibold text-secondary mb-3">{{ $project->title }}</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $project->description ?? '-' }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-slate-500 col-span-3">Tidak ada proyek untuk ditampilkan.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-bg py-24 bg-slate-100 relative overflow-hidden" id="contact">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
            <!-- Contact Info -->
            <div class="animate-on-scroll">
                <span class="inline-block bg-primary/10 text-primary py-2 px-5 rounded-full text-sm font-semibold uppercase tracking-wider mb-4">Hubungi Saya</span>
                <h2 class="font-heading text-4xl lg:text-5xl font-bold text-secondary mb-6">Mari Bekerja Sama</h2>
                <p class="text-slate-500 text-lg leading-relaxed mb-10">
                    Saya tertarik untuk mendengar tentang proyek-proyek baru dan peluang kerja sama. Jangan ragu untuk menghubungi saya melalui email, telepon, atau kunjungi lokasi saya.
                </p>
                <div class="space-y-6">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-xl text-primary shadow-lg">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-semibold text-secondary mb-1">Email</h4>
                            <p class="text-slate-500">{{ $profile->email ?? 'johndoe@example.com' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-xl text-primary shadow-lg">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-semibold text-secondary mb-1">Telepon</h4>
                            <p class="text-slate-500">{{ $profile->phone ?? '+1234567890' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-xl text-primary shadow-lg">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-semibold text-secondary mb-1">Lokasi</h4>
                            <p class="text-slate-500">{{ $profile->address ?? 'Jakarta, Indonesia' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="bg-white p-10 lg:p-12 rounded-3xl shadow-2xl animate-on-scroll">
                <form action="#" method="POST">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                        <div>
                            <label for="name" class="block font-medium text-secondary mb-2.5 text-sm">Nama Anda</label>
                            <input type="text" id="name" name="name" placeholder="John Doe" required class="form-input w-full py-4 px-5 border-2 border-slate-200 rounded-xl text-[15px] transition-all duration-300 bg-slate-50 outline-none">
                        </div>
                        <div>
                            <label for="email" class="block font-medium text-secondary mb-2.5 text-sm">Email Anda</label>
                            <input type="email" id="email" name="email" placeholder="john@example.com" required class="form-input w-full py-4 px-5 border-2 border-slate-200 rounded-xl text-[15px] transition-all duration-300 bg-slate-50 outline-none">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="subject" class="block font-medium text-secondary mb-2.5 text-sm">Subjek</label>
                        <input type="text" id="subject" name="subject" placeholder="Project Discussion" required class="form-input w-full py-4 px-5 border-2 border-slate-200 rounded-xl text-[15px] transition-all duration-300 bg-slate-50 outline-none">
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block font-medium text-secondary mb-2.5 text-sm">Pesan</label>
                        <textarea id="message" name="message" placeholder="Ceritakan tentang tujuan Anda..." required class="form-input w-full py-4 px-5 border-2 border-slate-200 rounded-xl text-[15px] transition-all duration-300 bg-slate-50 outline-none resize-y min-h-[140px]"></textarea>
                    </div>
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2.5 py-4 px-9 rounded-full font-semibold text-base bg-primary text-white btn-primary-shadow transition-all duration-300 hover:-translate-y-1 hover:bg-primary-dark">
                        Kirim Pesan
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
