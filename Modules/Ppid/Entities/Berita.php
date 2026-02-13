<?php

namespace Modules\Ppid\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $id = 'id';
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'sumber',
        'gambar',
    ];
}
