<?php

namespace Modules\Kui\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    // use HasFactory;

    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Kui\Database\factories\JurusanFactory::new();
    // }
    use HasFactory;
    protected $primaryKey = 'id_jurusan';
    protected $guarded = ['id_jurusan'];
    public function kerjasama()
    {
        return $this->belongsToMany(Kerjasama::class, 'kerjasama_jurusan', 'id_jurusan', 'id_kerjasama');
    }
}
