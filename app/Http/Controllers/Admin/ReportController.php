<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('status', 'semua');

        $laporan = Report::with('user')
            ->when($filter !== 'semua' && in_array($filter, Report::STATUS), fn ($q) => $q->where('status_laporan', $filter))
            ->orderByDesc('waktu_lapor')
            ->get();

        return view('admin.laporan.index', compact('laporan', 'filter'));
    }

    public function show(Report $laporan)
    {
        $laporan->load('user');

        return view('admin.laporan.show', compact('laporan'));
    }

    public function update(Request $request, Report $laporan)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(Report::STATUS)],
        ]);

        $laporan->update(['status_laporan' => $data['status']]);
        ActivityLog::catat('Mengubah Status Laporan', "Laporan #{$laporan->id} menjadi {$data['status']}");

        return back()->with('success', "Status laporan #{$laporan->id} berhasil diperbarui.");
    }

    public function destroy(Report $laporan)
    {
        $id = $laporan->id;
        $laporan->hapusFoto();
        $laporan->delete();
        ActivityLog::catat('Menghapus Laporan', "Laporan #$id dihapus");

        return redirect()->route('admin.laporan.index')->with('success', "Laporan #$id berhasil dihapus.");
    }
}
