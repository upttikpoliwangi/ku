<?php

namespace Modules\Kui\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kegiatankerjasama extends Model
{
    use HasFactory;
    protected $table = 'kegiatankerjasama';
    protected $id = 'id';
    protected $fillable = ['id_jurusan', 'nama_kegiatan', 'tanggal_kegiatan', 'biaya_kegiatan', 'dokumen_kegiatan', 'foto_kegiatan'];

    public function getFormattedBiayaAttribute()
    {
        return 'Rp ' . number_format($this->biaya_kegiatan, 0, ',', '.');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
}
