<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['user_id', 'nama', 'telepon', 'jenis_kelamin', 'agama', 'alamat'];

    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }
}
