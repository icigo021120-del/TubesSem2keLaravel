<?php

use App\Http\Controllers\Api\MonitoringController;
use App\Http\Controllers\Api\ReferenceController;
use Illuminate\Support\Facades\Route;

// Prefix "/api" otomatis dari bootstrap/app.php

Route::get('/', [ReferenceController::class, 'index']);

Route::apiResource('monitoring', MonitoringController::class);

Route::get('sensors', [ReferenceController::class, 'sensors']);
Route::get('alerts', [ReferenceController::class, 'alerts']);
Route::get('evacuation-routes', [ReferenceController::class, 'evacuationRoutes']);
Route::get('assembly-points', [ReferenceController::class, 'assemblyPoints']);
Route::get('education', [ReferenceController::class, 'education']);
