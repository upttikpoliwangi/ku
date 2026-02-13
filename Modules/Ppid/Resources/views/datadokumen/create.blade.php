@extends('adminlte::page')
@section('title', 'Tambah Data Dokumen')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Tambah Data Dokumen</h5>
            <form action="{{ route('datadokumen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Nama Dokumen --}}
                <div class="mb-3">
                    <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                    <input type="text" 
                           name="nama_dokumen" 
                           id="nama_dokumen" 
                           class="form-control @error('nama_dokumen') is-invalid @enderror" 
                           value="{{ old('nama_dokumen') }}">
                    @error('nama_dokumen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tahun --}}
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="date" 
                           name="tahun" 
                           id="tahun" 
                           class="form-control @error('tahun') is-invalid @enderror" 
                           value="{{ old('tahun') }}">
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jenis Dokumen --}}
                <div class="mb-3">
                    <label for="jenis_dokumens_id" class="form-label">Jenis Dokumen</label>
                    <select name="jenis_dokumens_id" 
                            id="jenis_dokumens_id" 
                            class="form-control @error('jenis_dokumens_id') is-invalid @enderror">
                        <option value="">- Pilih Jenis Dokumen -</option>
                        @foreach($jenis_dokumens as $jenis)
                            <option value="{{ $jenis->id }}" {{ old('jenis_dokumens_id') == $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->jenis_dokumen }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_dokumens_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Upload File --}}
                <div class="mb-3">
                    <label for="file" class="form-label">Upload File</label>
                    <input type="file" 
                           name="file" 
                           id="file"
                           accept="application/pdf"
                           class="form-control @error('file') is-invalid @enderror">
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('datadokumen.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
