<?php

namespace Modules\Kui\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Panduan extends Model
{
    // use HasFactory;

    // protected $fillable = [];
    use HasFactory;
    protected $table = 'panduan';
    protected $id = 'id';
    protected $fillable = ['nama_file', 'file_panduan'];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Kui\Database\factories\PanduanFactory::new();
    // }
}
