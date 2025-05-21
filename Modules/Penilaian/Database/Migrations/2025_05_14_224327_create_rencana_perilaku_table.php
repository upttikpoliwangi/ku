<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRencanaPerilakuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skp_rencana_perilaku', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rencana_id');
            $table->unsignedBigInteger('perilaku_kerja_id');
            $table->unsignedBigInteger('ketua_tim_id')->nullable();
            $table->text('ekspektasi_pimpinan')->nullable();
            $table->string('umpan_balik_predikat')->nullable();
            $table->text('umpan_balik_deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('rencana_id')->references('id')->on('skp_rencana_kerja')->onDelete('cascade');
            $table->foreign('perilaku_kerja_id')->references('id')->on('skp_perilaku_kerja')->onDelete('cascade');
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
        Schema::dropIfExists('skp_rencana_perilaku');
    }
}
