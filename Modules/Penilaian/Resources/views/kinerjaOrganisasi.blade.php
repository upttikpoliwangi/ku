@extends('adminlte::page')

@section('title', 'Dasbor Simlitabmas')

@section('content_header')
    <h1 class="m-0 text-dark">Capaian & Kurva Kinerja Organisasi</h1>
@stop
@php
    $users = [
        [
            'id' => 1,
            'name' => 'Widura Sasangka',
            'jabatan' => 'Analis Kinerja',
            'status' => 'Belum Dievaluasi',
            'predikatKinerja' => '-',
        ],
        [
            'id' => 2,
            'name' => 'Hasta Sasangka',
            'jabatan' => 'Pimpinana',
            'status' => 'Belum Ajukan Realisasi',
            'predikatKinerja' => '-',
        ],
        [
            'id' => 3,
            'name' => 'Widura Hasta',
            'jabatan' => 'Pimpinana',
            'status' => 'Sudah Dievaluasi',
            'predikatKinerja' => '-',
        ],
    ];

    $hasilKerja = [
        [
            'id' => 1,
            'capaian' => 'Manual book penggunaan aplikasi modul penyusunan SKP yang lengkap dan informatif (Penugasan dari Ketua Tim Perencanaan dan Sistem Informasi)',
            'indikator' => [
                [
                    'id' => 1,
                    'teks' => 'Draft manual book penggunaan aplikasi modul penyusunan rencana SKP yang lengkap sesuai dengan ketentuan dan diselesaikan maksimal satu bulan sebelum kegiatan sosialisasi'
                ]
            ],
            'realisasi' => 'Draft manual book aplikasi untuk modul penyusunan rencana SKP telah selesai pada bulan April sesuai dengan proses bisnis aplikasi',
            'umpan_balik' => ''
        ]
    ]
@endphp
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                @php
                    switch (true) {
                        case 'Belum Dievaluasi':
                            $badgeClass = 'badge-secondary';
                            break;
                        case 'Belum Ajukan Realisasi':
                            $badgeClass = 'badge-danger';
                            break;
                        case 'Sudah Dievaluasi':
                            $badgeClass = 'badge-success';
                            break;
                        default:
                            $badgeClass = 'badge-secondary';
                            break;
                    }
                @endphp
                <div class="bg-white p-4">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success">Refresh</button>
                    </div>
                    <div class="">
                        <form class="form-inline">
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                              <option selected>Silahkan Pilih</option>
                              <option value="1">Istimewa</option>
                              <option value="2">Baik</option>
                              <option value="3">Butuh Perbaikan</option>
                              <option value="3">Kurang</option>
                              <option value="3">Sangat Kurang</option>
                            </select>

                            <button type="submit" class="btn btn-primary my-1">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    textarea {
        border-color: #ced4da;
    }
    textarea:focus {
        outline: none !important;
        box-shadow: none !important;
    }
</style>
@stop

@push('js')
<script>

</script>
@endpush
