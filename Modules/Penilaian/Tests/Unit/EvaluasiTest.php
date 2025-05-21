<?php

namespace Modules\Penilaian\Tests\Unit;
namespace Modules\Penilaian\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EvaluasiTest extends TestCase {

    protected $evaluasicontroller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->evaluasicontroller = new EvaluasiController();
    }

    public function test_predikatKinerja_passed(){
        $this->assertEquals('Sangat Baik', $this->evaluasicontroller->predikatKinerja('Diatas Ekspektasi', 'Diatas Ekspektasi'));
        $this->assertEquals('Baik', $this->evaluasicontroller->predikatKinerja('Sesuai Ekspektasi', 'Diatas Ekspektasi'));
        $this->assertEquals('Kurang', $this->evaluasicontroller->predikatKinerja('Diatas Ekspektasi', 'Dibawah Ekspektasi'));
        $this->assertEquals('Butuh Perbaikan', $this->evaluasicontroller->predikatKinerja('Dibawah Ekspektasi', 'Diatas Ekspektasi'));
    }

    public function test_predikatKinerja_failed(){
        $this->assertEquals('Data tidak valid', $this->evaluasicontroller->predikatKinerja(null, null));
        $this->assertEquals('Data tidak valid', $this->evaluasicontroller->predikatKinerja('Dibawah Ekspektasi', null));
        $this->assertEquals('Data tidak valid', $this->evaluasicontroller->predikatKinerja(null, 'Dibawah Ekspektasi'));
    }

}
