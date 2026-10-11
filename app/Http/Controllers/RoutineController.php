<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RoutineController extends Controller
{
    // Default routine kalau user belum pernah simpan
    private array $defaultRoutine = [
        'pagi' => [
            ['title' => 'Facial Wash', 'desc' => 'Langkah 1: Pembersih'],
            ['title' => 'Toner', 'desc' => 'Langkah 2: Penyeimbang'],
            ['title' => 'Serum', 'desc' => 'Langkah 3: Perawatan Khusus'],
            ['title' => 'Moisturizer', 'desc' => 'Langkah 4: Pengunci'],
            ['title' => 'Sunscreen', 'desc' => 'Langkah 5: Perlindungan Terluar'],
        ],
        'malam' => [
            ['title' => 'Facial Wash', 'desc' => 'Langkah 1: Pembersih'],
            ['title' => 'Toner', 'desc' => 'Langkah 2: Penyeimbang'],
            ['title' => 'Serum', 'desc' => 'Langkah 3: Perawatan Khusus'],
            ['title' => 'Moisturizer', 'desc' => 'Langkah 4: Pengunci'],
        ],
    ];

    public function index()
    {
        $routine = Routine::where('id_user', Auth::id())
            ->orderBy('tanggal_diubah', 'desc')
            ->first();

        $data = $this->defaultRoutine;

        if ($routine && !empty($routine->detail_urutan)) {
            $decoded = json_decode($routine->detail_urutan, true);
            if (is_array($decoded)) {
                $data = array_merge($data, $decoded);
            }
        }

        return view('kelola-langkah', [
            'initialRoutine' => $data,
        ]);
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'pagi' => 'required|array',
            'pagi.*.title' => 'required|string|max:100',
            'pagi.*.desc' => 'nullable|string|max:200',
            'malam' => 'required|array',
            'malam.*.title' => 'required|string|max:100',
            'malam.*.desc' => 'nullable|string|max:200',
        ]);

        $detail = json_encode([
            'pagi' => $validated['pagi'],
            'malam' => $validated['malam'],
        ]);

        // Cek sudah ada routine user atau belum
        $routine = Routine::where('id_user', Auth::id())->first();

        if ($routine) {
            $routine->update([
                'tanggal_diubah' => Carbon::today(),
                'detail_urutan' => $detail,
            ]);
        } else {
            Routine::create([
                'id_user' => Auth::id(),
                'tanggal_diubah' => Carbon::today(),
                'detail_urutan' => $detail,
            ]);
        }

        return response()->json(['success' => true]);
    }
}