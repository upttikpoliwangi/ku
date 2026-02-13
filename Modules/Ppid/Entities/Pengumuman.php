<?php

namespace Modules\Ppid\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumen';
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'sumber',
        'gambar',
    ];

}
