<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NotifikasiController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $notifikasi = [];

        // ─── 1. Waspada Breakout ───
        $warning = $this->cekPemakaianBerturut($userId);
        if ($warning) {
            $notifikasi[] = $warning;
        }

        // ─── 2. Ritual Malam ───
        $sudahIsiMalam = Journal::where('id_user', $userId)
            ->whereDate('tanggal_pemakaian', Carbon::today())
            ->where('jadwal_pemakaian', 'Malam')
            ->exists();

        if (!$sudahIsiMalam) {
            $notifikasi[] = [
                'tipe' => 'ritual',
                'icon' => '🌙',
                'label' => 'RITUAL MALAM',
                'waktu' => 'Belum diisi',
                'judul' => 'Waktunya Ritual Skincare Malam! 💖',
                'pesan' => 'Pukul 21:00 WIB. Kulitmu butuh nutrisi sebelum tidur pulas. Yuk catat jurnal malam sekarang!',
                'aksi_link' => route('jurnal.malam'),
                'aksi_text' => 'Buka Jurnal Sekarang →',
                'aksi_style' => 'primary',
            ];
        }

        // ─── 3. Streak Booster ───
        $streak = $this->hitungStreak($userId);
        if ($streak > 0) {
            $notifikasi[] = [
                'tipe' => 'streak',
                'icon' => '🔥',
                'label' => 'STREAK BOOSTER',
                'waktu' => 'Hari Ini',
                'judul' => $streak >= 7
                    ? "Luar biasa! {$streak} Hari Streak Glowing Berturut-turut! 🥳✨"
                    : "Selamat! {$streak} Hari Streak Berturut-turut! 🥳",
                'pesan' => 'Kamu makin konsisten merawat skin barrier. Tetap semangat mencapai kulit impianmu!',
                'aksi_link' => null,
                'aksi_text' => '📢 Bagikan Pencapaian',
                'aksi_style' => 'secondary',
            ];
        }

        // ─── Kalau semua kosong ───
        if (empty($notifikasi)) {
            $notifikasi[] = [
                'tipe' => 'info',
                'icon' => '💡',
                'label' => 'INFO',
                'waktu' => 'Sekarang',
                'judul' => 'Belum Ada Notifikasi',
                'pesan' => 'Terus catat jurnal harianmu. Sistem akan mengirim pengingat & analisis otomatis.',
                'aksi_link' => route('dashboard'),
                'aksi_text' => 'Kembali ke Dashboard',
                'aksi_style' => 'primary',
            ];
        }

        return view('notifikasi', [
            'notifikasi' => $notifikasi,
        ]);
    }

    private function cekPemakaianBerturut($userId): ?array
    {
        $today = Carbon::today();

        // 1. Ambil produk keras (Serum/Exfoliator) milik user
        $produkKeras = Product::where('id_user', $userId)
            ->whereIn('jenis_produk', ['Serum', 'Exfoliator'])
            ->pluck('nama_produk', 'id_product')
            ->toArray();

        if (empty($produkKeras)) return null;

        // 2. Hitung pemakaian tiap produk keras dalam 7 hari terakhir
        $tujuhHariLalu = $today->copy()->subDays(7)->format('Y-m-d');
        $pemakaian = Journal::where('id_user', $userId)
            ->whereIn('id_product', array_keys($produkKeras))
            ->where('tanggal_pemakaian', '>=', $tujuhHariLalu . ' 00:00:00')
            ->selectRaw('id_product, COUNT(DISTINCT DATE(tanggal_pemakaian)) as total_hari')
            ->groupBy('id_product')
            ->having('total_hari', '>=', 2)
            ->orderByDesc('total_hari')
            ->get();

        if ($pemakaian->isEmpty()) return null;

        // 3. Ambil produk paling sering dipakai
        $top = $pemakaian->first();
        $namaProduk = $produkKeras[$top->id_product] ?? 'Produk';
        $hariPakai = $top->total_hari;

        // 4. Cek riwayat iritasi 7 hari terakhir
        $adaIritasi = Journal::where('id_user', $userId)
            ->whereIn('kondisi_kulit', ['Kemerahan', 'Perih', 'Iritasi'])
            ->where('tanggal_pemakaian', '>=', $tujuhHariLalu . ' 00:00:00')
            ->exists();

        // 5. Tentukan severity
        $severity = 'Rendah';
        $icon = '⚠️';
        $warnaLabel = 'WASPADA';

        if ($hariPakai >= 4 || ($hariPakai >= 3 && $adaIritasi)) {
            $severity = 'Tinggi';
            $warnaLabel = 'WASPADA BREAKOUT';
        } elseif ($hariPakai >= 3 || ($hariPakai >= 2 && $adaIritasi)) {
            $severity = 'Sedang';
            $warnaLabel = 'PERHATIAN';
        }

        // 6. Susun pesan
        $pesan = "Kamu menggunakan {$namaProduk} sebanyak {$hariPakai} hari dalam seminggu terakhir.";
        if ($adaIritasi) {
            $pesan .= " Dan terdeteksi adanya iritasi pada kulitmu. ";
        } else {
            $pesan .= " ";
        }

        if ($severity === 'Tinggi') {
            $pesan .= "Sangat disarankan untuk istirahatkan produk ini minimal 3 hari ke depan, cantik!";
        } elseif ($severity === 'Sedang') {
            $pesan .= "Coba beri jeda pemakaian agar skin barrier tetap sehat.";
        } else {
            $pesan .= "Tetap perhatikan respons kulitmu setelah pemakaian.";
        }

        return [
            'tipe' => 'warning',
            'icon' => $icon,
            'label' => $warnaLabel,
            'waktu' => 'Hari ini',
            'judul' => "Deteksi Bahan Aktif — Severity {$severity} 🚨",
            'pesan' => $pesan,
            'aksi_link' => route('analisis.kecocokan'),
            'aksi_text' => 'Lihat Analisis Kecocokan',
            'aksi_style' => 'primary',
            'severity' => $severity,
        ];
    }

    private function hitungStreak($userId): int
    {
        $tanggalList = Journal::where('id_user', $userId)
            ->selectRaw('DATE(tanggal_pemakaian) as tgl')
            ->distinct()
            ->orderBy('tgl', 'desc')
            ->pluck('tgl')
            ->map(fn ($t) => Carbon::parse($t)->startOfDay())
            ->toArray();

        if (empty($tanggalList)) return 0;

        $today = Carbon::today();
        if ($today->diffInDays($tanggalList[0], false) > 1) return 0;

        $streak = 1;
        for ($i = 1; $i < count($tanggalList); $i++) {
            if ($tanggalList[$i - 1]->diffInDays($tanggalList[$i], false) !== 1) break;
            $streak++;
        }
        return $streak;
    }
}