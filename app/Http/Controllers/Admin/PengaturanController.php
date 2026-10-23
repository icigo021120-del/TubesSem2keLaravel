<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Alert;
use App\Models\Report;
use App\Models\Sensor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PengaturanController extends Controller
{
    public function index()
    {
        return view('admin.pengaturan.index', [
            'admin'      => User::admin(),
            'adminList'  => User::where('role', 'admin')->orderBy('created_at')->get(),
            'totalSensor' => Sensor::count(),
            'totalLaporan' => Report::count(),
            'totalAlert' => Alert::count(),
        ]);
    }

    public function updateProfil(Request $request)
    {
        $data = $request->validate([
            'nama'       => ['required', 'string', 'max:100'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
        ], ['nama.required' => 'Nama wajib diisi.']);

        User::admin()?->update(['nama_lengkap' => $data['nama'], 'no_telepon' => $data['no_telepon'] ?? '']);

        return back()->with('success', 'Profil admin berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'password_lama' => ['required', 'string'],
            'password_baru' => ['required', 'string', 'min:6'],
            'konfirmasi'    => ['required', 'same:password_baru'],
        ], [
            'password_baru.min' => 'Kata sandi baru minimal 6 karakter.',
            'konfirmasi.same'   => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $admin = User::admin();

        if (! $admin || ! Hash::check($data['password_lama'], $admin->password_hash)) {
            return back()->withErrors(['password_lama' => 'Kata sandi lama tidak sesuai.']);
        }

        $admin->update(['password_hash' => Hash::make($data['password_baru'])]);
        ActivityLog::catat('Mengubah Kata Sandi', 'Admin memperbarui kata sandi');

        return back()->with('success', 'Kata sandi berhasil diperbarui.');
    }

    public function storeAdmin(Request $request)
    {
        $data = $request->validate([
            'new_nama'     => ['required', 'string', 'max:100'],
            'new_email'    => ['required', 'email', 'max:100', 'unique:users,email'],
            'new_password' => ['required', 'string', 'min:6'],
        ], [
            'new_email.unique'  => 'Email sudah digunakan.',
            'new_password.min'  => 'Kata sandi admin baru minimal 6 karakter.',
        ]);

        $user = User::create([
            'nama_lengkap'  => $data['new_nama'],
            'email'         => strtolower($data['new_email']),
            'role'          => 'admin',
            'password_hash' => Hash::make($data['new_password']),
        ]);
        ActivityLog::catat('Menambah Admin', "Admin baru: {$user->email}");

        return back()->with('success', 'Admin baru berhasil ditambahkan.');
    }
}
