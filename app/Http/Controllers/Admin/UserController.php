<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->query('q', ''));

        $users = User::withCount('reports')
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($w) use ($search) {
                    $w->where('nama_lengkap', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
                });
            })
            ->orderByDesc('created_at')
            ->get();

        return view('admin.pengguna.index', [
            'users'   => $users,
            'search'  => $search,
            'adminId' => User::admin()?->id,
        ]);
    }

    public function destroy(User $pengguna)
    {
        if ($pengguna->id === User::admin()?->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $pengguna->reports->each->hapusFoto();
        $pengguna->delete();
        ActivityLog::catat('Menghapus Pengguna', "Admin menghapus user dengan ID: {$pengguna->id}");

        return back()->with('success', "Pengguna #{$pengguna->id} berhasil dihapus.");
    }

    public function toggleRole(User $pengguna)
    {
        if ($pengguna->id === User::admin()?->id) {
            return back()->with('error', 'Role akun sendiri tidak bisa diubah.');
        }

        $newRole = $pengguna->isAdmin() ? 'mahasiswa' : 'admin';
        $pengguna->update(['role' => $newRole]);
        ActivityLog::catat('Mengubah Role', "Admin mengubah role user ID {$pengguna->id} menjadi $newRole");

        return back()->with('success', "Role pengguna #{$pengguna->id} diperbarui menjadi $newRole.");
    }
}
