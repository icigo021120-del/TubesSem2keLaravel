<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\AssemblyPoint;
use App\Models\EducationModule;
use App\Models\EvacuationRoute;
use App\Models\Sensor;
use Illuminate\Http\Request;

/**
 * Halaman informasi (read-only) untuk pengguna.
 */
class InfoController extends Controller
{
    public function pantauan()
    {
        return view('pengguna.pantauan', [
            'sensors' => Sensor::orderBy('status')->orderByDesc('last_checked')->get(),
            'alerts'  => Alert::with('sensor')->orderByDesc('waktu_kejadian')->take(10)->get(),
        ]);
    }

    public function peta()
    {
        return view('pengguna.peta', ['sensors' => Sensor::orderBy('status')->get()]);
    }

    public function status()
    {
        $sensors = Sensor::all();
        $aktif   = $sensors->where('status', 'aktif')->count();
        $rusak   = $sensors->where('status', 'rusak')->count();
        $maint   = $sensors->where('status', 'maintenance')->count();
        $pct     = $sensors->count() > 0 ? (int) round($aktif / $sensors->count() * 100) : 0;

        return view('pengguna.status', compact('sensors', 'aktif', 'rusak', 'maint', 'pct'));
    }

    public function peringatan()
    {
        return view('pengguna.peringatan', [
            'alerts' => Alert::with('sensor')->whereIn('tingkat_bahaya', ['siaga', 'awas'])->orderByDesc('waktu_kejadian')->get(),
        ]);
    }

    public function notifikasi()
    {
        return view('pengguna.notifikasi', [
            'alerts' => Alert::with('sensor')->orderByDesc('waktu_kejadian')->get(),
        ]);
    }

    public function rute()
    {
        return view('pengguna.rute', ['rutes' => EvacuationRoute::orderBy('id')->get()]);
    }

    public function titik()
    {
        return view('pengguna.titik', ['points' => AssemblyPoint::orderBy('id')->get()]);
    }

    public function edukasi(Request $request)
    {
        $filter = $request->query('kategori', 'semua');

        $modules = EducationModule::query()
            ->when(in_array($filter, EducationModule::KATEGORI), fn ($q) => $q->where('kategori', $filter))
            ->orderByDesc('created_at')
            ->get();

        return view('pengguna.edukasi', compact('modules', 'filter'));
    }
}
