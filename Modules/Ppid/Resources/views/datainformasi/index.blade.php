@extends('adminlte::page')
@section('title', 'Data Informasi')
@section('content')
<div class="container py-4">

    {{-- Notifikasi Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Daftar Data Informasi</h5>
            <a href="{{ route('datainformasi.create') }}" class="btn btn-primary mb-3">Tambah Data Informasi</a>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th style="width: 600px; text-align: center;">Nama Informasi</th>
                            <th>Jenis Informasi</th>
                            <th>Link</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datainformasi as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_informasi }}</td>
                            <td>{{ $item->jenisInformasi->jenis_informasi ?? '-' }}</td>
                            <td>
                                @if($item->link)
                                    <a href="{{ $item->link }}" target="_blank">Lihat</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                <a href="{{ route('datainformasi.edit', $item->id) }}" class="btn btn-warning btn-sm" style="margin-right: 5px">Edit</a>
                                <form action="{{ route('datainformasi.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-3">Data belum tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
