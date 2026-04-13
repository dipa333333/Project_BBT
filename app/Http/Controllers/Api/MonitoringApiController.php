<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Monitoring;

class MonitoringApiController extends Controller
{
    // Ambil data terbaru (untuk current value)
    public function latest()
    {
        $data = Monitoring::latest()->first();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    // Ambil 20 data terakhir (untuk chart)
    public function chart()
    {
        $data = Monitoring::latest()
            ->take(20)
            ->get()
            ->reverse()
            ->values();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function simulate()
    {
        $flowRate = rand(5, 50);

        $last = Monitoring::latest()->first();
        $lastTotal = $last ? $last->total_volume ?? 0 : 0;

        $intervalSeconds = 5;
        $volumeAdded = ($flowRate / 60) * $intervalSeconds;
        $newTotal = $lastTotal + $volumeAdded;

        Monitoring::create([
            'sensor_id' => 7,
            'value' => $flowRate, // 🔥 INI WAJIB ADA
            'flow_rate' => $flowRate,
            'total_volume' => $newTotal
        ]);

        return response()->json([
            'status' => 'success',
            'flow_rate' => $flowRate,
            'total_volume' => $newTotal
        ]);
    }
}