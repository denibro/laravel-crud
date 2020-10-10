<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Str;
use \App\Siswa;
use \App\Post;

class SiteController extends Controller
{

    public function home()
    {
        return view('sites.home');
    }

    public function about()
    {
        return view('sites.about');
    }


    public function register(Request $request)
    {
        // untuk validasi
        $this->validate($request, [
            'nama_depan' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'jenis_kelamin' => 'required',
            'agama' => 'required'
        ]);

        // inset ke tabel user
        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(40);
        $user->save();

        // inset ke tabel siswa
        $request->request->add(['user_id' => $user->id]);
        $siswa = \App\Siswa::create($request->all());
        return
            redirect('/login')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    public function singlepost($slug)
    {
        $post = Post::where('slug', '=', $slug)->first();
        return view('sites.singlepost', compact(['post']));
    }
}
