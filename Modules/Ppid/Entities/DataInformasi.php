<?php

namespace Modules\Ppid\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataInformasi extends Model
{
    use HasFactory;

    protected $table = 'data_informasis';
    protected $fillable = [
        'nama_informasi',
        'jenis_informasi_id',
        'link',
    ];

    public function jenisInformasi()
    {
        return $this->belongsTo(JenisInformasi::class, 'jenis_informasi_id');
    }
}
