<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fef8f5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FitMySkin') · FitMySkin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fitmyskin.css') }}">
    @stack('head')
</head>
</head>
<body data-page="@yield('page')">
    <header class="site-header">
        <a class="brand" href="{{ route('dashboard') }}" aria-label="FitMySkin, dashboard">
            <span class="brand-mark" aria-hidden="true">f</span>
            <span>FitMy<span class="brand-accent">Skin</span></span>
        </a>

        <button class="nav-toggle" type="button" aria-label="Buka navigasi" aria-expanded="false" aria-controls="main-navigation">
            <span></span><span></span><span></span>
        </button>

        <nav class="main-navigation" id="main-navigation" aria-label="Navigasi utama">
            <a href="{{ route('dashboard') }}" @if (request()->routeIs('dashboard')) aria-current="page" @endif>Dashboard</a>
            <a href="{{ route('katalog') }}" @if (request()->routeIs('katalog')) aria-current="page" @endif>Katalog Produk</a>
            <a href="{{ route('jurnal.pagi') }}" @if (request()->routeIs('jurnal.pagi')) aria-current="page" @endif>Jurnal Pagi</a>
            <a href="{{ route('jurnal.malam') }}" @if (request()->routeIs('jurnal.malam')) aria-current="page" @endif>Jurnal Malam</a>
            <a href="{{ route('jurnal.riwayat') }}" @if (request()->routeIs('jurnal.riwayat')) aria-current="page" @endif>Riwayat</a>
            <a href="{{ route('analisis.kecocokan') }}" @if (request()->routeIs('analisis.kecocokan')) aria-current="page" @endif>Analisis</a>
        </nav>

        <!-- Badge Streak -->
        <div style="display: flex; align-items: center; gap: 6px; background: var(--rose-pale); border: 1px solid #f7d5de; padding: 6px 14px; border-radius: 999px; font-size: 11px; font-weight: 700; color: var(--rose); white-space: nowrap;">
            <span>🔥</span>
            <span>{{ $navStreak ?? 0 }} Hari Streak ✨</span>
        </div>

            <!-- Tombol Notifikasi -->
            <a href="{{ route('notifikasi') }}" style="width: 38px; height: 38px; border-radius: 50%; border: 1px solid var(--line); background: white; display: grid; place-items: center; text-decoration: none; color: var(--muted); transition: background 0.2s; flex-shrink: 0;" title="Notifikasi">
                🔔
            </a>

            <!-- Profil Pengguna -->
            <a href="{{ route('profil') }}" style="display: flex; align-items: center; gap: 8px; background: white; border: 1px solid var(--line); padding: 4px 14px 4px 4px; border-radius: 999px; text-decoration: none; color: inherit; white-space: nowrap;">
                <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--rose); color: white; display: grid; place-items: center; font-weight: 800; font-size: 13px;">
                    {{ strtoupper(substr(auth()->user()->nama_user ?? 'U', 0, 1)) }}
                </div>
                <div style="text-align: left; line-height: 1.2;">
                    <span style="display: block; font-size: 11px; font-weight: 800; color: var(--ink);">{{ auth()->user()->nama_user ?? 'User' }}</span>
                    <span style="display: block; font-size: 9px; color: var(--muted);">FitMySkin Member</span>
                </div>
            </a>

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; padding: 6px 14px; border-radius: 999px; border: 1px solid #f7d5de; background: #fff0f2; color: var(--rose); font-size: 11px; font-weight: 800; cursor: pointer; transition: background 0.2s;" title="Keluar Akun">
                    🚪 Keluar
                </button>
            </form>
        </div>
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
    @stack('scripts')
</body>
</html>
