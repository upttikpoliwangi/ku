@extends('adminlte::page')

@section('title', 'List Menu')

@section('plugins.Select2', true)

@section('content_header')
<h1 class="m-0 text-dark"></h1>
@stop

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="row w-100">
                            <div class="col-md-6 d-flex align-items-center">
                                <h4 class="mb-0">Data Aktivitas</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ url('/kui/dataaktivitas/create') }}" class="btn btn-primary">Tambah Aktivitas</a>
                            </div>
                        </div>
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
                        <form method="GET" action="" class="mb-3">
                            <div class="row justify-content-end">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Cari" value="{{ request('search') }}">
                                        <button class="btn btn-primary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">No MOU</th>
                                        <th scope="col">Kegiatan</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><a
                                                href="{{ url('/aktivitas/kerjasama/show/' . $post->nomor_mou) }}">{{ $post->nomor_mou }}</a>
                                        </td>
                                        <td>{{ $post->kegiatan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($post->tanggal)->translatedFormat('l, j F Y') }}
                                        </td>
                                        {{-- <td>
                                                    <a href="{{ url('/aktivitas/show/' . $post->id) }}"
                                        class="btn btn-success">Show</a>
                                        <a href="{{ url('/aktivitas/edit/' . $post->id) }}"
                                            class="btn btn-info">Edit</a>
                                        <a href="{{ url('/aktivitas/delete/' . $post->id) }}"
                                            class="btn btn-danger">Delete</a>
                                        </td> --}}
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Aksi">
                                                <a href="{{ url('/aktivitas/show/' . $post->id) }}" class="btn btn-success">Show</a>
                                                <a href="{{ url('/aktivitas/edit/' . $post->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('/aktivitas/delete/' . $post->id) }}" class="btn btn-danger">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination pl-2 ml-4">
                                {{ $posts->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
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
                denyButtonText: Tidak,
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