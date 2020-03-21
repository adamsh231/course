<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pertemuan');
            $table->unsignedBigInteger('id_siswa');
            $table->enum('kehadiran',['Tidak Hadir', 'Hadir'])->default('Tidak Hadir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presensi');
    }
}
