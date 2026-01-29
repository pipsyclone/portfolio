@extends('layouts.error')

@section('title', '500 - Kesalahan Server')

@section('content')
<div class="animate-slide-up">
    <!-- Error Icon -->
    <div class="mb-8 relative inline-block">
        <div class="w-32 h-32 sm:w-40 sm:h-40 mx-auto icon-gradient-rose rounded-full flex items-center justify-center animate-float pulse-glow-rose">
            <div class="text-6xl sm:text-7xl">⚙️</div>
        </div>
    </div>

    <!-- Error Code -->
    <h1 class="font-heading text-8xl sm:text-9xl font-bold mb-4 animate-slide-up-delay-1 gradient-text-rose">
        500
    </h1>

    <!-- Error Title -->
    <h2 class="font-heading text-2xl sm:text-3xl lg:text-4xl font-bold text-secondary mb-4 animate-slide-up-delay-2">
        Kesalahan Server Internal
    </h2>

    <!-- Error Description -->
    <p class="text-slate-500 text-base sm:text-lg max-w-md mx-auto mb-8 leading-relaxed animate-slide-up-delay-3">
        Oops! Terjadi kesalahan pada server kami. Tim teknis kami sedang bekerja untuk memperbaikinya. Silakan coba lagi nanti.
    </p>

    <!-- Status Card -->
    <div class="glass-card rounded-2xl py-5 px-6 inline-block mb-8 animate-slide-up-delay-3">
        <div class="flex items-center gap-4">
            <div class="w-3 h-3 bg-amber-500 rounded-full animate-pulse"></div>
            <span class="text-slate-600 font-medium">Tim kami sedang memperbaiki masalah ini</span>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-up-delay-3">
        <button onclick="location.reload()" class="inline-flex items-center gap-2.5 py-4 px-8 rounded-full font-semibold text-base bg-primary text-white shadow-lg shadow-primary/30 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-primary/40 hover:bg-primary-dark">
            <i class="fas fa-refresh"></i>
            Coba Lagi
        </button>
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2.5 py-4 px-8 rounded-full font-semibold text-base bg-white text-secondary border-2 border-slate-200 transition-all duration-300 hover:border-primary hover:text-primary hover:-translate-y-1 shadow-lg shadow-slate-200/50">
            <i class="fas fa-home"></i>
            Ke Beranda
        </a>
    </div>
</div>

<!-- Floating Decoration -->
<div class="floating-decoration top-1/4 left-10 hidden lg:block animate-bounce-subtle">
    <div class="w-16 h-16 floating-decoration-rose rounded-2xl rotate-12 opacity-20"></div>
</div>
<div class="floating-decoration bottom-1/4 right-10 hidden lg:block animate-bounce-subtle" style="animation-delay: 1s;">
    <div class="w-12 h-12 floating-decoration-fuchsia rounded-xl -rotate-12 opacity-20"></div>
</div>
@endsection
