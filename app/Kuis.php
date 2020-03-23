<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    protected $table = "kuis";
    protected $guarded = ['id'];

    public function pertemuan(){
        return $this->belongsTo('App\Pertemuan', 'id_pertemuan');
    }

    public function soal(){
        return $this->hasMany('App\Soal', 'id_kuis');
    }

    public function nilai(){
        return $this->hasMany('App\Nilai', 'id_siswa');
    }
}
