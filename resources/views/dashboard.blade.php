@extends('layouts.app')

@section('title', 'Dashboard Utama')
@section('page', 'dashboard')

@section('content')
<div style="max-width: 1120px; margin: 0 auto; display: grid; gap: 24px;">

    <!-- 1. KARTU SAPAAN UTAMA (BANNER) -->
    <div class="journal-card" style="padding: 32px; border-radius: 28px; background: linear-gradient(135deg, #fff0f3 0%, #fff7f5 100%); border-color: #f6e4e6; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap;">
        <div>
            <p class="eyebrow"><span class="eyebrow-dot"></span> PAGI HARI • RITUAL PERCAYA DIRI</p>
            <h1 style="margin: 8px 0 10px; font-size: clamp(24px, 3.5vw, 32px); font-weight: 800; letter-spacing: -1px; color: var(--ink);">
                Selamat Datang Kembali, <br>{{ auth()->user()->nama_user ?? 'User' }}! 🌸✨
            </h1>
            <p class="intro-copy" style="max-width: 520px; font-size: 12px; color: var(--muted);">
                Kulitmu bersinar sehat hari ini. Lanjutkan rutinitas lembutmu dan perhatikan respon kulit terhadap cuaca lembap pagi ini!
            </p>
        </div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <!-- Tambah Produk -> Katalog -->
            <a href="{{ route('katalog') }}" class="button button-primary" style="background: var(--rose); border-radius: 99px; padding: 0 20px; font-size: 11px;">
                + Tambah Produk Baru
            </a>
            <!-- Catat Jurnal Kulit Hari Ini -> Jurnal Kulit Pagi -->
            <a href="{{ route('jurnal.pagi') }}" class="button button-secondary" style="border-radius: 99px; padding: 0 20px; font-size: 11px; background: white; border-color: #f7d5de; color: var(--rose);">
                📝 Catat Jurnal Kulit Hari Ini
            </a>
        </div>
    </div>

    <!-- 2. KARTU STATISTIK ATAS (Konsistensi, Kepatuhan, Pekan Ini) -->
    <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px;">
        
        <!-- Konsistensi -->
        <div class="journal-card" style="padding: 20px 24px; border-radius: 22px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 48px; height: 48px; border-radius: 16px; background: var(--rose-pale); display: grid; place-items: center; color: var(--rose); font-size: 20px;">
                🔥
            </div>
            <div>
                <span style="font-size: 8px; font-weight: 800; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px;">KONSISTENSI</span>
                <div style="display: flex; align-items: baseline; gap: 6px; margin: 2px 0;">
                    <strong style="font-size: 24px; font-weight: 800; color: var(--rose);">{{ $streak }} Hari</strong>
                    <span style="font-size: 9px; font-weight: 700; color: var(--green); background: #eef7f2; padding: 2px 6px; border-radius: 99px;">+1 hari ini</span>
                </div>
                <p style="margin: 0; font-size: 10px; color: var(--muted);">Streak berturut-turut 🔥</p>
            </div>
        </div>

        <!-- Kepatuhan Rutin -->
        <div class="journal-card" style="padding: 20px 24px; border-radius: 22px; display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div style="width: 48px; height: 48px; border-radius: 16px; background: #eef7f2; display: grid; place-items: center; color: var(--green); font-size: 20px;">
                    🛡️
                </div>
                <div>
                    <span style="font-size: 8px; font-weight: 800; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px;">KEPATUHAN RUTIN</span>
                    <strong style="display: block; font-size: 24px; font-weight: 800; color: var(--green); margin: 2px 0;">92%</strong>
                    <p style="margin: 0; font-size: 10px; color: var(--muted);">Sangat Disiplin 💧</p>
                </div>
            </div>
            <div style="width: 36px; height: 36px; border: 3px solid var(--green); border-radius: 50%; border-top-color: transparent;"></div>
        </div>

        <!-- Pekan Ini -->
        <div class="journal-card" style="padding: 20px 20px; border-radius: 22px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <span style="font-size: 8px; font-weight: 800; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px;">PEKAN INI • OKTOBER 2026</span>
                <span style="font-size: 9px; font-weight: 700; color: var(--rose);">5 dari 7 Hari Lengkap</span>
            </div>
            <div style="display: flex; justify-content: space-between; text-align: center;">
                <div>
                    <span style="display: block; font-size: 8px; color: var(--muted); margin-bottom: 4px;">Sen</span>
                    <span style="width: 24px; height: 24px; border-radius: 50%; background: var(--rose-pale); color: var(--rose); font-size: 10px; display: inline-grid; place-items: center;">♥</span>
                </div>
                <div>
                    <span style="display: block; font-size: 8px; color: var(--muted); margin-bottom: 4px;">Sel</span>
                    <span style="width: 24px; height: 24px; border-radius: 50%; background: var(--rose-pale); color: var(--rose); font-size: 10px; display: inline-grid; place-items: center;">♥</span>
                </div>
                <div>
                    <span style="display: block; font-size: 8px; color: var(--muted); margin-bottom: 4px;">Rab</span>
                    <span style="width: 24px; height: 24px; border-radius: 50%; background: var(--rose-pale); color: var(--rose); font-size: 10px; display: inline-grid; place-items: center;">♥</span>
                </div>
                <div>
                    <span style="display: block; font-size: 8px; color: var(--muted); margin-bottom: 4px;">Kam</span>
                    <span style="width: 24px; height: 24px; border-radius: 50%; background: var(--rose-pale); color: var(--rose); font-size: 10px; display: inline-grid; place-items: center;">♥</span>
                </div>
                <div>
                    <span style="display: block; font-size: 8px; color: var(--muted); margin-bottom: 4px;">Jum</span>
                    <span style="width: 24px; height: 24px; border-radius: 50%; background: var(--rose); color: white; font-size: 10px; display: inline-grid; place-items: center;">⏰</span>
                </div>
                <div>
                    <span style="display: block; font-size: 8px; color: var(--muted); margin-bottom: 4px;">Sab</span>
                    <span style="width: 24px; height: 24px; border-radius: 50%; border: 1px solid var(--line); display: inline-grid; place-items: center;"></span>
                </div>
                <div>
                    <span style="display: block; font-size: 8px; color: var(--muted); margin-bottom: 4px;">Min</span>
                    <span style="width: 24px; height: 24px; border-radius: 50%; border: 1px solid var(--line); display: inline-grid; place-items: center;"></span>
                </div>
            </div>
        </div>

    </div>

    <!-- 3. GRID KONTEN UTAMA (KIRI & KANAN) -->
    <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 24px; align-items: start;">

        <!-- KOLOM KIRI -->
        <div style="display: grid; gap: 24px;">

            <!-- Jurnal Hari Ini -->
            <div class="journal-card" style="padding: 24px; border-radius: 22px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 14px;">
                    <div>
                        <h3 style="margin: 0; font-size: 15px; font-weight: 800; color: var(--ink); display: flex; align-items: center; gap: 8px;">
                            📖 Jurnal Hari Ini
                        </h3>
                        <p style="margin: 2px 0 0; font-size: 10px; color: var(--muted);">{{ $tanggalHariIni }}</p>
                    </div>
                    <span style="background: var(--rose-pale); color: var(--rose); padding: 4px 12px; border-radius: 99px; font-size: 9px; font-weight: 800;">
                        Pagi Selesai, Malam Belum Diisi 🍷
                    </span>
                </div>

                <div style="margin-bottom: 16px;">
                    <div style="display: flex; justify-content: space-between; font-size: 9px; font-weight: 700; color: var(--muted); margin-bottom: 6px;">
                        <span>Progres Ritual Kulit</span>
                        <span style="color: var(--rose);">50% Selesai</span>
                    </div>
                    <div style="width: 100%; height: 8px; background: #f7efec; border-radius: 99px; overflow: hidden;">
                        <div style="width: 50%; height: 100%; background: var(--rose); border-radius: 99px;"></div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div style="background: {{ $jurnalPagiHariIni ? '#fdf2f4' : '#faf5f3' }}; border: 1px solid {{ $jurnalPagiHariIni ? '#f7d5de' : 'var(--line)' }}; padding: 16px; border-radius: 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="font-size: 12px;">☀️</span>
                            @if ($jurnalPagiHariIni)
                                <span style="color: var(--green); font-size: 12px;">✓</span>
                            @endif
                        </div>
                        <h4 style="margin: 0 0 2px; font-size: 12px; font-weight: 800; color: var(--ink);">Rutinitas Pagi</h4>
                        <p style="margin: 0; font-size: 9px; color: {{ $jurnalPagiHariIni ? 'var(--green)' : 'var(--muted)' }}; font-weight: 700;">
                            {{ $jurnalPagiHariIni ? '✓ Sudah dicatat' : 'Belum diisi' }}
                        </p>
                    </div>

                    <div style="background: {{ $jurnalMalamHariIni ? '#fdf2f4' : '#faf5f3' }}; border: 1px solid {{ $jurnalMalamHariIni ? '#f7d5de' : 'var(--line)' }}; padding: 16px; border-radius: 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="font-size: 12px;">🌙</span>
                            @if (!$jurnalMalamHariIni)
                                <a href="{{ route('jurnal.malam') }}" class="button button-primary" style="font-size: 8px; padding: 3px 10px; height: auto; background: var(--rose); border-radius: 99px;">Isi Sekarang</a>
                            @else
                                <span style="color: var(--green); font-size: 12px;">✓</span>
                            @endif
                        </div>
                        <h4 style="margin: 0 0 2px; font-size: 12px; font-weight: 800; color: var(--ink);">Rutinitas Malam</h4>
                        <p style="margin: 0; font-size: 9px; color: {{ $jurnalMalamHariIni ? 'var(--green)' : 'var(--muted)' }}; font-weight: 700;">
                            {{ $jurnalMalamHariIni ? '✓ Sudah dicatat' : 'Belum diisi' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Kondisi Kulit Terakhir -->
            <div class="journal-card" style="padding: 24px; border-radius: 22px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <div>
                        <h3 style="margin: 0; font-size: 15px; font-weight: 800; color: var(--ink); display: flex; align-items: center; gap: 8px;">
                            🛡️ Kondisi Kulit Terakhir
                        </h3>
                        <p style="margin: 2px 0 0; font-size: 10px; color: var(--muted);">Dicatat semalam (Pukul 22:15 WIB)</p>
                    </div>
                    <span style="background: #eef7f2; color: var(--green); padding: 5px 12px; border-radius: 99px; font-size: 9px; font-weight: 800;">
                        {{ $jurnalTerakhir?->kondisi_kulit ?? 'Belum ada data' }} ✨
                    </span>
                </div>

                <div style="display: grid; grid-template-columns: 140px 1fr; gap: 20px; align-items: center; background: #faf5f3; padding: 20px; border-radius: 18px; margin-bottom: 14px;">
                    <div style="text-align: center; border-right: 1px solid var(--line); padding-right: 15px;">
                        <span style="display: block; font-size: 8px; color: var(--muted); font-weight: 800; text-transform: uppercase;">BARRIER HEALTH</span>
                        <strong style="display: block; font-size: 32px; font-weight: 800; color: var(--green); line-height: 1.1; margin: 4px 0;">88</strong>
                        <span style="font-size: 9px; color: var(--muted);">/100</span>
                        <span style="display: block; font-size: 9px; font-weight: 700; color: var(--green); margin-top: 4px;">Kondisi Optimal</span>
                    </div>

                    <div style="display: grid; gap: 10px;">
                        <div>
                            <div style="display: flex; justify-content: space-between; font-size: 10px; font-weight: 700; margin-bottom: 3px;">
                                <span style="color: var(--muted);">💧 Hidrasi Kulit</span>
                                <span style="color: var(--rose);">90% (Sangat Lembap)</span>
                            </div>
                            <div style="width: 100%; height: 6px; background: white; border-radius: 99px; overflow: hidden;">
                                <div style="width: 90%; height: 100%; background: var(--rose); border-radius: 99px;"></div>
                            </div>
                        </div>

                        <div>
                            <div style="display: flex; justify-content: space-between; font-size: 10px; font-weight: 700; margin-bottom: 3px;">
                                <span style="color: var(--muted);">😊 Kemerahan / Inflamasi</span>
                                <span style="color: var(--green);">12% (Sangat Tenang)</span>
                            </div>
                            <div style="width: 100%; height: 6px; background: white; border-radius: 99px; overflow: hidden;">
                                <div style="width: 12%; height: 100%; background: var(--green); border-radius: 99px;"></div>
                            </div>
                        </div>

                        <div>
                            <div style="display: flex; justify-content: space-between; font-size: 10px; font-weight: 700; margin-bottom: 3px;">
                                <span style="color: var(--muted);">∠ Tekstur & Porous</span>
                                <span style="color: var(--rose);">Halus Kenyal</span>
                            </div>
                            <div style="width: 100%; height: 6px; background: white; border-radius: 99px; overflow: hidden;">
                                <div style="width: 85%; height: 100%; background: var(--rose); border-radius: 99px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background: #fdf2f4; border: 1px solid #f7d5de; padding: 12px 16px; border-radius: 14px; display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 14px;">💡</span>
                    <p style="margin: 0; font-size: 10px; color: #862348; line-height: 1.4;">
                        <strong style="font-weight: 800;">Catatan :</strong> Pemulihan skin barrier naik +6% semenjak kamu istirahatkan eksfoliasi berkonsentrasi tinggi dua hari lalu. Tetap pertahankan hidrasi ya!
                    </p>
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN -->
        <div style="display: grid; gap: 24px;">

            <!-- Koleksi Skincare -->
            <div class="journal-card" style="padding: 24px; border-radius: 22px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <div>
                        <h3 style="margin: 0; font-size: 15px; font-weight: 800; color: var(--ink);">📦 Koleksi Skincare</h3>
                        <p style="margin: 2px 0 0; font-size: 10px; color: var(--muted);">Total {{ $totalProduk }} Produk Terdaftar</p>
                    </div>
                    <!-- Kelola Lemari -> Katalog -->
                    <a href="{{ route('katalog') }}" style="color: var(--rose); font-size: 10px; font-weight: 800; text-decoration: none;">Kelola Lemari →</a>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
                    <div style="background: #faf5f3; border: 1px solid var(--line); padding: 16px; border-radius: 16px; text-align: center;">
                        <span style="display: inline-block; width: 24px; height: 24px; border-radius: 50%; background: #eef7f2; color: var(--green); font-size: 12px; line-height: 24px; margin-bottom: 6px;">✓</span>
                        <strong style="display: block; font-size: 20px; font-weight: 800; color: var(--ink);">{{ $produkAktif }}</strong>
                        <span style="font-size: 10px; font-weight: 800; color: var(--ink);">Sedang Aktif</span>
                        <p style="margin: 2px 0 0; font-size: 8px; color: var(--muted);">Dipakai rutin harian</p>
                    </div>

                    <div style="background: #faf5f3; border: 1px solid var(--line); padding: 16px; border-radius: 16px; text-align: center;">
                        <span style="display: inline-block; width: 24px; height: 24px; border-radius: 50%; background: #fdf2f4; color: var(--rose); font-size: 12px; line-height: 24px; margin-bottom: 6px;">⏸</span>
                        <strong style="display: block; font-size: 20px; font-weight: 800; color: var(--ink);">{{ $produkStop }}</strong>
                        <span style="font-size: 10px; font-weight: 800; color: var(--ink);">Stop / Dijeda</span>
                        <p style="margin: 2px 0 0; font-size: 8px; color: var(--muted);">Dalam pengujian alergi</p>
                    </div>
                </div>

                <div style="background: #faf5f3; padding: 10px 14px; border-radius: 12px; text-align: center;">
                    <p style="margin: 0; font-size: 9px; color: var(--muted); font-weight: 700;">Semua aman dicatat</p>
                </div>
            </div>

            <!-- Analisis Kecocokan -->
            <div class="journal-card" style="padding: 24px; border-radius: 22px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <div>
                        <h3 style="margin: 0; font-size: 15px; font-weight: 800; color: var(--ink);">🔍 Analisis Kecocokan</h3>
                        <p style="margin: 2px 0 0; font-size: 10px; color: var(--muted);">Korelasi Reaksi Kulitmu</p>
                    </div>
                    <span style="background: var(--rose-pale); color: var(--rose); padding: 3px 10px; border-radius: 99px; font-size: 8px; font-weight: 800;">Terupdate</span>
                </div>

                <div style="display: grid; gap: 12px; margin-bottom: 16px;">
                    <!-- Item 1 -->
                    <div style="background: #faf5f3; border: 1px solid var(--line); padding: 14px; border-radius: 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 6px;">
                            <div>
                                <strong style="font-size: 11px; font-weight: 800; color: var(--ink);">Hyalucera Moisturizer Gel</strong>
                                <span style="display: block; font-size: 9px; color: var(--rose); font-weight: 700;">Holy Grail Terverifikasi 💖</span>
                            </div>
                            <span style="background: #eef7f2; color: var(--green); padding: 2px 8px; border-radius: 99px; font-size: 8px; font-weight: 800;">100% Aman</span>
                        </div>
                        <p style="margin: 0; font-size: 9px; color: var(--muted); line-height: 1.4;">
                            Tidak ada rekaman jerawat baru atau kemerahan selama 5 hari pemakaian rutin. Sangat mempertahankan hidrasi skin barrier!
                        </p>
                    </div>

                    <!-- Item 2 -->
                    <div style="background: #fdf2f4; border: 1px solid #f7d5de; padding: 14px; border-radius: 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 6px;">
                            <div>
                                <strong style="font-size: 11px; font-weight: 800; color: var(--ink);">Glycolic Acid Exfoliating Brightening</strong>
                                <span style="display: block; font-size: 9px; color: #a33b5c; font-weight: 700;">Waspada: Pemicu Iritasi & Purging</span>
                            </div>
                            <span style="background: #fdf2f4; color: #ab2c5d; padding: 2px 8px; border-radius: 99px; font-size: 8px; font-weight: 800;">Korelasi 85%</span>
                        </div>
                        <p style="margin: 0; font-size: 9px; color: var(--muted); line-height: 1.4;">
                            Terdeteksi kemerahan dan kulit kering setiap kali produk ini diaplikasikan. Disarankan jeda sementara atau turunkan frekuensi menjadi seminggu sekali.
                        </p>
                    </div>
                </div>

                <!-- Lihat Riwayat & Matriks Bahan Lengkap -> Analisis Kecocokan -->
                <a href="{{ route('analisis.kecocokan') }}" class="button button-secondary" style="width: 100%; border-radius: 99px; justify-content: center; background: #faf5f3; border-color: transparent; color: var(--rose); font-size: 10px;">
                    Lihat Riwayat & Matriks Bahan Lengkap →
                </a>
            </div>

        </div>

    </div>

</div>
@endsection
