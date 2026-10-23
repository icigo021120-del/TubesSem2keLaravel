<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = User::pengguna();

        return view('pengguna.profil', [
            'user'       => $user,
            'jmlLaporan' => $user ? Report::where('user_id', $user->id)->count() : 0,
        ]);
    }

    public function update(Request $request)
    {
        $user = User::pengguna();
        abort_unless($user, 404, 'Belum ada data pengguna.');

        $data = $request->validate([
            'nama'          => ['required', 'string', 'max:100'],
            'no_telepon'    => ['nullable', 'string', 'max:20'],
            'password_baru' => ['nullable', 'string', 'min:6'],
            'password_lama' => ['nullable', 'string'],
        ], [
            'nama.required'     => 'Nama lengkap wajib diisi.',
            'password_baru.min' => 'Kata sandi baru minimal 6 karakter.',
        ]);

        $update = ['nama_lengkap' => $data['nama'], 'no_telepon' => $data['no_telepon'] ?? ''];

        if (! empty($data['password_baru'])) {
            if (! Hash::check($data['password_lama'] ?? '', $user->password_hash)) {
                return back()->withInput()->withErrors(['password_lama' => 'Kata sandi lama tidak sesuai.']);
            }
            $update['password_hash'] = Hash::make($data['password_baru']);
        }

        $user->update($update);

        return back()->with('success', ! empty($data['password_baru'])
            ? 'Profil dan kata sandi berhasil diperbarui.'
            : 'Profil berhasil diperbarui.');
    }
}
