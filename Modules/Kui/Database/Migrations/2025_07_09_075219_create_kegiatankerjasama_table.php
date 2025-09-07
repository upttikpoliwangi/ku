<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatankerjasamaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatankerjasama', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jurusan')
                ->constrained('jurusans', 'id_jurusan')
                ->onDelete('cascade');
            $table->string('nama_kegiatan');
            $table->date('tanggal_kegiatan');
            $table->integer('biaya_kegiatan');
            $table->string('dokumen_kegiatan');
            $table->string('foto_kegiatan');
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
        Schema::dropIfExists('kegiatankerjasama');
    }
}
