<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    // Halaman form jurnal pagi
    public function morning()
    {
        $products = Product::where('id_user', Auth::id())
            ->where('status_pemakaian', 'Aktif')
            ->get();

        return view('jurnal.pagi', ['initialProducts' => $this->mapProducts($products)]);
    }

    // Halaman form jurnal malam
    public function evening()
    {
        $products = Product::where('id_user', Auth::id())
            ->where('status_pemakaian', 'Aktif')
            ->get();

        return view('jurnal.malam', ['initialProducts' => $this->mapProducts($products)]);
    }

    // Halaman riwayat
    public function history()
    {
        $journals = Journal::with('product')
            ->where('id_user', Auth::id())
            ->orderBy('tanggal_pemakaian', 'desc')
            ->orderBy('id_jurnal', 'desc')
            ->get()
            ->groupBy(fn ($j) => $j->tanggal_pemakaian . '|' . $j->jadwal_pemakaian . '|' . $j->kondisi_kulit . '|' . $j->catatan_jadwal)
            ->map(function ($group) {
                $first = $group->first();
                $catatan = json_decode($first->catatan_jadwal, true) ?? [];

                return [
                    'id' => (string) $first->id_jurnal,
                    'ids' => $group->pluck('id_jurnal')->map(fn ($v) => (string) $v)->toArray(),
                    'type' => $first->jadwal_pemakaian === 'Malam' ? 'evening' : 'morning',
                    'date' => explode(' ', $first->tanggal_pemakaian)[0],
                    'condition' => $first->kondisi_kulit,
                    'products' => $group->pluck('product.nama_produk')->filter()->values()->toArray(),
                    'symptoms' => $catatan['symptoms'] ?? [],
                    'note' => $catatan['note'] ?? '',
                ];
            })
            ->values();

        return view('jurnal.riwayat', ['initialJournals' => $journals]);
    }

    // Simpan jurnal baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:morning,evening',
            'date' => 'required|date',
            'condition' => 'required|string|max:50',
            'products' => 'nullable|array',
            'products.*' => 'integer|exists:product,id_product',
            'symptoms' => 'nullable|array',
            'note' => 'nullable|string|max:500',
        ]);

        $jadwal = $validated['type'] === 'morning' ? 'Siang' : 'Malam';

        $catatan = json_encode([
            'symptoms' => $validated['symptoms'] ?? [],
            'note' => $validated['note'] ?? '',
        ]);

        $productIds = $validated['products'] ?? [null];

        foreach ($productIds as $productId) {
            Journal::create([
                'id_user' => Auth::id(),
                'id_product' => $productId,
                'tanggal_pemakaian' => $validated['date'] . ' ' . now()->format('H:i:s'),
                'kondisi_kulit' => $validated['condition'],
                'jadwal_pemakaian' => $jadwal,
                'catatan_jadwal' => $catatan,
            ]);
        }

        return response()->json(['success' => true]);
    }

    // Hapus jurnal (semua baris dalam satu sesi)
    public function destroy($id)
    {
        $journal = Journal::where('id_jurnal', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        Journal::where('id_user', Auth::id())
            ->where('tanggal_pemakaian', $journal->tanggal_pemakaian)
            ->where('jadwal_pemakaian', $journal->jadwal_pemakaian)
            ->where('kondisi_kulit', $journal->kondisi_kulit)
            ->where('catatan_jadwal', $journal->catatan_jadwal)
            ->delete();

        return response()->json(['success' => true]);
    }

    private function mapProducts($products)
    {
        return $products->map(function ($p) {
            return [
                'id' => (string) $p->id_product,
                'name' => $p->nama_produk,
                'brand' => $p->merek,
                'category' => strtolower($p->jenis_produk),
                'ingredient' => $p->bahan_aktif,
                'routine' => $this->mapRoutine($p->jadwal_pemakaian),
                'status' => $p->status_pemakaian === 'Aktif' ? 'active' : 'paused',
                'note' => $p->catatan_product,
            ];
        });
    }

    private function mapRoutine($jadwal)
    {
        $j = strtolower($jadwal ?? '');
        if (str_contains($j, 'siang') && str_contains($j, 'malam')) return 'both';
        if (str_contains($j, 'siang')) return 'morning';
        if (str_contains($j, 'malam')) return 'evening';
        return 'both';
    }
}