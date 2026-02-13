<?php

namespace Modules\Ppid\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class permohonaninformasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemohon',
        'nik',
        'alamat_pemohon',
        'nomor_telepon',
        'email',
        'informasi_yang_dibutuhkan',
        'alasan_permohonan',
        'jenis_permohonan_id',
        'status',
        'file',
        'catatan',
    ];

    public function jenisPermohonan()
    {
        return $this->belongsTo(JenisPermohonan::class, 'jenis_permohonan_id');
    }

}
