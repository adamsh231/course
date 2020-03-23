<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use Notifiable;

    protected $table = "siswa";
    protected $guarded = ['id'];

    public function presensi(){
        return $this->hasMany('App\Presensi', 'id_siswa');
    }

    public function nilai(){
        return $this->hasMany('App\Nilai', 'id_siswa');
    }
}
