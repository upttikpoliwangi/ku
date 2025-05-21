@extends('adminlte::page')

@section('title', 'Dasbor Simlitabmas')

@section('content_header')
    <h1 class="m-0 text-dark">Evaluasi SKP</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('penilaian::components.set-periode')
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="w-100 justify-content-between align-items-center p-4 {{ $rencana->predikat_akhir == null ? 'd-none' : 'd-flex' }}">
                    @php
                        switch ($rencana->predikat_akhir) {
                            case 'Sangat Baik':
                            case 'Baik':
                                $badgeClass = 'badge-success';
                                break;
                            case 'Butuh Perbaikan':
                                $badgeClass = 'badge-danger';
                                break;
                            default:
                                $badgeClass = 'badge-light';
                                break;
                        }
                    @endphp
                    <span class="badge m-2 {{ $badgeClass }}" style="width: fit-content">{{ $rencana->predikat_akhir }}</span>
                    <button id="proses-umpan-balik-button" class="btn btn-primary ml-1 {{ $rencana->predikat_akhir == null ? 'd-none' : '' }}">Batalkan Evaluasi</button>
                </div>
                @include('penilaian::components.atasan-bawahan-section')
                <div class="bg-white p-4">
                    <form
                    method="POST"
                    action="{{ url('/penilaian/evaluasi/proses-umpan-balik/' . $pegawai->username) }}"
                    >
                        @csrf
                        {{-- utama --}}
                        <table class="table mb-0" style="table-layout: auto; width: 100%;">
                            <thead>
                              <tr>
                                <th colspan="4">HASIL KERJA</th>
                              </tr>
                              <tr>
                                <th colspan="4">A. Utama</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if ($rencana && $rencana->hasilKerja)
                                    @foreach ($rencana->hasilKerja as $index => $item)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td style="width: 50%;">
                                                <p>{{ $item->deskripsi }}</p>
                                                <span>Ukuran keberhasilan / Indikator Kinerja Individu, dan Target :</span>
                                                <ul>
                                                    @foreach ($item->indikator as $indikator)
                                                        <li>{{ $indikator->deskripsi }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td style="width: 25%;">
                                                <span>Realisasi :</span>
                                                <p>{{ $item['realisasi'] }}</p>
                                            </td>
                                            <td style="width: 25%;">
                                                <span>Umpan Balik :</span>
                                                <div class="input-group">
                                                    <input type="hidden" name="feedback[{{ $index }}][hasil_kerja_id]" value="{{ $item->id }}">
                                                    <select class="custom-select" id="umpan_bali_id" name="feedback[{{ $index }}][umpan_balik_predikat]">
                                                        @if ($item->penilaianHasilKerja[0]->umpan_balik_predikat == null)
                                                            @include('penilaian::components.predikat-dropdown', ['jenis' => 'Predikat'])
                                                        @else
                                                            <option value="{{ $item->penilaianHasilKerja[0]->umpan_balik_predikat }}">{{ $item->penilaianHasilKerja[0]->umpan_balik_predikat }}</option>
                                                        @endif
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button">
                                                            <i class="nav-icon fas fa-copy "></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <textarea
                                                class="{{ ($item->penilaianHasilKerja[0]->umpan_balik_predikat !== null && $item->penilaianHasilKerja[0]->umpan_balik_deskripsi === null) ? 'd-none' : '' }}"
                                                {{ ($item->penilaianHasilKerja[0]->umpan_balik_predikat !== null && $item->penilaianHasilKerja[0]->umpan_balik_deskripsi !== null) ? 'disabled' : '' }}
                                                name="feedback[{{ $index }}][umpan_balik_deskripsi]"
                                                placeholder="{{ ($item->penilaianHasilKerja[0]->umpan_balik_predikat !== null && $item->penilaianHasilKerja[0]->umpan_balik_deskripsi !== null) ? $item->penilaianHasilKerja[0]->umpan_balik_deskripsi : '' }}"
                                                style="height: 150px; width: 100%; padding: 10px; overflow-y: auto; resize: vertical;"></textarea>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{-- tambahan --}}
                        <table class="table mb-0" style="table-layout: fixed; width: 100%;">
                            <thead>
                              <tr>
                                <th colspan="4">B. Tambahan</th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4">No data</td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- perilaku --}}
                        <table class="table mb-0" style="table-layout: auto; width: 100%;">
                            <thead>
                              <tr>
                                <th colspan="4">PERILAKU KERJA</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if ($rencana && $rencana->perilakuKerja)
                                    @foreach ($rencana->perilakuKerja as $index => $item)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>
                                                <p>
                                                    {{ $item->deskripsi }}
                                                </p>
                                                <ul>
                                                    <li>Memahami dan memenuhi kebutuhan masyarakat</li>
                                                    <li>Ramah, cekatan, solutif, dan dapat diandalkan</li>
                                                    <li>Melakukan perbaikan tiada henti</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <span>Ekspektasi Khusus Pimpinan:</span>
                                                <p>{{ $item->ekspektasi_pimpinan }}</p>
                                            </td>
                                            <td>
                                                <span>Umpan Balik :</span>
                                                <div class="input-group">
                                                    <input type="hidden" name="feedback_perilaku_kerja[{{ $index }}][perilaku_kerja_id]" value="{{ $item->rencanaPerilaku->id }}">
                                                    <select class="custom-select" id="perilaku_kerja_id" name="feedback_perilaku_kerja[{{ $index }}][perilaku_umpan_balik_predikat]">
                                                        @if ($item->rencanaPerilaku->penilaianPerilakuKerja[0]->umpan_balik_predikat == null)
                                                            @include('penilaian::components.predikat-dropdown', ['jenis' => 'Predikat'])
                                                        @else
                                                            <option value="{{ $item->rencanaPerilaku->penilaianPerilakuKerja[0]->umpan_balik_predikat }}">{{ $item->rencanaPerilaku->penilaianPerilakuKerja[0]->umpan_balik_predikat }}</option>
                                                        @endif
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button">
                                                            <i class="nav-icon fas fa-copy "></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <textarea
                                                class="{{ ($item->rencanaPerilaku->penilaianPerilakuKerja[0]->umpan_balik_predikat !== null && $item->rencanaPerilaku->penilaianPerilakuKerja[0]->umpan_balik_deskripsi === null) ? 'd-none' : '' }}"
                                                {{ ($item->rencanaPerilaku->penilaianPerilakuKerja[0]->umpan_balik_predikat !== null && $item->rencanaPerilaku->penilaianPerilakuKerja[0]->umpan_balik_deskripsi !== null) ? 'disabled' : '' }}
                                                name="feedback_perilaku_kerja[{{ $index }}][perilaku_umpan_balik_deskripsi]"
                                                placeholder="{{ ($item->rencanaPerilaku->penilaianPerilakuKerja[0]->umpan_balik_predikat !== null && $item->rencanaPerilaku->penilaianPerilakuKerja[0]->umpan_balik_deskripsi !== null) ? $item->rencanaPerilaku->umpan_balik_deskripsi : '' }}"
                                                style="height: 150px; width: 100%; padding: 10px; overflow-y: auto; resize: vertical;"></textarea>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @php
                            $loggedInKetuaId = $pegawaiWhoLogin->id;
                            $semuaSudahTerisi = $rencana->hasilKerja->every(function ($hasil) use ($loggedInKetuaId) {
                                $penilaian = $hasil->penilaianHasilKerja
                                    ->firstWhere('ketua_tim_id', $loggedInKetuaId);

                                return $penilaian && !is_null($penilaian->umpan_balik_predikat);
                            });
                        @endphp
                        @if (!$semuaSudahTerisi)
                            <div class="w-100 mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Proses Umpan Balik</button>
                            </div>
                        @endif
                    </form>
                    @if($semuaSudahTerisi && count($rencana->hasilKerja) !== 0)
                        <div>@include('penilaian::components.proses-umpan-balik')</div>
                    @endif
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
    @include('penilaian::evaluasi.script-evaluasi-detail')
    @include('penilaian::evaluasi.script-periode')
@endpush
