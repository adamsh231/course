<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presensi', function (Blueprint $table) {
            $table->foreign('id_pertemuan')->references('id')->on('pertemuan')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('cascade');
        });
        Schema::table('file', function (Blueprint $table) {
            $table->foreign('id_pertemuan')->references('id')->on('pertemuan')->onDelete('cascade');
        });
        Schema::table('soal', function (Blueprint $table) {
            $table->foreign('id_kuis')->references('id')->on('kuis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presensi', function (Blueprint $table) {
            $table->dropForeign(['id_pertemuan']);
            $table->dropForeign(['id_siswa']);
        });
        Schema::table('file', function (Blueprint $table) {
            $table->dropForeign(['id_pertemuan']);
        });
        Schema::table('soal', function (Blueprint $table) {
            $table->dropForeign(['id_kuis']);
        });
    }
}
