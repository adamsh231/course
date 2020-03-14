<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = "detail";
    protected $guarded = ['id'];

    public function pertemuan(){
        return $this->belongsTo('App\Pertemuan', 'id_pertemuan');
    }
}
