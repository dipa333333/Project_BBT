<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting; // model untuk tabel settings

class SettingsController extends Controller
{

    public function index()
    {
        $settings = Setting::first(); // ambil data pertama saja
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'max_usage' => 'required|numeric',
            'unit' => 'required|string',
        ]);

        $settings = Setting::first() ?? new Setting;

        $settings->max_usage = $request->max_usage;
        $settings->unit = $request->unit;
        $settings->dark_mode = $request->has('dark_mode'); // true/false

        $settings->save();

        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil disimpan!');
    }
}
