<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
    protected $table = "latihan";
    protected $guarded = ['id'];

    public function kuis(){
        return $this->belongsTo('App\Pertemuan', 'id_pertemuan');
    }
}
