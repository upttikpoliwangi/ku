<?php

namespace Modules\Penilaian\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RencanaPerilaku extends Model
{
    use HasFactory;
    protected $table = 'skp_rencana_perilaku';
    protected $guarded = ['id'];

    public function perilakuKerja()
    {
        return $this->belongsTo(PerilakuKerja::class);
    }

    public function rencanaKerja()
    {
        return $this->belongsTo(RencanaKerja::class, 'rencana_id');
    }

    public function penilaianPerilakuKerja(){
        return $this->hasMany(PenilaianPerilakuKerja::class, 'rencana_perilaku_id', 'id');
    }
}
