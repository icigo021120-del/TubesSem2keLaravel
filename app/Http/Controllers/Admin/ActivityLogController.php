<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Alert;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $filter  = $request->query('tipe', 'semua');
        $perPage = 15;
        $page    = max(1, (int) $request->query('page', 1));

        $logs = collect()
            ->merge(Alert::all()->map(fn ($a) => [
                'tipe' => 'alert', 'sub' => $a->tingkat_bahaya, 'teks' => $a->pesan_peringatan,
                'waktu' => $a->waktu_kejadian, 'lokasi' => null, 'nama_user' => null,
            ]))
            ->merge(Report::with('user')->get()->map(fn ($r) => [
                'tipe' => 'laporan', 'sub' => $r->status_laporan, 'teks' => $r->deskripsi_kejadian,
                'waktu' => $r->waktu_lapor, 'lokasi' => $r->lokasi_kejadian, 'nama_user' => $r->user?->nama_lengkap,
            ]))
            ->merge(ActivityLog::all()->map(fn ($l) => [
                'tipe' => 'aktivitas', 'sub' => 'Sistem', 'teks' => $l->aksi,
                'waktu' => $l->created_at, 'lokasi' => $l->detail, 'nama_user' => null,
            ]))
            ->merge(User::all()->map(fn ($u) => [
                'tipe' => 'aktivitas', 'sub' => 'Pendaftaran', 'teks' => 'Akun baru terdaftar: ' . $u->nama_lengkap,
                'waktu' => $u->created_at, 'lokasi' => null, 'nama_user' => $u->nama_lengkap,
            ]))
            ->sortByDesc('waktu')
            ->values();

        if (in_array($filter, ['alert', 'laporan', 'aktivitas'])) {
            $logs = $logs->where('tipe', $filter)->values();
        } else {
            $filter = 'semua';
        }

        $paginator = new LengthAwarePaginator(
            $logs->forPage($page, $perPage)->values(),
            $logs->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.log.index', ['logs' => $paginator, 'filter' => $filter]);
    }
}
