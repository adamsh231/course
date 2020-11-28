<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeign extends Migration
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
        Schema::table('video', function (Blueprint $table) {
            $table->foreign('id_pertemuan')->references('id')->on('pertemuan')->onDelete('cascade');
        });
        Schema::table('soal', function (Blueprint $table) {
            $table->foreign('id_kuis')->references('id')->on('kuis')->onDelete('cascade');
        });
        Schema::table('latihan', function (Blueprint $table) {
            $table->foreign('id_pertemuan')->references('id')->on('pertemuan')->onDelete('cascade');
        });
        Schema::table('detail', function (Blueprint $table) {
            $table->foreign('id_pertemuan')->references('id')->on('pertemuan')->onDelete('cascade');
        });
        Schema::table('kuis', function (Blueprint $table) {
            $table->foreign('id_pertemuan')->references('id')->on('pertemuan')->onDelete('cascade');
        });
        Schema::table('deskripsi', function (Blueprint $table) {
            $table->foreign('id_detail')->references('id')->on('detail')->onDelete('cascade');
        });
        Schema::table('nilai', function (Blueprint $table) {
            $table->foreign('id_kuis')->references('id')->on('kuis')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('cascade');
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
        Schema::table('video', function (Blueprint $table) {
            $table->dropForeign(['id_pertemuan']);
        });
        Schema::table('soal', function (Blueprint $table) {
            $table->dropForeign(['id_kuis']);
        });
        Schema::table('soal', function (Blueprint $table) {
            $table->dropForeign(['id_pertemuan']);
        });
        Schema::table('detail', function (Blueprint $table) {
            $table->dropForeign(['id_pertemuan']);
        });
        Schema::table('kuis', function (Blueprint $table) {
            $table->dropForeign(['id_pertemuan']);
        });
        Schema::table('deskripsi', function (Blueprint $table) {
            $table->dropForeign(['id_detail']);
        });
        Schema::table('nilai', function (Blueprint $table) {
            $table->dropForeign(['id_kuis']);
            $table->dropForeign(['id_siswa']);
        });
    }
}
