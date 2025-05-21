<?php

namespace Modules\Penilaian\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Penilaian\Entities\RencanaKerja;

class RealisasiTest extends TestCase
{
    public function test_ajukan_realisasi_mengubah_status(){
        $rencana = RencanaKerja::factory()->create([
            'status_realisasi' => 'Belum Diajukan',
        ]);
        $response = $this->post("/rencana/{$rencana->id}/ajukan-realisasi");
        $response->assertRedirect();
        $this->assertDatabaseHas('skp_rencana_kerja', [
            'id' => $rencana->id,
            'status_realisasi' => 'Sudah Diajukan',
        ]);

        $response->assertSessionHas('success', 'Berhasil ditambahkan');
    }

}
