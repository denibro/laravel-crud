<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Mapel;
use \App\Guru;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = \App\Mapel::all();
        $guru = \App\Guru::all();
        return view('mapel.index', ['mapel' => $mapel, 'guru' => $guru]);
    }

    public function create(Request $request)
    {

        // return $request;
        $mapel = new \App\Mapel;
        $mapel->guru_id = $request->guru_id;
        $mapel->kode = $request->kode;
        $mapel->nama = $request->nama;
        $mapel->semester = $request->semester;
        $mapel->save();

        return redirect('/mapel')->with('sukses', 'Data Mapel Berhasil Ditambahkan');
    }

    public function getdatamapel()
    {
        $mapel = Mapel::select('mapel.*');
        return \DataTables::eloquent($mapel)
            ->addColumn('aksi', function ($s) {
                return
                    '<a href="/siswa/' . $s->id . '/profile" class="btn btn-primary btn-sm">Prof</a>' . ' ' .
                    '<a href="/siswa/' . $s->id . '/edit" class="btn btn-warning btn-sm">Edit</a>' . ' ' .
                    '<a href="#" class="btn btn-danger btn-sm delete" siswa-id="' . $s->id . '" siswa-nama="' . $s->nama . '">Hapus</a>';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }
}
