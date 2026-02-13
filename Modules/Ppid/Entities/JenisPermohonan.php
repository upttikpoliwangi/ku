<?php

namespace Modules\Ppid\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisPermohonan extends Model
{
    use HasFactory;

    protected $table = 'jenis_permohonans';
    protected $fillable = [
        'jenis_permohonan',
    ];
}