<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = "soal";
    protected $guarded = ['id'];

    public function kuis(){
        return $this->belongsTo('App\Kuis', 'id_kuis');
    }
}
