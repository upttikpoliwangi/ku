<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataDokumenTable extends Migration
{
    public function up()
    {
        Schema::create('data_dokumen', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->date('tahun')->nullable();
            $table->unsignedBigInteger('jenis_dokumens_id');
            $table->string('file_path')->nullable();
            $table->timestamps();

            $table->foreign('jenis_dokumens_id')
                  ->references('id')
                  ->on('jenis_dokumens')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_dokumen');
    }
}
