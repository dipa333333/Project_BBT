<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function index()
    {
        $data = Notifikasi::latest()->get();
        return view('notifikasi.index', compact('data'));
    }

    public function destroy(Notifikasi $notifikasi)
    {
         $notifikasi->delete();
        return back()->with('success', 'Notifikasi dihapus');
    }



    public function store(Request $request)
    {
        
    }


    public function show(string $id)
    {

    }


    public function edit(string $id)
    {

    }


    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */


}
