<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataInformasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_informasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_informasi');
            $table->unsignedBigInteger('jenis_informasi_id');
            $table->string('link');
            $table->timestamps();

            $table->foreign('jenis_informasi_id')
                  ->references('id')
                  ->on('jenis_informasis')
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
        Schema::dropIfExists('data_informasis');
    }
}
