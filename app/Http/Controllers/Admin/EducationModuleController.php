<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\EducationModule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EducationModuleController extends Controller
{
    public function index()
    {
        return view('admin.edukasi.index', [
            'modules' => EducationModule::orderByDesc('created_at')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.edukasi.form', ['modul' => new EducationModule(['kategori' => 'umum'])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['created_by'] = User::admin()?->id;

        $modul = EducationModule::create($data);
        ActivityLog::catat('Menambah Modul Edukasi', $modul->judul);

        return redirect()->route('admin.edukasi.index')->with('success', 'Modul edukasi berhasil ditambahkan.');
    }

    public function edit(EducationModule $modul)
    {
        return view('admin.edukasi.form', compact('modul'));
    }

    public function update(Request $request, EducationModule $modul)
    {
        $modul->update($this->validated($request));
        ActivityLog::catat('Mengubah Modul Edukasi', $modul->judul);

        return redirect()->route('admin.edukasi.index')->with('success', 'Modul edukasi berhasil diperbarui.');
    }

    public function destroy(EducationModule $modul)
    {
        $judul = $modul->judul;
        $modul->delete();
        ActivityLog::catat('Menghapus Modul Edukasi', $judul);

        return redirect()->route('admin.edukasi.index')->with('success', 'Modul edukasi berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'judul'    => ['required', 'string', 'max:200'],
            'kategori' => ['required', Rule::in(EducationModule::KATEGORI)],
            'konten'   => ['required', 'string'],
        ]);
    }
}
