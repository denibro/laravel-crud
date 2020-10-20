<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Str;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Siswa;


class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data_siswa = \App\Siswa::where('nama_depan', 'LIKE', '%' . $request->cari . '%')->get();
        } else {
            $data_siswa = \App\Siswa::all();
        }
        return view('siswa.index', ['data_siswa' => $data_siswa]);
    }


    public function create(Request $request)
    {

        // inset ke tabel user
        $user = new \App\User;
        $user->role = $request->role;
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token = Str::random(40);
        $user->save();

        // inset ke tabel siswa
        $request->request->add(['user_id' => $user->id]);
        $siswa = \App\Siswa::create($request->all());
        return redirect('/siswa')->with('sukses', 'Data Siswa Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $siswa = \App\Siswa::find($id);
        return view('siswa.edit', ['siswa' => $siswa]);
    }

    public function update(Request $request, $idsiswa, $iduser)
    {
        // dd($request->all());
        $siswa = \App\Siswa::find($idsiswa);
        $siswa->update($request->all());
        if ($request->hasfile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }

        // update tabel users
        $user = \App\User::find($iduser);
        $user->update([
            'email' => $request->email
        ]);
        return redirect('/dashboard')->with('sukses', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $siswa = \App\Siswa::find($id);
        $siswa->delete();
        return redirect('/siswa')->with('delete', 'Data Berhasil Dihapus');
    }

    public function profile($id)
    {
        if (auth()->user()->role == 'siswa') {

            $user = \App\User::find($id);
            $siswa = $user->siswa;
            return view('siswa.profile', ['siswa' => $siswa]);
        } else {
            $siswa = \App\Siswa::find($id);
            $matapelajaran = \App\Mapel::all();

            // menyiapkan data untuk chart
            $categories = [];
            $data = [];

            foreach ($matapelajaran as $mp) {
                if ($siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()) {
                    $categories[] = $mp->nama;
                    $data[] = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
                }
            }
            return view('siswa.profile', ['siswa' => $siswa, 'matapelajaran' => $matapelajaran, 'categories' => $categories, 'data' => $data]);
        }
    }

    public function addnilai(Request $request, $idsiswa)
    {
        $siswa = \App\Siswa::find($idsiswa);
        if ($siswa->mapel()->where('mapel_id', $request->mapel)->exists()) {
            return redirect('siswa/' . $idsiswa . '/profile')->with('error', 'Mata Pelajaran Sudah pernah dimasukan');
        }
        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);
        return redirect('siswa/' . $idsiswa . '/profile')->with('sukses', 'Nilai Berhasil Dimasukan');
    }

    public function deletenilai($idsiswa, $idmapel)
    {
        $siswa = \App\Siswa::find($idsiswa);
        $siswa->mapel()->detach($idmapel);
        return redirect()->back()->with('deletenilaimapel', 'Data Nilai Berhasil Dihapus');
    }
    public function exportExcel()
    {
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }

    public function exportPdf()
    {
        $siswa = \App\Siswa::all();
        $pdf = PDF::loadView('export.siswapdf', ['siswa' => $siswa]);
        return $pdf->download('Siswa.pdf');
    }

    public function rubahpassword($id)
    {
        $siswa = \App\Siswa::find($id);
        return view('siswa.editpas', ['siswa' => $siswa]);
    }

    public function updatepassword(Request $request, $id)
    {
        $user = \App\User::find($id);
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        return redirect('/siswa')->with('updatepasssiswa', 'Password Siswa Berhasil Diupdate');
    }

    public function getdatasiswa()
    {
        $siswa = Siswa::select('siswa.*');
        return \DataTables::eloquent($siswa)
            ->addColumn('nama_lengkap', function ($s) {
                return $s->nama_depan . ' ' .  $s->nama_belakang;
            })
            ->addColumn('rata2_nilai', function ($s) {
                return $s->rataRataNilai();
            })
            ->addColumn('aksi', function ($s) {
                return
                    '<a href="/siswa/' . $s->id . '/profile" class="btn btn-primary btn-sm">Prof</a>' . ' ' .
                    '<a href="/siswa/' . $s->id . '/edit" class="btn btn-warning btn sm">Edit</a>' . ' ' .
                    '<a href="#" class="btn btn-danger btn-sm delete" siswa-id="' . $s->id . '" siswa-nama="' . $s->nama_lengkap() . '">Hapus</a>' . ' ' .
                    '<a href="/siswa/' . $s->id . '/rubahpassword" class="btn btn-success btn-sm">Pass</a>';
            })
            ->rawColumns(['nama_lengkap', 'rata2_nilai', 'aksi'])
            ->toJson();
    }

    public function importexcel(Request $request)
    {
        Excel::import(new \App\Imports\SiswaImport, $request->file('data_siswa'));
        return redirect('/siswa')->with('updatepasssiswa', 'Import Data selesai');
    }
}
