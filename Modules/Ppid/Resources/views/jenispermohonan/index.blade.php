@extends('adminlte::page')
@section('title', 'Daftar Jenis Permohonan')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Daftar Jenis Permohonan</h5>
            <a href="{{ route('jenispermohonan.create') }}" class="btn btn-primary mb-3">Tambah Jenis Permohonan</a>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th style="width: 900px; text-align: center;">Jenis Permohonan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jenispermohonans as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->jenis_permohonan }}</td>
                            <td class="text-center">
                                <div class="d-flex">
                                <a href="{{ route('jenispermohonan.edit', $item->id) }}" class="btn btn-warning btn-sm mb-1" style="margin-right: 5px">Edit</a>
                                <form action="{{ route('jenispermohonan.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-3">Data belum tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
