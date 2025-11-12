<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    protected $fillable = ([
        'id_siswa',
        'NIS',
        'jurusan_id',
        'tempat_lahir',
        'tanggal_lahir',
        'kelas_id',
        'jenis_kelamin',
        'golongan_darah',
        'nama_dudi',
        'pembimbing_id',
        'foto',
        'no_hp',
    ]);

    public function user() {
        return $this->belongsTo(User::class, 'id_siswa');
    }

    public function pembimbing() {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function jurusan() {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function dudi() {
        return $this->belongsTo(Dudi::class, 'nama_dudi');
    }

    public function kegiatan() {
        return $this->hasMany(Kegiatan::class, 'id_siswa');
    }

    public function absensi() {
        return $this->hasMany(Absensi::class, 'id_siswa');
    }

}
