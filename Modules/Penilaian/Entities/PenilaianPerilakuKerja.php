<?php

namespace Modules\Penilaian\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianPerilakuKerja extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'skp_penilaian_perilaku_kerja';

    public function rencanaPerilaku(){
        return $this->belongsTo(RencanaPerilaku::class);
    }
}
