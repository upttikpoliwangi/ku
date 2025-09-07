@extends('adminlte::page')
@section('title', 'Edit Panduan Kerjasama')
@section('plugins.Select2', true)
@section('content_header')
<h1 class="m-0 text-dark">Edit Panduan Kerjasama</h1>
@stop

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-black">
            <h3 class="mb-0">Form Edit Panduan Kerjasama</h3>
        </div>

        <div class="card-body">
            <form action="{{ url('/kui/panduan/update', $allDatapanduan->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_file">Nama file</label>
                            <input type="text" class="form-control" id="nama_file" name="nama_file"
                                value="{{ old('nama_file', $allDatapanduan->nama_file) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file_panduan">Panduan Kerjasama (PDF)</label>
                            <input type="file" class="form-control-file" id="file_panduan" name="file_panduan" accept=".pdf">
                            @if($allDatapanduan->file_panduan)
                            <small class="form-text text-muted">
                                Dokumen saat ini: {{ $allDatapanduan->file_panduan }}
                            </small>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group text-right mt-6">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
@stop

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    $(document).ready(function() {
        // Validasi client-side bisa ditambahkan di sini
    });
</script>
@endpush