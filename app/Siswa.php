<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['nama_depan', 'nama_belakang', 'jenis_kelamin', 'agama', 'alamat', 'avatar', 'user_id'];

    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('/images/default.png');
        }
        return asset('images/' . $this->avatar);
    }

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class)->withPivot(['nilai'])->withTimeStamps();
    }

    public function rataRataNilai()
    {
        $total = 0;
        $hitung = 0;
        if ($this->mapel->isNotEmpty()) {
            foreach ($this->mapel as $mapel) {
                $total = $total + $mapel->pivot->nilai;
                $hitung = $hitung + 1;
            }
        }
        return $total != 0 ? round($total / $hitung) : $total;
    }

    public function nama_lengkap()
    {
        return $this->nama_depan . ' ' . $this->nama_belakang;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function JumlahNilai()
    {
        $total = 0;
        if ($this->mapel->isNotEmpty()) {
            foreach ($this->mapel as $mapel) {
                $total = $total + $mapel->pivot->nilai;
            }
        }
        return $total;
    }

    // untuk merubah huruf pertama jadi kapital ditampilkan di halaman index
    public function getNamaDepanAttribute($value)
    {
        return ucwords($value);
    }

    public function getNamaBelakangAttribute($value)
    {
        return ucwords($value);
    }

    public function getAgamaAttribute($value)
    {
        return ucwords($value);
    }

    public function getAlamatAttribute($value)
    {
        return ucwords($value);
    }
    // akhir untuk merubah huruf pertama jadi kapital ditampilkan di halaman index

    // untuk merubah huruf pertama jadi kapital ditampilkan di tabel
    public function setNamaDepanAttribute($value)
    {
        $this->attributes['nama_depan'] = ucwords($value);
    }

    public function setNamaBelakangAttribute($value)
    {
        $this->attributes['nama_belakang'] = ucwords($value);
    }

    public function setAgamaAttribute($value)
    {
        $this->attributes['agama'] = ucwords($value);
    }

    public function setAlamatAttribute($value)
    {
        $this->attributes['alamat'] = ucwords($value);
    }
    // akhir untuk merubah huruf pertama jadi kapital ditampilkan di tabel
}
