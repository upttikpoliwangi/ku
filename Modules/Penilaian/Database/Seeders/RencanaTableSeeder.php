<?php

namespace Modules\Penilaian\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Penilaian\Entities\RencanaKerja;
use Modules\Penilaian\Entities\HasilKerja;
use Modules\Penilaian\Entities\Indikator;

class RencanaTableSeeder extends Seeder
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

        RencanaKerja::truncate();
        HasilKerja::truncate();
        Indikator::truncate();

        $rencana =  RencanaKerja::create([
            'status_persetujuan' => 'Belum Buat SKP',
            'status_realisasi' => 'Belum Diajukan',
        ]);

        $hasilKerja = HasilKerja::create([
            'rencana_id' => $rencana->id,
            'deskripsi' => 'test'
        ]);

        Indikator::insert([
            [
                'hasil_kerja_id' => $hasilKerja->id,
                'deskripsi' => 'indikator 1'
            ],
            [
                'hasil_kerja_id' => $hasilKerja->id,
                'deskripsi' => 'indikator 2'
            ]
        ]);


    }
}
