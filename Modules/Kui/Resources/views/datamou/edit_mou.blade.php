@extends('adminlte::page')
@section('title', 'Edit Panduan Kerjasama')
@section('plugins.Select2', true)
@section('content_header')
<h1 class="m-0 text-dark">Edit File MoU</h1>
@stop

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Data File MOU</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form action="{{ url('/kui/datamou/update/' . $file->id) }}" method="POST"
                            enctype="multipart/form-data" id="form-tambah">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama_file">Nama File</label>
                                        <input type="text"
                                            class="form-control @error('nama_file')
                                                is-invalid
                                            @enderror"
                                            id="nama_file" name="nama_file" aria-describedby="mouHelp"
                                            placeholder="Masukkan Nama" value="{{ $file->nama_file }}">
                                        @error('nama_file')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputmou1">File</label>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                                            name="file" accept=".pdf">
                                        @error('file')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @if($file->file)
                                        <small class="form-text text-muted">
                                            Dokumen saat ini: {{ $file->file }}
                                        </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="button-tambah" class="btn btn-primary"
                                style="float: right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#jurusan').select2({
            tags: true,
            placeholder: "Pilih Jurusan",
            // selectionCssClass: "form-control"

        });
        $('#kategori').select2({
            tags: true,
            placeholder: "Pilih Kategori"
        });
        $('#button-tambah').on("click", function(e) {
            e.preventDefault();
            var form = $(this).parents('form');
            Swal.fire({
                icon: 'warning',
                title: 'Apakah Anda Yakin ?',
                showDenyButton: true,
                confirmButtonText: 'Yakin',
                denyButtonText: `Tidak`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#form-tambah").submit();
                } else if (result.isDenied) {
                    Swal.fire('Data Tidak Ditambahkan', '', 'success')
                }
            })
        })
    });
</script>
@endpush
@endsection