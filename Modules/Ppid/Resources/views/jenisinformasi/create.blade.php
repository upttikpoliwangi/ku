@extends('adminlte::page')
@section('title', 'Tambah Jenis Informasi')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Tambah Jenis Informasi</h5>
            <form action="{{ route('jenisinformasi.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="jenis_informasi" class="form-label">Jenis Informasi</label>
                    <input type="text" name="jenis_informasi" id="jenis_informasi" class="form-control" value="{{ old('jenis_informasi') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('jenisinformasi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
