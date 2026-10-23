<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SensorController extends Controller
{
    public function index()
    {
        return view('admin.sensor.index', [
            'sensors' => Sensor::orderBy('status')->orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.sensor.form', ['sensor' => new Sensor(['status' => 'aktif', 'jenis_sensor' => 'asap'])]);
    }

    public function store(Request $request)
    {
        $sensor = Sensor::create($request->validate($this->rules()));
        ActivityLog::catat('Menambah Sensor', "Sensor {$sensor->kode_sensor} ditambahkan");

        return redirect()->route('admin.sensor.index')->with('success', 'Sensor berhasil ditambahkan.');
    }

    public function edit(Sensor $sensor)
    {
        return view('admin.sensor.form', compact('sensor'));
    }

    public function update(Request $request, Sensor $sensor)
    {
        $sensor->update($request->validate($this->rules($sensor)));
        ActivityLog::catat('Mengubah Sensor', "Sensor {$sensor->kode_sensor} diperbarui");

        return redirect()->route('admin.sensor.index')->with('success', 'Sensor berhasil diperbarui.');
    }

    public function destroy(Sensor $sensor)
    {
        $kode = $sensor->kode_sensor;
        $sensor->delete();
        ActivityLog::catat('Menghapus Sensor', "Sensor $kode dihapus");

        return redirect()->route('admin.sensor.index')->with('success', 'Sensor berhasil dihapus.');
    }

    private function rules(?Sensor $sensor = null): array
    {
        return [
            'kode_sensor'   => ['required', 'string', 'max:50', Rule::unique('sensors', 'kode_sensor')->ignore($sensor?->id)],
            'jenis_sensor'  => ['required', Rule::in(Sensor::JENIS)],
            'lokasi_gedung' => ['required', 'string', 'max:100'],
            'status'        => ['required', Rule::in(Sensor::STATUS)],
        ];
    }
}
