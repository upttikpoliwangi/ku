<?php

namespace Modules\Ppid\Database\Seeders;

use Modules\Ppid\Entities\Menu;
use Illuminate\Database\Seeder;

class LandingPageMenuSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            // Profil Section
            [
                'title' => 'Profil',
                'type' => 'route',
                'route_name' => 'publik.p.direktur.index', 
                'parent_id' => null,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Sambutan Direktur',
                'type' => 'route',
                'route_name' => 'publik.p.direktur.index',
                'parent_id' => 1, 
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Profil PPID',
                'type' => 'route',
                'route_name' => 'publik.p.profil.index',
                'parent_id' => 1,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Visi Misi',
                'type' => 'route',
                'route_name' => 'publik.p.visi-misi.index',
                'parent_id' => 1,
                'order' => 3,
                'is_active' => true,
            ],

            // Informasi Publik Section
            [
                'title' => 'Informasi Publik',
                'type' => 'route',
                'route_name' => 'publik.i-regulasi.index',
                'parent_id' => null,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Regulasi',
                'type' => 'route',
                'route_name' => 'publik.i-regulasi.index',
                'parent_id' => 5,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Daftar Informasi',
                'type' => 'route',
                'route_name' => 'publik.i-publik.index',
                'parent_id' => 5,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Informasi Dikecualikan',
                'type' => 'route',
                'route_name' => 'publik.i-dikecualikan.index',
                'parent_id' => 5,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Informasi Setiap Saat',
                'type' => 'route',
                'route_name' => 'publik.i-setiap-saat.index',
                'parent_id' => 5,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Informasi Berkala',
                'type' => 'route',
                'route_name' => 'publik.i-berkala.index',
                'parent_id' => 5,
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Informasi Serta Merta',
                'type' => 'route',
                'route_name' => 'publik.i-serta-merta.index',
                'parent_id' => 5,
                'order' => 6,
                'is_active' => true,
            ],

            // Layanan Section
            [
                'title' => 'Layanan',
                'type' => 'route',
                'route_name' => 'publik.l-maklumat.index',
                'parent_id' => null,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Maklumat Layanan',
                'type' => 'route',
                'route_name' => 'publik.l-maklumat.index',
                'parent_id' => 12,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Standar Layanan',
                'type' => 'route',
                'route_name' => 'publik.l-standar.index',
                'parent_id' => 12,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Prosedur Permohonan Informasi',
                'type' => 'route',
                'route_name' => 'publik.l-permohonan-informasi.index',
                'parent_id' => 12,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Prosedur Keberatan Informasi',
                'type' => 'route',
                'route_name' => 'publik.l-permohonan-keberatan.index',
                'parent_id' => 12,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Prosedur Penyelesaian Sengketa',
                'type' => 'route',
                'route_name' => 'publik.l-permohonan-sengketa.index',
                'parent_id' => 12,
                'order' => 5,
                'is_active' => true,
            ],

            // Publikasi Section
            [
                'title' => 'Publikasi',
                'type' => 'route',
                'route_name' => 'publikasi.berita.index',
                'parent_id' => null,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Berita',
                'type' => 'route',
                'route_name' => 'publikasi.berita.index',
                'parent_id' => 18,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Pengumuman',
                'type' => 'route',
                'route_name' => 'publikasi.pengumuman.index',
                'parent_id' => 18,
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
