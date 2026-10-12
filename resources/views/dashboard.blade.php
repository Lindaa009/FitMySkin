@extends('layouts.app')

@section('title', 'Dashboard Utama')
@section('page', 'dashboard')

@section('content')
<div style="max-width: 1120px; margin: 0 auto; display: grid; gap: 24px;">

    <!-- 1. BANNER -->
    <div class="journal-card" style="padding: 32px; border-radius: 28px; background: linear-gradient(135deg, #fff0f3 0%, #fff7f5 100%); border-color: #f6e4e6; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap;">
        <div>
            <p class="eyebrow"><span class="eyebrow-dot"></span> PAGI HARI • RITUAL PERCAYA DIRI</p>
            <h1 style="margin: 8px 0 10px; font-size: clamp(24px, 3.5vw, 32px); font-weight: 800; letter-spacing: -1px; color: var(--ink);">
                Selamat Datang Kembali, <br>{{ auth()->user()->nama_user ?? 'User' }}! 🌸✨
            </h1>
            <p class="intro-copy" style="max-width: 520px; font-size: 12px; color: var(--muted);">
                @if ($jurnalPagiHariIni && $jurnalMalamHariIni)
                    Mantap! Kamu udah lengkap catat jurnal hari ini. Pertahankan ya cantik! 💖
                @elseif ($jurnalPagiHariIni || $jurnalMalamHariIni)
                    Sedikit lagi lengkap! Yuk catat jurnal satunya biar streak-mu aman. 🌸
                @else
                    Ayo mulai catat jurnal pertamamu hari ini dan raih streak pertamamu! ✨
                @endif
            </p>
        </div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="{{ route('katalog') }}" class="button button-primary" style="background: var(--rose); border-radius: 99px; padding: 0 20px; font-size: 11px;">
                + Tambah Produk Baru
            </a>
            <a href="{{ route('jurnal.pagi') }}" class="button button-secondary" style="border-radius: 99px; padding: 0 20px; font-size: 11px; background: white; border-color: #f7d5de; color: var(--rose);">
                📝 Catat Jurnal Kulit Hari Ini
            </a>
        </div>
    </div>

    <!-- 2. STATISTIK ATAS -->
    <div class="dash-stats-grid" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px;">

        <!-- Konsistensi -->
        <div class="journal-card" style="padding: 20px 24px; border-radius: 22px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 48px; height: 48px; border-radius: 16px; background: var(--rose-pale); display: grid; place-items: center; color: var(--rose); font-size: 20px; flex-shrink: 0;">
                🔥
            </div>
            <div>
                <span style="font-size: 8px; font-weight: 800; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px;">KONSISTENSI</span>
                <div style="display: flex; align-items: baseline; gap: 6px; margin: 2px 0;">
                    <strong style="font-size: 24px; font-weight: 800; color: var(--rose);">{{ $streak }} Hari</strong>
                    @if ($jurnalPagiHariIni || $jurnalMalamHariIni)
                        <span style="font-size: 9px; font-weight: 700; color: var(--green); background: #eef7f2; padding: 2px 6px; border-radius: 99px;">+1</span>
                    @endif
                </div>
                <p style="margin: 0; font-size: 10px; color: var(--muted);">Streak berturut-turut 🔥</p>
            </div>
        </div>

        <!-- Kepatuhan -->
        <div class="journal-card" style="padding: 20px 24px; border-radius: 22px; display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div style="width: 48px; height: 48px; border-radius: 16px; background: #eef7f2; display: grid; place-items: center; color: var(--green); font-size: 20px; flex-shrink: 0;">
                    🛡️
                </div>
                <div>
                    <span style="font-size: 8px; font-weight: 800; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px;">KEPATUHAN</span>
                    <strong style="display: block; font-size: 24px; font-weight: 800; color: var(--green); margin: 2px 0;">{{ $kepatuhanPersen }}%</strong>
                    <p style="margin: 0; font-size: 10px; color: var(--muted);">
                        @if ($kepatuhanPersen >= 80) Sangat Disiplin 💧
                        @elseif ($kepatuhanPersen >= 50) Cukup Konsisten 🌱
                        @elseif ($kepatuhanPersen > 0) Ayo Lebih Rajin 🌸
                        @else Belum ada data 🌱
                        @endif
                    </p>
                </div>
            </div>
            <div style="width: 36px; height: 36px; border: 3px solid var(--green); border-radius: 50%; border-top-color: transparent; flex-shrink: 0;"></div>
        </div>

        <!-- Pekan Ini -->
        <div class="journal-card" style="padding: 20px 16px; border-radius: 22px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; gap: 8px;">
                <span style="font-size: 8px; font-weight: 800; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px; white-space: nowrap;">
                    PEKAN INI
                </span>
                <span style="font-size: 9px; font-weight: 700; color: var(--rose); white-space: nowrap;">{{ $pekanCount }}/7</span>
            </div>
            <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; text-align: center;">
                @foreach ($pekanIni as $day)
                    <div style="min-width: 0;">
                        <span style="display: block; font-size: 8px; color: var(--muted); margin-bottom: 4px;">{{ $day['hari'] }}</span>
                        @if ($day['status'] === 'done')
                            <span style="width: 22px; height: 22px; margin: 0 auto; border-radius: 50%; background: var(--rose-pale); color: var(--rose); font-size: 10px; display: grid; place-items: center;">♥</span>
                        @elseif ($day['status'] === 'today')
                            <span style="width: 22px; height: 22px; margin: 0 auto; border-radius: 50%; background: var(--rose); color: white; font-size: 10px; display: grid; place-items: center;">⏰</span>
                        @else
                            <span style="width: 22px; height: 22px; margin: 0 auto; border-radius: 50%; border: 1px solid var(--line); display: grid; place-items: center;"></span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- 3. GRID 2 KOLOM -->
    <div class="dash-main-grid" style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 24px; align-items: start;">

        <!-- KOLOM KIRI -->
        <div style="display: grid; gap: 24px; min-width: 0;">

            <!-- Jurnal Hari Ini -->
            <div class="journal-card" style="padding: 24px; border-radius: 22px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 14px; gap: 10px; flex-wrap: wrap;">
                    <div>
                        <h3 style="margin: 0; font-size: 15px; font-weight: 800; color: var(--ink);">📖 Jurnal Hari Ini</h3>
                        <p style="margin: 2px 0 0; font-size: 10px; color: var(--muted);">{{ $tanggalHariIni }}</p>
                    </div>
                    <span style="background: var(--rose-pale); color: var(--rose); padding: 4px 12px; border-radius: 99px; font-size: 9px; font-weight: 800; white-space: nowrap;">
                        {{ $statusJurnalHariIni }}
                    </span>
                </div>

                <div style="margin-bottom: 16px;">
                    <div style="display: flex; justify-content: space-between; font-size: 9px; font-weight: 700; color: var(--muted); margin-bottom: 6px;">
                        <span>Progres Ritual Kulit</span>
                        <span style="color: var(--rose);">{{ $progressRitual }}% Selesai</span>
                    </div>
                    <div style="width: 100%; height: 8px; background: #f7efec; border-radius: 99px; overflow: hidden;">
                        <div style="width: {{ $progressRitual }}%; height: 100%; background: var(--rose); border-radius: 99px; transition: width 0.3s;"></div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div style="background: {{ $jurnalPagiHariIni ? '#fdf2f4' : '#faf5f3' }}; border: 1px solid {{ $jurnalPagiHariIni ? '#f7d5de' : 'var(--line)' }}; padding: 14px; border-radius: 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; gap: 6px;">
                            <span style="font-size: 12px; flex-shrink: 0;">☀️</span>
                            @if (!$jurnalPagiHariIni)
                                <a href="{{ route('jurnal.pagi') }}" style="font-size: 8px; font-weight: 800; padding: 3px 8px; background: var(--rose); color: white; border-radius: 99px; text-decoration: none; white-space: nowrap;">Isi</a>
                            @else
                                <span style="color: var(--green); font-size: 12px;">✓</span>
                            @endif
                        </div>
                        <h4 style="margin: 0 0 2px; font-size: 12px; font-weight: 800; color: var(--ink);">Rutinitas Pagi</h4>
                        <p style="margin: 0; font-size: 9px; color: {{ $jurnalPagiHariIni ? 'var(--green)' : 'var(--muted)' }}; font-weight: 700;">
                            {{ $jurnalPagiHariIni ? '✓ Sudah dicatat' : 'Belum diisi' }}
                        </p>
                    </div>

                    <div style="background: {{ $jurnalMalamHariIni ? '#fdf2f4' : '#faf5f3' }}; border: 1px solid {{ $jurnalMalamHariIni ? '#f7d5de' : 'var(--line)' }}; padding: 14px; border-radius: 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; gap: 6px;">
                            <span style="font-size: 12px; flex-shrink: 0;">🌙</span>
                            @if (!$jurnalMalamHariIni)
                                <a href="{{ route('jurnal.malam') }}" style="font-size: 8px; font-weight: 800; padding: 3px 8px; background: var(--rose); color: white; border-radius: 99px; text-decoration: none; white-space: nowrap;">Isi</a>
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
                @if (!$jurnalTerakhir)
                    <div style="text-align: center; padding: 20px;">
                        <div style="font-size: 40px; margin-bottom: 10px;">🌸</div>
                        <h3 style="margin: 0 0 6px; font-size: 15px; font-weight: 800; color: var(--ink);">Belum Ada Catatan Kulit</h3>
                        <p style="margin: 0 0 16px; font-size: 11px; color: var(--muted);">Catat jurnal pertamamu untuk melihat kondisi kulit di sini.</p>
                        <a href="{{ route('jurnal.pagi') }}" class="button button-primary" style="font-size: 10px; padding: 8px 16px; border-radius: 99px; background: var(--rose);">
                            📝 Mulai Catat Jurnal
                        </a>
                    </div>
                @else
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; gap: 10px; flex-wrap: wrap;">
                        <div>
                            <h3 style="margin: 0; font-size: 15px; font-weight: 800; color: var(--ink);">🛡️ Kondisi Kulit Terakhir</h3>
                            <p style="margin: 2px 0 0; font-size: 10px; color: var(--muted);">Dicatat: {{ $waktuJurnalTerakhir }}</p>
                        </div>
                        <span style="background: #eef7f2; color: var(--green); padding: 5px 12px; border-radius: 99px; font-size: 9px; font-weight: 800;">
                            {{ $jurnalTerakhir->kondisi_kulit }} ✨
                        </span>
                    </div>

                    <div style="display: grid; grid-template-columns: 140px 1fr; gap: 20px; align-items: center; background: #faf5f3; padding: 20px; border-radius: 18px; margin-bottom: 14px;">
                        <div style="text-align: center; border-right: 1px solid var(--line); padding-right: 15px;">
                            <span style="display: block; font-size: 8px; color: var(--muted); font-weight: 800; text-transform: uppercase;">BARRIER</span>
                            <strong style="display: block; font-size: 32px; font-weight: 800; color: {{ $metrik['barrierColor'] }}; line-height: 1.1; margin: 4px 0;">{{ $metrik['barrier'] }}</strong>
                            <span style="font-size: 9px; color: var(--muted);">/100</span>
                            <span style="display: block; font-size: 9px; font-weight: 700; color: {{ $metrik['barrierColor'] }}; margin-top: 4px;">{{ $metrik['barrierStatus'] }}</span>
                        </div>
                        <div style="display: grid; gap: 10px;">
                            <div>
                                <div style="display: flex; justify-content: space-between; font-size: 10px; font-weight: 700; margin-bottom: 3px;">
                                    <span style="color: var(--muted);">💧 Hidrasi</span>
                                    <span style="color: var(--rose);">{{ $metrik['hidrasi'] }}%</span>
                                </div>
                                <div style="width: 100%; height: 6px; background: white; border-radius: 99px; overflow: hidden;">
                                    <div style="width: {{ $metrik['hidrasi'] }}%; height: 100%; background: var(--rose); border-radius: 99px;"></div>
                                </div>
                            </div>
                            <div>
                                <div style="display: flex; justify-content: space-between; font-size: 10px; font-weight: 700; margin-bottom: 3px;">
                                    <span style="color: var(--muted);">😊 Kemerahan</span>
                                    <span style="color: {{ $metrik['kemerahan'] <= 20 ? 'var(--green)' : 'var(--rose)' }};">{{ $metrik['kemerahan'] }}%</span>
                                </div>
                                <div style="width: 100%; height: 6px; background: white; border-radius: 99px; overflow: hidden;">
                                    <div style="width: {{ $metrik['kemerahan'] }}%; height: 100%; background: {{ $metrik['kemerahan'] <= 20 ? 'var(--green)' : '#F57C00' }}; border-radius: 99px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="background: #fdf2f4; border: 1px solid #f7d5de; padding: 12px 16px; border-radius: 14px; display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 14px;">💡</span>
                        <p style="margin: 0; font-size: 10px; color: #862348; line-height: 1.4;">
                            <strong>Catatan:</strong>
                            @if ($metrik['barrier'] >= 80) Kondisi kulitmu sangat baik! Pertahankan 🌸
                            @elseif ($metrik['barrier'] >= 60) Cukup baik. Jaga hidrasi 💧
                            @else Perlu perhatian ekstra. Fokus hidrasi 🌱
                            @endif
                        </p>
                    </div>
                @endif
            </div>

        </div>

        <!-- KOLOM KANAN -->
        <div style="display: grid; gap: 24px; min-width: 0;">

            <!-- Koleksi Skincare -->
            <div class="journal-card" style="padding: 24px; border-radius: 22px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; gap: 10px; flex-wrap: wrap;">
                    <div>
                        <h3 style="margin: 0; font-size: 15px; font-weight: 800; color: var(--ink);">📦 Koleksi Skincare</h3>
                        <p style="margin: 2px 0 0; font-size: 10px; color: var(--muted);">Total {{ $totalProduk }} Produk</p>
                    </div>
                    <a href="{{ route('katalog') }}" style="color: var(--rose); font-size: 10px; font-weight: 800; text-decoration: none; white-space: nowrap;">Kelola →</a>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
                    <div style="background: #faf5f3; border: 1px solid var(--line); padding: 16px; border-radius: 16px; text-align: center;">
                        <span style="display: inline-block; width: 24px; height: 24px; border-radius: 50%; background: #eef7f2; color: var(--green); font-size: 12px; line-height: 24px; margin-bottom: 6px;">✓</span>
                        <strong style="display: block; font-size: 20px; font-weight: 800; color: var(--ink);">{{ $produkAktif }}</strong>
                        <span style="font-size: 10px; font-weight: 800; color: var(--ink);">Sedang Aktif</span>
                    </div>
                    <div style="background: #faf5f3; border: 1px solid var(--line); padding: 16px; border-radius: 16px; text-align: center;">
                        <span style="display: inline-block; width: 24px; height: 24px; border-radius: 50%; background: #fdf2f4; color: var(--rose); font-size: 12px; line-height: 24px; margin-bottom: 6px;">⏸</span>
                        <strong style="display: block; font-size: 20px; font-weight: 800; color: var(--ink);">{{ $produkStop }}</strong>
                        <span style="font-size: 10px; font-weight: 800; color: var(--ink);">Stop / Dijeda</span>
                    </div>
                </div>

                <div style="background: #faf5f3; padding: 10px 14px; border-radius: 12px; text-align: center;">
                    <p style="margin: 0; font-size: 9px; color: var(--muted); font-weight: 700;">
                        @if ($totalProduk === 0) Belum ada produk — yuk tambah!
                        @else Semua aman dicatat
                        @endif
                    </p>
                </div>
            </div>

            <!-- Analisis Kecocokan -->
            <div class="journal-card" style="padding: 24px; border-radius: 22px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <div>
                        <h3 style="margin: 0; font-size: 15px; font-weight: 800; color: var(--ink);">🔍 Analisis Kecocokan</h3>
                        <p style="margin: 2px 0 0; font-size: 10px; color: var(--muted);">Korelasi Reaksi Kulitmu</p>
                    </div>
                </div>

                @if (!$analisis['ada_data'] && !$analisis['aman'])
                    <div style="text-align: center; padding: 20px; background: #faf5f3; border-radius: 16px;">
                        <div style="font-size: 32px; margin-bottom: 8px;">🔍</div>
                        <p style="margin: 0 0 4px; font-size: 11px; font-weight: 800; color: var(--ink);">Belum Ada Data Analisis</p>
                        <p style="margin: 0; font-size: 9px; color: var(--muted);">Terus catat jurnal untuk melihat pola kulitmu.</p>
                    </div>
                @else
                    <div style="display: grid; gap: 12px; margin-bottom: 16px;">
                        @if ($analisis['aman'])
                            <div style="background: #faf5f3; border: 1px solid var(--line); padding: 14px; border-radius: 16px;">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 6px; gap: 8px;">
                                    <strong style="font-size: 11px; font-weight: 800; color: var(--ink);">{{ $analisis['aman']['nama'] }}</strong>
                                    <span style="background: #eef7f2; color: var(--green); padding: 2px 8px; border-radius: 99px; font-size: 8px; font-weight: 800; white-space: nowrap;">Aman</span>
                                </div>
                                <p style="margin: 0; font-size: 9px; color: var(--muted); line-height: 1.4;">Sejauh ini aman 💖 Terus pantau ya!</p>
                            </div>
                        @endif
                        @if ($analisis['pemicu'])
                            <div style="background: #fdf2f4; border: 1px solid #f7d5de; padding: 14px; border-radius: 16px;">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 6px; gap: 8px;">
                                    <strong style="font-size: 11px; font-weight: 800; color: var(--ink);">{{ $analisis['pemicu']['nama'] }}</strong>
                                    <span style="background: #fdf2f4; color: #ab2c5d; padding: 2px 8px; border-radius: 99px; font-size: 8px; font-weight: 800; white-space: nowrap;">
                                        {{ $analisis['pemicu']['persen'] }}%
                                    </span>
                                </div>
                                <p style="margin: 0; font-size: 9px; color: var(--muted); line-height: 1.4;">Waspada: sering muncul sebelum iritasi.</p>
                            </div>
                        @endif
                    </div>
                @endif

                <a href="{{ route('analisis.kecocokan') }}" class="button button-secondary" style="width: 100%; border-radius: 99px; justify-content: center; background: #faf5f3; border-color: transparent; color: var(--rose); font-size: 10px;">
                    Lihat Matriks Lengkap →
                </a>
            </div>

        </div>

    </div>

</div>

<style>
    @media (max-width: 920px) {
        .dash-main-grid {
            grid-template-columns: 1fr !important;
        }
    }
    @media (max-width: 680px) {
        .dash-stats-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection