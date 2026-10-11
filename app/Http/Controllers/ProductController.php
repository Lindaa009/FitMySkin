<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('id_user', Auth::id())->get();
        $mapped = $products->map(fn ($p) => $this->mapProduct($p));

        return view('katalog.index', ['initialProducts' => $mapped]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'brand' => 'required|string|max:100',
            'category' => 'required|in:cleanser,toner,serum,moisturizer,sunscreen,exfoliator',
            'ingredient' => 'nullable|string|max:255',
            'routine' => 'required|in:both,morning,evening',
        ]);

        $product = Product::create([
            'id_user' => Auth::id(),
            'nama_produk' => $validated['name'],
            'merek' => $validated['brand'],
            'bahan_aktif' => $validated['ingredient'] ?? '',
            'jenis_produk' => ucfirst($validated['category']),
            'jadwal_pemakaian' => $this->unmapRoutine($validated['routine']),
            'status_pemakaian' => 'Aktif',
            'catatan_product' => '',
        ]);

        return response()->json([
            'success' => true,
            'product' => $this->mapProduct($product),
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('id_product', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        // Kalau cuma toggle status (dari tombol Istirahatkan/Gunakan lagi)
        if ($request->has('status') && !$request->has('name')) {
            $request->validate(['status' => 'required|in:active,paused']);
            $product->status_pemakaian = $request->status === 'active' ? 'Aktif' : 'Tidak Aktif';
        } else {
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'brand' => 'required|string|max:100',
                'category' => 'required|in:cleanser,toner,serum,moisturizer,sunscreen,exfoliator',
                'ingredient' => 'nullable|string|max:255',
                'routine' => 'required|in:both,morning,evening',
                'status' => 'required|in:active,paused',
            ]);

            $product->nama_produk = $validated['name'];
            $product->merek = $validated['brand'];
            $product->bahan_aktif = $validated['ingredient'] ?? '';
            $product->jenis_produk = ucfirst($validated['category']);
            $product->jadwal_pemakaian = $this->unmapRoutine($validated['routine']);
            $product->status_pemakaian = $validated['status'] === 'active' ? 'Aktif' : 'Tidak Aktif';
        }

        $product->save();

        return response()->json([
            'success' => true,
            'product' => $this->mapProduct($product),
        ]);
    }

    public function destroy($id)
    {
        $product = Product::where('id_product', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $product->delete();

        return response()->json(['success' => true]);
    }

    // ── Helpers ──

    private function mapProduct($p)
    {
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
    }

    private function mapRoutine($jadwal)
    {
        $j = strtolower($jadwal ?? '');
        if (str_contains($j, 'siang') && str_contains($j, 'malam')) return 'both';
        if (str_contains($j, 'siang')) return 'morning';
        if (str_contains($j, 'malam')) return 'evening';
        return 'both';
    }

    private function unmapRoutine($routine)
    {
        return match ($routine) {
            'morning' => 'Siang',
            'evening' => 'Malam',
            default => 'Siang dan Malam',
        };
    }
}