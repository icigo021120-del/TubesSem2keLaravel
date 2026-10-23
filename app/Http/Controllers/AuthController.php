<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginPengguna()
    {
        return view('auth.login', ['admin' => false]);
    }

    public function showLoginAdmin()
    {
        return view('auth.login', ['admin' => true]);
    }

    public function showRegister()
    {
        return view('auth.registrasi');
    }

    public function loginPengguna(Request $request)
    {
        return $this->attempt($request, false);
    }

    public function loginAdmin(Request $request)
    {
        return $this->attempt($request, true);
    }

    private function attempt(Request $request, bool $admin)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $back = $admin ? 'login.admin' : 'login.pengguna';
        $user = User::where('email', strtolower(trim($data['email'])))->first();

        if (! $user) {
            return redirect()->route($back)->withInput($request->only('email'))->with('error', 'Email tidak ditemukan!');
        }
        if ($admin && ! $user->isAdmin()) {
            return redirect()->route($back)->withInput($request->only('email'))->with('error', 'Akses ditolak! Anda bukan Administrator.');
        }
        if (! $admin && $user->isAdmin()) {
            return redirect()->route($back)->withInput($request->only('email'))->with('error', 'Silakan gunakan portal Admin untuk login.');
        }
        if (! Hash::check($data['password'], $user->password_hash)) {
            return redirect()->route($back)->withInput($request->only('email'))->with('error', 'Kata sandi salah!');
        }

        Auth::login($user);
        $request->session()->regenerate();
        $request->session()->put('user_id', $user->id);

        return redirect()->route($admin ? 'admin.dashboard' : 'pengguna.beranda');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'konfirmasi_password' => ['required', 'same:password'],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.max' => 'Nama lengkap maksimal 100 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 100 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'konfirmasi_password.required' => 'Konfirmasi kata sandi wajib diisi.',
            'konfirmasi_password.same' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        User::create([
            'nama_lengkap' => $data['nama'],
            'email' => strtolower($data['email']),
            'no_telepon' => '',
            'role' => 'mahasiswa',
            'password_hash' => Hash::make($data['password']),
        ]);

        return redirect()->route('login.pengguna')->with('success', 'Registrasi berhasil! Silakan masuk.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing.home');
    }
}
