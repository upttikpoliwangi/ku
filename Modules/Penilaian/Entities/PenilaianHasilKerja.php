<?php

namespace Modules\Penilaian\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianHasilKerja extends Model
{
    use HasFactory;

    protected $table = 'skp_penilaian_hasil_kerja';
    protected $guarded = ['id'];

    public function hasilKerja(){
        return $this->belongsTo(HasilKerja::class);
    }
}
