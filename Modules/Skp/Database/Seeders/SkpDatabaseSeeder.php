<?php

namespace Modules\Skp\Database\Seeders;

use App\Models\Core\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SkpDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        Menu::where('modul', 'PerencanaanSKP')->delete();
        $menu =  Menu::create([
            'modul' => 'PerencanaanSKP',
            'label' => 'Perencanaan SKP',
            'url' => '',
            'can' => serialize(['*']),
            'icon' => 'fab fa-playstation',
            'urut' => 1,
            'parent_id' => 0,
            'active' => '',
        ]);
        Menu::create([
            'modul' => 'PerencanaanSKP',
            'label' => 'Perencanaan Bulanan',
            'url' => 'perencanaan/perencanaan-bulanan',
            'can' => serialize(['*']),
            'icon' => 'fas fa-home',
            'urut' => 1,
            'parent_id' => $menu->id,
            'active' => serialize(['perencanaan/perencanaan-bulanan', 'perencanaan/perencanaan-bulanan*']),
        ]);
        Menu::create([
            'modul' => 'PerencanaanSKP',
            'label' => 'Evaluasi SKP',
            'url' => 'perencanaan/evaluasi',
            'can' => serialize(['*']),
            'icon' => 'fas fa-home',
            'urut' => 1,
            'parent_id' => $menu->id,
            'active' => serialize(['perencanaan/evaluasi', 'perencanaan/evaluasi*']),
        ]);
        Menu::create([
            'modul' => 'PerencanaanSKP',
            'label' => 'Realisasi SKP',
            'url' => 'realisasi',
            'can' => serialize(['*']),
            'icon' => 'fas fa-home',
            'urut' => 1,
            'parent_id' => $menu->id,
            'active' => serialize(['realisasi', 'realisasi*']),
        ]);
    }
}
