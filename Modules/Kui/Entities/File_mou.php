<?php

namespace Modules\Kui\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File_mou extends Model
{
    // use HasFactory;

    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Kui\Database\factories\FileMouFactory::new();
    // }

    use HasFactory;
    protected $table = 'file_mou';
    protected $id = 'id';
    protected $fillable = ['nama_file'];

}
