<?php

namespace Modules\Penilaian\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PenilaianDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(MenuPenilaianTableSeeder::class);
        $this->call(PerilakuKerjaTableSeeder::class);
        // $this->call(UserTableSeeder::class);

    }
}
