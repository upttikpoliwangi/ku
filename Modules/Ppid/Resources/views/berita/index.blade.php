@extends('adminlte::page')
@section('title', 'Daftar Berita')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Daftar Berita</h5>
            <a href="{{ route('berita.create') }}" class="btn btn-primary mb-3">Tambah Berita</a>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th style="width: 300px; text-align: center;">Judul</th>
                            <th style="width: 300px; text-align: center;">Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Sumber</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($beritas as $index => $berita)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $berita->judul }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($berita->deskripsi, 60) }}</td>
                            <td>{{ $berita->tanggal }}</td>
                            <td>{{ $berita->sumber }}</td>
                            <td>
                                @if($berita->gambar)
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar" width="80">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning btn-sm" style="margin-right: 5px">Edit</a>
                                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-3">Belum ada berita.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
