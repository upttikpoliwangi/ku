<?php

namespace Modules\Ppid\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Riwayatpermohonan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'permohonan_id',
        'nama_pemohon',
        'jenis_permohonan_id',
        'informasi_dibutuhkan',
        'status',
        'tanggal_permohonan',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\core\User', 'user_id');
    }

    public function permohonan()
    {
        return $this->belongsTo(Permohonaninformasi::class, 'permohonan_id');
    }

    public function jenisPermohonan()
    {
        return $this->belongsTo(JenisPermohonan::class, 'jenis_permohonan_id');
    }
}