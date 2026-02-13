<?php
namespace Modules\Ppid\Entities;

use Illuminate\Database\Eloquent\Model;

class Datadokumen extends Model
{
    protected $table = 'data_dokumen';
    protected $fillable = [
        'nama_dokumen',
        'tahun',
        'jenis_dokumens_id',
        'file_path',
    ];

    public function jenisDokumens()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_dokumens_id');
    }
}
