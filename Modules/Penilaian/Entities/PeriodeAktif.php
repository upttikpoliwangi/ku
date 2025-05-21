<?php

namespace Modules\Penilaian\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Pengaturan\Entities\Pegawai;

class PeriodeAktif extends Model
{
    use HasFactory;

    protected $table = 'periode_aktif';

    protected $guarded = ['id'];

    public function pegawai(){
        return $this->belongsTo(Pegawai::class);
    }

    public function periode(){
        return $this->belongsTo(Periode::class);
    }
}
