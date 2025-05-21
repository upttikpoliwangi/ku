@extends('adminlte::page')

@section('title', 'Dasbor Simlitabmas')

@section('content_header')
    <h1 class="m-0 text-dark">Periode SKP</h1>
@stop
@php
@endphp
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="bg-white p-4">
                    <div class="d-flex justify-content-end">
                        @include('penilaian::components.modal-create-periode')
                    </div>
                    <table id="table-periode" class="mt-4 table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Durasi</th>
                                <th>Tahun</th>
                                <th>Jenis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periodes as $index => $periode)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($periode->start_date)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($periode->end_date)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $periode->tahun }}</td>
                                    <td>{{ $periode->jenis_periode }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@push('js')
@include('penilaian::evaluasi.script-periode')
@endpush
