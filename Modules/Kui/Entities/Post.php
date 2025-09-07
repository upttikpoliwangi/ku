<?php

namespace Modules\Kui\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kategori',
        'kegiatan',
        'nomor_mou',
        'foto',
        'deskripsi',
        'tanggal'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
