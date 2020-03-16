<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deskripsi extends Model
{
    protected $table = "deskripsi";
    protected $guarded = ['id'];

    public function detail(){
        return $this->belongsTo('App\Detail', 'id_detail');
    }
}
