@extends('adminlte::page')
@section('title', 'List Menu')
@section('plugins.Select2', true)
@section('content_header')

@stop

@section('content')
<div class="container p-4">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card shadow" style="background: #fff;">
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="">Aktivitas Poliwangi</h1>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ url('/kui/dataaktivitas/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="nomor_mou">Nomor MOU:</label>
                            <select class="form-control" id="kategori" name="nomor_mou">
                                <option value="">-- Plih Nomor MOU --</option>
                                @foreach ($kerjasama as $item)
                                    <option value="{{ $item->nomor_mou }}"
                                        {{ old('nomor_mou') == $item->nomor_mou ? 'selected' : '' }}>
                                        {{ $item->nomor_mou }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kegiatan">Kegiatan:</label>
                            <input type="text" class="form-control" name="kegiatan" placeholder="Kegiatan">
                        </div>
                        <div class="form-group">
                            <label for="prodi">Kategori:</label>
                            <select class="form-control" id="kategori" name="id_kategori">
                                <option value="">-- Plih Kategori --</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id_kategori }}"
                                        {{ old('kategori') == $item->id_kategori ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal">Tanggal:</label>
                            <input type="date" class="form-control" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <label for="">Cover Aktivitas:</label>
                            <input type="file" class="form-control" name="foto" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="">Deskripsi:</label>
                            <textarea name="deskripsi" id="description" cols="30" rows="10"></textarea>
                        </div>
                        <div class="text-end">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $('#description').summernote({
            placeholder: 'description...',
            tabsize: 2,
            height: 300
        });
    </script>
@endpush
@endsection
