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

    /**
     * Cek apakah user pakai produk tertentu 2 hari berturut-turut.
     */
    private function cekPemakaianBerturut($userId): ?array
    {
        $today = Carbon::today();
        $yesterday = $today->copy()->subDay();

        // Produk yang dipakai HARI INI
        $produkHariIni = Journal::where('id_user', $userId)
            ->whereDate('tanggal_pemakaian', $today)
            ->whereNotNull('id_product')
            ->pluck('id_product')
            ->toArray();

        if (empty($produkHariIni)) return null;

        // Produk yang dipakai KEMARIN
        $produkKemarin = Journal::where('id_user', $userId)
            ->whereDate('tanggal_pemakaian', $yesterday)
            ->whereNotNull('id_product')
            ->pluck('id_product')
            ->toArray();

        // Cari irisan (produk yang dipakai 2 hari berturut)
        $duplikat = array_intersect($produkHariIni, $produkKemarin);

        if (empty($duplikat)) return null;

        // Ambil produk pertama yang duplikat
        $pid = reset($duplikat);
        $produk = Product::find($pid);
        if (!$produk) return null;

        // Cek apakah produk ini bahan aktif keras (exfoliator / serum)
        $jenis = strtolower($produk->jenis_produk ?? '');
        $bahanKeras = ['exfoliator', 'serum'];
        if (!in_array($jenis, $bahanKeras)) return null;

        return [
            'tipe' => 'warning',
            'icon' => '⚠️',
            'label' => 'WASPADA BREAKOUT',
            'waktu' => 'Hari ini',
            'judul' => 'Peringatan Deteksi Bahan Aktif! 🚨',
            'pesan' => "Kamu menggunakan {$produk->nama_produk} 2 hari berturut-turut. Jangan lupa beri jeda hidrasi barrier malam ini ya, cantik!",
            'aksi_link' => route('analisis.kecocokan'),
            'aksi_text' => 'Lihat Analisis Kecocokan',
            'aksi_style' => 'primary',
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