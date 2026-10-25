<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fef8f5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FitMySkin') - FitMySkin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fitmyskin.css') }}">
    @stack('head')
</head>
</head>
<body data-page="@yield('page')">
    @php $currentUser = auth()->user(); @endphp
    <header class="site-header">
        <a class="brand" href="{{ route('login') }}" aria-label="FitMySkin, dashboard">
            <span class="brand-mark" aria-hidden="true">f</span>
            <span>FitMy<span class="brand-accent">Skin</span></span>
        </a>

        <button class="nav-toggle" type="button" aria-label="Buka navigasi" aria-expanded="false" aria-controls="main-navigation">
            <span class="nav-toggle-icon">☰</span>
            <span>Menu</span>
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

        @if ($currentUser)
            <!-- Profil Pengguna -->
            <a href="{{ route('profil') }}" style="display: flex; align-items: center; gap: 8px; background: white; border: 1px solid var(--line); padding: 4px 14px 4px 4px; border-radius: 999px; text-decoration: none; color: inherit; white-space: nowrap;">
                @if ($currentUser->foto_profil)
                    <img src="{{ asset('storage/' . $currentUser->foto_profil) }}" alt="{{ $currentUser->nama_user }}" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                @else
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--rose); color: white; display: grid; place-items: center; font-weight: 800; font-size: 13px;">
                        {{ strtoupper(substr($currentUser->nama_user ?? 'U', 0, 1)) }}
                    </div>
                @endif
                <div style="text-align: left; line-height: 1.2;">
                    <span style="display: block; font-size: 11px; font-weight: 800; color: var(--ink);">{{ $currentUser->nama_user ?? 'User' }}</span>
                    <span style="display: block; font-size: 9px; color: var(--muted);">FitMySkin Member</span>
                </div>
            </a>

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; padding: 6px 14px; border-radius: 999px; border: 1px solid #f7d5de; background: #fff0f2; color: var(--rose); font-size: 11px; font-weight: 800; cursor: pointer; transition: background 0.2s;" title="Keluar Akun">
                    🚪 Keluar
                </button>
            </form>
        @else
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="{{ route('login') }}" style="padding: 8px 14px; border-radius: 999px; border: 1px solid var(--line); background: white; color: var(--ink); font-size: 11px; font-weight: 800; text-decoration: none;">Masuk</a>
            </div>
        @endif
    </header>

    <main class="page-shell">
        @yield('content')
    </main>

    <footer class="site-footer">
        <span class="footer-brand">FitMySkin</span>
        <span>Rawat kulitmu, satu langkah setiap hari.</span>
    </footer>

    <div class="toast" id="app-toast" role="status" aria-live="polite"></div>
    <!-- Modal Konfirmasi Global -->
    <div id="confirm-modal" style="display: none; position: fixed; inset: 0; z-index: 999; background: rgba(51, 38, 43, 0.5); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 20px;">
        <div style="background: white; border-radius: 28px; padding: 32px 28px; text-align: center; max-width: 400px; width: 100%; box-shadow: 0 25px 60px rgba(103, 53, 69, 0.25); border: 1px solid var(--line); animation: confirmPop 0.2s ease;">
            <div id="confirm-icon" style="width: 68px; height: 68px; background: linear-gradient(135deg, var(--rose-pale), #f7dfd5); border-radius: 50%; display: grid; place-items: center; margin: 0 auto 18px; font-size: 28px;">
                ⚠️
            </div>
            <h3 id="confirm-title" style="margin: 0 0 8px; font-size: 18px; font-weight: 800; color: var(--ink);">Konfirmasi</h3>
            <p id="confirm-message" style="margin: 0 0 22px; color: var(--muted); font-size: 12px; line-height: 1.6;">Apakah kamu yakin?</p>
            <div style="display: flex; gap: 10px;">
                <button type="button" id="confirm-cancel" class="button button-secondary" style="flex: 1; border-radius: 99px; justify-content: center; padding: 12px 0; font-size: 12px; border: 1px solid var(--line);">Batal</button>
                <button type="button" id="confirm-ok" class="button button-primary" style="flex: 1; border-radius: 99px; justify-content: center; padding: 12px 0; font-size: 12px; background: var(--rose); color: white;">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>

    <style>
    @keyframes confirmPop {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    </style>
    <script src="{{ asset('js/fitmyskin.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const header = document.querySelector('.site-header');
            if (!header) return;

            window.addEventListener('scroll', () => {
                if (window.scrollY > 10) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }, { passive: true });
        });
    </script>
    @stack('scripts')
</body>
</html>
