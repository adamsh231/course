<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = "nilai";
    protected $guarded = ['id'];

    public function siswa(){
        return $this->belongsTo('App\Siswa', 'id_siswa');
    }

    public function kuis(){
        return $this->belongsTo('App\Kuis', 'id_kuis');
    }
}
