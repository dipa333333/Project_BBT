<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        $data = Sensor::all();
        return view('sensor.index', compact('data'));
    }

    public function create()
    {
        return view('sensor.create');
    }

    public function store(Request $request)
    {
        Sensor::create($request->all());
        return redirect('/sensor')->with('success', 'Sensor berhasil ditambahkan!');
    }

    public function edit(Sensor $sensor)
    {
        return view('sensor.edit', compact('sensor'));
    }

    public function update(Request $request, Sensor $sensor)
    {
        $sensor->update($request->all());
        return redirect('/sensor')->with('success', 'Sensor berhasil diperbarui!');
    }

    public function destroy(Sensor $sensor)
    {
        $sensor->delete();
        return redirect('/sensor')->with('success', 'Sensor berhasil dihapus!');
    }
}
