<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @method \Illuminate\Routing\PendingResourceRegistration middleware(array|string $middleware)
 */

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $r)
    {
        User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => Hash::make($r->password),
            'role' => $r->role,
        ]);

        return redirect('/users')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $r, $id)
    {
        $u = User::find($id);

        $u->name = $r->name;
        $u->email = $r->email;
        $u->role = $r->role;

        if ($r->password != "") {
            $u->password = Hash::make($r->password);
        }

        $u->save();

        return redirect('/users')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect('/users')->with('success', 'User berhasil dihapus');
    }
}
