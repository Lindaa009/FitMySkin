@extends('layouts.app2')

@section('title', 'Dashboard - FitMySkin')

@section('content')
<div class="max-w-6xl mx-auto w-full px-4 sm:px-6 py-6">

    <!-- NAVBAR -->
    <header class="bg-white rounded-2xl shadow-xs px-4 sm:px-6 py-3.5 mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            <div class="bg-rose-500 text-white p-2 rounded-xl flex items-center justify-center shadow-xs">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg>
            </div>
            <div>
                <span class="font-bold text-rose-500 text-lg leading-tight block">FitMySkin</span>
                <span class="text-[10px] uppercase tracking-wider text-neutral-400 font-semibold block">Skin Journal</span>
            </div>
        </div>

        <nav class="flex items-center gap-1 sm:gap-2 bg-rose-50/50 p-1 rounded-xl text-xs sm:text-sm font-medium">
            <a href="{{ route('dashboard') }}" class="bg-rose-500 text-white px-3.5 py-1.5 rounded-lg shadow-xs transition">Dashboard</a>
            <a href="#" class="text-neutral-600 hover:text-rose-500 px-3.5 py-1.5 rounded-lg transition">Katalog Produk</a>
            <a href="#" class="text-neutral-600 hover:text-rose-500 px-3.5 py-1.5 rounded-lg transition">Jurnal Kulit</a>
            <a href="#" class="text-neutral-600 hover:text-rose-500 px-3.5 py-1.5 rounded-lg transition">Riwayat Jurnal</a>
            <a href="#" class="text-neutral-600 hover:text-rose-500 px-3.5 py-1.5 rounded-lg transition">Analisis Kecocokan</a>
        </nav>

        <div class="flex items-center gap-3">
            <div class="flex items-center gap-1.5 bg-rose-50 border border-rose-100 px-3 py-1.5 rounded-full text-xs font-semibold text-rose-600">
                <span>🔥 5 Hari Streak</span>
            </div>
            <div class="flex items-center gap-2.5 pl-2 border-l border-neutral-200">
                <div class="w-9 h-9 rounded-full overflow-hidden bg-rose-200 border border-rose-300">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=face" alt="User" class="w-full h-full object-cover">
                </div>
                <div class="hidden sm:block text-left">
                    <p class="text-xs font-bold text-neutral-800 leading-tight">Clara</p>
                    <p class="text-[10px] text-neutral-400 font-medium">Normal / Kombinasi</p>
                </div>
            </div>
        </div>
    </header>

    <!-- BANNER UTAMA -->
    <section class="bg-gradient-to-r from-rose-50/80 via-rose-100/30 to-pink-50/60 border border-rose-100/60 rounded-3xl p-6 sm:p-8 mb-6 relative overflow-hidden shadow-xs">
        <div class="inline-flex items-center gap-1.5 bg-white/80 border border-rose-200/60 px-3.5 py-1.5 rounded-full text-xs font-semibold text-rose-600 mb-3">
            <span>🌸 Pagi Hari • Ritual Percaya Diri</span>
        </div>
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-neutral-900 tracking-tight mb-2">
                    Selamat Datang Kembali, Clara! 🌸✨
                </h1>
                <p class="text-xs sm:text-sm text-neutral-600 max-w-xl leading-relaxed">
                    Kulitmu bersinar sehat hari ini. Lanjutkan rutinitas lembutmu dan perhatikan respon kulit terhadap cuaca lembap pagi ini!
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <button class="bg-rose-500 hover:bg-rose-600 text-white text-xs sm:text-sm font-semibold px-4 py-2.5 rounded-xl shadow-sm transition">
                    ➕ Tambah Produk Baru
                </button>
                <button class="bg-white hover:bg-neutral-50 text-neutral-700 border border-neutral-200 text-xs sm:text-sm font-semibold px-4 py-2.5 rounded-xl shadow-2xs transition">
                    📝 Catat Jurnal Kulit Hari Ini
                </button>
            </div>
        </div>
    </section>

    <!-- Content Grid lainnya ditempatkan di sini -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Card Jurnal Hari Ini & Kondisi Kulit -->
        </div>
        <!-- Kolom Kanan -->
        <div class="space-y-6">
            <!-- Card Koleksi Skincare & Analisis -->
        </div>
    </div>
</div>
@endsection
