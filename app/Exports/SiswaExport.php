<?php

namespace App\Exports;

use App\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

// class SiswaExport implements FromCollection, WithMapping, WithHeadings, FromView
class SiswaExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    // untuk menampilkan semua data di databes siswa
    // public function collection()
    // {
    //     return Siswa::all();
    // }

    // // untuk menampilkan data yang bisa di custom
    // public function map($siswa): array
    // {
    //     return [
    //         $siswa->nama_lengkap(),
    //         $siswa->jenis_kelamin,
    //         $siswa->agama,
    //         $siswa->alamat,
    //         $siswa->rataRataNilai()
    //     ];
    // }

    // public function headings(): array
    // {
    //     return [
    //         'NAMA',
    //         'JENIS_KELAMIN',
    //         'AGAMA',
    //         'ALAMAT',
    //         'NILAI RATA RATA'
    //     ];
    // }

    public function view(): View
    {
        return view('export.siswaexcel', [
            'siswaexcel' => Siswa::all()
        ]);
    }
}
