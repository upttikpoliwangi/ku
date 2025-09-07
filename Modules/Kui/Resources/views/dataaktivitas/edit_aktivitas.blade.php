@extends('adminlte::page')
@section('title', 'Edit Panduan Kerjasama')
@section('plugins.Select2', true)
@section('content_header')
<h1 class="m-0 text-dark">Edit Panduan Kerjasama</h1>
@stop

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aktivitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body>
    <div class="container p-4">
        <a class="btn btn-lg btn-danger" type="button" href="{{ url('/kui/aktivitas') }}">Kembali</a>
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="text-center">
                    <h1 class="">Update Aktivitas Poliwangi</h1>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ url('/aktivitas/update/' . $post->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="mb-3 form-group">
                        <label for="nomor_mou">Nomor MOU:</label>
                        <select class="form-control" id="kategori" name="nomor_mou">
                            <option value="">-- Plih Nomor MOU --</option>
                            @foreach ($kerjasama as $item)
                                <option value="{{ $item->nomor_mou }}"
                                    {{ $post->nomor_mou == $item->nomor_mou ? 'selected' : '' }}>
                                    {{ $item->nomor_mou }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kegiatan">Kegiatan:</label>
                        <input type="text" class="form-control" name="kegiatan" value="{{ $post->kegiatan }}">
                    </div>
                    <div class="form-group">
                        <label for="prodi">Kategori</label>
                        <select class="form-control" id="kategori" name="id_kategori">
                            <option value="">-- Plih Kategori --</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id_kategori }}"
                                    {{ $post->id_kategori == $item->id_kategori ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ $post->tanggal }}">
                    </div>
                    <div class="mb-3">
                        <label for="">Cover Aktivitas:</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                    <div class="mb-3">
                        <label for="">Deskripsi:</label>
                        <textarea name="deskripsi" id="description" cols="30" rows="10">{{ $post->deskripsi }}</textarea>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#description').summernote({
            placeholder: 'description...',
            tabsize: 2,
            height: 300
        });
    </script>
</body>

</html>
