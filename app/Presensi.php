<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = "presensi";
    protected $guarded = ['id'];

    public function pertemuan()
    {
        return $this->belongsTo('App\Pertemuan', 'id_pertemuan');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Siswa', 'id_siswa');
    }
}
