<?php

namespace Modules\Kui\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Kui\Entities\Post;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $guarded = ['id_kategori'];
    public function kerjasama()
    {
        return $this->hasOne(Kerjasama::class, 'id_kategori');
    }
    public function post()
    {
        return $this->hasOne(Post::class, 'id_kategori');
    }
}
