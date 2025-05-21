<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenilaianPerilakuKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skp_penilaian_perilaku_kerja', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('rencana_perilaku_id')->nullable();
            $table->unsignedInteger('ketua_tim_id')->nullable();
            $table->text('ekspektasi_pimpinan')->nullable();
            $table->string('umpan_balik_predikat')->nullable();
            $table->text('umpan_balik_deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('rencana_perilaku_id')
                  ->references('id')->on('skp_rencana_perilaku')
                  ->onDelete('cascade');

            $table->foreign('ketua_tim_id')
                  ->references('id')->on('pegawai')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skp_penilaian_perilaku_kerja');
    }
}
