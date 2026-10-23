<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\Report;
use App\Models\Sensor;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            ['val' => User::where('role', '!=', 'admin')->count(), 'label' => 'Total Pengguna',  'icon' => 'fa-users',          'color' => 'bg-blue-50 text-blue-600'],
            ['val' => Report::count(),                              'label' => 'Total Laporan',   'icon' => 'fa-file-lines',     'color' => 'bg-purple-50 text-purple-600'],
            ['val' => Report::where('status_laporan', 'menunggu')->count(), 'label' => 'Menunggu Tindak', 'icon' => 'fa-clock', 'color' => 'bg-yellow-50 text-yellow-600'],
            ['val' => Sensor::where('status', 'aktif')->count(),    'label' => 'Sensor Aktif',    'icon' => 'fa-satellite-dish', 'color' => 'bg-green-50 text-green-600'],
            ['val' => Sensor::count(),                              'label' => 'Total Sensor',    'icon' => 'fa-circle-dot',     'color' => 'bg-teal-50 text-teal-600'],
            ['val' => Alert::count(),                               'label' => 'Total Alert',     'icon' => 'fa-bell',           'color' => 'bg-red-50 text-red-600'],
        ];

        return view('admin.dashboard', [
            'stats'        => $stats,
            'recent'       => Report::with('user')->orderByDesc('waktu_lapor')->take(5)->get(),
            'recentAlerts' => Alert::with('sensor')->orderByDesc('waktu_kejadian')->take(5)->get(),
        ]);
    }
}
