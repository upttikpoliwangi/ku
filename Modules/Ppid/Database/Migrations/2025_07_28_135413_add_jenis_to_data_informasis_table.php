<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJenisToDataInformasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_informasis', function (Blueprint $table) {
            $table->enum('jenis', ['link', 'dokumen'])->after('jenis_informasi_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_informasis', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
}
