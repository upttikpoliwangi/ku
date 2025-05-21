<?php

namespace Modules\Penilaian\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilKerja extends Model
{
    use HasFactory;
    protected $table = 'skp_hasil_kerja';
    protected $guarded = ['id'];

    public function rencanakerja() {
        return $this->belongsTo(RencanaKerja::class, 'rencana_id');
    }

    public function parent(){
        return $this->belongsTo(HasilKerja::class, 'parent_hasil_kerja_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(HasilKerja::class, 'parent_hasil_kerja_id');
    }

    public function indikator(){
        return $this->hasMany(Indikator::class);
    }

    public function penilaianHasilKerja(){
        return $this->hasMany(PenilaianHasilKerja::class, 'hasil_kerja_id', 'id');
    }
}
