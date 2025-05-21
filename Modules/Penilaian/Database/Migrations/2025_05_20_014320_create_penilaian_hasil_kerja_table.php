<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenilaianHasilKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skp_penilaian_hasil_kerja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hasil_kerja_id')->nullable();
            $table->unsignedBigInteger('ketua_tim_id')->nullable();
            $table->string('umpan_balik_predikat')->nullable();
            $table->text('umpan_balik_deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('hasil_kerja_id')->references('id')->on('skp_hasil_kerja')->onDelete('cascade');
            $table->foreign('ketua_tim_id')->references('id')->on('pegawai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skp_penilaian_hasil_kerja');
    }
}
