<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FitMySkin - Skincare Journal')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAF5F2;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col justify-between text-neutral-800">

    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Global -->
    <footer class="bg-white border-t border-neutral-200/60 mt-12 py-5 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-neutral-500">
            <div class="flex items-center gap-2">
                <span class="font-bold text-rose-500">FitMySkin</span>
                <span>© {{ date('Y') }} FitMySkin Skincare Tracker. Ritual cantik setiap hari.</span>
            </div>
            <div class="flex items-center gap-6 font-medium">
                <a href="#" class="hover:text-rose-500 transition">Privasi & Data</a>
                <a href="#" class="hover:text-rose-500 transition">Panduan Bahan Kulit</a>
                <a href="#" class="hover:text-rose-500 transition">Bantuan Rutin</a>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
