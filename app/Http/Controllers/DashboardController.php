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

        // Streak
        $streak = $this->hitungStreak($userId);

        // Produk
        $totalProduk = Product::where('id_user', $userId)->count();
        $produkAktif = Product::where('id_user', $userId)
            ->where('status_pemakaian', 'Aktif')->count();
        $produkStop = $totalProduk - $produkAktif;

        // Jurnal hari ini (pagi/malam)
        $jurnalPagiHariIni = Journal::where('id_user', $userId)
            ->whereDate('tanggal_pemakaian', $today)
            ->where('jadwal_pemakaian', 'Siang')
            ->exists();

        $jurnalMalamHariIni = Journal::where('id_user', $userId)
            ->whereDate('tanggal_pemakaian', $today)
            ->where('jadwal_pemakaian', 'Malam')
            ->exists();

        // Jurnal terakhir (apapun)
        $jurnalTerakhir = Journal::where('id_user', $userId)
            ->orderBy('tanggal_pemakaian', 'desc')
            ->orderBy('id_jurnal', 'desc')
            ->first();

        return view('dashboard', [
            'streak' => $streak,
            'totalProduk' => $totalProduk,
            'produkAktif' => $produkAktif,
            'produkStop' => $produkStop,
            'jurnalPagiHariIni' => $jurnalPagiHariIni,
            'jurnalMalamHariIni' => $jurnalMalamHariIni,
            'jurnalTerakhir' => $jurnalTerakhir,
            'tanggalHariIni' => $today->translatedFormat('l, d F Y'),
        ]);
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