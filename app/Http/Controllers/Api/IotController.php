<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Monitoring;

class IotController extends Controller
{
    public function store(Request $request)
    {
        Monitoring::create([
            'sensor_id' => $request->sensor_id,
            'value' => $request->flow_rate, 
            'flow_rate' => $request->flow_rate,
            'total_volume' => $request->total_volume,
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }
}