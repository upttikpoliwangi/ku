<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayatpermohonansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayatpermohonans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Pemohon
            $table->unsignedBigInteger('permohonan_id'); // Relasi ke permohonaninformasi
            $table->string('nama_pemohon'); // Dari permohonaninformasi
            $table->unsignedBigInteger('jenis_permohonan_id'); // Dari tabel jenis_permohonan
            $table->text('informasi_dibutuhkan'); // Dari permohonaninformasi
            $table->enum('status', ['diproses', 'ditolak', 'selesai'])->default('diproses'); // Dari permohonaninformasi
            $table->date('tanggal_permohonan'); // Dari permohonaninformasi
            $table->timestamps();

            // Relasi
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('permohonan_id')->references('id')->on('permohonaninformasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayatpermohonans');
    }
}
