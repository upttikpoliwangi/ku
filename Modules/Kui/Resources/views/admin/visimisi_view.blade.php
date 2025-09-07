@extends('adminlte::page')

@section('title', 'List Menu')

@section('plugins.Select2', true)

@section('content_header')
<h1 class="m-0 text-dark"></h1>
@stop


@section('content')
<div class="container">
    <h2>Daftar Visi & Misi</h2>
    <!-- Tombol edit dipindah ke kolom aksi di bawah -->

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- <table class="table table-bordered" style="background-color: #fff;"> -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Halaman</th>
                        <th>visi</th>
                        <th>Misi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->namahalaman }}</td>
                        <td>{{ $item->visi }}</td>
                        <td>{{ $item->misi }}</td>
                        <td>
                            <a href="{{ route('kui.visimisi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Belum ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
    </div>
    @endsection