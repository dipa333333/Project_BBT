<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\Monitoring;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'totalSensor'       => Sensor::count(),
            'sensorAktif'       => Sensor::where('status', 'aktif')->count(),
            'sensorNonAktif'    => Sensor::where('status', 'nonaktif')->count(),

            'pemakaianHariIni' => Monitoring::latest()->value('total_volume') ?? 0,

            'labels' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            'values' => [150, 200, 180, 220, 240, 260, 210],
        ]);
    }
}
