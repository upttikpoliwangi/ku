<?php

namespace Modules\Ppid\Database\Seeders;

use App\Models\Core\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MenuModulPpidTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Menu::where('modul', 'Ppid')->delete();
        $menu =  Menu::create([
            'modul' => 'Ppid',
            'label' => 'Kelola Profil',
            'url' => 'ppid/kelola-profil',
            // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
            'can' => serialize(['admin']),
            'icon' => 'fas fa-clipboard',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['ppid/kelola-profil', 'ppid/kelola-profil*']),
        ]);

        $menu =  Menu::create([
            'modul' => 'Ppid',
            'label' => 'Kelola Dokumen',
            'url' => 'ppid/kelola-dokumen',
            // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
            'can' => serialize(['admin']),
            'icon' => 'fas fa-clipboard',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['ppid/kelola-dokumen', 'ppid/kelola-dokumen*']),
        ]);
        Menu::create([
            'modul' => 'Ppid',
            'label' => 'Jenis Dokumen',
            'url' => 'ppid/jenis-dokumen',
            // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
            'can' => serialize(['admin']),
            'icon' => 'far fa-circle',
            'urut' => 1,
            'parent_id' => $menu->id,
            'active' => serialize(['ppid/jenis-dokumen', 'ppid/jenis-dokumen*']),]);

        Menu::create([
            'modul' => 'Ppid',
            'label' => 'Data Dokumen',
            'url' => 'ppid/data-dokumen',
            // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
            'can' => serialize(['admin']),
            'icon' => 'far fa-circle',
            'urut' => 1,
            'parent_id' => $menu->id,
            'active' => serialize(['ppid/data-dokumen', 'ppid/data-dokumen*']),]);

        $menu =  Menu::create([
            'modul' => 'Ppid',
            'label' => 'Kelola Informasi',
            'url' => 'ppid/kelola-informasi',
            // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
            'can' => serialize(['admin']),
            'icon' => 'fas fa-clipboard',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['ppid/kelola-informasi', 'ppid/kelola-informasi*']),
        ]);
        Menu::create([
            'modul' => 'Ppid',
            'label' => 'Jenis Informasi',
            'url' => 'ppid/jenis-informasi',
            // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
            'can' => serialize(['admin']),
            'icon' => 'far fa-circle',
            'urut' => 1,
            'parent_id' => $menu->id,
            'active' => serialize(['ppid/jenis-informasi', 'ppid/jenis-informasi*']),]);

        Menu::create([
            'modul' => 'Ppid',
            'label' => 'Data Informasi',
            'url' => 'ppid/data-informasi',
            // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
            'can' => serialize(['admin']),
            'icon' => 'far fa-circle',
            'urut' => 1,
            'parent_id' => $menu->id,
            'active' => serialize(['ppid/data-informasi', 'ppid/data-informasi*']),]);

        $menu =  Menu::create([
            'modul' => 'Ppid',
            'label' => 'Kelola Permohonan',
            'url' => 'ppid/kelola-permohonan',
            // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
            'can' => serialize(['admin']),
            'icon' => 'fas fa-clipboard',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['ppid/kelola-permohonan', 'ppid/kelola-permohonan*']),
        ]);
        Menu::create([
            'modul' => 'Ppid',
            'label' => 'Jenis Permohonan',
            'url' => 'ppid/jenis-permohonan',
            // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
            'can' => serialize(['admin']),
            'icon' => 'far fa-circle',
            'urut' => 1,
            'parent_id' => $menu->id,
            'active' => serialize(['ppid/jenis-permohonan', 'ppid/jenis-permohonan*']),]);

        // Menu::create([
        //     'modul' => 'Ppid',
        //     'label' => 'Permohonan Informasi',
        //     'url' => 'ppid/pemohon',
        //     // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
        //     'can' => serialize(['admin', 'masrayakat']),
        //     'icon' => 'far fa-circle',
        //     'urut' => 1,
        //     'parent_id' => $menu->id,
        //     'active' => serialize(['ppid/pemohon', 'ppid/pemohon*']),]);

        $menu = Menu::create([
            'modul' => 'Ppid',
            'label' => 'Permohonan Informasi',
            'url' => 'ppid/pemohon',
            // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
            'can' => serialize(['admin', 'terdaftar']),
            'icon' => 'fas fa-clipboard',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['ppid/pemohon', 'ppid/pemohon*']),
        ]);
        
        // Menu::create([
        //     'modul' => 'Ppid',
        //     'label' => 'Data Pemohon',
        //     'url' => 'ppid/data-pemohon',
        //     // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
        //     'can' => serialize(['admin']),
        //     'icon' => 'far fa-circle',
        //     'urut' => 1,
        //     'parent_id' => $menu->id,
        //     'active' => serialize(['ppid/data-pemohon', 'ppid/data-pemohon*']),]);

        $menu =  Menu::create([
            'modul' => 'Ppid',
            'label' => 'Berita',
            'url' => 'ppid/berita',
            // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
            'can' => serialize(['admin']),
            'icon' => 'fas fa-clipboard',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['ppid/berita', 'ppid/berita*']),
        ]);

        $menu =  Menu::create([
            'modul' => 'Ppid',
            'label' => 'Pengumuman',
            'url' => 'ppid/pengumuman',
            // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
            'can' => serialize(['admin']),
            'icon' => 'fas fa-clipboard',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['ppid/pengumuman', 'ppid/pengumuman*']),
        ]);

        $menu =  Menu::create([
            'modul' => 'Ppid',
            'label' => 'Riwayat',
            'url' => 'ppid/riwayat',
            // 'can' => serialize(['pimpinan', 'pejabat', 'sekretaris', 'kepegawaian', 'dosen']),
            'can' => serialize(['admin']),
            'icon' => 'fas fa-clipboard',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['ppid/riwayat', 'ppid/riwayat*']),
        ]);
    }
}