<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Error') - Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Plus Jakarta Sans', 'sans-serif'],
                        'heading': ['Sora', 'Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#6366f1',
                        'primary-dark': '#4f46e5',
                        'secondary': '#0f172a',
                        'accent': '#f59e0b',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
</head>
<body class="font-sans text-slate-600 leading-relaxed antialiased min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50 pattern-bg overflow-x-hidden">
    <!-- Decorative Elements -->
    <div class="error-decoration error-decoration-1"></div>
    <div class="error-decoration error-decoration-2"></div>
    <div class="error-decoration error-decoration-3 hidden lg:block"></div>

    <div class="min-h-screen flex flex-col">
        <!-- Simple Header -->
        <header class="py-6 px-6 relative z-10">
            <nav class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="{{ url('/') }}" class="font-heading text-2xl sm:text-3xl font-bold text-primary hover:text-primary-dark transition-colors">
                    Portfolio
                </a>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="flex-grow flex items-center justify-center px-4 sm:px-6 py-12 relative z-10">
            <div class="max-w-2xl mx-auto text-center">
                @yield('content')
            </div>
        </main>

        <!-- Simple Footer -->
        <footer class="py-6 px-6 relative z-10">
            <div class="max-w-7xl mx-auto text-center">
                <p class="text-slate-400 text-sm">
                    &copy; {{ date('Y') }} Portfolio. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
