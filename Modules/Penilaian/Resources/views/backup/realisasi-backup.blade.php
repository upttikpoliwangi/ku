@extends('adminlte::page')

@section('title', 'Dasbor Simlitabmas')

@section('content_header')
    <h1 class="m-0 text-dark">Realisasi</h1>
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
                {{-- <div class="w-100 d-flex justify-content-between align-items-center p-4">
                    <div class="alert alert-success m-0" role="alert">
                        This is a success alert—check it out!
                    </div>
                    <button id="proses-umpan-balik-button" class="btn btn-primary ml-1">Batalkan Evaluasi</button>
                </div> --}}
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
                <div class="w-100 d-flex justify-content-between align-items-center p-2">
                    <span class="badge m-2 {{ $badgeClass }}" style="width: fit-content">Belum Diajukan</span>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cetakEvaluasiModal">Cetak Evaluasi</button>
                    @include('penilaian::components.modal-cetak-evaluasi')
                </div>
                <div class="bg-white d-flex p-4">
                    <table class="table" style="table-layout: fixed; width: 100%;">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th colspan="2">Pegawai yang dinilai</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Nama</td>
                            <td>Mark</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>NIP</td>
                            <td>362155401190</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Pangkat / Gol</td>
                            <td>362155401190</td>
                          </tr>
                          <tr>
                            <th scope="row">4</th>
                            <td>Jabatan</td>
                            <td>362155401190</td>
                          </tr>
                          <tr>
                            <th scope="row">5</th>
                            <td>Unit Kerja</td>
                            <td>362155401190</td>
                          </tr>
                        </tbody>
                    </table>
                    <table class="table" style="table-layout: fixed; width: 100%;">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th colspan="2">Pejabat Penilai Kinerja</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <th scope="row">1</th>
                              <td>Nama</td>
                              <td>Mark</td>
                            </tr>
                            <tr>
                              <th scope="row">2</th>
                              <td>NIP</td>
                              <td>362155401190</td>
                            </tr>
                            <tr>
                              <th scope="row">3</th>
                              <td>Pangkat / Gol</td>
                              <td>362155401190</td>
                            </tr>
                            <tr>
                              <th scope="row">4</th>
                              <td>Jabatan</td>
                              <td>362155401190</td>
                            </tr>
                            <tr>
                              <th scope="row">5</th>
                              <td>Unit Kerja</td>
                              <td>362155401190</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bg-white p-4">
                    {{-- Hasil kerja --}}
                    <table class="table mb-0" style="width: 100%;">
                        <thead>
                          <tr>
                            <th colspan="5">HASIL KERJA</th>
                          </tr>
                          <tr>
                            <th colspan="5">A. Utama</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasilKerja as $index => $item)
                                <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>
                                    <p>{{ $item['capaian'] }}</p>
                                    <span>Ukuran keberhasilan / Indikator Kinerja Individu, dan Target :</span>
                                    <ul>
                                        @foreach ($item['indikator'] as $indikator)
                                            <li>{{ $indikator['teks'] }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <span>Realisasi :</span>
                                    <p>{{ $item['realisasi'] }}</p>
                                </td>
                                <td>
                                    <span>Umpan Balik :</span>
                                    <p>{{ $item['umpan_balik'] }}</p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                        <i class="nav-icon fas fa-pencil-alt "></i>
                                    </button>
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Isi Realisasi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-1" style="width:30%">Hasil Kerja</div>
                                                        <div class="flex-grow" style="width: 100%">
                                                        <input type="text" class="form-control" id="inputPassword" placeholder="Hasil Kerja">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-start">
                                                        <div class="mr-1" style="width:30%">Realisasi</div>
                                                        <div class="" style="width: 100%">
                                                            <textarea placeholder="Realisasi" style="height: 70px; width: 100%; padding: 10px; overflow-y: auto; resize: vertical;"></textarea>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table mb-0" style="width: 100%;">
                        <thead>
                          <tr>
                            <th colspan="5">B. Tambahan</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tbody>
                                @foreach ($hasilKerja as $index => $item)
                                    <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>
                                        <p>{{ $item['capaian'] }}</p>
                                        <span>Ukuran keberhasilan / Indikator Kinerja Individu, dan Target :</span>
                                        <ul>
                                            @foreach ($item['indikator'] as $indikator)
                                                <li>{{ $indikator['teks'] }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <span>Realisasi :</span>
                                        <p>{{ $item['realisasi'] }}</p>
                                    </td>
                                    <td>
                                        <span>Umpan Balik :</span>
                                        <p>{{ $item['umpan_balik'] }}</p>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                            <i class="nav-icon fas fa-pencil-alt "></i>
                                        </button>
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Isi Realisasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width:30%">Hasil Kerja</div>
                                                            <div class="flex-grow" style="width: 100%">
                                                            <input type="text" class="form-control" id="inputPassword" placeholder="Hasil Kerja">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-start">
                                                            <div class="mr-1" style="width:30%">Realisasi</div>
                                                            <div class="" style="width: 100%">
                                                                <textarea placeholder="Realisasi" style="height: 70px; width: 100%; padding: 10px; overflow-y: auto; resize: vertical;"></textarea>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </tbody>
                    </table>
                    <table class="table mb-0" style="width: 100%;">
                        <thead>
                          <tr>
                            <th colspan="5">PERILAKU KERJA</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>
                                <p>
                                    Manual book penggunaan aplikasi modul penyusunan SKP yang lengkap dan informatif (Penugasan dari Ketua Tim Perencanaan dan Sistem Informasi)
                                </p>
                                <span>Ukuran keberhasilan / Indikator Kinerja Individu, dan Target :</span>
                                <ul>
                                    <li>Draft manual book penggunaan aplikasi modul penyusunan rencana SKP yang lengkap sesuai dengan ketentuan dan diselesaikan maksimal satu bulan sebelum kegiatan sosialisasi</li>
                                </ul>
                            </td>
                            <td>
                                <span>Realisasi :</span>
                                <p>Draft manual book aplikasi untuk modul penyusunan rencana SKP telah selesai pada bulan April sesuai dengan proses bisnis aplikasi</p>
                            </td>
                            <td>
                                <span>Umpan Balik :</span>
                                <div class="input-group">
                                    <select class="custom-select" id="inputGroupSelect04">
                                      <option selected>Choose...</option>
                                      <option value="1">One</option>
                                      <option value="2">Two</option>
                                      <option value="3">Three</option>
                                    </select>
                                    <div class="input-group-append">
                                      <button class="btn btn-outline-secondary" type="button">
                                        <i class="nav-icon fas fa-copy "></i>
                                      </button>
                                    </div>
                                </div>
                                <textarea style="height: 150px; width: 100%; padding: 10px; overflow-y: auto; resize: vertical;"></textarea>
                            </td>
                            <td>
                                <button onclick="window.location.href=''" type="button" class="btn btn-primary">
                                    <i class="nav-icon fas fa-pencil-alt "></i>
                                </button>
                            </td>
                          </tr>
                        </tbody>
                    </table>
                    <div class="w-100 mt-4 d-flex justify-content-end">
                        <button id="proses-umpan-balik-button" class="btn btn-primary">Ajukan Realisasi</button>
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
    const prosesUmpanBalikButton = document.querySelector('#proses-umpan-balik-button');
    // prosesUmpanBalikButton.addEventListener('click', () => {
    //     prosesUmpanBalikButton.
    // })
</script>
@endpush
