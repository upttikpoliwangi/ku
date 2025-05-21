<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkpHasilKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skp_hasil_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rencana_id');
            $table->unsignedInteger('parent_hasil_kerja_id')->nullable();
            $table->unsignedInteger('kategori_id')->nullable();
            $table->text('realisasi')->nullable();
            $table->string('umpan_balik_predikat')->nullable();
            $table->text('umpan_balik_deskripsi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->unsignedInteger('kriteria_id')->nullable();
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
        Schema::dropIfExists('skp_hasil_kerja');
    }
}
