@extends('layouts.app')

@section('title', 'Profil & Preferensi Kulit')
@section('page', 'profil')

@section('content')
<div style="max-width: 1080px; margin: 0 auto; display: grid; gap: 24px;">

    <!-- KARTU HEADER PROFIL -->
    <div class="journal-card" style="display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; background: linear-gradient(135deg, #fff0f3 0%, #fff7f5 100%); border-color: #f6e4e6; padding: 28px 32px; border-radius: 28px;">
        <div style="display: flex; align-items: center; gap: 20px;">
            <div style="position: relative;">
                <div style="width: 84px; height: 84px; border-radius: 50%; background: var(--rose); color: white; display: grid; place-items: center; font-size: 32px; font-weight: 800; border: 3px solid white; box-shadow: 0 4px 12px rgba(171,44,93,0.15);">
                    {{ strtoupper(substr(auth()->user()->nama_user ?? 'U', 0, 1)) }}
                </div>
            </div>
            <div>
                <h1 style="margin: 0; font-size: 22px; font-weight: 800; display: flex; align-items: center; gap: 6px;">
                    {{ auth()->user()->nama_user ?? 'User' }} 🌸
                </h1>
                <p style="margin: 4px 0 0; color: var(--muted); font-size: 11px;">{{ auth()->user()->alamat_email }} • Member FitMySkin</p>
            </div>
        </div>

        <!-- Statistik Box -->
        <div style="display: grid; grid-template-columns: repeat(3, auto); gap: 12px; background: white; padding: 12px 18px; border-radius: 20px; border: 1px solid var(--line); text-align: center;">
            <div style="padding: 0 10px; border-right: 1px solid var(--line);">
                <span style="display: block; font-size: 16px; font-weight: 800; color: var(--rose);">{{ $totalJurnal }}</span>
                <span style="font-size: 8px; color: var(--muted); text-transform: uppercase; font-weight: 700;">Total Jurnal</span>
            </div>
            <div style="padding: 0 10px; border-right: 1px solid var(--line);">
                <span style="display: block; font-size: 16px; font-weight: 800; color: var(--ink);">{{ $totalProduk }}</span>
                <span style="font-size: 8px; color: var(--muted); text-transform: uppercase; font-weight: 700;">Produk</span>
            </div>
            <div style="padding: 0 10px;">
                <span style="display: block; font-size: 16px; font-weight: 800; color: var(--rose);">{{ $streak }} ♥</span>
                <span style="font-size: 8px; color: var(--muted); text-transform: uppercase; font-weight: 700;">Streak Aktif</span>
            </div>
        </div>
    </div>

    <!-- GRID FORM -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: start;">

        <!-- KOLOM KIRI: INFORMASI PERSONAL & RUTINITAS -->
        <div style="display: grid; gap: 24px;">

            <!-- Informasi Personal (Bisa Di-Edit) -->
            <div class="journal-card" style="padding: 24px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                    <span style="color: var(--rose); font-size: 16px;">🌸</span>
                    <h2 style="margin: 0; font-size: 15px; font-weight: 800;">Informasi Personal</h2>
                </div>
                <p style="margin: 0 0 16px; color: var(--muted); font-size: 10px;">Ubah data akun FitMySkin kamu.</p>

                <div style="display: grid; gap: 12px;">
                    <div class="form-field">
                        <label>Nama Lengkap</label>
                        <input type="text" id="input-nama" value="{{ auth()->user()->nama_user }}" maxlength="100">
                    </div>
                    <div class="form-field">
                        <label>Email Pribadi</label>
                        <input type="email" id="input-email" value="{{ auth()->user()->alamat_email }}" maxlength="100">
                    </div>
                </div>

                <hr style="border: none; border-top: 1px solid var(--line); margin: 20px 0 16px;">

                <h3 style="margin: 0 0 12px; font-size: 13px; font-weight: 800; color: var(--ink);">🔐 Ganti Password</h3>
                <div style="display: grid; gap: 12px;">
                    <div class="form-field">
                        <label>Password Lama</label>
                        <input type="password" id="input-pass-lama" placeholder="Masukkan password saat ini">
                    </div>
                    <div class="form-field">
                        <label>Password Baru</label>
                        <input type="password" id="input-pass-baru" placeholder="Minimal 6 karakter">
                    </div>
                    <div class="form-field">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" id="input-pass-konfirm" placeholder="Ulangi password baru">
                    </div>
                    <button type="button" id="btn-ganti-pass" class="button button-secondary" style="font-size: 11px; border-radius: 99px;">🔐 Update Password</button>
                </div>
            </div>

            <!-- Rutinitas Harian (Read-Only) -->
            <div class="journal-card" style="padding: 24px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: var(--rose);">🌸</span>
                        <h2 style="margin: 0; font-size: 15px; font-weight: 800;">Rutinitas Harian</h2>
                    </div>
                    <a href="{{ route('profil.langkah') }}" style="color: var(--rose); font-size: 10px; font-weight: 800; text-decoration: none;">Kelola Langkah →</a>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div style="background: var(--rose-pale); border: 1px solid #f7d5de; padding: 16px; border-radius: 18px; text-align: center;">
                        <div style="width: 32px; height: 32px; background: white; border-radius: 50%; display: grid; place-items: center; margin: 0 auto 6px; font-size: 14px;">☀️</div>
                        <h3 style="margin: 0; font-size: 12px; font-weight: 800; color: var(--ink);">Pagi Hari</h3>
                        <p style="margin: 2px 0 6px; font-size: 9px; color: var(--muted); font-weight: 700;">{{ count($pagi) }} Langkah Aktif</p>
                        <span style="font-size: 8px; color: var(--rose); font-weight: 700; display: block; line-height: 1.3;">{{ collect($pagi)->pluck('title')->implode(' • ') }}</span>
                    </div>

                    <div style="background: #f0f7f4; border: 1px solid #d2e8dc; padding: 16px; border-radius: 18px; text-align: center;">
                        <div style="width: 32px; height: 32px; background: white; border-radius: 50%; display: grid; place-items: center; margin: 0 auto 6px; font-size: 14px;">🌙</div>
                        <h3 style="margin: 0; font-size: 12px; font-weight: 800; color: var(--ink);">Malam Hari</h3>
                        <p style="margin: 2px 0 6px; font-size: 9px; color: var(--muted); font-weight: 700;">{{ count($malam) }} Langkah Aktif</p>
                        <span style="font-size: 8px; color: var(--green); font-weight: 700; display: block; line-height: 1.3;">{{ collect($malam)->pluck('title')->implode(' • ') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN -->
        <div style="display: grid; gap: 24px;">
            <div class="journal-card" style="padding: 24px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                    <span style="color: var(--rose);">🌸</span>
                    <h2 style="margin: 0; font-size: 15px; font-weight: 800;">Tipe Kulit Utama</h2>
                </div>
                <p style="margin: 0 0 16px; color: var(--muted); font-size: 10px;">Fitur ini akan aktif setelah kolom tipe_kulit ditambahkan ke database.</p>

                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; opacity: 0.5;">
                    <button type="button" class="button button-secondary" disabled style="font-size: 10px; padding: 8px; justify-content: center; cursor: not-allowed;">Normal</button>
                    <button type="button" class="button button-secondary" disabled style="font-size: 10px; padding: 8px; justify-content: center; cursor: not-allowed;">Berminyak</button>
                    <button type="button" class="button button-secondary" disabled style="font-size: 10px; padding: 8px; justify-content: center; cursor: not-allowed;">Kering</button>
                    <button type="button" class="button button-secondary" disabled style="font-size: 10px; padding: 8px; justify-content: center; cursor: not-allowed;">Kombinasi</button>
                </div>
            </div>

            <div class="journal-card" style="padding: 24px; opacity: 0.6;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                    <span style="color: var(--rose);">🔍</span>
                    <h2 style="margin: 0; font-size: 15px; font-weight: 800;">Masalah Kulit Dominan</h2>
                </div>
                <p style="font-size: 10px; color: var(--muted); margin: 0;">🚧 Fitur ini akan tersedia di update selanjutnya.</p>
            </div>

            <div class="journal-card" style="padding: 24px; opacity: 0.6;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                    <span style="color: var(--rose);">⛔</span>
                    <h2 style="margin: 0; font-size: 15px; font-weight: 800;">Riwayat Alergi Bahan</h2>
                </div>
                <p style="font-size: 10px; color: var(--muted); margin: 0;">🚧 Fitur ini akan tersedia di update selanjutnya.</p>
            </div>
        </div>

    </div>

    <!-- TOMBOL AKSI BAWAH -->
    <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 10px;">
        <a href="{{ route('dashboard') }}" class="button button-secondary" style="border-radius: 99px; padding: 0 24px;">Batal Perubahan</a>
        <button type="button" id="btn-simpan" class="button button-primary" style="border-radius: 99px; padding: 0 28px; background: var(--rose);">Simpan Profil Cantik ✨</button>
    </div>

</div>

<!-- MODAL SUKSES -->
<div id="modal-sukses" style="display: none; position: fixed; inset: 0; z-index: 100; background: rgba(51, 38, 43, 0.4); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 20px;">
    <div style="background: white; border-radius: 32px; padding: 40px 30px; text-align: center; max-width: 420px; width: 100%; box-shadow: 0 25px 60px rgba(103, 53, 69, 0.25); border: 1px solid var(--line); animation: scaleUp 0.25s ease;">
        <div style="width: 76px; height: 76px; background: linear-gradient(135deg, var(--rose-pale), #f7dfd5); border-radius: 50%; display: grid; place-items: center; margin: 0 auto 20px; font-size: 32px;">🎉</div>
        <span style="background: #eef7f2; color: var(--green); font-size: 9px; font-weight: 800; letter-spacing: 1px; padding: 4px 14px; border-radius: 99px; text-transform: uppercase; display: inline-block; margin-bottom: 12px;">PROFILE TERSIMPAN</span>
        <h2 style="margin: 0 0 10px; font-size: 22px; font-weight: 800; color: var(--ink); line-height: 1.3;">Hore, Profile Berhasil Disimpan! 🥳✨</h2>
        <p style="margin: 0 0 24px; color: var(--muted); font-size: 11px; line-height: 1.5;">
            Data profil kamu berhasil diperbarui. Semangat memulai jurnal baru bersama FitMySkin!
        </p>
        <a href="{{ route('dashboard') }}" class="button button-primary" style="width: 100%; background: var(--rose); border-radius: 99px; justify-content: center; padding: 12px 0; font-size: 12px;">
            Kembali ke Dashboard
        </a>
    </div>
</div>

@push('styles')
<style>
@keyframes scaleUp {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
</style>
@endpush

@push('scripts')
<script>
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }

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

    document.addEventListener('DOMContentLoaded', () => {
        const btnSimpan = document.getElementById('btn-simpan');
        const btnGantiPass = document.getElementById('btn-ganti-pass');
        const modalSukses = document.getElementById('modal-sukses');

        // ==== Simpan Profil (Nama + Email) ====
        if (btnSimpan && modalSukses) {
            btnSimpan.addEventListener('click', async () => {
                const nama = document.getElementById('input-nama').value.trim();
                const email = document.getElementById('input-email').value.trim();

                if (!nama || !email) {
                    showToast('Nama dan email wajib diisi.');
                    return;
                }

                try {
                    btnSimpan.disabled = true;
                    btnSimpan.textContent = 'Menyimpan...';

                    const res = await fetch('/profil', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': getCsrfToken(),
                        },
                        body: JSON.stringify({ nama_user: nama, alamat_email: email }),
                    });

                    if (!res.ok) {
                        const err = await res.json().catch(() => ({}));
                        throw new Error(err.message || 'Gagal menyimpan.');
                    }

                    modalSukses.style.display = 'flex';
                } catch (e) {
                    console.error(e);
                    showToast('❌ ' + e.message);
                } finally {
                    btnSimpan.disabled = false;
                    btnSimpan.textContent = 'Simpan Profil Cantik ✨';
                }
            });
        }

        // ==== Ganti Password ====
        if (btnGantiPass) {
            btnGantiPass.addEventListener('click', async () => {
                const lama = document.getElementById('input-pass-lama').value;
                const baru = document.getElementById('input-pass-baru').value;
                const konfirm = document.getElementById('input-pass-konfirm').value;

                if (!lama || !baru || !konfirm) {
                    showToast('Semua field password wajib diisi.');
                    return;
                }

                if (baru.length < 6) {
                    showToast('Password baru minimal 6 karakter.');
                    return;
                }

                if (baru !== konfirm) {
                    showToast('Konfirmasi password tidak cocok.');
                    return;
                }

                try {
                    btnGantiPass.disabled = true;
                    btnGantiPass.textContent = 'Memproses...';

                    const res = await fetch('/profil/password', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': getCsrfToken(),
                        },
                        body: JSON.stringify({
                            password_lama: lama,
                            password_baru: baru,
                            password_baru_confirmation: konfirm,
                        }),
                    });

                    const data = await res.json().catch(() => ({}));

                    if (!res.ok) {
                        throw new Error(data.message || 'Gagal update password.');
                    }

                    showToast('✅ Password berhasil diubah.');
                    document.getElementById('input-pass-lama').value = '';
                    document.getElementById('input-pass-baru').value = '';
                    document.getElementById('input-pass-konfirm').value = '';
                } catch (e) {
                    console.error(e);
                    showToast('❌ ' + e.message);
                } finally {
                    btnGantiPass.disabled = false;
                    btnGantiPass.textContent = '🔐 Update Password';
                }
            });
        }
    });
</script>
@endpush
@endsection