<?php

namespace App\Exports;

use App\Models\Kerjasama as ModelsKerjasama;
use Illuminate\Support\Collection;
use Modules\Kui\Entities\Kerjasama;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Kui\Entities\Kerjasama as EntitiesKerjasama;

class KerjasamaExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return Kerjasama::all();
        $kerjasamas = Kerjasama::all([
            'id_kerjasama',
            'id_user',
            'id_kategori',
            'nomor_mou',
            'kriteria',
            'email_instansi',
            'alamat_instansi',
            'nama_instansi',
            'nama_contact_person',
            'contact_person',
            'jenis_kegiatan',
            'file_mou',
            'hard_file',
            'tgl_mulai',
            'tgl_berakhir',
            'status',
            'created_at',
            'updated_at'
        ]);

        // Tambahkan nomor urut ke setiap item dalam koleksi
        $numberedKerjasamas = $kerjasamas->map(function ($kerjasama, $key) {
            return array_merge(['No' => $key + 1], $kerjasama->toArray());
        });

        return new collection ($numberedKerjasamas);
    }

    public function headings(): array
    {
        return [
            'NO',
            'ID Kerjasama',
            'ID User',
            'ID Kategori',
            'Nomor MOU',
            'Kriteria',
            'Email Instansi',
            'Alamat Instansi',
            'Nama Instansi',
            'Nama Contact Person',
            'Contact Person',
            'Jenis Kegiatan',
            'File MOU',
            'Hard File',
            'Tanggal Mulai',
            'Tanggal Berakhir',
            'Deleted at',
            'Created at',
            'Upadated at'
        ];
    }
}
