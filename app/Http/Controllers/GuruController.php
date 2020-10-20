<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guru;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    public function profile($id)
    {
        $guru = Guru::find($id);
        return view('guru.profile', ['guru' => $guru]);
    }

    public function index()
    {
        $guru = \App\Guru::all();
        return view('guru.index', ['guru' => $guru]);
    }

    public function create(Request $request)
    {

        // inset ke tabel user
        $user = new \App\User;
        $user->role = $request->role;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token = Str::random(40);
        $user->save();

        // inset ke tabel guru
        $request->request->add(['user_id' => $user->id]);
        $guru = \App\Guru::create($request->all());
        return redirect('/guru')->with('sukses', 'Data Guru Berhasil Ditambahkan');
    }

    public function getdataguru()
    {
        $guru = Guru::select('guru.*');
        return \DataTables::eloquent($guru)
            ->addColumn('aksi', function ($s) {
                return
                    '<a href="/siswa/' . $s->id . '/profile" class="btn btn-primary btn-sm">Prof</a>' . ' ' .
                    '<a href="/siswa/' . $s->id . '/edit" class="btn btn-warning btn sm">Edit</a>' . ' ' .
                    '<a href="#" class="btn btn-danger btn-sm delete" siswa-id="' . $s->id . '" siswa-nama="' . $s->nama . '">Hapus</a>' . ' ' .
                    '<a href="/siswa/' . $s->id . '/rubahpassword" class="btn btn-success btn-sm">Pass</a>';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }
}
