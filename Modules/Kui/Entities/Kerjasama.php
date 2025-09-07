<?php

namespace Modules\Kui\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kerjasama extends Model
{
    // use HasFactory;

    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Kui\Database\factories\KerjasamaFactory::new();
    // }
    use HasFactory, SoftDeletes;
    protected $table = 'kerjasama';
    protected $primaryKey = 'id_kerjasama';
    protected $guarded = ['id_kerjasama'];

    public function prodi()
    {
        return $this->belongsToMany(Jurusan::class, 'kerjasama_jurusan', 'id_kerjasama', 'id_jurusan');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
