<?php

namespace Modules\Penilaian\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerilakuKerja extends Model
{
    use HasFactory;
    protected $table = 'skp_perilaku_kerja';
    protected $guarded = ['id'];

    public function rencanaKerja()
    {
        return $this->belongsToMany(RencanaKerja::class, 'skp_rencana_perilaku', 'perilaku_kerja_id', 'rencana_id');
    }

    public function rencanaPerilaku(){
        return $this->hasOne(RencanaPerilaku::class, 'perilaku_kerja_id', 'id');
    }
}
