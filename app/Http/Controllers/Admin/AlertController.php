<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Alert;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlertController extends Controller
{
    public function index()
    {
        return view('admin.peringatan.index', [
            'alerts' => Alert::with('sensor')->orderByDesc('waktu_kejadian')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.peringatan.form', [
            'alert'   => new Alert(['tingkat_bahaya' => 'waspada']),
            'sensors' => Sensor::orderBy('kode_sensor')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $alert = Alert::create($this->validated($request));
        ActivityLog::catat('Menambah Peringatan', "Peringatan tingkat {$alert->tingkat_bahaya} ditambahkan");

        return redirect()->route('admin.peringatan.index')->with('success', 'Peringatan berhasil ditambahkan!');
    }

    public function edit(Alert $peringatan)
    {
        return view('admin.peringatan.form', [
            'alert'   => $peringatan,
            'sensors' => Sensor::orderBy('kode_sensor')->get(),
        ]);
    }

    public function update(Request $request, Alert $peringatan)
    {
        $peringatan->update($this->validated($request));
        ActivityLog::catat('Mengubah Peringatan', "Peringatan #{$peringatan->id} diperbarui");

        return redirect()->route('admin.peringatan.index')->with('success', 'Peringatan berhasil diperbarui!');
    }

    public function destroy(Alert $peringatan)
    {
        $id = $peringatan->id;
        $peringatan->delete();
        ActivityLog::catat('Menghapus Peringatan', "Peringatan #$id dihapus");

        return redirect()->route('admin.peringatan.index')->with('success', 'Peringatan berhasil dihapus!');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'sensor_id'        => ['nullable', 'exists:sensors,id'],
            'tingkat_bahaya'   => ['required', Rule::in(Alert::TINGKAT)],
            'pesan_peringatan' => ['required', 'string'],
        ]);
        $data['sensor_id'] = $data['sensor_id'] ?: null;

        return $data;
    }
}
