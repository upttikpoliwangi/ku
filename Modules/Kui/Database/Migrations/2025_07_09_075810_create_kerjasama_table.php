<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKerjasamaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerjasama', function (Blueprint $table) {
            $table->id('id_kerjasama');
            $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
            $table->string('nomor_mou')->nullable();
            $table->string('kriteria');
            $table->string('email_instansi');
            $table->string('alamat_instansi');
            $table->string('nama_instansi');
            $table->string('nama_contact_person');
            $table->string('contact_person');
            $table->string('jenis_kegiatan');
            $table->string('file_mou');
            $table->tinyInteger('hard_file')->default(0);
            $table->date('tgl_mulai');
            $table->date('tgl_berakhir');
            $table->tinyInteger('status')->default(0);
            $table->string('catatan');
            $table->softDeletes();
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
        Schema::dropIfExists('kerjasama');
    }
}
