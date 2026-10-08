<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisis Kecocokan - FitMySkin</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Font: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#FEF8F5] text-[#1D1B1A] min-h-screen pb-12">

    <!-- 1. NAVBAR -->
    <header class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-pink-100 px-8 py-3">
        <div class="max-w-[1200px] mx-auto flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-[#AB2C5D] rounded-full flex items-center justify-center text-white font-bold text-xs">FMS</div>
                <span class="font-extrabold text-lg text-[#AB2C5D]">FitMySkin</span>
            </div>
            
            <nav class="flex gap-6 text-sm font-semibold text-gray-600">
                <a href="#" class="hover:text-[#AB2C5D]">Dashboard</a>
                <a href="#" class="hover:text-[#AB2C5D]">Katalog Produk</a>
                <a href="#" class="hover:text-[#AB2C5D]">Jurnal Kulit</a>
                <a href="#" class="hover:text-[#AB2C5D]">Riwayat Jurnal</a>
                <a href="#" class="text-white bg-[#AB2C5D] px-3 py-1 rounded-full flex items-center font-bold">Analisis Kecocokan</a>
            </nav>
            
            <div class="flex items-center gap-3">
                <span class="bg-pink-100 text-[#AB2C5D] text-xs px-3 py-1 rounded-full font-bold">🔥 5 Hari Streak</span>
                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-xs font-bold">C</div>
                <div class="text-xs">
                    <p class="font-bold">Clara</p>
                    <p class="text-gray-400 text-[10px]">Normal / Kombinasi</p>
                </div>
            </div>
        </div>
    </header>

    <!-- CONTAINER UTAMA -->
    <main class="max-w-[1100px] mx-auto pt-8 px-4 space-y-6">

        <!-- HEADER TITLE -->
        <div>
            <span class="text-[10px] font-extrabold tracking-widest uppercase text-[#AB2C5D]">⚡ SMART SKIN DIAGNOSTICS</span>
            <h1 class="text-2xl font-bold mt-1 text-[#1D1B1A]">Analisis Kecocokan Produk & Iritasi</h1>
            <p class="text-xs text-[#574146]">Korelasi presisi antara formula aktif, frekuensi pemakaian, dan reaksi sensitivitas kulitmu.</p>
        </div>

        <!-- DYNAMIC ALERT BANNER (PERHATIAN KHUSUS) -->
        <div class="bg-[#FFDAD6] p-6 rounded-[32px] flex items-start gap-4 shadow-sm border border-red-200">
            <div class="w-10 h-10 bg-[#BA1A1A] rounded-full flex items-center justify-center text-white font-bold text-lg shrink-0">⚠️</div>
            <div>
                <span class="bg-[#BA1A1A] text-white text-[9px] font-extrabold px-2 py-0.5 rounded-full uppercase">PERHATIAN KHUSUS</span>
                <h2 class="text-base font-bold text-[#93000A] mt-1">Pemicu Iritasi Terdeteksi! Korelasi 85% dalam 3 Hari Terakhir (22–24 Okt)</h2>
                <p class="text-xs text-[#93000A] opacity-90 mt-1 leading-relaxed">
                    Sistem mendeteksi munculnya kemerahan dan perih berulang setelah pemakaian Glycolic Acid Exfoliating Brightening (22 Okt) yang dilanjutkan dengan Niacinamide Serum Facial Wash serta Toner Brightly Essence tanpa penambahan lapisan pelembab yang memadai.
                </p>
            </div>
        </div>

        <!-- GRID UTAMA (2 KOLOM: KIRI DAN KANAN) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- ================= KOLOM KIRI (7/12) ================= -->
            <div class="lg:col-span-7 space-y-6">

                <!-- CARD 1: SUSPECT PRODUCT HIGHLIGHT -->
                <div class="bg-white p-6 rounded-[32px] shadow-sm space-y-4">
                    <div class="flex justify-between items-center text-[10px] font-extrabold">
                        <span class="bg-[#FFDAD6] text-[#93000A] px-3 py-1 rounded-full">🚨 Tersangka Utama Pemicu</span>
                        <span class="text-[#BA1A1A]">📌 Tingkat Reaksi: Tinggi</span>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold text-[#884C60] uppercase tracking-wider">GLYCOLIC ACID EXFOLIATING BRIGHTENING • BHA 1%</span>
                        <h3 class="text-lg font-bold text-[#1D1B1A] mt-0.5">SKINTIFIC Glycolic Acid Exfoliating Brightening</h3>
                    </div>

                    <p class="text-xs text-[#574146] leading-relaxed">
                        Bahan aktif: Kombinasi 10% AHA (Glycolic Acid), 1% BHA (Salicylic Acid), 0.5% PHA (Lactobionic Acid), dan 0.5% LHA (Capryloyl Salicylic Acid) 100% kandungan memicu reaksi langsung pada 22 Okt 2026.
                    </p>

                    <div class="inline-block bg-[#F2EDEA] text-[#574146] text-[10px] font-bold px-3 py-1 rounded-full">
                        Frekuensi: 1x pemakaian, langsung memicu iritasi
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button class="flex-1 bg-[#F06292] text-[#5E002B] py-2.5 rounded-full font-bold text-xs hover:opacity-90">Istirahatkan Produk (7 Hari)</button>
                        <button class="flex-1 bg-[#FFD9E2] text-[#38091D] py-2.5 rounded-full font-bold text-xs hover:opacity-90">Tandai Stop di Katalog</button>
                    </div>
                </div>

                <!-- CARD 2: POLA SKIN BARRIER & REKOMENDASI -->
                <div class="bg-white p-6 rounded-[32px] shadow-sm space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-pink-100 rounded-full flex items-center justify-center text-xs">💡</div>
                        <span class="text-[10px] font-extrabold uppercase text-[#AB2C5D]">ANALISIS KECERDASAN JURNAL • Kepercayaan 98%</span>
                    </div>

                    <h3 class="text-base font-bold text-[#1D1B1A]">Pola Sangat Jelas Terdeteksi pada Skin Barrier</h3>

                    <p class="text-xs text-[#574146] leading-relaxed">
                        Iritasi, sensasi perih, dan bruntusan mikro muncul tepat setelah 1 hari pemakaian Glycolic Acid (22 Okt) dan berlanjut menjadi kering serta perih saat memakai Toner Brightly Essence (25 Okt). Saat Anda menggabungkannya dengan Niacinamide Serum Facial Wash dan Scarlett Brightly Ever After Serum di malam berikutnya, pH asam eksfoliator bereaksi berlebihan pada lapisan epidermis yang sedang dehidrasi.
                    </p>

                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <div class="bg-[#F8F2EF] p-4 rounded-2xl">
                            <span class="text-[11px] font-bold text-[#884C60] block mb-1">🎯 Rekomendasi Siklus</span>
                            <p class="text-[11px] text-[#1D1B1A] leading-normal">Beri jeda pemakaian AHA/BHA minimal 3-4 hari sekali (Skin Cycling: Eksfoliasi - Recovery - Recovery - Recovery).</p>
                        </div>
                        <div class="bg-[#F8F2EF] p-4 rounded-2xl">
                            <span class="text-[11px] font-bold text-[#286957] block mb-1">🌱 Langkah Pemulihan</span>
                            <p class="text-[11px] text-[#1D1B1A] leading-normal">Fokuskan rutinitas pada Ceramide, Panthenol, dan Hyaluronic Acid murni hingga kemerahan mereda sempurna.</p>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: MATRIKS KORELASI 7 HARI -->
                <div class="bg-white p-6 rounded-[32px] shadow-sm space-y-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-sm font-bold">📊 Matriks Korelasi 7 Hari</h3>
                        <div class="flex gap-2 text-[10px] font-bold">
                            <span class="text-green-600">🟢 Nyaman</span>
                            <span class="text-yellow-600">🟡 Kering</span>
                            <span class="text-red-600">🔴 Iritasi</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-pink-50/50 text-gray-500 text-[10px]">
                                <tr>
                                    <th class="p-2">Produk / Hari</th>
                                    <th class="p-2">Sen</th><th class="p-2">Sel</th><th class="p-2">Rab</th><th class="p-2">Kam</th><th class="p-2">Jum</th><th class="p-2">Sab</th><th class="p-2">Min</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-[11px]">
                                <tr><td class="py-2 font-medium">Niacinamide Wash</td><td>✓</td><td>✓</td><td>✓</td><td>✓</td><td>✓</td><td>✓</td><td>✓</td></tr>
                                <tr><td class="py-2 font-medium">Glycolic Acid</td><td>-</td><td>✓</td><td>✓</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                                <tr><td class="py-2 font-medium">Toner Brightly Essence</td><td>✓</td><td>-</td><td>✓</td><td>✓</td><td>✓</td><td>✓</td><td>✓</td></tr>
                                <tr><td class="py-2 font-medium">Brightly Ever After Serum</td><td>-</td><td>✓</td><td>✓</td><td>✓</td><td>✓</td><td>✓</td><td>✓</td></tr>
                                <tr class="font-bold bg-pink-50/30">
                                    <td class="py-2">Reaksi Kulit</td>
                                    <td>🟢</td><td>🔴</td><td>🔴</td><td>🟡</td><td>🟢</td><td>🟢</td><td>🟢</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- ================= KOLOM KANAN (5/12) ================= -->
            <div class="lg:col-span-5 space-y-6">

                <!-- CARD FREKUENSI PEMAKAIAN SAAT IRITASI -->
                <div class="bg-white p-6 rounded-[32px] shadow-sm space-y-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-sm font-bold">Frekuensi Pemakaian Saat Iritasi</h3>
                        <span class="bg-pink-100 text-[#AB2C5D] text-[9px] font-bold px-2 py-0.5 rounded-full">Rentang 3 Hari</span>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between items-center bg-gray-50 p-2.5 rounded-xl">
                            <div>
                                <p class="font-bold text-[11px]">Glycolic Acid Exfoliating</p>
                                <p class="text-[9px] text-gray-400">Dipakai 2x dari 3 hari iritasi</p>
                            </div>
                            <span class="text-xs font-bold text-red-600">100% Pemicu</span>
                        </div>

                        <div class="flex justify-between items-center bg-gray-50 p-2.5 rounded-xl">
                            <div>
                                <p class="font-bold text-[11px]">Niacinamide Serum Wash</p>
                                <p class="text-[9px] text-gray-400">Dipakai 2x dari 3 hari iritasi</p>
                            </div>
                            <span class="text-xs font-bold text-orange-500">85% Pemicu</span>
                        </div>

                        <div class="flex justify-between items-center bg-gray-50 p-2.5 rounded-xl">
                            <div>
                                <p class="font-bold text-[11px]">Toner Brightly Essence</p>
                                <p class="text-[9px] text-gray-400">Dipakai 2x dari 3 hari iritasi</p>
                            </div>
                            <span class="text-xs font-bold text-yellow-600">60% Potensi</span>
                        </div>
                    </div>

                    <div class="bg-pink-50 p-3 rounded-2xl text-[10px] text-[#AB2C5D]">
                        <b>Kesimpulan Korelasi:</b> Eksfoliasi Kimiawi (AHA/BHA) + Niacinamide Berturut-turut memicu reaksi negatif.
                    </div>
                </div>

                <!-- CARD FREKUENSI KONDISI KULIT -->
                <div class="bg-white p-6 rounded-[32px] shadow-sm space-y-3">
                    <div class="flex justify-between items-center">
                        <h3 class="text-sm font-bold">Frekuensi Kondisi Kulit</h3>
                        <span class="text-[10px] text-gray-400">7 Hari Terakhir</span>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div>
                            <div class="flex justify-between text-[11px] font-bold mb-1">
                                <span class="text-emerald-700">🟢 Glowing & Sehat</span>
                                <span>60% (4 Hari)</span>
                            </div>
                            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-emerald-600 h-full w-[60%]"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-[11px] font-bold mb-1">
                                <span class="text-amber-700">🟡 Kering / Dehidrasi</span>
                                <span>20% (2 Hari)</span>
                            </div>
                            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-amber-500 h-full w-[20%]"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-[11px] font-bold mb-1">
                                <span class="text-rose-700">🔴 Iritasi / Bruntusan</span>
                                <span>20% (2 Hari)</span>
                            </div>
                            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-rose-600 h-full w-[20%]"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD KEPATUHAN RUTINITAS (DONUT CHART) -->
                <div class="bg-white p-6 rounded-[32px] shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-[9px] font-extrabold uppercase text-[#AB2C5D]">KEPATUHAN RUTINITAS</span>
                        <h4 class="text-lg font-extrabold text-[#1D1B1A]">92% Konsisten</h4>
                        <p class="text-[10px] text-gray-400 max-w-[150px]">10 hari selesai pagi & malam tanpa absen.</p>
                        <span class="inline-block bg-pink-100 text-[#AB2C5D] text-[9px] font-extrabold px-2 py-0.5 rounded-full mt-2">Grade A+ Disiplin</span>
                    </div>

                    <!-- RING CHART LINGKARAN -->
                    <div class="relative w-20 h-20 flex items-center justify-center">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-pink-100" stroke-width="4" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="text-[#AB2C5D]" stroke-dasharray="92, 100" stroke-width="4" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        </svg>
                        <div class="absolute text-center">
                            <span class="text-sm font-extrabold text-[#AB2C5D]">92%</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="mt-16 text-center text-xs text-gray-400 border-t pt-6">
        <p><b class="text-[#AB2C5D]">FitMySkin</b> © 2026 FitMySkin Skincare Tracker. Ritual cantik setiap hari.</p>
    </footer>

</body>
</html>