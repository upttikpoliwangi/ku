@extends('adminlte::page')
@section('title', 'Data Dokumen')
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
            <h5 class="mb-3">Daftar Data Dokumen</h5>
            <a href="{{ route('datadokumen.create') }}" class="btn btn-primary mb-3">Tambah Dokumen</a>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Dokumen</th>
                            <th>Tahun</th>
                            <th>Jenis Dokumen</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datadokumen as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_dokumen }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->jenisDokumens->jenis_dokumen ?? '-' }}</td>
                            <td>
                                @if($item->file_path)
                                    <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank">Lihat File</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                <a href="{{ route('datadokumen.edit', $item->id) }}" class="btn btn-warning btn-sm" style="margin-right: 5px">Edit</a>
                                <form action="{{ route('datadokumen.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus dokumen ini?')">Hapus</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-3">Data belum tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Script untuk auto hide alert --}}
@section('js')
<script>
    setTimeout(function() {
        $('#alert-success').fadeOut('slow');
    }, 3000); // 3 detik
</script>
@endsection