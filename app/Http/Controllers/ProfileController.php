<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Product;
use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Statistik
        $totalJurnal = Journal::where('id_user', $userId)->count();
        $totalProduk = Product::where('id_user', $userId)->count();
        $streak = $this->hitungStreak($userId);

        // Rutinitas
        $routine = Routine::where('id_user', $userId)
            ->orderBy('tanggal_diubah', 'desc')
            ->first();

        $pagi = [];
        $malam = [];

        if ($routine && !empty($routine->detail_urutan)) {
            $decoded = json_decode($routine->detail_urutan, true);
            $pagi = $decoded['pagi'] ?? [];
            $malam = $decoded['malam'] ?? [];
        }

        // Kalau belum ada routine, pakai default
        if (empty($pagi)) {
            $pagi = [
                ['title' => 'Facial Wash'], ['title' => 'Toner'],
                ['title' => 'Serum'], ['title' => 'Moisturizer'], ['title' => 'Sunscreen']
            ];
        }
        if (empty($malam)) {
            $malam = [
                ['title' => 'Facial Wash'], ['title' => 'Toner'],
                ['title' => 'Serum'], ['title' => 'Moisturizer']
            ];
        }

        return view('profil', [
            'totalJurnal' => $totalJurnal,
            'totalProduk' => $totalProduk,
            'streak' => $streak,
            'pagi' => $pagi,
            'malam' => $malam,
        ]);
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'nama_user' => 'required|string|max:100',
            'alamat_email' => 'required|email|max:100|unique:users,alamat_email,' . $user->id_user . ',id_user',
        ], [
            'alamat_email.unique' => 'Email ini sudah dipakai user lain.',
        ]);

        $user->nama_user = $validated['nama_user'];
        $user->alamat_email = $validated['alamat_email'];
        $user->save();

        return response()->json([
            'success' => true,
            'user' => [
                'nama_user' => $user->nama_user,
                'alamat_email' => $user->alamat_email,
            ],
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($validated['password_lama'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password lama salah.',
            ], 422);
        }

        $user->password = Hash::make($validated['password_baru']);
        $user->save();

        return response()->json(['success' => true]);
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