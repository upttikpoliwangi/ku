<?php

namespace Modules\Kui\Database\Seeders;

use App\Models\Core\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MenuModulKuiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Menu :: where('modul', 'Kui')->delete();
        $menu = Menu::create([
            'modul' => 'Kui',
            'label' => 'Data Kerjasama',
            'url' => 'kui/datakerjasama',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-table',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['kui/datakerjasama', 'kui/datakerjasama/*'])
        ]);
        Menu::create([
            'modul' => 'Kui',
            'label' => 'Data Aktivitas',
            'url' => 'kui/dataaktivitas',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-tasks',
            'urut' => 2,
            'parent_id' => 0,
            'active' => serialize(['kui/dataaktivitas', 'kui/dataaktivitas/*'])
        ]);
        Menu::create([
            'modul' => 'Kui',
            'label' => 'Data File MoU',
            'url' => 'kui/datamou',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-envelope',
            'urut' => 3,
            'parent_id' => 0,
            'active' => serialize(['kui/datamou', 'kui/datamou/*'])
        ]);
        Menu::create([
            'modul' => 'Kui',
            'label' => 'Kegiatan Kerjasama',
            'url' => 'kui/kegiatankerjasama',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-eye-dropper',
            'urut' => 4,
            'parent_id' => 0,
            'active' => serialize(['kui/kegiatankerjasama', 'kui/kegiatankerjasama/*'])
        ]);
        Menu::create([
            'modul' => 'Kui',
            'label' => 'Panduan',
            'url' => 'kui/panduan',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-file',
            'urut' => 5,
            'parent_id' => 0,
            'active' => serialize(['kui/panduan', 'kui/panduan/*'])
        ]);
        Menu::create([
            'modul' => 'Kui',
            'label' => 'Visi Misi',
            'url' => 'kui/visimisi',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-file-alt',
            'urut' => 6,
            'parent_id' => 0,
            'active' => serialize(['kui/visimisi', 'kui/visimisi/*'])
        ]);
        Menu::create([
            'modul' => 'Kui',
            'label' => 'Struktur Organisasi',
            'url' => 'kui/strukturorganisasi',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-users',
            'urut' => 7,
            'parent_id' => 0,
            'active' => serialize(['kui/strukturorganisasi', 'kui/strukturorganisasi/*'])
        ]);
    }
}
