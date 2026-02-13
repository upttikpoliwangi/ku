@extends('adminlte::page')
@section('title', 'Edit Jenis Informasi')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Edit Jenis Informasi</h5>
            <form action="{{ route('jenisinformasi.update', $jenis_informasi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="jenis_informasi" class="form-label">Nama Jenis</label>
                    <input type="text" name="jenis_informasi" id="jenis_informasi" class="form-control" value="{{ old('jenis_informasi', $jenis_informasi->jenis_informasi) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('jenisinformasi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
