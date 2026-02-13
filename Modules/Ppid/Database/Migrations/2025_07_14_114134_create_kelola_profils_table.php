<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelolaProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelola_profils', function (Blueprint $table) {
            $table->id();
            $table->string('nama_direktur');
            $table->text('sambutan');
            $table->string('media');
            $table->text('ppid');
            $table->string('foto_organisasi');
            $table->text('tugas_fungsi');
            $table->text('visi');
            $table->text('misi');
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
        Schema::dropIfExists('kelola_profils');
    }
}
