@extends('layouts.app')

@section('title', 'Kelola Urutan Langkah Skincare')
@section('page', 'kelola-langkah')

@section('content')
<div style="max-width: 1080px; margin: 0 auto; display: grid; gap: 24px;">

    <!-- BREADCRUMB & HEADER -->
    <div>
        <p style="font-size: 10px; color: var(--muted); margin: 0 0 12px; font-weight: 600;">
            👤 Profile / Rutinitas Harian / <span style="color: #ab2c5d; font-weight: 800;">Kelola Urutan Langkah</span>
        </p>

        <span style="background: #fdf2f4; color: #ab2c5d; font-size: 9px; font-weight: 800; letter-spacing: 0.8px; padding: 4px 12px; border-radius: 99px; text-transform: uppercase; display: inline-block; margin-bottom: 8px;">
            🪄 KOSTUMISASI RUTINITAS
        </span>

        <div style="display: flex; justify-content: space-between; align-items: flex-end; gap: 16px; flex-wrap: wrap;">
            <div>
                <h1 style="margin: 0 0 6px; font-size: 26px; font-weight: 800; letter-spacing: -0.8px; color: var(--ink);">
                    Kelola Urutan Langkah Skincare
                </h1>
                <p style="margin: 0; color: var(--muted); font-size: 11px;">
                    Atur urutan pemakaian berdasarkan jenis produk untuk rutinitas harianmu yang lembut dan teratur.
                </p>
            </div>

            <!-- TOMBOL HEADER AKSI -->
            <div style="display: flex; gap: 10px;">
                <button type="button" class="button button-secondary" style="border-radius: 99px; font-size: 11px; padding: 0 18px; background: white;">
                    🔄 Reset Default
                </button>
                <!-- Simpan Urutan -> Kembali ke Profil -->
                <a href="{{ route('profil') }}" class="button button-primary" style="border-radius: 99px; font-size: 11px; padding: 0 22px; background: #ab2c5d;">
                    ✨ Simpan Urutan ✨
                </a>
            </div>
        </div>
    </div>

    <!-- TAB PILIHAN RUTINITAS (PAGI / MALAM) -->
    <div style="background: #faf5f3; padding: 6px; border-radius: 18px; display: flex; gap: 6px; max-width: 100%;">
        <button type="button" id="tab-pagi" onclick="switchRoutine('pagi')" style="flex: 0 0 150px; padding: 8px 16px; border: none; border-radius: 12px; background: white; font-weight: 800; font-size: 11px; cursor: pointer; color: #ab2c5d; box-shadow: 0 2px 8px rgba(0,0,0,0.04); display: flex; align-items: center; justify-content: center; gap: 6px;">
            ☀️ Rutinitas Pagi
        </button>
        <button type="button" id="tab-malam" onclick="switchRoutine('malam')" style="flex: 0 0 150px; padding: 8px 16px; border: none; border-radius: 12px; background: transparent; font-weight: 800; font-size: 11px; cursor: pointer; color: var(--ink); display: flex; align-items: center; justify-content: center; gap: 6px;">
            🌙 Rutinitas Malam
        </button>
    </div>

    <!-- GRID UTAMA URUTAN PEMAKAIAN -->
    <div style="display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: start;">

        <!-- KOLOM KIRI: DAFTAR LANGKAH -->
        <div>
            <div style="display: flex; items-center; justify-content: space-between; margin-bottom: 14px;">
                <h2 style="margin: 0; font-size: 14px; font-weight: 800; display: flex; align-items: center; gap: 6px;">
                    ⇅ Urutan Pemakaian <span style="font-weight: 500; color: var(--muted); font-size: 10px;">(Tekan panah atau ubah jenis langsung)</span>
                </h2>
            </div>

            <!-- CONTAINER ITEM LANGKAH -->
            <div id="routine-list" style="display: grid; gap: 12px;">
                <!-- Diberi Render Dinamis lewat JS di bawah -->
            </div>

            <!-- SECTION TAMBAH LANGKAH BARU -->
            <div class="journal-card" style="margin-top: 16px; padding: 16px 20px; border-radius: 20px; background: #faf5f3; border-color: transparent; display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #fdf2f4; border: 1px solid #f7d5de; display: grid; place-items: center; color: #ab2c5d; font-size: 14px;">
                        ➕
                    </div>
                    <div>
                        <h4 style="margin: 0; font-size: 11px; font-weight: 800; color: var(--ink);">Tambah Langkah Baru</h4>
                        <p style="margin: 2px 0 0; font-size: 9px; color: var(--muted);">Pilih jenis produk yang ingin disisipkan</p>
                    </div>
                </div>

                <div style="display: flex; gap: 8px;">
                    <select style="min-height: 36px; padding: 0 14px; border-radius: 12px; border: 1px solid var(--line); font-size: 10px; background: white; outline: none; cursor: pointer;">
                        <option value="">Pilih Jenis Produk</option>
                        <option>Micellar Water</option>
                        <option>Exfoliating Toner</option>
                        <option>Eye Cream</option>
                        <option>Sleeping Mask</option>
                    </select>
                    <button type="button" class="button button-primary" style="background: #ef6b94; font-size: 10px; height: 36px; padding: 0 16px; border-radius: 12px;">
                        + Sisipkan
                    </button>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: PANDUAN & BANTUAN -->
        <div style="display: grid; gap: 16px;">

            <!-- PANDUAN URUTAN DASAR -->
            <div class="journal-card" style="padding: 22px; border-radius: 24px;">
                <h3 style="margin: 0 0 8px; font-size: 13px; font-weight: 800; color: var(--ink); display: flex; align-items: center; gap: 6px;">
                    💡 Panduan Urutan Dasar
                </h3>
                <p style="margin: 0 0 14px; font-size: 10px; color: var(--muted); line-height: 1.5;">
                    Aturan umum perawatan wajah adalah <strong style="color: #ab2c5d;">cair ke kental (thin to thick)</strong> agar penyerapan bahan aktif berjalan maksimal:
                </p>

                <div style="display: grid; gap: 8px;">
                    <div style="background: #faf5f3; padding: 8px 12px; border-radius: 12px; display: flex; align-items: center; gap: 10px;">
                        <span style="width: 20px; height: 20px; border-radius: 50%; background: #ef6b94; color: white; font-size: 9px; font-weight: 800; display: grid; place-items: center; flex-shrink: 0;">1</span>
                        <div>
                            <strong style="display: block; font-size: 10px; color: var(--ink);">Pembersih (Cleansing)</strong>
                            <span style="font-size: 8px; color: var(--muted);">Micellar Water, Cleansing Oil, Facial Wash</span>
                        </div>
                    </div>

                    <div style="background: #faf5f3; padding: 8px 12px; border-radius: 12px; display: flex; align-items: center; gap: 10px;">
                        <span style="width: 20px; height: 20px; border-radius: 50%; background: #ef6b94; color: white; font-size: 9px; font-weight: 800; display: grid; place-items: center; flex-shrink: 0;">2</span>
                        <div>
                            <strong style="display: block; font-size: 10px; color: var(--ink);">Penyeimbang (Prep)</strong>
                            <span style="font-size: 8px; color: var(--muted);">Toner</span>
                        </div>
                    </div>

                    <div style="background: #faf5f3; padding: 8px 12px; border-radius: 12px; display: flex; align-items: center; gap: 10px;">
                        <span style="width: 20px; height: 20px; border-radius: 50%; background: #ef6b94; color: white; font-size: 9px; font-weight: 800; display: grid; place-items: center; flex-shrink: 0;">3</span>
                        <div>
                            <strong style="display: block; font-size: 10px; color: var(--ink);">Perawatan Khusus</strong>
                            <span style="font-size: 8px; color: var(--muted);">Serum, Exfoliant, Mask</span>
                        </div>
                    </div>

                    <div style="background: #faf5f3; padding: 8px 12px; border-radius: 12px; display: flex; align-items: center; gap: 10px;">
                        <span style="width: 20px; height: 20px; border-radius: 50%; background: #ef6b94; color: white; font-size: 9px; font-weight: 800; display: grid; place-items: center; flex-shrink: 0;">4</span>
                        <div>
                            <strong style="display: block; font-size: 10px; color: var(--ink);">Pengunci (Moisture Lock)</strong>
                            <span style="font-size: 8px; color: var(--muted);">Moisturizer, Cream</span>
                        </div>
                    </div>

                    <div style="background: #faf5f3; padding: 8px 12px; border-radius: 12px; display: flex; align-items: center; gap: 10px;">
                        <span style="width: 20px; height: 20px; border-radius: 50%; background: #ef6b94; color: white; font-size: 9px; font-weight: 800; display: grid; place-items: center; flex-shrink: 0;">5</span>
                        <div>
                            <strong style="display: block; font-size: 10px; color: var(--ink);">Perlindungan Terluar</strong>
                            <span style="font-size: 8px; color: var(--muted);">Sunscreen (Khusus Siang Hari)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SINKRONISASI INFO -->
            <div style="background: #fdf2f4; border: 1px solid #f7d5de; padding: 18px; border-radius: 20px; display: flex; gap: 12px;">
                <span style="color: #ab2c5d; font-size: 16px;">📋</span>
                <div>
                    <h4 style="margin: 0 0 4px; font-size: 11px; font-weight: 800; color: #862348;">Sinkronisasi Jurnal Kulit</h4>
                    <p style="margin: 0; font-size: 9px; color: var(--muted); line-height: 1.5;">
                        Urutan ini akan langsung menjadi panduan checklist di fitur Jurnal Kulit dan jadwal pengingat rutinitasmu.
                    </p>
                </div>
            </div>

            <div style="background: #eef7f2; border: 1px solid #d2e8dc; padding: 14px 18px; border-radius: 20px; display: flex; align-items: center; gap: 10px;">
                <span style="color: var(--green); font-size: 16px;">🛡️</span>
                <p style="margin: 0; font-size: 9px; color: var(--green); font-weight: 700; line-height: 1.4;">
                    Hanya 10 kategori standar yang didukung untuk menjaga analisa kecocokan tetap akurat.
                </p>
            </div>

        </div>

    </div>

</div>

@push('scripts')
<script>
    const dataPagi = [
        { num: '01', title: 'Facial Wash', desc: 'Langkah 1: Pembersih' },
        { num: '02', title: 'Toner', desc: 'Langkah 2: Penyeimbang' },
        { num: '03', title: 'Serum', desc: 'Langkah 3: Perawatan Khusus' },
        { num: '04', title: 'Moisturizer', desc: 'Langkah 4: Pengunci' },
        { num: '05', title: 'Sunscreen', desc: 'Langkah 5: Perlindungan Terluar' }
    ];

    const dataMalam = [
        { num: '01', title: 'Facial Wash', desc: 'Langkah 1: Pembersih' },
        { num: '02', title: 'Toner', desc: 'Langkah 2: Penyeimbang' },
        { num: '03', title: 'Serum', desc: 'Langkah 3: Perawatan Khusus' },
        { num: '04', title: 'Moisturizer', desc: 'Langkah 4: Pengunci' }
    ];

    function renderRoutine(items) {
        const container = document.getElementById('routine-list');
        if (!container) return;

        container.innerHTML = items.map(item => `
            <div class="journal-card" style="padding: 16px 20px; border-radius: 18px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                <div style="display: flex; align-items: center; gap: 14px;">
                    <span style="color: #c4b5b9; cursor: grab; font-size: 12px;">:::</span>
                    <span style="background: #fdf2f4; color: #ab2c5d; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; font-size: 10px; font-weight: 800;">
                        ${item.num}
                    </span>
                    <div>
                        <h3 style="margin: 0; font-size: 13px; font-weight: 800; color: var(--ink);">${item.title}</h3>
                        <p style="margin: 2px 0 0; font-size: 9px; color: var(--muted); font-weight: 600;">${item.desc}</p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 12px; color: var(--muted);">
                    <button type="button" style="border: none; background: transparent; cursor: pointer; color: var(--muted); font-size: 10px;">▲</button>
                    <button type="button" style="border: none; background: transparent; cursor: pointer; color: var(--muted); font-size: 10px;">▼</button>
                    <button type="button" style="border: none; background: transparent; cursor: pointer; color: var(--muted); font-size: 12px;">🗑️</button>
                </div>
            </div>
        `).join('');
    }

    function switchRoutine(type) {
        const tabPagi = document.getElementById('tab-pagi');
        const tabMalam = document.getElementById('tab-malam');

        if (type === 'malam') {
            tabMalam.style.background = 'white';
            tabMalam.style.color = '#ab2c5d';
            tabMalam.style.boxShadow = '0 2px 8px rgba(0,0,0,0.04)';
            tabPagi.style.background = 'transparent';
            tabPagi.style.color = 'var(--ink)';
            tabPagi.style.boxShadow = 'none';
            renderRoutine(dataMalam);
        } else {
            tabPagi.style.background = 'white';
            tabPagi.style.color = '#ab2c5d';
            tabPagi.style.boxShadow = '0 2px 8px rgba(0,0,0,0.04)';
            tabMalam.style.background = 'transparent';
            tabMalam.style.color = 'var(--ink)';
            tabMalam.style.boxShadow = 'none';
            renderRoutine(dataPagi);
        }
    }

    // Default Render awal saat halaman dibuka
    document.addEventListener('DOMContentLoaded', () => {
        renderRoutine(dataPagi);
    });
</script>
@endpush
@endsection
