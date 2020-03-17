<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pertemuan')->unique();
            $table->string('nama');
            $table->string('jawaban')->nullable(); // File
            $table->integer('waktu');
            $table->boolean('aktif')->default(0);
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
        Schema::dropIfExists('kuis');
    }
}
