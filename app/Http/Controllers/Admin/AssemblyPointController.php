<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\AssemblyPoint;
use Illuminate\Http\Request;

class AssemblyPointController extends Controller
{
    public function index()
    {
        return view('admin.titik.index', ['points' => AssemblyPoint::orderBy('id')->get()]);
    }

    public function create()
    {
        return view('admin.titik.form', ['titik' => new AssemblyPoint(['kapasitas' => 0])]);
    }

    public function store(Request $request)
    {
        $titik = AssemblyPoint::create($this->validated($request));
        ActivityLog::catat('Menambah Titik Kumpul', $titik->nama_titik);

        return redirect()->route('admin.titik.index')->with('success', 'Titik kumpul berhasil ditambahkan.');
    }

    public function edit(AssemblyPoint $titik)
    {
        return view('admin.titik.form', compact('titik'));
    }

    public function update(Request $request, AssemblyPoint $titik)
    {
        $titik->update($this->validated($request));
        ActivityLog::catat('Mengubah Titik Kumpul', $titik->nama_titik);

        return redirect()->route('admin.titik.index')->with('success', 'Titik kumpul berhasil diperbarui.');
    }

    public function destroy(AssemblyPoint $titik)
    {
        $nama = $titik->nama_titik;
        $titik->delete();
        ActivityLog::catat('Menghapus Titik Kumpul', $nama);

        return redirect()->route('admin.titik.index')->with('success', 'Titik kumpul berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nama_titik' => ['required', 'string', 'max:150'],
            'lokasi'     => ['required', 'string', 'max:200'],
            'kapasitas'  => ['nullable', 'integer', 'min:0'],
            'deskripsi'  => ['nullable', 'string'],
        ]);
        $data['kapasitas'] = $data['kapasitas'] ?? 0;

        return $data;
    }
}
