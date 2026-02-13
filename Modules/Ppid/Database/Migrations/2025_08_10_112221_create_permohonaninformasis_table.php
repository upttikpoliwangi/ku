<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermohonaninformasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonaninformasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('nik');
            $table->string('alamat_pemohon');
            $table->string('nomor_telepon');
            $table->string('email');
            $table->string('informasi_yang_dibutuhkan');
            $table->string('alasan_permohonan');
            $table->unsignedBigInteger('jenis_permohonan_id');
            $table->string('status')->default('menunggu');
            $table->string('file')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();

            $table->foreign('jenis_permohonan_id')
                  ->references('id')
                  ->on('jenis_permohonans')
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
        Schema::dropIfExists('permohonaninformasis');
    }
}
