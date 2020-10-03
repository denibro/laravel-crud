<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $admin = \App\Admin::all();
        return view('admins.index', ['admin' => $admin]);
    }

    public function create(Request $request)
    {
        // inset ke tabel user
        $user = new \App\User;
        $user->role = $request->role;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(40);
        $user->save();

        // inset ke tabel siswa
        $request->request->add(['user_id' => $user->id]);
        $admin = \App\Admin::create($request->all());
        return redirect('/admins');
    }
}
