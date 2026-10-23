<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\AssemblyPoint;
use App\Models\EducationModule;
use App\Models\EvacuationRoute;
use App\Models\Sensor;
use Illuminate\Http\JsonResponse;

/**
 * Endpoint GET read-only: sensors, alerts, evacuation-routes, assembly-points, education.
 */
class ReferenceController extends Controller
{
    public function sensors(): JsonResponse
    {
        return $this->ok(Sensor::orderBy('id')->get());
    }

    public function alerts(): JsonResponse
    {
        $data = Alert::with('sensor')->orderByDesc('waktu_kejadian')->get()->map(fn ($a) => [
            'id'               => $a->id,
            'sensor_id'        => $a->sensor_id,
            'tingkat_bahaya'   => $a->tingkat_bahaya,
            'pesan_peringatan' => $a->pesan_peringatan,
            'waktu_kejadian'   => $a->waktu_kejadian?->format('Y-m-d H:i:s'),
            'kode_sensor'      => $a->sensor?->kode_sensor,
            'lokasi_gedung'    => $a->sensor?->lokasi_gedung,
        ]);

        return $this->ok($data);
    }

    public function evacuationRoutes(): JsonResponse
    {
        return $this->ok(EvacuationRoute::orderBy('id')->get());
    }

    public function assemblyPoints(): JsonResponse
    {
        return $this->ok(AssemblyPoint::orderBy('id')->get());
    }

    public function education(): JsonResponse
    {
        return $this->ok(EducationModule::orderByDesc('created_at')->get());
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'status'    => 'success',
            'message'   => 'Smart Disaster System REST API',
            'endpoints' => [
                'GET /api/monitoring',
                'GET /api/monitoring/{id}',
                'POST /api/monitoring',
                'PUT /api/monitoring/{id}',
                'PATCH /api/monitoring/{id}',
                'DELETE /api/monitoring/{id}',
                'GET /api/sensors',
                'GET /api/alerts',
                'GET /api/evacuation-routes',
                'GET /api/assembly-points',
                'GET /api/education',
            ],
        ]);
    }

    private function ok($data): JsonResponse
    {
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
