<?php

namespace Modules\Penilaian\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Indikator extends Model
{
    use HasFactory;
    protected $table = 'skp_indikators';
    protected $guarded = ['id'];

    public function hasilkerja() {
        return $this->belongsTo(HasilKerja::class, 'hasil_kerja_id');
    }

    public function cascading(){
        return $this->hasMany(Cascading::class);
    }
}
