@extends('adminlte::page')
@section('title', 'Edit Jenis Dokumen')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Edit Jenis Dokumen</h5>
            <form action="{{ route('jenisdokumen.update', $jenisdokumen->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="jenis_dokumen" class="form-label">Jenis Dokumen</label>
                    <input type="text" name="jenis_dokumen" id="jenis_dokumen" class="form-control" value="{{ old('jenis_dokumen', $jenisdokumen->jenis_dokumen) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('jenisdokumen.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
