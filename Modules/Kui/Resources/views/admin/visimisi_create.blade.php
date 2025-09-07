@extends('adminlte::page')
@section('title', 'Edit Panduan Kerjasama')
@section('plugins.Select2', true)
@section('content_header')
<h1 class="m-0 text-dark">Edit Profil</h1>
@stop

@section('content')

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<div class="container">
    <form action="{{ route('kui.visimisi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nama Halaman</label>
            <input type="text" name="namahalaman" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Visi</label>
            <textarea name="visi" id="visi" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Misi</label>
            <textarea name="misi" id="misi" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Struktur Organisasi</label>
            <input type="file" name="struktur_organisasi" class="form-control-file" accept="image/*">
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    CKEDITOR.replace('visi');
    CKEDITOR.replace('misi');
</script>

@endsection