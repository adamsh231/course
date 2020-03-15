<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    protected $table = "pertemuan";
    protected $guarded = ['id'];

    public function detail(){
        return $this->hasMany('App\Detail', 'id_pertemuan');
    }

    public function file(){
        return $this->hasMany('App\File', 'id_pertemuan');
    }

    public function kuis(){
        return $this->hasOne('App\Kuis', 'id_pertemuan');
    }

    public function presensi(){
        return $this->hasMany('App\Presensi', 'id_pertemuan');
    }
}
