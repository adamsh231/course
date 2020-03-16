<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = "video";
    protected $guarded = ['id'];

    public function pertemuan(){
        return $this->belongsTo('App\Pertemuan', 'id_pertemuan');
    }
}
