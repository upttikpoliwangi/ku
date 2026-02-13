@extends('adminlte::page')
@section('title', 'Edit Jenis Permohonan')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Edit Jenis Permohonan</h5>
            <form action="{{ route('jenispermohonan.update', $jenispermohonan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="jenis_permohonan" class="form-label">Jenis Permohonan</label>
                    <input type="text" name="jenis_permohonan" id="jenis_permohonan" class="form-control" value="{{ old('jenis_permohonan', $jenispermohonan->jenis_permohonan) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('jenispermohonan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
