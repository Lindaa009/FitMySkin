<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fef8f5">
    <title>@yield('title', 'FitMySkin') · FitMySkin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fitmyskin.css') }}">
</head>
<body data-page="@yield('page')">
    <header class="site-header">
        <a class="brand" href="{{ route('katalog') }}" aria-label="FitMySkin, katalog produk">
            <span class="brand-mark" aria-hidden="true">f</span>
            <span>FitMy<span class="brand-accent">Skin</span></span>
        </a>

        <button class="nav-toggle" type="button" aria-label="Buka navigasi" aria-expanded="false" aria-controls="main-navigation">
            <span></span><span></span><span></span>
        </button>

        <nav class="main-navigation" id="main-navigation" aria-label="Navigasi utama">
            <a href="{{ route('katalog') }}" @if (request()->routeIs('katalog')) aria-current="page" @endif>Katalog Produk</a>
            <a href="{{ route('jurnal.pagi') }}" @if (request()->routeIs('jurnal.pagi')) aria-current="page" @endif>Jurnal Pagi</a>
            <a href="{{ route('jurnal.malam') }}" @if (request()->routeIs('jurnal.malam')) aria-current="page" @endif>Jurnal Malam</a>
            <a href="{{ route('jurnal.riwayat') }}" @if (request()->routeIs('jurnal.riwayat')) aria-current="page" @endif>Riwayat</a>
            <a href="{{ route('analisis.kecocokan') }}" @if (request()->routeIs('analisis.kecocokan')) aria-current="page" @endif>Analisis</a>
        </nav>
    </header>

    <main class="page-shell">
        @yield('content')
    </main>

    <footer class="site-footer">
        <span class="footer-brand">FitMySkin</span>
        <span>Rawat kulitmu, satu langkah setiap hari.</span>
    </footer>

    <div class="toast" id="app-toast" role="status" aria-live="polite"></div>
    <script src="{{ asset('js/fitmyskin.js') }}" defer></script>
</body>
</html>
