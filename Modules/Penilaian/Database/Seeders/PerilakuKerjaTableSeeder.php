<?php

namespace Modules\Penilaian\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Penilaian\Entities\PerilakuKerja;

class PerilakuKerjaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('skp_perilaku_kerja')->delete();
        PerilakuKerja::insert([
            [
                'deskripsi' => 'Berorientasi Pelayanan',
                'kriteria' => 'Memahami dan memenuhi kebutuhan masyarakat; Ramah, cekatan, solutif, dan dapat diandalkan; Melakukan perbaikan tiada henti'
            ],
            [
                'deskripsi' => 'Akuntabel',
                'kriteria' => 'Melaksanakan tugas dengan jujur, bertanggung jawab, cermat, disiplin, dan berintegritas tinggi;
                                Menggunakan kekayaan dan barang milik negara secara bertanggung jawab, efektif, dan efisien;
                                Tidak menyalahgunakan kewenangan jabatan'
            ],
            [
                'deskripsi' => 'Kompeten',
                'kriteria' => 'Meningkatkan kompetensi diri untuk menjawab tantangan yang selalu berubah;
                                Membantu orang lain belajar; Melaksanakan tugas dengan kualitas terbaik'
            ],
            [
                'deskripsi' => 'Adaptif',
                'kriteria' => 'Cepat menyesuaikan diri menghadapi perubahan; Terus berinovasi dan mengembangkan kreativitas; Bertindak positif'
            ],
            [
                'deskripsi' => 'Kolaboratif',
                'kriteria' => 'Memberi kesempatan kepada berbagai pihak untuk berkontribusi; terbuka dalam bekerja sama untuk menghasilkan nilai tambah;
                                Menggerakkan pemanfaatan berbagai sumberdaya untuk tujuan bersama'
            ],

        ]);
    }
}
