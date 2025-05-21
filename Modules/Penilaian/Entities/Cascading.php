<?php

namespace Modules\Penilaian\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Pengaturan\Entities\Pegawai;

class Cascading extends Model
{
    use HasFactory;

    protected $table = 'cascading';
    protected $guarded = ['id'];

    public function indikator()
    {
        return $this->belongsTo(Indikator::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }
}
