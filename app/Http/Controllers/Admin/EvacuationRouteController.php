<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\AssemblyPoint;
use App\Models\EvacuationRoute;
use Illuminate\Http\Request;

class EvacuationRouteController extends Controller
{
    public function index()
    {
        return view('admin.rute.index', ['rutes' => EvacuationRoute::orderBy('id')->get()]);
    }

    public function create()
    {
        return view('admin.rute.form', [
            'rute'   => new EvacuationRoute(['jarak_meter' => 0]),
            'titiks' => AssemblyPoint::orderBy('nama_titik')->pluck('nama_titik'),
        ]);
    }

    public function store(Request $request)
    {
        $rute = EvacuationRoute::create($this->validated($request));
        ActivityLog::catat('Menambah Rute Evakuasi', $rute->nama_rute);

        return redirect()->route('admin.rute.index')->with('success', 'Rute evakuasi berhasil ditambahkan.');
    }

    public function edit(EvacuationRoute $rute)
    {
        return view('admin.rute.form', [
            'rute'   => $rute,
            'titiks' => AssemblyPoint::orderBy('nama_titik')->pluck('nama_titik'),
        ]);
    }

    public function update(Request $request, EvacuationRoute $rute)
    {
        $rute->update($this->validated($request));
        ActivityLog::catat('Mengubah Rute Evakuasi', $rute->nama_rute);

        return redirect()->route('admin.rute.index')->with('success', 'Rute evakuasi berhasil diperbarui.');
    }

    public function destroy(EvacuationRoute $rute)
    {
        $nama = $rute->nama_rute;
        $rute->delete();
        ActivityLog::catat('Menghapus Rute Evakuasi', $nama);

        return redirect()->route('admin.rute.index')->with('success', 'Rute berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nama_rute'    => ['required', 'string', 'max:150'],
            'lokasi_asal'  => ['required', 'string', 'max:150'],
            'titik_kumpul' => ['required', 'string', 'max:150'],
            'deskripsi'    => ['nullable', 'string'],
            'jarak_meter'  => ['nullable', 'integer', 'min:0'],
        ]);
        $data['jarak_meter'] = $data['jarak_meter'] ?? 0;

        return $data;
    }
}
