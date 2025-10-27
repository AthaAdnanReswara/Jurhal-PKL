<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dudi extends Model
{
    //
    protected $fillable = ([
        'nama_dudi',
        'jenis_usaha',
        'alamat',
        'no_hp',
        'direktur',
        'pembimbing',
    ]);

    public function siswa() {
        return $this->hasMany(Siswa::class, 'nama_dudi');
    }
}
