@extends('adminlte::page')
@section('title', 'Tambah Data Informasi')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Tambah Data Informasi</h5>
            <form action="{{ route('datainformasi.store') }}" method="POST">
                @csrf

                <!-- Nama Informasi -->
                <div class="mb-3">
                    <label for="nama_informasi" class="form-label">Nama Informasi</label>
                    <input type="text" name="nama_informasi" id="nama_informasi"
                        class="form-control @error('nama_informasi') is-invalid @enderror"
                        value="{{ old('nama_informasi') }}">
                    @error('nama_informasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jenis Informasi -->
                <div class="mb-3">
                    <label for="jenis_informasi_id" class="form-label">Jenis Informasi</label>
                    <select name="jenis_informasi_id" id="jenis_informasi_id"
                        class="form-control @error('jenis_informasi_id') is-invalid @enderror">
                        <option value="">- Pilih Jenis Informasi -</option>
                        @foreach($jenisInformasi as $jenis)
                            <option value="{{ $jenis->id }}" {{ old('jenis_informasi_id') == $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->jenis_informasi }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_informasi_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Link -->
                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="url" name="link" id="link"
                        class="form-control @error('link') is-invalid @enderror"
                        value="{{ old('link') }}">
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('datainformasi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection