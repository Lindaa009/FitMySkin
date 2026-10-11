<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AnalisisController extends Controller
{
    // Kondisi yang dianggap "iritasi"
    private array $iritasiConditions = ['Kemerahan', 'Perih', 'Iritasi'];

    public function index()
    {
        $userId = Auth::id();

        $streak = $this->hitungStreak($userId);
        $pemicu = $this->analisisProdukPemicu($userId);
        $kondisiFreq = $this->frekuensiKondisi($userId);

        return view('Analisis.kecocokan', [
            'streak' => $streak,
            'pemicu' => $pemicu,
            'kondisiFreq' => $kondisiFreq,
        ]);
    }

    /**
     * Hitung streak: berapa hari berturut-turut user nyatet jurnal.
     */
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
        $selisih = $today->diffInDays($tanggalList[0], false);

        // Kalau jurnal terakhir lebih dari 1 hari yang lalu, streak = 0
        if ($selisih > 1) return 0;

        $streak = 1;
        for ($i = 1; $i < count($tanggalList); $i++) {
            $diff = $tanggalList[$i - 1]->diffInDays($tanggalList[$i], false);
            if ($diff !== 1) break;
            $streak++;
        }

        return $streak;
    }

    /**
     * Analisis produk pemicu iritasi.
     * Logika: cari tanggal-tanggal yang kondisi kulitnya Iritasi,
     * lalu lihat produk apa yang dipakai 3 hari SEBELUM tanggal itu.
     */
    private function analisisProdukPemicu($userId): array
    {
        // 1. Cari semua tanggal yang ada iritasi
        $tanggalIritasi = Journal::where('id_user', $userId)
            ->whereIn('kondisi_kulit', $this->iritasiConditions)
            ->selectRaw('DATE(tanggal_pemakaian) as tgl')
            ->distinct()
            ->pluck('tgl')
            ->map(fn ($t) => Carbon::parse($t))
            ->toArray();

        if (empty($tanggalIritasi)) {
            return [
                'suspect' => null,
                'list' => [],
                'total_iritasi' => 0,
                'rentang' => null,
            ];
        }

        // 2. Untuk setiap tanggal iritasi, ambil produk yang dipakai H-1 sampai H-3 sebelumnya
        $counter = [];
        $produkMap = [];

        foreach ($tanggalIritasi as $tgl) {
            $start = $tgl->copy()->subDays(3);
            $end = $tgl->copy()->subDay();

            $journals = Journal::where('id_user', $userId)
                ->whereBetween('tanggal_pemakaian', [
                    $start->format('Y-m-d') . ' 00:00:00',
                    $end->format('Y-m-d') . ' 23:59:59',
                ])
                ->whereNotNull('id_product')
                ->get();

            foreach ($journals as $j) {
                $pid = $j->id_product;
                if (!isset($counter[$pid])) {
                    $counter[$pid] = 0;
                    $product = Product::find($pid);
                    $produkMap[$pid] = $product ? $product->nama_produk : 'Produk';
                }
                $counter[$pid]++;
            }
        }

        // 3. Hitung persentase (dari total hari iritasi)
        $totalHariIritasi = count($tanggalIritasi);
        $list = [];
        foreach ($counter as $pid => $count) {
            $persen = round(($count / $totalHariIritasi) * 100);
            $list[] = [
                'id' => $pid,
                'nama' => $produkMap[$pid],
                'count' => $count,
                'persen' => min($persen, 100),
                'total_iritasi' => $totalHariIritasi,
            ];
        }

        // Urutkan dari yang paling tinggi
        usort($list, fn ($a, $b) => $b['persen'] <=> $a['persen']);

        return [
            'suspect' => $list[0] ?? null,
            'list' => $list,
            'total_iritasi' => $totalHariIritasi,
            'rentang' => [
                'dari' => min($tanggalIritasi)->format('d M'),
                'sampai' => max($tanggalIritasi)->format('d M'),
            ],
        ];
    }

    /**
     * Frekuensi kondisi kulit dari jurnal.
     */
    private function frekuensiKondisi($userId): array
    {
        $total = Journal::where('id_user', $userId)->count();

        if ($total === 0) {
            return ['total' => 0, 'kondisi' => []];
        }

        $counts = Journal::where('id_user', $userId)
            ->selectRaw('kondisi_kulit, COUNT(*) as jml')
            ->groupBy('kondisi_kulit')
            ->pluck('jml', 'kondisi_kulit')
            ->toArray();

        $kondisi = [];
        foreach ($counts as $nama => $jml) {
            $kondisi[] = [
                'nama' => $nama ?? 'Tidak diketahui',
                'jml' => $jml,
                'persen' => round(($jml / $total) * 100),
            ];
        }

        usort($kondisi, fn ($a, $b) => $b['jml'] <=> $a['jml']);

        return ['total' => $total, 'kondisi' => $kondisi];
    }
}