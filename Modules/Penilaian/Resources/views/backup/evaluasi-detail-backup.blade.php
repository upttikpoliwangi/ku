@extends('adminlte::page')

@section('title', 'Dasbor Simlitabmas')

@section('content_header')
    <h1 class="m-0 text-dark">Evaluasi SKP</h1>
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
@endphp
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="w-100 d-flex justify-content-between align-items-center p-4">
                    <div class="alert alert-success m-0" role="alert">
                        This is a success alert—check it out!
                    </div>
                    <button id="proses-umpan-balik-button" class="btn btn-primary ml-1">Batalkan Evaluasi</button>
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
                    <table class="table mb-0" style="table-layout: fixed; width: 100%;">
                        <thead>
                          <tr>
                            <th colspan="4">HASIL KERJA</th>
                          </tr>
                          <tr>
                            <th colspan="4">A. Utama</th>
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
                          </tr>
                        </tbody>
                    </table>
                    <table class="table mb-0" style="table-layout: fixed; width: 100%;">
                        <thead>
                          <tr>
                            <th colspan="4">B. Tambahan</th>
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
                          </tr>
                        </tbody>
                    </table>
                    <table class="table mb-0" style="table-layout: fixed; width: 100%;">
                        <thead>
                          <tr>
                            <th colspan="4">PERILAKU KERJA</th>
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
                          </tr>
                        </tbody>
                    </table>
                    <div class="w-100 mt-4 d-flex justify-content-end">
                        <button id="proses-umpan-balik-button" class="btn btn-primary">Proses Umpan Balik</button>
                    </div>
                    <div class="mt-4">
                        <table class="table mb-0" style="table-layout: fixed; width: 100%;">
                            <thead>
                              <tr>
                                <th colspan="2">EVALUASI HASIL KERJA</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Rekomendasi</td>
                                <td>Diatas Ekspektasi</td>
                              </tr>
                              <tr>
                                <td>Rating Hasil Kerja</td>
                                <td>
                                    <select class="custom-select" id="inputGroupSelect04">
                                        <option selected>-- Pilih Rating --</option>
                                        <option value="1">Diatas Ekspektasi</option>
                                        <option value="2">Sesuai Ekspektasi</option>
                                        <option value="3">Dibawah Ekspektasi</option>
                                    </select>
                                    <textarea style="height: 150px; width: 100%; padding: 10px; overflow-y: auto; resize: vertical;"></textarea>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                        <table class="table" style="table-layout: fixed; width: 100%;">
                            <thead>
                              <tr>
                                <th colspan="2">EVALUASI PERILAKU</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Rekomendasi</td>
                                <td>Diatas Ekspektasi</td>
                              </tr>
                              <tr>
                                <td>Rating Perilaku</td>
                                <td>
                                    <select class="custom-select" id="inputGroupSelect04">
                                        <option selected>-- Pilih Rating --</option>
                                        <option value="1">Diatas Ekspektasi</option>
                                        <option value="2">Sesuai Ekspektasi</option>
                                        <option value="3">Dibawah Ekspektasi</option>
                                    </select>
                                    <textarea style="height: 150px; width: 100%; padding: 10px; overflow-y: auto; resize: vertical;"></textarea>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                        <table class="table" style="table-layout: fixed; width: 100%;">
                            <tbody>
                              <tr>
                                <td>Predikat Kinerja Pegawai</td>
                                <td>-</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-100 mt-4 d-flex justify-content-end">
                        <button id="proses-umpan-balik-button" class="btn btn-primary mr-1">Ubah Umpan Balik</button>
                        <button id="proses-umpan-balik-button" class="btn btn-primary ml-1">Simpan Hasil Evaluasi</button>
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
