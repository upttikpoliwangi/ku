<?php

namespace Modules\Kui\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Struktur extends Model
{
    // use HasFactory;

    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Kui\Database\factories\StrukturFactory::new();
    // }
    protected $table = 'strukturorganisasi';
    protected $id = 'id';
    protected $fillable = ['judul', 'foto_struktur'];
    
}
