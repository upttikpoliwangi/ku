<?php

namespace Modules\Kui\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class KuiDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(MenuModulKuiTableSeeder::class);
        // $this->call("OthersTableSeeder");
    }
}
