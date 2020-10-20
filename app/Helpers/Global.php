<?php

use App\Siswa;
use App\Guru;
use App\Admin;

function rangking5Besar()
{
    $siswa = \App\Siswa::all();

    //menambahkan atribut rataRataNilai
    $siswa->map(function ($s) {
        $s->rataRataNilai = $s->rataRataNilai();
        return $s;
    });
    $siswa = $siswa->sortByDesc('rataRataNilai')->take(5);
    return $siswa;
}

function totalsiswa()
{
    return Siswa::count();
}

function totalguru()
{
    return Guru::count();
}

function totaladmin()
{
    return Admin::count();
}
