@extends('adminlte::page')

@section('title', 'Dasbor Simlitabmas')


@section('content_header')
    <h1 class="m-0 text-dark">Matriks Peran Hasil</h1>
@stop

@php
    $selectedId = request('hasil_kerja_id');
    $selected = $rencana->hasilKerja->firstWhere('id', $selectedId);
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card bg-white ">
                <div class="d-flex p-4">
                    <form method="GET" action="{{ url()->current() }}" class="w-100">
                        <div class="form-group">
                            <label for="hasil-kerja-select">Hasil Kerja</label>
                            <select class="form-control" id="hasil-kerja-select" name="hasil_kerja_id" onchange="this.form.submit()">
                                <option value="">-- Pilih Hasil Kerja --</option>
                                @foreach ($rencana->hasilKerja as $item)
                                    <option value="{{ $item->id }}" {{ request('hasil_kerja_id') == $item->id ? 'selected' : '' }}>{{ $item->deskripsi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="px-4">
                    @if ($selected)
                        @foreach ($selected->indikator as $indikator)
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 90%" colspan="2">{{ $indikator->deskripsi }}</th>
                                    <th style="width: 10%" colspan="1">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-cascading-{{ $indikator->id }}">
                                            <i class="nav-icon fas fa-plus "></i>
                                        </button>
                                        @include('penilaian::components.modal-create-cascading', [
                                            'indikator' => $indikator,
                                            'hasil_kerja_id' => $selectedId
                                        ])
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <ul>
                                            @foreach ($indikator->cascading as $item)
                                                <li>{{ $item->pegawai->nama }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>-</td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
@stop

@push('js')
    <script>
        $(document).ready(function() {
            $('.modal').on('shown.bs.modal', function () {
                let modal = $(this);
                let table = modal.find('table[id^="table-pegawai-cascading-"]');
                let tableId = '#' + table.attr('id');
                if ( $.fn.DataTable.isDataTable(tableId) ) {
                    $(tableId).DataTable().destroy();
                }
                $(tableId).DataTable({
                    responsive: true,
                    scrollX: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/penilaian/matriks-peran-hasil/anggota',
                        type: 'GET',
                        dataSrc: function (response) {
                            try {
                                return response.data.map((data) => {
                                    return {
                                        id: data.pegawai.id,
                                        nama: data.pegawai.username,
                                    }
                                })
                            } catch (error) {
                                console.log(error)
                            }
                        },
                    },
                    columns: [
                        {
                            data: null,
                            defaultContent: '',
                            className: 'select-checkbox',
                            orderable: false,
                            render: (data, type, row) => {
                                return `<input type="checkbox" name="cascading[]" value="${row.id}">`
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama',
                            orderable: true
                        },
                    ],
                    select: {
                        style:    'multi',
                        selector: 'td.select-checkbox'
                    },
                    pageLength: 10,
                    lengthMenu: [10, 25, 50, 100],
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                })
            })
        });
    </script>
@endpush
