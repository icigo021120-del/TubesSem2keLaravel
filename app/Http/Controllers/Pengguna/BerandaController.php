<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\Report;
use App\Models\Sensor;
use App\Models\User;

class BerandaController extends Controller
{
    public function index()
    {
        $user = User::pengguna();

        return view('pengguna.beranda', [
            'user'           => $user,
            'totalLaporan'   => $user ? Report::where('user_id', $user->id)->count() : 0,
            'sensorAktif'    => Sensor::where('status', 'aktif')->count(),
            'peringatanAktif' => Alert::whereIn('tingkat_bahaya', ['siaga', 'awas'])->count(),
            'aktivitas'      => Alert::orderByDesc('waktu_kejadian')->take(5)->get(),
            'indeks'         => 90,
        ]);
    }
}
