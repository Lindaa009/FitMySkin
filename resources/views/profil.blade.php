@extends('layouts.app')

@section('title', 'Profil & Preferensi Kulit')
@section('page', 'profil')

@section('content')
<div class="profile-page" style="max-width: 1080px; margin: 0 auto; display: grid; gap: 24px;">

    <!-- KARTU HEADER PROFIL -->
    <div class="profile-header journal-card" style="display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; background: linear-gradient(135deg, #fff0f3 0%, #fff7f5 100%); border-color: #f6e4e6; padding: 28px 32px; border-radius: 28px;">
        <div style="display: flex; align-items: center; gap: 20px;">
            <div style="position: relative;">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&h=150&fit=crop&crop=face" alt="Clara Anindya" style="width: 84px; height: 84px; border-radius: 50%; object-fit: cover; border: 3px solid white; box-shadow: 0 4px 12px rgba(171,44,93,0.15);">
                <div style="position: absolute; bottom: 0; right: 0; background: var(--rose); color: white; width: 26px; height: 26px; border-radius: 50%; display: grid; place-items: center; font-size: 11px; border: 2px solid white;">📷</div>
            </div>
            <div>
                <h1 class="profile-display-name" style="margin: 0; font-size: 22px; font-weight: 800; display: flex; align-items: center; gap: 6px;">
                    Clara Anindya 🌸
                </h1>
                <p class="profile-handle" style="margin: 4px 0 0; color: var(--muted); font-size: 11px;">@clara.FltMySkin • Member FitMySkin sejak Oktober 2026</p>
            </div>
        </div>

        <!-- Statistik Box -->
        <div class="profile-statistics" style="display: grid; grid-template-columns: repeat(4, auto); gap: 12px; background: white; padding: 12px 18px; border-radius: 20px; border: 1px solid var(--line); text-align: center;">
            <div style="padding: 0 10px; border-right: 1px solid var(--line);">
                <span style="display: block; font-size: 16px; font-weight: 800; color: var(--rose);">10</span>
                <span style="font-size: 8px; color: var(--muted); text-transform: uppercase; font-weight: 700;">Total Jurnal</span>
            </div>
            <div style="padding: 0 10px; border-right: 1px solid var(--line);">
                <span id="profile-product-total" style="display: block; font-size: 16px; font-weight: 800; color: var(--ink);">4</span>
                <span style="font-size: 8px; color: var(--muted); text-transform: uppercase; font-weight: 700;">Produk</span>
            </div>
            <div style="padding: 0 10px; border-right: 1px solid var(--line);">
                <span style="display: block; font-size: 16px; font-weight: 800; color: var(--green);">88%</span>
                <span style="font-size: 8px; color: var(--muted); text-transform: uppercase; font-weight: 700;">Barrier Score</span>
            </div>
            <div style="padding: 0 10px;">
                <span style="display: block; font-size: 16px; font-weight: 800; color: var(--rose);">5 ♥</span>
                <span style="font-size: 8px; color: var(--muted); text-transform: uppercase; font-weight: 700;">Streak Aktif</span>
            </div>
        </div>
    </div>

    <!-- GRID FORM (2 KOLOM) -->
    <div class="profile-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: start;">

        <!-- KOLOM KIRI: INFORMASI PERSONAL & RUTINITAS HARIAN -->
        <div style="display: grid; gap: 24px;">
            <!-- Informasi Personal -->
            <div class="journal-card" style="padding: 24px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                    <span style="color: var(--rose); font-size: 16px;">🌸</span>
                    <h2 style="margin: 0; font-size: 15px; font-weight: 800;">Informasi Personal</h2>
                </div>
                <p style="margin: 0 0 16px; color: var(--muted); font-size: 10px;">Detail akun FitMySkin untuk identifikasi catatan & kartu progres.</p>
                
                <div style="display: grid; gap: 12px;">
                    <div class="form-field">
                        <label>Nama Lengkap</label>
                        <div style="position: relative; display: flex; align-items: center;">
                            <input type="text" data-profile-field="fullName" value="Clara Anindya" style="padding-right: 35px;">
                            <span style="position: absolute; right: 12px; font-size: 13px;">🔒</span>
                        </div>
                    </div>
                    <div class="form-field">
                        <label>Nama Panggilan Manis</label>
                        <div style="position: relative; display: flex; align-items: center;">
                            <input type="text" data-profile-field="nickname" value="Clara" style="padding-right: 35px;">
                            <span style="position: absolute; right: 12px; font-size: 11px; color: var(--muted);">✎</span>
                        </div>
                    </div>
                    <div class="form-field">
                        <label>Email Pribadi</label>
                        <div style="position: relative; display: flex; align-items: center;">
                            <input type="email" data-profile-field="email" value="clara.anindya@email.com" style="padding-right: 90px;">
                            <span style="position: absolute; right: 10px; font-size: 9px; font-weight: 700; color: var(--green); background: #eef7f2; padding: 3px 8px; border-radius: 99px;">✓ Terverifikasi</span>
                        </div>
                    </div>
                    <div class="form-field">
                        <label>Nomor WhatsApp (opsional reminder)</label>
                        <input type="tel" data-profile-field="whatsapp" value="+62 812-3456-7890">
                    </div>
                    <div class="form-field">
                        <label>Tanggal Lahir</label>
                        <input type="text" data-profile-field="birthDate" value="05/14/2001">
                    </div>
                </div>
            </div>

            <!-- Rutinitas Harian -->
            <div class="journal-card" style="padding: 24px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: var(--rose);">🌸</span>
                        <h2 style="margin: 0; font-size: 15px; font-weight: 800;">Rutinitas Harian</h2>
                    </div>
                    <!-- Tombol Kelola Langkah ke Halaman Baru -->
                    <a href="{{ route('profil.langkah') }}" style="color: var(--rose); font-size: 10px; font-weight: 800; text-decoration: none;">Kelola Langkah →</a>
                </div>

                <div class="profile-routine-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div style="background: var(--rose-pale); border: 1px solid #f7d5de; padding: 16px; border-radius: 18px; text-align: center;">
                        <div style="width: 32px; height: 32px; background: white; border-radius: 50%; display: grid; place-items: center; margin: 0 auto 6px; font-size: 14px;">☀️</div>
                        <h3 style="margin: 0; font-size: 12px; font-weight: 800; color: var(--ink);">Pagi Hari</h3>
                        <p style="margin: 2px 0 6px; font-size: 9px; color: var(--muted); font-weight: 700;">5 Langkah Aktif</p>
                        <span style="font-size: 8px; color: var(--rose); font-weight: 700; display: block; line-height: 1.3;">Facial Wash • Toner • Serum • Moist • Sunscreen</span>
                    </div>

                    <div style="background: #f0f7f4; border: 1px solid #d2e8dc; padding: 16px; border-radius: 18px; text-align: center;">
                        <div style="width: 32px; height: 32px; background: white; border-radius: 50%; display: grid; place-items: center; margin: 0 auto 6px; font-size: 14px;">🌙</div>
                        <h3 style="margin: 0; font-size: 12px; font-weight: 800; color: var(--ink);">Malam Hari</h3>
                        <p style="margin: 2px 0 6px; font-size: 9px; color: var(--muted); font-weight: 700;">4 Langkah Aktif</p>
                        <span style="font-size: 8px; color: var(--green); font-weight: 700; display: block; line-height: 1.3;">Facial Wash • Toner • Serum • Moist</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: TIPE KULIT, MASALAH, & ALERGI -->
        <div style="display: grid; gap: 24px;">
            <!-- Tipe Kulit Utama -->
            <div class="journal-card" style="padding: 24px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                    <span style="color: var(--rose);">🌸</span>
                    <h2 style="margin: 0; font-size: 15px; font-weight: 800;">Tipe Kulit Utama</h2>
                </div>
                <p style="margin: 0 0 16px; color: var(--muted); font-size: 10px;">Pilih tipe kulit yang paling merepresentasikan kondisi wajah harianmu.</p>
                
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px;">
                    <button type="button" class="button button-secondary skin-type-choice" data-skin-type="Normal" aria-pressed="false" style="font-size: 10px; padding: 8px; justify-content: center;">Normal</button>
                    <button type="button" class="button button-secondary skin-type-choice" data-skin-type="Berminyak" aria-pressed="false" style="font-size: 10px; padding: 8px; justify-content: center;">Berminyak</button>
                    <button type="button" class="button button-secondary skin-type-choice" data-skin-type="Kering" aria-pressed="false" style="font-size: 10px; padding: 8px; justify-content: center;">Kering</button>
                    <button type="button" class="button button-secondary skin-type-choice" data-skin-type="Kombinasi" aria-pressed="true" style="font-size: 10px; padding: 8px; justify-content: center;">Kombinasi ✨</button>
                </div>
            </div>

            <!-- Masalah Kulit Dominan -->
            <div class="journal-card" style="padding: 24px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: var(--rose);">🔍</span>
                        <h2 style="margin: 0; font-size: 15px; font-weight: 800;">Masalah Kulit Dominan (Concern)</h2>
                    </div>
                    <span id="concern-count" style="font-size: 9px; font-weight: 800; color: var(--rose);">3 Terpilih</span>
                </div>

                <div id="profile-concerns" data-profile-group="concerns" style="display: flex; flex-wrap: wrap; gap: 8px;">
                    <button type="button" class="profile-choice is-selected" data-profile-value="Pori-pori tersumbat" aria-pressed="true">◎ Pori-pori tersumbat</button>
                    <button type="button" class="profile-choice is-selected" data-profile-value="Kemerahan di area hidung/pipi" aria-pressed="true">◎ Kemerahan di area hidung/pipi</button>
                    <button type="button" class="profile-choice is-selected" data-profile-value="Dehidrasi saat kena AC" aria-pressed="true">◎ Dehidrasi saat kena AC</button>
                    <button type="button" class="profile-add" data-add-profile-item="concerns">+ Tambah Masalah</button>
                </div>
            </div>

            <!-- Riwayat Alergi Bahan Skincare -->
            <div class="journal-card" style="padding: 24px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                    <span style="color: var(--rose);">⛔</span>
                    <h2 style="margin: 0; font-size: 15px; font-weight: 800;">Riwayat Alergi Bahan Skincare</h2>
                </div>
                <p style="margin: 0 0 14px; color: var(--muted); font-size: 10px;">Kami akan memperingatkanmu bila produk baru mengandung bahan-bahan ini!</p>

                <div id="profile-allergies" data-profile-group="allergies" style="display: flex; flex-wrap: wrap; gap: 8px;">
                    <button type="button" class="profile-choice is-selected" data-profile-value="Fragrance / Parfum Sintetis" aria-pressed="true">Fragrance / Parfum Sintetis</button>
                    <button type="button" class="profile-choice is-selected" data-profile-value="Alkohol Denat Keras" aria-pressed="true">Alkohol Denat Keras</button>
                    <button type="button" class="profile-choice is-selected" data-profile-value="Scrub Kasar (Physical)" aria-pressed="true">Scrub Kasar (Physical)</button>
                    <button type="button" class="profile-add" data-add-profile-item="allergies">+ Tambah Bahan Alergi</button>
                </div>
            </div>
        </div>

    </div>

    <!-- TOMBOL AKSI BAWAH -->
    <div class="profile-actions" style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 10px;">
        <!-- Batal Perubahan -> Kembali ke Dashboard -->
        <a href="{{ route('dashboard') }}" class="button button-secondary" style="border-radius: 99px; padding: 0 24px;">Batal Perubahan</a>
        
        <!-- Simpan Perubahan -> Memunculkan Pop-up Notifikasi -->
        <button type="button" id="btn-simpan" class="button button-primary" style="border-radius: 99px; padding: 0 28px; background: var(--rose);">Simpan Profil Cantik ✨</button>
    </div>
    <p id="profile-feedback" role="status" aria-live="polite" hidden style="margin: -16px 0 0; color: var(--rose); font-size: 11px; text-align: right;"></p>

</div>

<dialog class="app-dialog" id="profile-item-dialog" aria-labelledby="profile-item-dialog-title">
    <form class="dialog-card" id="profile-item-form">
        <div class="dialog-heading">
            <div>
                <p class="eyebrow">PREFERENSI KULIT</p>
                <h2 id="profile-item-dialog-title">Tambah pilihan</h2>
            </div>
            <button class="icon-button" type="button" data-close-profile-item aria-label="Tutup">×</button>
        </div>
        <label class="form-field" for="profile-item-input">
            Nama pilihan
            <input id="profile-item-input" type="text" maxlength="80" required>
        </label>
        <div class="dialog-actions">
            <button class="button button-secondary" type="button" data-close-profile-item>Batal</button>
            <button class="button button-primary" type="submit">Tambah pilihan</button>
        </div>
    </form>
</dialog>

<!-- MODAL / POPUP NOTIFIKASI BERHASIL (Sesuai Gambar 1) -->
<div id="modal-sukses" role="dialog" aria-modal="true" aria-labelledby="profile-modal-title" style="display: none; position: fixed; inset: 0; z-index: 100; background: rgba(51, 38, 43, 0.4); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 20px;">
    <div style="background: white; border-radius: 32px; padding: 40px 30px; text-align: center; max-width: 420px; width: 100%; box-shadow: 0 25px 60px rgba(103, 53, 69, 0.25); border: 1px solid var(--line); animation: scaleUp 0.25s ease;">
        
        <!-- Icon Banner Pop-up -->
        <div style="width: 76px; height: 76px; background: linear-gradient(135deg, var(--rose-pale), #f7dfd5); border-radius: 50%; display: grid; place-items: center; margin: 0 auto 20px; font-size: 32px; box-shadow: inset 0 2px 6px rgba(255,255,255,0.8);">
            🎉
        </div>

        <span style="background: #eef7f2; color: var(--green); font-size: 9px; font-weight: 800; letter-spacing: 1px; padding: 4px 14px; border-radius: 99px; text-transform: uppercase; display: inline-block; margin-bottom: 12px;">PROFILE TERSIMPAN</span>
        
        <h2 id="profile-modal-title" style="margin: 0 0 10px; font-size: 22px; font-weight: 800; color: var(--ink); line-height: 1.3;">
            Perubahan profil tersimpan di browser ✨
        </h2>
        
        <p style="margin: 0 0 24px; color: var(--muted); font-size: 11px; line-height: 1.5;">
            Data ini hanya tersimpan di browser pada perangkat ini, belum ke akun atau server.
        </p>

        <button type="button" id="btn-tutup-modal" class="button button-primary" style="width: 100%; background: var(--rose); border-radius: 99px; justify-content: center; padding: 12px 0; font-size: 12px;">
            Kembali ke Profil
        </button>
    </div>
</div>

@push('styles')
<style>
@keyframes scaleUp {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
.profile-choice, .profile-add {
    padding: 6px 12px;
    border: 1px solid #f0e5e2;
    border-radius: 99px;
    color: var(--muted);
    background: white;
    font-size: 10px;
    font-weight: 700;
    cursor: pointer;
}
.profile-choice.is-selected, .skin-type-choice.is-selected {
    border-color: #f7d5de;
    color: var(--rose);
    background: var(--rose-pale);
}
.profile-add { border-style: dashed; color: var(--rose); }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnSimpan = document.getElementById('btn-simpan');
        const modalSukses = document.getElementById('modal-sukses');
        const btnTutupModal = document.getElementById('btn-tutup-modal');
        const feedback = document.getElementById('profile-feedback');
        const concernCount = document.getElementById('concern-count');
        const itemDialog = document.getElementById('profile-item-dialog');
        const itemForm = document.getElementById('profile-item-form');
        const itemInput = document.getElementById('profile-item-input');
        const itemDialogTitle = document.getElementById('profile-item-dialog-title');
        const profileName = document.querySelector('.profile-display-name');
        const profileHandle = document.querySelector('.profile-handle');
        const profileFields = [...document.querySelectorAll('[data-profile-field]')];
        const storageKey = 'fitmyskin-profile';
        const skinTypes = ['Normal', 'Berminyak', 'Kering', 'Kombinasi'];
        let profileOptions = { skinType: 'Kombinasi' };

        const showFeedback = (message) => {
            if (feedback) {
                feedback.textContent = message;
                feedback.hidden = false;
            }
        };

        const setSkinType = (skinType) => {
            profileOptions.skinType = skinType;
            document.querySelectorAll('[data-skin-type]').forEach((button) => {
                const isSelected = button.dataset.skinType === skinType;
                button.classList.toggle('is-selected', isSelected);
                button.setAttribute('aria-pressed', String(isSelected));
            });
        };

        const renderProfileGroup = (groupName, values, selectedValues = values) => {
            const group = document.querySelector(`[data-profile-group="${groupName}"]`);
            if (!group) {
                return;
            }

            group.querySelectorAll('[data-profile-value]').forEach((button) => button.remove());
            values.forEach((value) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.dataset.profileValue = value;
                const isSelected = selectedValues.includes(value);
                button.className = `profile-choice${isSelected ? ' is-selected' : ''}`;
                button.setAttribute('aria-pressed', String(isSelected));
                button.textContent = groupName === 'concerns' ? `◎ ${value}` : value;
                group.insertBefore(button, group.querySelector('[data-add-profile-item]'));
            });

            if (groupName === 'concerns' && concernCount) {
                concernCount.textContent = `${selectedValues.length} Terpilih`;
            }
        };

        const readFormProfile = () => ({
            ...Object.fromEntries(profileFields.map((field) => [field.dataset.profileField, field.value.trim()])),
            skinType: profileOptions.skinType,
            concerns: [...document.querySelectorAll('#profile-concerns [data-profile-value]')].map((item) => item.dataset.profileValue),
            selectedConcerns: [...document.querySelectorAll('#profile-concerns [data-profile-value].is-selected')].map((item) => item.dataset.profileValue),
            allergies: [...document.querySelectorAll('#profile-allergies [data-profile-value]')].map((item) => item.dataset.profileValue),
            selectedAllergies: [...document.querySelectorAll('#profile-allergies [data-profile-value].is-selected')].map((item) => item.dataset.profileValue),
        });

        const saveProfile = () => {
            try {
                window.localStorage.setItem(storageKey, JSON.stringify(readFormProfile()));
                return true;
            } catch (error) {
                console.error('Profil lokal tidak dapat disimpan.', error);
                showFeedback('Perubahan belum tersimpan. Periksa penyimpanan browser lalu coba lagi.');
                return false;
            }
        };

        const updateProfileHeader = () => {
            const fullName = document.querySelector('[data-profile-field="fullName"]')?.value.trim();
            const nickname = document.querySelector('[data-profile-field="nickname"]')?.value.trim();

            if (profileName && fullName) {
                profileName.textContent = `${fullName} 🌸`;
            }
            if (profileHandle && nickname) {
                profileHandle.textContent = `@${nickname} • ${profileOptions.skinType} • Member FitMySkin`;
            }
        };

        try {
            const savedProfile = JSON.parse(window.localStorage.getItem(storageKey) || 'null');
            if (savedProfile && typeof savedProfile === 'object' && !Array.isArray(savedProfile)) {
                profileFields.forEach((field) => {
                    const value = savedProfile[field.dataset.profileField];
                    if (typeof value === 'string') {
                        field.value = value;
                    }
                });
                if (skinTypes.includes(savedProfile.skinType)) {
                    setSkinType(savedProfile.skinType);
                }
                if (Array.isArray(savedProfile.concerns) && savedProfile.concerns.every((value) => typeof value === 'string')) {
                    const selected = Array.isArray(savedProfile.selectedConcerns)
                        ? savedProfile.selectedConcerns.filter((value) => savedProfile.concerns.includes(value))
                        : savedProfile.concerns;
                    renderProfileGroup('concerns', savedProfile.concerns, selected);
                }
                if (Array.isArray(savedProfile.allergies) && savedProfile.allergies.every((value) => typeof value === 'string')) {
                    const selected = Array.isArray(savedProfile.selectedAllergies)
                        ? savedProfile.selectedAllergies.filter((value) => savedProfile.allergies.includes(value))
                        : savedProfile.allergies;
                    renderProfileGroup('allergies', savedProfile.allergies, selected);
                }
                updateProfileHeader();
            }
            const products = JSON.parse(window.localStorage.getItem('fitmyskin.products.v1') || 'null');
            if (Array.isArray(products) && products.every((product) => product && typeof product.name === 'string')) {
                document.getElementById('profile-product-total').textContent = String(products.length);
            }
        } catch (error) {
            console.error('Profil lokal tidak dapat dibaca.', error);
            showFeedback('Data profil tersimpan tidak dapat dibaca dari browser ini.');
        }

        document.querySelectorAll('[data-skin-type]').forEach((button) => {
            button.addEventListener('click', () => {
                setSkinType(button.dataset.skinType);
                updateProfileHeader();
                if (saveProfile()) {
                    showFeedback(`Tipe kulit ${button.dataset.skinType} tersimpan di browser ini.`);
                }
            });
        });

        document.querySelectorAll('[data-profile-group]').forEach((group) => {
            group.addEventListener('click', (event) => {
                const button = event.target.closest('[data-profile-value]');
                if (!button) {
                    return;
                }

                button.classList.toggle('is-selected');
                button.setAttribute('aria-pressed', String(button.classList.contains('is-selected')));
                if (group.id === 'profile-concerns' && concernCount) {
                    concernCount.textContent = `${group.querySelectorAll('[data-profile-value].is-selected').length} Terpilih`;
                }
                if (saveProfile()) {
                    showFeedback('Pilihan profil tersimpan di browser ini.');
                }
            });
        });

        let activeProfileGroup = null;
        let activeAddButton = null;

        document.querySelectorAll('[data-add-profile-item]').forEach((button) => {
            button.addEventListener('click', () => {
                activeProfileGroup = button.dataset.addProfileItem;
                activeAddButton = button;
                itemDialogTitle.textContent = activeProfileGroup === 'concerns' ? 'Tambah masalah kulit' : 'Tambah bahan alergi';
                itemInput.value = '';
                itemDialog.showModal();
                itemInput.focus();
            });
        });

        document.querySelectorAll('[data-close-profile-item]').forEach((button) => {
            button.addEventListener('click', () => itemDialog.close());
        });

        itemForm?.addEventListener('submit', (event) => {
            event.preventDefault();
            const newValue = itemInput.value.trim();
            if (!newValue) {
                itemInput.reportValidity();
                return;
            }

            const currentValues = [...document.querySelectorAll(`#profile-${activeProfileGroup} [data-profile-value]`)].map((item) => item.dataset.profileValue);
            if (currentValues.some((item) => item.toLocaleLowerCase('id') === newValue.toLocaleLowerCase('id'))) {
                showFeedback('Pilihan tersebut sudah ada.');
                itemInput.focus();
                return;
            }

            renderProfileGroup(activeProfileGroup, [...currentValues, newValue]);
            if (saveProfile()) {
                showFeedback('Pilihan baru tersimpan di browser ini.');
                itemDialog.close();
                activeAddButton?.focus();
            }
        });

        itemDialog?.addEventListener('click', (event) => {
            if (event.target === itemDialog) {
                itemDialog.close();
                activeAddButton?.focus();
            }
        });

        if (btnSimpan && modalSukses) {
            btnSimpan.addEventListener('click', () => {
                const emailField = document.querySelector('[data-profile-field="email"]');
                if (emailField && !emailField.reportValidity()) {
                    return;
                }

                if (!saveProfile()) {
                    return;
                }

                updateProfileHeader();
                modalSukses.style.display = 'flex';
                btnTutupModal?.focus();
            });
        }

        btnTutupModal?.addEventListener('click', () => {
            if (modalSukses) {
                modalSukses.style.display = 'none';
                btnSimpan?.focus();
            }
        });

        modalSukses?.addEventListener('click', (event) => {
            if (event.target === modalSukses) {
                modalSukses.style.display = 'none';
                btnSimpan?.focus();
            }
        });
    });
</script>
@endpush
@endsection
