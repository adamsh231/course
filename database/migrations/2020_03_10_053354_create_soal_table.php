<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_kuis');
            $table->string('gambar')->nullable(); //pertanyaan lewat gambar
            $table->text('pertanyaan'); //pertanyaan lewat text
            $table->string('A');
            $table->string('B');
            $table->string('C');
            $table->string('D');
            $table->enum('jawaban',['A','B','C','D']);
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
        Schema::dropIfExists('soal');
    }
}
