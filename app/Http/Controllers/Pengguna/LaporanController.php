<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $user = User::pengguna();

        return view('pengguna.laporan', [
            'riwayat' => $user
                ? Report::where('user_id', $user->id)->orderByDesc('waktu_lapor')->take(10)->get()
                : collect(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'deskripsi' => ['required', 'string'],
            'lokasi'    => ['required', 'string', 'max:150'],
            'foto'      => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ], [
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'lokasi.required'    => 'Lokasi wajib diisi.',
            'foto.mimes'         => 'Format file tidak diizinkan. Gunakan JPG/PNG.',
            'foto.max'           => 'Ukuran file maksimal 5MB.',
            'foto.image'         => 'File harus berupa gambar JPG/PNG.',
        ]);

        $path = $request->hasFile('foto') ? $request->file('foto')->store('laporan', 'public') : null;

        Report::create([
            'user_id'            => User::pengguna()?->id,
            'deskripsi_kejadian' => $data['deskripsi'],
            'lokasi_kejadian'    => $data['lokasi'],
            'foto_bukti'         => $path,
        ]);

        return redirect()->route('pengguna.laporan')
            ->with('success', 'Laporan darurat berhasil dikirim! Tim akan segera merespons.');
    }
}
