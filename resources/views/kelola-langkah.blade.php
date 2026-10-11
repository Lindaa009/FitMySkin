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
                <button type="button" id="reset-routine" class="button button-secondary" style="border-radius: 99px; font-size: 11px; padding: 0 18px; background: white;">
                    🔄 Reset Default
                </button>
                <!-- Simpan Urutan -> Kembali ke Profil -->
                <button type="button" id="save-routine" data-profile-url="{{ route('profil') }}" class="button button-primary" style="border-radius: 99px; font-size: 11px; padding: 0 22px; background: #ab2c5d;">
                    ✨ Simpan Urutan ✨
                </button>
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
    <div class="routine-layout" style="display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: start;">

        <!-- KOLOM KIRI: DAFTAR LANGKAH -->
        <div>
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
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
                    <select id="routine-step-type" aria-label="Pilih jenis langkah skincare" style="min-height: 36px; padding: 0 14px; border-radius: 12px; border: 1px solid var(--line); font-size: 10px; background: white; outline: none; cursor: pointer;">
                        <option value="">Pilih Jenis Produk</option>
                        <option value="Micellar Water">Micellar Water</option>
                        <option value="Exfoliating Toner">Exfoliating Toner</option>
                        <option value="Eye Cream">Eye Cream</option>
                        <option value="Sleeping Mask">Sleeping Mask</option>
                    </select>
                    <button type="button" id="insert-routine-step" class="button button-primary" style="background: #ef6b94; font-size: 10px; height: 36px; padding: 0 16px; border-radius: 12px;">
                        + Sisipkan
                    </button>
                </div>
            </div>
            <p id="routine-feedback" role="status" aria-live="polite" style="margin: 8px 0 0; color: var(--rose); font-size: 10px;"></p>
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
    const routineStorageKey = 'fitmyskin.routines.v1';
    const defaultRoutines = {
        pagi: [
            'Facial Wash',
            'Toner',
            'Serum',
            'Moisturizer',
            'Sunscreen',
        ],
        malam: [
            'Facial Wash',
            'Toner',
            'Serum',
            'Moisturizer',
        ],
    };
    const routineDescriptions = {
        'Facial Wash': 'Pembersih',
        'Micellar Water': 'Pembersih awal',
        'Toner': 'Penyeimbang',
        'Exfoliating Toner': 'Eksfoliasi',
        'Serum': 'Perawatan khusus',
        'Eye Cream': 'Perawatan area mata',
        'Moisturizer': 'Pengunci kelembapan',
        'Sleeping Mask': 'Perawatan malam',
        'Sunscreen': 'Perlindungan terluar',
    };
    let routines = JSON.parse(JSON.stringify(defaultRoutines));
    let activeRoutine = 'pagi';

    const routineFeedback = document.getElementById('routine-feedback');

    function showRoutineFeedback(message) {
        if (routineFeedback) {
            routineFeedback.textContent = message;
        }
    }

    function loadRoutines() {
        try {
            const savedRoutines = JSON.parse(window.localStorage.getItem(routineStorageKey) || 'null');
            if (savedRoutines === null) {
                return;
            }
            if (!savedRoutines || !['pagi', 'malam'].every((type) =>
                Array.isArray(savedRoutines[type]) && savedRoutines[type].every((step) => typeof step === 'string')
            )) {
                throw new Error('Format rutinitas tidak sesuai.');
            }
            routines = savedRoutines;
        } catch (error) {
            console.error('Rutinitas lokal tidak dapat dibaca.', error);
            showRoutineFeedback('Rutinitas tersimpan tidak dapat dibaca. Gunakan Reset Default untuk memulai lagi.');
        }
    }

    function saveRoutines() {
        try {
            window.localStorage.setItem(routineStorageKey, JSON.stringify(routines));
            showRoutineFeedback('Perubahan rutinitas tersimpan di browser ini.');
            return true;
        } catch (error) {
            console.error('Rutinitas lokal tidak dapat disimpan.', error);
            showRoutineFeedback('Perubahan belum tersimpan. Periksa penyimpanan browser lalu coba lagi.');
            return false;
        }
    }

    function renderRoutine() {
        const container = document.getElementById('routine-list');
        if (!container) return;

        container.replaceChildren();
        routines[activeRoutine].forEach((title, index) => {
            const card = document.createElement('div');
            card.className = 'journal-card';
            card.style.cssText = 'padding: 16px 20px; border-radius: 18px; display: flex; align-items: center; justify-content: space-between; gap: 12px;';

            const description = document.createElement('div');
            description.style.cssText = 'display: flex; align-items: center; gap: 14px;';
            const stepNumber = String(index + 1).padStart(2, '0');
            const number = document.createElement('span');
            number.textContent = stepNumber;
            number.style.cssText = 'background: #fdf2f4; color: #ab2c5d; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; font-size: 10px; font-weight: 800;';
            const text = document.createElement('div');
            const heading = document.createElement('h3');
            heading.textContent = title;
            heading.style.cssText = 'margin: 0; font-size: 13px; font-weight: 800; color: var(--ink);';
            const detail = document.createElement('p');
            detail.textContent = `Langkah ${index + 1}: ${routineDescriptions[title] || 'Perawatan kulit'}`;
            detail.style.cssText = 'margin: 2px 0 0; font-size: 9px; color: var(--muted); font-weight: 600;';
            text.append(heading, detail);
            description.append(number, text);

            const actions = document.createElement('div');
            actions.style.cssText = 'display: flex; align-items: center; gap: 12px; color: var(--muted);';
            [
                { action: 'up', label: '▲', description: `Pindahkan ${title} ke atas` },
                { action: 'down', label: '▼', description: `Pindahkan ${title} ke bawah` },
                { action: 'remove', label: '🗑️', description: `Hapus ${title} dari rutinitas` },
            ].forEach(({ action, label, description: ariaLabel }) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.dataset.routineAction = action;
                button.dataset.index = String(index);
                button.setAttribute('aria-label', ariaLabel);
                button.textContent = label;
                button.style.cssText = 'border: none; background: transparent; cursor: pointer; color: var(--muted); font-size: 12px;';
                actions.append(button);
            });
            card.append(description, actions);
            container.append(card);
        });

        if (routines[activeRoutine].length === 0) {
            const empty = document.createElement('p');
            empty.textContent = 'Belum ada langkah. Pilih jenis produk untuk menambahkannya.';
            empty.style.color = 'var(--muted)';
            container.append(empty);
        }
    }

    function switchRoutine(type) {
        const tabPagi = document.getElementById('tab-pagi');
        const tabMalam = document.getElementById('tab-malam');
        activeRoutine = type === 'malam' ? 'malam' : 'pagi';

        if (activeRoutine === 'malam') {
            tabMalam.style.background = 'white';
            tabMalam.style.color = '#ab2c5d';
            tabMalam.style.boxShadow = '0 2px 8px rgba(0,0,0,0.04)';
            tabPagi.style.background = 'transparent';
            tabPagi.style.color = 'var(--ink)';
            tabPagi.style.boxShadow = 'none';
        } else {
            tabPagi.style.background = 'white';
            tabPagi.style.color = '#ab2c5d';
            tabPagi.style.boxShadow = '0 2px 8px rgba(0,0,0,0.04)';
            tabMalam.style.background = 'transparent';
            tabMalam.style.color = 'var(--ink)';
            tabMalam.style.boxShadow = 'none';
        }
        renderRoutine();
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadRoutines();
        renderRoutine();

        document.getElementById('routine-list')?.addEventListener('click', (event) => {
            const button = event.target.closest('[data-routine-action]');
            if (!button) {
                return;
            }
            const index = Number(button.dataset.index);
            const items = routines[activeRoutine];
            const action = button.dataset.routineAction;

            if (action === 'remove') {
                items.splice(index, 1);
            } else {
                const targetIndex = action === 'up' ? index - 1 : index + 1;
                if (targetIndex < 0 || targetIndex >= items.length) {
                    return;
                }
                [items[index], items[targetIndex]] = [items[targetIndex], items[index]];
            }

            renderRoutine();
            saveRoutines();
        });

        document.getElementById('insert-routine-step')?.addEventListener('click', () => {
            const select = document.getElementById('routine-step-type');
            const value = select.value;
            if (!value) {
                showRoutineFeedback('Pilih jenis langkah yang ingin disisipkan.');
                select.focus();
                return;
            }

            routines[activeRoutine].push(value);
            select.value = '';
            renderRoutine();
            saveRoutines();
        });

        document.getElementById('reset-routine')?.addEventListener('click', () => {
            routines = JSON.parse(JSON.stringify(defaultRoutines));
            renderRoutine();
            saveRoutines();
        });

        document.getElementById('save-routine')?.addEventListener('click', (event) => {
            if (saveRoutines()) {
                window.location.assign(event.currentTarget.dataset.profileUrl);
            }
        });
    });
</script>
@endpush
@endsection
