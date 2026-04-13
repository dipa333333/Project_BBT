<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Monitoring;
use App\Models\Sensor;
use App\Http\Controllers\Api\MonitoringApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/iot/flow', function (Request $request) {

    $request->validate([
        'sensor_id'    => 'required|exists:sensors,id',
        'flow_rate'    => 'required|numeric',
        'total_volume' => 'required|numeric'
    ]);

    Monitoring::create([
        'sensor_id'    => $request->sensor_id,
        'value'        => $request->flow_rate, // sementara tetap isi
        'flow_rate'    => $request->flow_rate,
        'total_volume' => $request->total_volume,
    ]);

    Sensor::where('id', $request->sensor_id)
        ->update(['status' => 'online']);

    return response()->json([
        'status' => 'success',
        'message' => 'Data berhasil disimpan'
    ]);
});

Route::get('/monitoring/latest', [MonitoringApiController::class, 'latest']);
Route::get('/monitoring/chart', [MonitoringApiController::class, 'chart']);
Route::get('/simulate/flow', [MonitoringApiController::class, 'simulate']);