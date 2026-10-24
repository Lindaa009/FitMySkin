@extends('layouts.app')

@section('title', 'Analisis Kecocokan')
@section('page', 'analisis')

@push('head')
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Reset default style dari fitmyskin.css yang bikin tabrakan dengan Tailwind */
        .page-shell { padding: 0 !important; max-width: none !important; }
        .analisis-wrapper { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FEF8F5;
            color: #1D1B1A;
            min-height: 70vh;
            padding-bottom: 3rem;
        }
    </style>
@endpush

@section('content')
<div class="analisis-wrapper">

    <div class="max-w-[1100px] mx-auto pt-8 px-4 space-y-6">

        <!-- HEADER TITLE -->
        <div>
            <span class="text-[10px] font-extrabold tracking-widest uppercase text-[#AB2C5D]">⚡ SMART SKIN DIAGNOSTICS</span>
            <h1 class="text-2xl font-bold mt-1 text-[#1D1B1A]">Analisis Kecocokan Produk & Iritasi</h1>
            <p class="text-xs text-[#574146]">Korelasi presisi antara formula aktif, frekuensi pemakaian, dan reaksi sensitivitas kulitmu.</p>
        </div>

        @if ($pemicu['suspect'])
            <div class="bg-[#FFDAD6] p-6 rounded-[32px] flex items-start gap-4 shadow-sm border border-red-200">
                <div class="w-10 h-10 bg-[#BA1A1A] rounded-full flex items-center justify-center text-white font-bold text-lg shrink-0">⚠️</div>
                <div>
                    <span class="bg-[#BA1A1A] text-white text-[9px] font-extrabold px-2 py-0.5 rounded-full uppercase">PERHATIAN KHUSUS</span>
                    <h2 class="text-base font-bold text-[#93000A] mt-1">
                        Pemicu Iritasi Terdeteksi! Korelasi {{ $pemicu['suspect']['persen'] }}% dalam {{ $pemicu['total_iritasi'] }} hari iritasi
                        @if ($pemicu['rentang'])
                            ({{ $pemicu['rentang']['dari'] }}–{{ $pemicu['rentang']['sampai'] }})
                        @endif
                    </h2>
                    <p class="text-xs text-[#93000A] opacity-90 mt-1 leading-relaxed">
                        Sistem mendeteksi produk <b>{{ $pemicu['suspect']['nama'] }}</b> paling sering muncul dalam rentang 3 hari sebelum kondisi kulit iritasi muncul.
                        @if (count($pemicu['list']) > 1)
                            Produk lain yang juga mencurigakan: <b>{{ collect($pemicu['list'])->skip(1)->take(2)->pluck('nama')->implode(', ') }}</b>.
                        @endif
                    </p>
                </div>
            </div>
        @else
            <div class="bg-[#E8F5E9] p-6 rounded-[32px] flex items-start gap-4 shadow-sm border border-green-200">
                <div class="w-10 h-10 bg-[#2E7D32] rounded-full flex items-center justify-center text-white font-bold text-lg shrink-0">✓</div>
                <div>
                    <span class="bg-[#2E7D32] text-white text-[9px] font-extrabold px-2 py-0.5 rounded-full uppercase">AMAN</span>
                    <h2 class="text-base font-bold text-[#1B5E20] mt-1">Belum Ada Pemicu Iritasi Terdeteksi</h2>
                    <p class="text-xs text-[#1B5E20] opacity-90 mt-1 leading-relaxed">
                        Terus catat jurnal harianmu. Sistem akan otomatis menganalisis pola kulitmu setelah data terkumpul.
                    </p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-7 space-y-6">

                @if ($pemicu['suspect'])
                    <div class="bg-white p-6 rounded-[32px] shadow-sm space-y-4">
                        <div class="flex justify-between items-center text-[10px] font-extrabold">
                            <span class="bg-[#FFDAD6] text-[#93000A] px-3 py-1 rounded-full">🚨 Tersangka Utama Pemicu</span>
                            <span class="text-[#BA1A1A]">📌 Tingkat Reaksi: {{ $pemicu['suspect']['persen'] >= 80 ? 'Tinggi' : 'Sedang' }}</span>
                        </div>

                        <div>
                            <span class="text-[10px] font-bold text-[#884C60] uppercase tracking-wider">PRODUK TERDETEKSI</span>
                            <h3 class="text-lg font-bold text-[#1D1B1A] mt-0.5">{{ $pemicu['suspect']['nama'] }}</h3>
                        </div>

                        <p class="text-xs text-[#574146] leading-relaxed">
                            Produk ini terdeteksi muncul <b>{{ $pemicu['suspect']['count'] }} kali</b> dalam rentang 3 hari sebelum kondisi kulit iritasi terjadi.
                            Total ada <b>{{ $pemicu['total_iritasi'] }} hari</b> iritasi tercatat di jurnalmu.
                        </p>

                        <div class="inline-block bg-[#F2EDEA] text-[#574146] text-[10px] font-bold px-3 py-1 rounded-full">
                            Korelasi: {{ $pemicu['suspect']['persen'] }}% dari total iritasi
                        </div>
                    </div>
                @endif

                <div class="bg-white p-6 rounded-[32px] shadow-sm space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-pink-100 rounded-full flex items-center justify-center text-xs">💡</div>
                        <span class="text-[10px] font-extrabold uppercase text-[#AB2C5D]">ANALISIS KECERDASAN JURNAL</span>
                    </div>

                    <h3 class="text-base font-bold text-[#1D1B1A]">Rekomendasi Berdasarkan Data Jurnalmu</h3>

                    <p class="text-xs text-[#574146] leading-relaxed">
                        @if ($pemicu['suspect'])
                            Berdasarkan pola pemakaian produkmu, disarankan untuk mengurangi frekuensi pemakaian produk yang berpotensi memicu iritasi. Berikan jeda minimal 3-4 hari antar pemakaian eksfoliator.
                        @else
                            Sejauh ini kondisi kulitmu stabil. Terus jaga rutinitas yang konsisten dan catat setiap perubahan agar sistem bisa mendeteksi pola lebih akurat.
                        @endif
                    </p>

                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <div class="bg-[#F8F2EF] p-4 rounded-2xl">
                            <span class="text-[11px] font-bold text-[#884C60] block mb-1">🎯 Rekomendasi Siklus</span>
                            <p class="text-[11px] text-[#1D1B1A] leading-normal">Beri jeda pemakaian AHA/BHA minimal 3-4 hari sekali (Skin Cycling).</p>
                        </div>
                        <div class="bg-[#F8F2EF] p-4 rounded-2xl">
                            <span class="text-[11px] font-bold text-[#286957] block mb-1">🌱 Langkah Pemulihan</span>
                            <p class="text-[11px] text-[#1D1B1A] leading-normal">Fokuskan rutinitas pada Ceramide, Panthenol, dan Hyaluronic Acid hingga kemerahan mereda.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-5 space-y-6">

                <div class="bg-white p-6 rounded-[32px] shadow-sm space-y-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-sm font-bold">Frekuensi Pemakaian Saat Iritasi</h3>
                        <span class="bg-pink-100 text-[#AB2C5D] text-[9px] font-bold px-2 py-0.5 rounded-full">Rentang 3 Hari</span>
                    </div>

                    @if (count($pemicu['list']) > 0)
                        <div class="space-y-2 text-xs">
                            @foreach ($pemicu['list'] as $item)
                                <div class="flex justify-between items-center bg-gray-50 p-2.5 rounded-xl">
                                    <div>
                                        <p class="font-bold text-[11px]">{{ $item['nama'] }}</p>
                                        <p class="text-[9px] text-gray-400">Dipakai {{ $item['count'] }}x dari {{ $pemicu['total_iritasi'] }} hari iritasi</p>
                                    </div>
                                    <span class="text-xs font-bold {{ $item['persen'] >= 80 ? 'text-red-600' : ($item['persen'] >= 50 ? 'text-orange-500' : 'text-yellow-600') }}">
                                        {{ $item['persen'] }}% Pemicu
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-gray-400 text-center py-4">Belum ada data iritasi untuk dianalisis.</p>
                    @endif

                    @if ($pemicu['suspect'])
                        <div class="bg-pink-50 p-3 rounded-2xl text-[10px] text-[#AB2C5D]">
                            <b>Kesimpulan:</b> Produk <b>{{ $pemicu['suspect']['nama'] }}</b> paling sering muncul sebelum iritasi.
                        </div>
                    @endif
                </div>

                <div class="bg-white p-6 rounded-[32px] shadow-sm space-y-3">
                    <div class="flex justify-between items-center">
                        <h3 class="text-sm font-bold">Frekuensi Kondisi Kulit</h3>
                        <span class="text-[10px] text-gray-400">{{ $kondisiFreq['total'] }} catatan</span>
                    </div>

                    @if (count($kondisiFreq['kondisi']) > 0)
                        <div class="space-y-2 text-xs">
                            @foreach ($kondisiFreq['kondisi'] as $k)
                                @php
                                    $warna = 'bg-gray-400';
                                    $textColor = 'text-gray-700';
                                    if (in_array(strtolower($k['nama']), ['nyaman', 'baik'])) { $warna = 'bg-emerald-600'; $textColor = 'text-emerald-700'; }
                                    elseif (in_array(strtolower($k['nama']), ['kering'])) { $warna = 'bg-amber-500'; $textColor = 'text-amber-700'; }
                                    elseif (in_array(strtolower($k['nama']), ['berminyak'])) { $warna = 'bg-yellow-500'; $textColor = 'text-yellow-700'; }
                                    elseif (in_array(strtolower($k['nama']), ['kemerahan', 'perih', 'iritasi'])) { $warna = 'bg-rose-600'; $textColor = 'text-rose-700'; }
                                @endphp
                                <div>
                                    <div class="flex justify-between text-[11px] font-bold mb-1">
                                        <span class="{{ $textColor }}">{{ $k['nama'] }}</span>
                                        <span>{{ $k['persen'] }}% ({{ $k['jml'] }} catatan)</span>
                                    </div>
                                    <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                        <div class="{{ $warna }} h-full" style="width: {{ $k['persen'] }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-gray-400 text-center py-4">Belum ada catatan jurnal.</p>
                    @endif
                </div>

                <div class="bg-white p-6 rounded-[32px] shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-[9px] font-extrabold uppercase text-[#AB2C5D]">KEPATUHAN RUTINITAS</span>
                        <h4 class="text-lg font-extrabold text-[#1D1B1A]">{{ $streak }} Hari Streak</h4>
                        <p class="text-[10px] text-gray-400 max-w-[150px]">Terus konsisten catat jurnal setiap hari.</p>
                        <span class="inline-block bg-pink-100 text-[#AB2C5D] text-[9px] font-extrabold px-2 py-0.5 rounded-full mt-2">
                            {{ $streak >= 7 ? 'Grade A+ Disiplin' : ($streak >= 3 ? 'Grade B Konsisten' : 'Grade C Mulai') }}
                        </span>
                    </div>

                    <div class="relative w-20 h-20 flex items-center justify-center">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-pink-100" stroke-width="4" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="text-[#AB2C5D]" stroke-dasharray="{{ min($streak * 10, 100) }}, 100" stroke-width="4" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        </svg>
                        <div class="absolute text-center">
                            <span class="text-sm font-extrabold text-[#AB2C5D]">{{ $streak }}</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection