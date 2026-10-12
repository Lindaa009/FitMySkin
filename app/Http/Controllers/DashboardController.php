<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $today = Carbon::today();

        // ─── Streak ───
        $streak = $this->hitungStreak($userId);

        // ─── Produk ───
        $totalProduk = Product::where('id_user', $userId)->count();
        $produkAktif = Product::where('id_user', $userId)
            ->where('status_pemakaian', 'Aktif')->count();
        $produkStop = $totalProduk - $produkAktif;

        // ─── Jurnal hari ini ───
        $jurnalPagiHariIni = Journal::where('id_user', $userId)
            ->whereDate('tanggal_pemakaian', $today)
            ->where('jadwal_pemakaian', 'Siang')
            ->exists();

        $jurnalMalamHariIni = Journal::where('id_user', $userId)
            ->whereDate('tanggal_pemakaian', $today)
            ->where('jadwal_pemakaian', 'Malam')
            ->exists();

        // ─── Progress ritual hari ini ───
        $progressRitual = 0;
        if ($jurnalPagiHariIni && $jurnalMalamHariIni) $progressRitual = 100;
        elseif ($jurnalPagiHariIni || $jurnalMalamHariIni) $progressRitual = 50;

        if ($jurnalPagiHariIni && $jurnalMalamHariIni) {
            $statusJurnalHariIni = 'Pagi & Malam Selesai ✨';
        } elseif ($jurnalPagiHariIni) {
            $statusJurnalHariIni = 'Pagi Selesai, Malam Belum Diisi 🍷';
        } elseif ($jurnalMalamHariIni) {
            $statusJurnalHariIni = 'Malam Selesai, Pagi Belum Diisi ☀️';
        } else {
            $statusJurnalHariIni = 'Belum Ada Jurnal Hari Ini 📝';
        }

        // ─── Jurnal terakhir ───
        $jurnalTerakhir = Journal::where('id_user', $userId)
            ->orderBy('tanggal_pemakaian', 'desc')
            ->orderBy('id_jurnal', 'desc')
            ->first();

        $waktuJurnalTerakhir = $jurnalTerakhir
            ? Carbon::parse($jurnalTerakhir->tanggal_pemakaian)->translatedFormat('d F Y, H:i') . ' WIB'
            : 'Belum ada catatan';

        // ─── Kepatuhan rutin ───
        $kepatuhanPersen = $this->hitungKepatuhan($userId);

        // ─── Pekan ini (kalender 7 hari) ───
        $pekanIni = $this->getPekanIni($userId);
        $pekanCount = collect($pekanIni)->where('status', 'done')->count();

        // ─── Barrier health & metrik ───
        $metrik = $this->hitungMetrik($userId, $streak);

        // ─── Analisis (produk pemicu + aman) ───
        $analisis = $this->getAnalisis($userId);

        return view('dashboard', [
            'streak' => $streak,
            'totalProduk' => $totalProduk,
            'produkAktif' => $produkAktif,
            'produkStop' => $produkStop,
            'jurnalPagiHariIni' => $jurnalPagiHariIni,
            'jurnalMalamHariIni' => $jurnalMalamHariIni,
            'progressRitual' => $progressRitual,
            'statusJurnalHariIni' => $statusJurnalHariIni,
            'jurnalTerakhir' => $jurnalTerakhir,
            'waktuJurnalTerakhir' => $waktuJurnalTerakhir,
            'tanggalHariIni' => $today->translatedFormat('l, d F Y'),
            'kepatuhanPersen' => $kepatuhanPersen,
            'pekanIni' => $pekanIni,
            'pekanCount' => $pekanCount,
            'metrik' => $metrik,
            'analisis' => $analisis,
        ]);
    }

    // ═══════════════════════════════════════════
    // HELPER METHODS
    // ═══════════════════════════════════════════

    private function hitungStreak($userId): int
    {
        $tanggalList = Journal::where('id_user', $userId)
            ->selectRaw('DATE(tanggal_pemakaian) as tgl')
            ->distinct()
            ->orderBy('tgl', 'desc')
            ->pluck('tgl')
            ->map(fn($t) => Carbon::parse($t)->startOfDay())
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

    private function hitungKepatuhan($userId): int
    {
        $user = Auth::user();
        $tglDaftar = Carbon::parse($user->created_at ?? now())->startOfDay();
        $hariIni = Carbon::today();
        $totalHari = max($tglDaftar->diffInDays($hariIni) + 1, 1);

        $hariAdaJurnal = Journal::where('id_user', $userId)
            ->selectRaw('DATE(tanggal_pemakaian) as tgl')
            ->distinct()
            ->count();

        if ($totalHari === 0) return 0;

        return min((int) round(($hariAdaJurnal / $totalHari) * 100), 100);
    }

    private function getPekanIni($userId): array
    {
        $today = Carbon::today();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);

        $jurnalDates = Journal::where('id_user', $userId)
            ->whereBetween('tanggal_pemakaian', [
                $startOfWeek->format('Y-m-d') . ' 00:00:00',
                $startOfWeek->copy()->addDays(6)->format('Y-m-d') . ' 23:59:59',
            ])
            ->selectRaw('DATE(tanggal_pemakaian) as tgl')
            ->distinct()
            ->pluck('tgl')
            ->toArray();

        $hariSingkat = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
        $result = [];

        for ($i = 0; $i < 7; $i++) {
            $tgl = $startOfWeek->copy()->addDays($i);
            $tglStr = $tgl->format('Y-m-d');
            $isToday = $tgl->isSameDay($today);
            $isFuture = $tgl->gt($today);
            $ada = in_array($tglStr, $jurnalDates);

            if ($isToday) $status = 'today';
            elseif ($isFuture) $status = 'future';
            elseif ($ada) $status = 'done';
            else $status = 'missed';

            $result[] = [
                'hari' => $hariSingkat[$i],
                'tanggal' => $tglStr,
                'status' => $status,
                'isToday' => $isToday,
            ];
        }

        return $result;
    }

    private function hitungMetrik($userId, $streak): array
    {
        $today = Carbon::today();
        $tujuhHariLalu = $today->copy()->subDays(7)->format('Y-m-d') . ' 00:00:00';

        $journals = Journal::where('id_user', $userId)
            ->where('tanggal_pemakaian', '>=', $tujuhHariLalu)
            ->get();

        $total = $journals->count();

        if ($total === 0) {
            return [
                'barrier' => 0,
                'barrierStatus' => 'Belum Ada Data',
                'barrierColor' => '#82747a',
                'hidrasi' => 0,
                'hidrasiLabel' => 'Belum ada data',
                'kemerahan' => 0,
                'kemerahanLabel' => 'Belum ada data',
                'tekstur' => 0,
                'teksturLabel' => 'Belum ada data',
            ];
        }

        $nyaman = $journals->filter(fn($j) => in_array(strtolower($j->kondisi_kulit), ['nyaman', 'baik']))->count();
        $kering = $journals->filter(fn($j) => strtolower($j->kondisi_kulit) === 'kering')->count();
        $kemerahan = $journals->filter(fn($j) => in_array(strtolower($j->kondisi_kulit), ['kemerahan', 'perih', 'iritasi']))->count();

        $hidrasi = (int) round((($total - $kering) / $total) * 100);
        $kemerahanPersen = (int) round(($kemerahan / $total) * 100);
        $tekstur = (int) round(($nyaman / $total) * 100);

        // Barrier score: base 60 + bonus
        $base = 60 + (int) round(($nyaman / $total) * 25);
        $bonus = min($streak * 2, 12);
        $barrier = min($base + $bonus, 100);

        $barrierStatus = 'Perlu Perhatian';
        $barrierColor = '#BA1A1A';
        if ($barrier >= 80) { $barrierStatus = 'Kondisi Optimal'; $barrierColor = '#49765e'; }
        elseif ($barrier >= 60) { $barrierStatus = 'Cukup Baik'; $barrierColor = '#F57C00'; }

        return [
            'barrier' => $barrier,
            'barrierStatus' => $barrierStatus,
            'barrierColor' => $barrierColor,
            'hidrasi' => $hidrasi,
            'hidrasiLabel' => $hidrasi >= 80 ? 'Sangat Lembap' : ($hidrasi >= 50 ? 'Cukup' : 'Kurang Lembap'),
            'kemerahan' => $kemerahanPersen,
            'kemerahanLabel' => $kemerahanPersen <= 20 ? 'Sangat Tenang' : ($kemerahanPersen <= 50 ? 'Sedang' : 'Tinggi'),
            'tekstur' => $tekstur,
            'teksturLabel' => $tekstur >= 70 ? 'Halus Kenyal' : ($tekstur >= 40 ? 'Cukup Baik' : 'Perlu Perhatian'),
        ];
    }

    private function getAnalisis($userId): array
    {
        // Cari produk pemicu (dipakai 3 hari sebelum iritasi)
        $tanggalIritasi = Journal::where('id_user', $userId)
            ->whereIn('kondisi_kulit', ['Kemerahan', 'Perih', 'Iritasi'])
            ->selectRaw('DATE(tanggal_pemakaian) as tgl')
            ->distinct()
            ->pluck('tgl')
            ->map(fn($t) => Carbon::parse($t))
            ->toArray();

        if (empty($tanggalIritasi)) {
            // Cari produk aman (aktif, belum pernah terkait iritasi)
            $produkAman = Product::where('id_user', $userId)
                ->where('status_pemakaian', 'Aktif')
                ->first();

            return [
                'ada_data' => false,
                'pemicu' => null,
                'aman' => $produkAman ? [
                    'nama' => $produkAman->nama_produk,
                    'bahan' => $produkAman->bahan_aktif ?? '',
                ] : null,
            ];
        }

        $counter = [];
        foreach ($tanggalIritasi as $tgl) {
            $start = $tgl->copy()->subDays(3);
            $end = $tgl->copy()->subDay();

            $pids = Journal::where('id_user', $userId)
                ->whereBetween('tanggal_pemakaian', [
                    $start->format('Y-m-d') . ' 00:00:00',
                    $end->format('Y-m-d') . ' 23:59:59',
                ])
                ->whereNotNull('id_product')
                ->pluck('id_product')
                ->toArray();

            foreach ($pids as $pid) {
                $counter[$pid] = ($counter[$pid] ?? 0) + 1;
            }
        }

        arsort($counter);

        $pemicu = null;
        if (!empty($counter)) {
            $topPid = array_key_first($counter);
            $topProduk = Product::find($topPid);
            if ($topProduk) {
                $totalHari = count($tanggalIritasi);
                $persen = min((int) round(($counter[$topPid] / $totalHari) * 100), 100);
                $pemicu = [
                    'nama' => $topProduk->nama_produk,
                    'bahan' => $topProduk->bahan_aktif ?? '',
                    'persen' => $persen,
                ];
            }
        }

        // Produk aman: aktif, bukan pemicu
        $produkAman = Product::where('id_user', $userId)
            ->where('status_pemakaian', 'Aktif')
            ->whereNotIn('id_product', array_keys($counter))
            ->first();

        return [
            'ada_data' => true,
            'pemicu' => $pemicu,
            'aman' => $produkAman ? [
                'nama' => $produkAman->nama_produk,
                'bahan' => $produkAman->bahan_aktif ?? '',
            ] : null,
        ];
    }
}