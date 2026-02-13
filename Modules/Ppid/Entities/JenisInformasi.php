<?php

namespace Modules\Ppid\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisInformasi extends Model
{
    use HasFactory;

    protected $table = 'jenis_informasis';
    protected $fillable = [
        'jenis_informasi',
    ];
}
