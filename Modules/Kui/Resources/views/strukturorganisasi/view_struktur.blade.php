@extends('adminlte::page')

@section('title', 'List Menu')

@section('plugins.Select2', true)

@section('content_header')
<h1 class="m-0 text-dark"></h1>
@stop


@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-black d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Struktur Organisasi</h3>
            <div class="ms-auto">
                <a href="{{url('/kui/strukturorganisasi/create')}}" class="btn btn-primary btn-sm">+ Add New</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="kerjasamaTable" class="table table-bordered table-striped">
                    <table id="example" class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Struktur</th>
                                <th>Foto Stuktur Organisasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allDatastrukturorganisasi as $index => $item)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->foto_struktur }}</td>
                                <td>
                                    <!-- Tambahkan tombol aksi di sini -->
                                    <a href="{{url('/kui/strukturorganisasi/edit/'. $item->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ url('/kui/strukturorganisasi/delete/'. $item->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class=""></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.bootstrap5.css">
@stop

@push('js')
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true,
            autoWidth: false
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-"></script>
<script src="bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.bootstrap5.js"></script>
@endpush