<?php

namespace Modules\Kui\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visimisi extends Model
{
    use HasFactory;
    protected $table = 'visimisi';

    protected $fillable = [
        'namahalaman', 'slug', 'visi', 'misi', 'struktur_organisasi',
    ];
    // protected $table = 'visimisi';
    // protected $id = 'id';
    // protected $fillable = ['visi', 'misi'];
}
