@extends('layouts.app')

@section('title', 'Profil & Preferensi Kulit')
@section('page', 'profil')

@section('content')
<div style="max-width: 1080px; margin: 0 auto; display: grid; gap: 24px;">

    <!-- KARTU HEADER PROFIL -->
    <div class="journal-card" style="display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; background: linear-gradient(135deg, #fff0f3 0%, #fff7f5 100%); border-color: #f6e4e6; padding: 28px 32px; border-radius: 28px;">
        <div style="display: flex; align-items: center; gap: 20px;">
            <div style="position: relative;">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&h=150&fit=crop&crop=face" alt="Clara Anindya" style="width: 84px; height: 84px; border-radius: 50%; object-fit: cover; border: 3px solid white; box-shadow: 0 4px 12px rgba(171,44,93,0.15);">
                <div style="position: absolute; bottom: 0; right: 0; background: var(--rose); color: white; width: 26px; height: 26px; border-radius: 50%; display: grid; place-items: center; font-size: 11px; border: 2px solid white;">📷</div>
            </div>
            <div>
                <h1 style="margin: 0; font-size: 22px; font-weight: 800; display: flex; align-items: center; gap: 6px;">
                    Clara Anindya 🌸
                </h1>
                <p style="margin: 4px 0 0; color: var(--muted); font-size: 11px;">@clara.FltMySkin • Member FitMySkin sejak Oktober 2026</p>
            </div>
        </div>

        <!-- Statistik Box -->
        <div style="display: grid; grid-template-columns: repeat(4, auto); gap: 12px; background: white; padding: 12px 18px; border-radius: 20px; border: 1px solid var(--line); text-align: center;">
            <div style="padding: 0 10px; border-right: 1px solid var(--line);">
                <span style="display: block; font-size: 16px; font-weight: 800; color: var(--rose);">10</span>
                <span style="font-size: 8px; color: var(--muted); text-transform: uppercase; font-weight: 700;">Total Jurnal</span>
            </div>
            <div style="padding: 0 10px; border-right: 1px solid var(--line);">
                <span style="display: block; font-size: 16px; font-weight: 800; color: var(--ink);">7</span>
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
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: start;">

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
                            <input type="text" value="Clara Anindya" style="padding-right: 35px;">
                            <span style="position: absolute; right: 12px; font-size: 13px;">🔒</span>
                        </div>
                    </div>
                    <div class="form-field">
                        <label>Nama Panggilan Manis</label>
                        <div style="position: relative; display: flex; align-items: center;">
                            <input type="text" value="Clara" style="padding-right: 35px;">
                            <span style="position: absolute; right: 12px; font-size: 11px; color: var(--muted);">✎</span>
                        </div>
                    </div>
                    <div class="form-field">
                        <label>Email Pribadi</label>
                        <div style="position: relative; display: flex; align-items: center;">
                            <input type="email" value="clara.anindya@email.com" style="padding-right: 90px;">
                            <span style="position: absolute; right: 10px; font-size: 9px; font-weight: 700; color: var(--green); background: #eef7f2; padding: 3px 8px; border-radius: 99px;">✓ Terverifikasi</span>
                        </div>
                    </div>
                    <div class="form-field">
                        <label>Nomor WhatsApp (opsional reminder)</label>
                        <input type="text" value="+62 812-3456-7890">
                    </div>
                    <div class="form-field">
                        <label>Tanggal Lahir</label>
                        <input type="text" value="05/14/2001">
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

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
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
                    <button type="button" class="button button-secondary" style="font-size: 10px; padding: 8px; justify-content: center;">Normal</button>
                    <button type="button" class="button button-secondary" style="font-size: 10px; padding: 8px; justify-content: center;">Berminyak</button>
                    <button type="button" class="button button-secondary" style="font-size: 10px; padding: 8px; justify-content: center;">Kering</button>
                    <button type="button" class="button button-primary" style="font-size: 10px; padding: 8px; justify-content: center; background: var(--rose);">Kombinasi ✨</button>
                </div>
            </div>

            <!-- Masalah Kulit Dominan -->
            <div class="journal-card" style="padding: 24px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: var(--rose);">🔍</span>
                        <h2 style="margin: 0; font-size: 15px; font-weight: 800;">Masalah Kulit Dominan (Concern)</h2>
                    </div>
                    <span style="font-size: 9px; font-weight: 800; color: var(--rose);">3 Terpilih</span>
                </div>

                <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                    <span style="background: var(--rose-pale); border: 1px solid #f7d5de; color: var(--rose); padding: 6px 12px; border-radius: 99px; font-size: 10px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">◎ Pori-pori tersumbat</span>
                    <span style="background: var(--rose-pale); border: 1px solid #f7d5de; color: var(--rose); padding: 6px 12px; border-radius: 99px; font-size: 10px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">◎ Kemerahan di area hidung/pipi</span>
                    <span style="background: var(--rose-pale); border: 1px solid #f7d5de; color: var(--rose); padding: 6px 12px; border-radius: 99px; font-size: 10px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">◎ Dehidrasi saat kena AC</span>
                    <span style="background: white; border: 1px dashed var(--line); color: var(--muted); padding: 6px 12px; border-radius: 99px; font-size: 10px; font-weight: 700; cursor: pointer;">+ Tambah Masalah</span>
                </div>
            </div>

            <!-- Riwayat Alergi Bahan Skincare -->
            <div class="journal-card" style="padding: 24px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                    <span style="color: var(--rose);">⛔</span>
                    <h2 style="margin: 0; font-size: 15px; font-weight: 800;">Riwayat Alergi Bahan Skincare</h2>
                </div>
                <p style="margin: 0 0 14px; color: var(--muted); font-size: 10px;">Kami akan memperingatkanmu bila produk baru mengandung bahan-bahan ini!</p>

                <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                    <span style="background: #fdf2f4; border: 1px solid #f7d5de; color: #a33b5c; padding: 6px 12px; border-radius: 99px; font-size: 10px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">Fragrance / Parfum Sintetis ⓧ</span>
                    <span style="background: #fdf2f4; border: 1px solid #f7d5de; color: #a33b5c; padding: 6px 12px; border-radius: 99px; font-size: 10px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">Alkohol Denat Keras ⓧ</span>
                    <span style="background: #fdf2f4; border: 1px solid #f7d5de; color: #a33b5c; padding: 6px 12px; border-radius: 99px; font-size: 10px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">Scrub Kasar (Physical) ⓧ</span>
                    <span style="background: white; border: 1px dashed var(--line); color: var(--rose); padding: 6px 12px; border-radius: 99px; font-size: 10px; font-weight: 700; cursor: pointer;">+ Tambah Bahan Alergi</span>
                </div>
            </div>
        </div>

    </div>

    <!-- TOMBOL AKSI BAWAH -->
    <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 10px;">
        <!-- Batal Perubahan -> Kembali ke Dashboard -->
        <a href="{{ route('dashboard') }}" class="button button-secondary" style="border-radius: 99px; padding: 0 24px;">Batal Perubahan</a>
        
        <!-- Simpan Perubahan -> Memunculkan Pop-up Notifikasi -->
        <button type="button" id="btn-simpan" class="button button-primary" style="border-radius: 99px; padding: 0 28px; background: var(--rose);">Simpan Profil Cantik ✨</button>
    </div>

</div>

<!-- MODAL / POPUP NOTIFIKASI BERHASIL (Sesuai Gambar 1) -->
<div id="modal-sukses" style="display: none; position: fixed; inset: 0; z-index: 100; background: rgba(51, 38, 43, 0.4); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 20px;">
    <div style="background: white; border-radius: 32px; padding: 40px 30px; text-align: center; max-width: 420px; width: 100%; box-shadow: 0 25px 60px rgba(103, 53, 69, 0.25); border: 1px solid var(--line); animation: scaleUp 0.25s ease;">
        
        <!-- Icon Banner Pop-up -->
        <div style="width: 76px; height: 76px; background: linear-gradient(135deg, var(--rose-pale), #f7dfd5); border-radius: 50%; display: grid; place-items: center; margin: 0 auto 20px; font-size: 32px; box-shadow: inset 0 2px 6px rgba(255,255,255,0.8);">
            🎉
        </div>

        <span style="background: #eef7f2; color: var(--green); font-size: 9px; font-weight: 800; letter-spacing: 1px; padding: 4px 14px; border-radius: 99px; text-transform: uppercase; display: inline-block; margin-bottom: 12px;">PROFILE TERSIMPAN</span>
        
        <h2 style="margin: 0 0 10px; font-size: 22px; font-weight: 800; color: var(--ink); line-height: 1.3;">
            Hore, Profile Berhasil Disimpan! 🥳✨
        </h2>
        
        <p style="margin: 0 0 24px; color: var(--muted); font-size: 11px; line-height: 1.5;">
            Selamat Clara, Profile mu berhasil tersimpan semangat memulai jurnal baru bersama FitMySkin
        </p>

        <!-- Tombol Kembali ke Dashboard -->
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
    document.addEventListener('DOMContentLoaded', () => {
        const btnSimpan = document.getElementById('btn-simpan');
        const modalSukses = document.getElementById('modal-sukses');

        if (btnSimpan && modalSukses) {
            btnSimpan.addEventListener('click', () => {
                modalSukses.style.display = 'flex';
            });
        }
    });
</script>
@endpush
@endsection
