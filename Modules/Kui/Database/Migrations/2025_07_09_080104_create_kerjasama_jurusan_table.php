<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKerjasamaJurusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerjasama_jurusan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kerjasama')->references('id')->on('kegiatankerjasama')->onDelete('cascade');
            $table->foreignId('id_jurusan')->references('id_jurusan')->on('jurusans')->onDelete('cascade');
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
        Schema::dropIfExists('kerjasama_jurusan');
    }
}
