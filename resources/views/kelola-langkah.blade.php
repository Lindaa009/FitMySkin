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
                <button type="button" id="btn-reset-routine" class="button button-secondary" style="border-radius: 99px; font-size: 11px; padding: 0 18px; background: white; cursor: pointer;">
                    🔄 Reset Default
                </button>
                <!-- Simpan Urutan -> Kembali ke Profil -->
                <button type="button" id="btn-save-routine" class="button button-primary" style="border-radius: 99px; font-size: 11px; padding: 0 22px; background: #ab2c5d; cursor: pointer;">
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
    <div style="display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: start;">

        <!-- KOLOM KIRI: DAFTAR LANGKAH -->
        <div>
            <div style="display: flex; items-center; justify-content: space-between; margin-bottom: 14px;">
                <h2 style="margin: 0; font-size: 14px; font-weight: 800; display: flex; align-items: center; gap: 6px;">
                    ⇅ Urutan Pemakaian 
                    <span style="font-weight: 500; color: var(--muted); font-size: 10px;">(Geser card atau pakai panah ▲▼)</span>
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
                    <select id="add-step-select" style="min-height: 36px; padding: 0 14px; border-radius: 12px; border: 1px solid var(--line); font-size: 10px; background: white; outline: none; cursor: pointer;">
                        <option value="">Pilih Jenis Produk</option>

                        <optgroup label="🧼 Pembersih (Cleansing)">
                            <option value="Micellar Water">Micellar Water</option>
                            <option value="Cleansing Oil">Cleansing Oil</option>
                            <option value="Facial Wash">Facial Wash</option>
                        </optgroup>

                        <optgroup label="💧 Penyeimbang (Prep)">
                            <option value="Toner">Toner</option>
                            <option value="Exfoliating Toner">Exfoliating Toner</option>
                            <option value="Essence">Essence</option>
                        </optgroup>

                        <optgroup label="✨ Perawatan Khusus (Treatment)">
                            <option value="Serum">Serum</option>
                            <option value="Ampoule">Ampoule</option>
                            <option value="Eye Cream">Eye Cream</option>
                            <option value="Spot Treatment">Spot Treatment</option>
                        </optgroup>

                        <optgroup label="☁ Pelembap (Moisture Lock)">
                            <option value="Moisturizer">Moisturizer</option>
                            <option value="Facial Oil">Facial Oil</option>
                        </optgroup>

                        <optgroup label="🌙 Perawatan Ekstra (Malam)">
                            <option value="Sleeping Mask">Sleeping Mask</option>
                            <option value="Sheet Mask">Sheet Mask</option>
                        </optgroup>

                        <optgroup label="☀ Pelindung (Day)">
                            <option value="Sunscreen">Sunscreen</option>
                        </optgroup>
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
        function showConfirm(message, onConfirm, options = {}) {
        const modal = document.getElementById('confirm-modal');
        if (!modal) {
            if (window.confirm(message)) onConfirm();
            return;
        }

        const title = options.title || 'Konfirmasi';
        const icon = options.icon || '⚠️';
        const okText = options.okText || 'Ya, Lanjutkan';

        document.getElementById('confirm-title').textContent = title;
        document.getElementById('confirm-message').textContent = message;
        document.getElementById('confirm-icon').textContent = icon;

        const okBtn = document.getElementById('confirm-ok');
        const cancelBtn = document.getElementById('confirm-cancel');
        okBtn.textContent = okText;

        modal.style.display = 'flex';

        const newOk = okBtn.cloneNode(true);
        const newCancel = cancelBtn.cloneNode(true);
        okBtn.replaceWith(newOk);
        cancelBtn.replaceWith(newCancel);

        const close = () => { modal.style.display = 'none'; };

        newOk.addEventListener('click', () => { close(); onConfirm(); });
        newCancel.addEventListener('click', close);

        modal.addEventListener('click', (e) => {
            if (e.target === modal) close();
        });
    }

    // Data dari server
    let routineData = @json($initialRoutine);
    let currentType = 'pagi';

    // Ambil CSRF
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }

    // Notifikasi pakai toast global kalau ada
    function showToast(msg) {
        const toast = document.querySelector('#app-toast');
        if (toast) {
            toast.textContent = msg;
            toast.classList.add('is-visible');
            setTimeout(() => toast.classList.remove('is-visible'), 3000);
        } else {
            alert(msg);
        }
    }

    // Render daftar langkah
    function renderRoutine(type) {
        const container = document.getElementById('routine-list');
        if (!container) return;
        const items = routineData[type] || [];

        if (items.length === 0) {
            container.innerHTML = `
                <div style="text-align: center; padding: 32px; color: var(--muted); font-size: 11px;">
                    Belum ada langkah untuk rutinitas ${type}. Tambahkan langkah baru di bawah.
                </div>
            `;
            return;
        }

        container.innerHTML = items.map((item, index) => `
            <div class="journal-card routine-item" 
                draggable="true" 
                data-index="${index}"
                style="padding: 16px 20px; border-radius: 18px; display: flex; align-items: center; justify-content: space-between; gap: 12px; cursor: grab; transition: opacity 0.2s, transform 0.2s;">
                <div style="display: flex; align-items: center; gap: 14px;">
                    <span style="color: #c4b5b9; font-size: 14px; cursor: grab;" title="Geser untuk ubah urutan">⋮⋮</span>
                    <span style="background: #fdf2f4; color: #ab2c5d; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; font-size: 10px; font-weight: 800;">
                        ${String(index + 1).padStart(2, '0')}
                    </span>
                    <div>
                        <h3 style="margin: 0; font-size: 13px; font-weight: 800; color: var(--ink);">${item.title}</h3>
                        <p style="margin: 2px 0 0; font-size: 9px; color: var(--muted); font-weight: 600;">${item.desc || ''}</p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 12px; color: var(--muted);">
                    <button type="button" data-action="up" data-index="${index}" style="border: none; background: transparent; cursor: pointer; color: var(--muted); font-size: 10px;">▲</button>
                    <button type="button" data-action="down" data-index="${index}" style="border: none; background: transparent; cursor: pointer; color: var(--muted); font-size: 10px;">▼</button>
                    <button type="button" data-action="delete" data-index="${index}" style="border: none; background: transparent; cursor: pointer; color: var(--muted); font-size: 12px;">🗑️</button>
                </div>
            </div>
        `).join('');
         
                // Update dropdown: disable opsi yang udah ada di list
        const selectEl = document.getElementById('add-step-select');
        if (selectEl) {
            const existing = new Set((routineData[type] || []).map(i => i.title));
            Array.from(selectEl.options).forEach(opt => {
                if (!opt.value) return;
                const isExist = existing.has(opt.value);
                opt.disabled = isExist;
                opt.textContent = isExist ? opt.value + ' (sudah ada)' : opt.value;
            });
            if (selectEl.value && existing.has(selectEl.value)) {
                selectEl.value = '';
            }
        }
        
        // Pasang event listener untuk tombol
        container.querySelectorAll('button[data-action]').forEach(btn => {
            btn.addEventListener('click', () => {
                const action = btn.dataset.action;
                const idx = parseInt(btn.dataset.index);

                if (action === 'up' && idx > 0) {
                    [routineData[type][idx - 1], routineData[type][idx]] = [routineData[type][idx], routineData[type][idx - 1]];
                    renderRoutine(type);
                } else if (action === 'down' && idx < routineData[type].length - 1) {
                    [routineData[type][idx + 1], routineData[type][idx]] = [routineData[type][idx], routineData[type][idx + 1]];
                    renderRoutine(type);
                } else if (action === 'delete') {
                    const itemName = routineData[type][idx]?.title || 'langkah ini';
                    const label = type === 'pagi' ? 'pagi' : 'malam';

                    showConfirm(
                        `Hapus "${itemName}" dari urutan rutinitas ${label}?`,
                        () => {
                            routineData[type].splice(idx, 1);
                            renderRoutine(type);
                            showToast(`🗑️ "${itemName}" dihapus dari urutan.`);
                        },
                        { title: 'Hapus Langkah?', icon: '🗑️', okText: 'Ya, Hapus' }
                    );
                }
            });
        });
        // Drag & Drop handler
        let dragSrcIndex = null;

        container.querySelectorAll('.routine-item').forEach(el => {
            el.addEventListener('dragstart', (e) => {
                dragSrcIndex = parseInt(el.dataset.index);
                el.style.opacity = '0.4';
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/plain', dragSrcIndex);
            });

            el.addEventListener('dragend', () => {
                el.style.opacity = '1';
                container.querySelectorAll('.routine-item').forEach(x => {
                    x.style.borderTop = '';
                    x.style.borderBottom = '';
                });
            });

            el.addEventListener('dragover', (e) => {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'move';
                const targetIndex = parseInt(el.dataset.index);
                if (targetIndex === dragSrcIndex) return;

                // Visual: kasih garis atas kalau mau taruh sebelum
                container.querySelectorAll('.routine-item').forEach(x => {
                    x.style.borderTop = '';
                    x.style.borderBottom = '';
                });
                el.style.borderTop = '3px solid var(--rose)';
            });

            el.addEventListener('dragleave', () => {
                el.style.borderTop = '';
            });

            el.addEventListener('drop', (e) => {
                e.preventDefault();
                const targetIndex = parseInt(el.dataset.index);
                if (targetIndex === dragSrcIndex || dragSrcIndex === null) return;

                // Geser item
                const moved = routineData[type].splice(dragSrcIndex, 1)[0];
                routineData[type].splice(targetIndex, 0, moved);
                dragSrcIndex = null;
                renderRoutine(type);
            });
        });
    }

    // Tab switching
    function switchRoutine(type) {
        currentType = type;
        const tabPagi = document.getElementById('tab-pagi');
        const tabMalam = document.getElementById('tab-malam');

        if (type === 'malam') {
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
        renderRoutine(type);
    }

    // Tambah langkah
    function setupAddStep() {
        const select = document.getElementById('add-step-select');
        if (!select) return;

        let sisipkanBtn = null;
        document.querySelectorAll('button').forEach(b => {
            if (b.textContent.includes('Sisipkan')) sisipkanBtn = b;
        });
        if (!sisipkanBtn) return;

        sisipkanBtn.addEventListener('click', () => {
            const val = select.value;
            if (!val) {
                showToast('Pilih jenis produk dulu.');
                return;
            }

            // Guard: cek duplikat
            const existing = new Set((routineData[currentType] || []).map(i => i.title));
            if (existing.has(val)) {
                showToast('⚠️ "' + val + '" sudah ada di urutan. Pilih yang lain.');
                return;
            }

            routineData[currentType].push({
                title: val,
                desc: `Langkah ${routineData[currentType].length + 1}: ${val}`
            });
            select.value = '';
            renderRoutine(currentType);
        });
    }

    // Save routine
    function setupSave() {
        const btn = document.getElementById('btn-save-routine');
        if (!btn) return;

        btn.addEventListener('click', async () => {
            try {
                btn.disabled = true;
                btn.textContent = 'Menyimpan...';

                const res = await fetch('/routines', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken(),
                    },
                    body: JSON.stringify({
                        pagi: routineData.pagi,
                        malam: routineData.malam,
                    }),
                });

                if (!res.ok) {
                    const err = await res.json().catch(() => ({}));
                    throw new Error(err.message || 'Gagal menyimpan.');
                }

                showToast('✅ Urutan rutinitas berhasil disimpan.');
                btn.textContent = '✨ Simpan Urutan ✨';
                btn.disabled = false;
            } catch (e) {
                console.error(e);
                showToast('❌ Gagal menyimpan: ' + e.message);
                btn.textContent = '✨ Simpan Urutan ✨';
                btn.disabled = false;
            }
        });
    }

    // Reset ke default
    function setupReset() {
        const btn = document.getElementById('btn-reset-routine');
        if (!btn) return;

        btn.addEventListener('click', () => {
            const doReset = () => {
                routineData.pagi = [
                    { title: 'Facial Wash', desc: 'Langkah 1: Pembersih' },
                    { title: 'Toner', desc: 'Langkah 2: Penyeimbang' },
                    { title: 'Serum', desc: 'Langkah 3: Perawatan Khusus' },
                    { title: 'Moisturizer', desc: 'Langkah 4: Pengunci' },
                    { title: 'Sunscreen', desc: 'Langkah 5: Perlindungan Terluar' },
                ];
                routineData.malam = [
                    { title: 'Facial Wash', desc: 'Langkah 1: Pembersih' },
                    { title: 'Toner', desc: 'Langkah 2: Penyeimbang' },
                    { title: 'Serum', desc: 'Langkah 3: Perawatan Khusus' },
                    { title: 'Moisturizer', desc: 'Langkah 4: Pengunci' },
                ];
                renderRoutine(currentType);
                showToast('🔄 Urutan direset ke default. Jangan lupa klik Simpan.');
            };

            if (typeof window.showConfirm === 'function') {
                window.showConfirm(
                    'Reset urutan ke pengaturan default? Perubahan yang belum disimpan akan hilang.',
                    doReset,
                    { title: 'Reset ke Default?', icon: '🔄', okText: 'Ya, Reset' }
                );
            } else {
                if (window.confirm('Reset urutan ke pengaturan default? Perubahan yang belum disimpan akan hilang.')) {
                    doReset();
                }
            }
        });
    }

    // Init
    document.addEventListener('DOMContentLoaded', () => {
        renderRoutine('pagi');
        setupAddStep();
        setupSave();
        setupReset();
    });
</script>
@endpush
@endsection
