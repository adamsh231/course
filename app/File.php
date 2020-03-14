<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = "file";
    protected $guarded = ['id'];

    public function pertemuan(){
        return $this->belongsTo('App\Pertemuan', 'id_pertemuan');
    }
}
