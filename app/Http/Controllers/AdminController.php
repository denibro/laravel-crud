<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Str;
use \App\User;

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
        return redirect('/admins')->with('tambahadmin', 'Data Admin Berhasil Ditambahkan');
    }

    public function delete($id)
    {
        $admin = \App\Admin::find($id);
        $admin->delete();
        return redirect('/admins')->with('deleteadmin', 'Data Berhasil Dihapus');
    }

    public function edit($id)
    {
        $admin = \App\Admin::find($id);
        return view('admins.edit', ['admin' => $admin]);
    }

    public function update(Request $request, $idadmin, $iduser)
    {
        // update tabel admin
        $admin = \App\Admin::find($idadmin);
        $admin->update($request->all());

        // update tabel users
        $user = \App\User::find($iduser);
        $user->update([
            'role' => $request->role,
            'name' => $request->nama,
            'email' => $request->email,
            // 'password' => bcrypt($request->password)
        ]);
        return redirect('/admins')->with('updateadmin', 'Data Admin Berhasil Diupdate');
    }

    public function rubahpassword($id)
    {
        $user = \App\User::find($id);
        return view('admins.editpas', ['user' => $user]);
    }

    public function updatepassword(Request $request, $id)
    {
        $user = \App\User::find($id);
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        return redirect('/admins')->with('updatepassadmin', 'Password Admin Berhasil Diupdate');
    }
}
