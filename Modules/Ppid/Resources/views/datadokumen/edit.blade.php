@extends('adminlte::page')
@section('title', 'Edit Data Dokumen')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Edit Data Dokumen</h5>
            <form action="{{ route('datadokumen.update', $datadokumen->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                    <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control" value="{{ old('nama_dokumen', $datadokumen->nama_dokumen) }}" required>
                </div>
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="date" name="tahun" id="tahun" class="form-control" value="{{ old('tahun', $datadokumen->tahun) }}">
                </div>
                <div class="mb-3">
                    <label for="jenis_dokumen_id" class="form-label">Jenis Dokumen</label>
                    <select name="jenis_dokumen_id" id="jenis_dokumen_id" class="form-control" required>
                        <option value="">- Pilih Jenis Dokumen -</option>
                        @foreach($jenis_dokumen as $jenis)
                            <option value="{{ $jenis->id }}" @if($datadokumen->jenis_dokumen_id == $jenis->id) selected @endif>{{ $jenis->jenis_dokumen }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Upload File (jika ingin mengganti)</label>
                    <input type="file" name="file" id="file" accept="application/pdf" class="form-control @error('file') is-invalid @enderror">
                    @if($datadokumen->file_path)
                        <small>File saat ini: <a href="{{ asset('storage/' . $datadokumen->file_path) }}" target="_blank">Download</a></small>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('datadokumen.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
