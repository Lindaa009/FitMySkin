<?php

namespace App\Providers;

use App\Models\Journal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share $navStreak ke semua view yang pakai layouts.app
        View::composer('layouts.app', function ($view) {
            $streak = 0;

            if (Auth::check()) {
                $tanggalList = Journal::where('id_user', Auth::id())
                    ->selectRaw('DATE(tanggal_pemakaian) as tgl')
                    ->distinct()
                    ->orderBy('tgl', 'desc')
                    ->pluck('tgl')
                    ->map(fn ($t) => Carbon::parse($t)->startOfDay())
                    ->toArray();

                if (!empty($tanggalList)) {
                    $today = Carbon::today();
                    $selisih = $today->diffInDays($tanggalList[0], false);

                    if ($selisih <= 1) {
                        $streak = 1;
                        for ($i = 1; $i < count($tanggalList); $i++) {
                            $diff = $tanggalList[$i - 1]->diffInDays($tanggalList[$i], false);
                            if ($diff !== 1) break;
                            $streak++;
                        }
                    }
                }
            }

            $view->with('navStreak', $streak);
        });
    }
}