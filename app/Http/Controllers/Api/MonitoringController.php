<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * REST API /api/monitoring (data laporan), format respons sama dengan API native lama
 * supaya react-frontend tetap bisa dipakai.
 */
class MonitoringController extends Controller
{
    public function index(): JsonResponse
    {
        $data = Report::with('user')->orderByDesc('waktu_lapor')->get()->map(fn ($r) => $this->format($r));

        return $this->ok($data);
    }

    public function show($id): JsonResponse
    {
        $report = Report::with('user')->find($id);

        return $report ? $this->ok($this->format($report)) : $this->fail('Data monitoring tidak ditemukan', 404);
    }

    public function store(Request $request): JsonResponse
    {
        foreach (['user_id', 'deskripsi_kejadian', 'lokasi_kejadian'] as $field) {
            if (! $request->filled($field)) {
                return $this->fail("Field '$field' wajib diisi", 400);
            }
        }

        $status = $request->input('status_laporan', 'menunggu');
        if (! in_array($status, Report::STATUS)) {
            $status = 'menunggu';
        }

        $report = Report::create([
            'user_id'            => (int) $request->input('user_id'),
            'deskripsi_kejadian' => $request->input('deskripsi_kejadian'),
            'lokasi_kejadian'    => $request->input('lokasi_kejadian'),
            'status_laporan'     => $status,
            'foto_bukti'         => $request->input('foto_bukti'),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data monitoring berhasil ditambahkan',
            'data'    => $this->format($report->fresh('user')),
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $report = Report::find($id);
        if (! $report) {
            return $this->fail('Data monitoring tidak ditemukan', 404);
        }

        $status = $request->input('status_laporan', $report->status_laporan);
        if (! in_array($status, Report::STATUS)) {
            $status = $report->status_laporan;
        }

        $report->update([
            'deskripsi_kejadian' => $request->input('deskripsi_kejadian', $report->deskripsi_kejadian),
            'lokasi_kejadian'    => $request->input('lokasi_kejadian', $report->lokasi_kejadian),
            'status_laporan'     => $status,
            'foto_bukti'         => $request->input('foto_bukti', $report->foto_bukti),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data monitoring berhasil diperbarui',
            'data'    => $this->format($report->fresh('user')),
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $report = Report::find($id);
        if (! $report) {
            return $this->fail('Data monitoring tidak ditemukan', 404);
        }

        $report->hapusFoto();
        $report->delete();

        return response()->json(['status' => 'success', 'message' => "Data monitoring #$id berhasil dihapus"]);
    }

    private function format(Report $r): array
    {
        return [
            'id'                 => $r->id,
            'user_id'            => $r->user_id,
            'deskripsi_kejadian' => $r->deskripsi_kejadian,
            'lokasi_kejadian'    => $r->lokasi_kejadian,
            'status_laporan'     => $r->status_laporan,
            'foto_bukti'         => $r->foto_bukti,
            'waktu_lapor'        => $r->waktu_lapor?->format('Y-m-d H:i:s'),
            'nama_lengkap'       => $r->user?->nama_lengkap,
            'email'              => $r->user?->email,
        ];
    }

    private function ok($data): JsonResponse
    {
        return response()->json(['status' => 'success', 'data' => $data]);
    }

    private function fail(string $message, int $code): JsonResponse
    {
        return response()->json(['status' => 'error', 'message' => $message], $code);
    }
}
