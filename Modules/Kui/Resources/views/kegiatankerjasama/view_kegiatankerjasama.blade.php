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
            <h3 class="mb-0">Kegiatan Kerjasama</h3>
            <div class="ms-auto">
                <a href="{{url('/kui/kegiatankerjasama/create')}}" class="btn btn-primary btn-sm">+ Add New</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="kerjasamaTable" class="table table-bordered table-striped">
                    <table id="example" class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Jurusan</th>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Biaya Kegiatan</th>
                                <th width="20%">Aksi</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach($allDatakegiatankerjasama as $index => $item)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{ $item->jurusan->nama_jurusan ?? $item->jurusan->nama ?? '-' }}</td>
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>{{ $item->tanggal_kegiatan }}</td>
                                <td>{{ $item->formatted_biaya }}</td>
                                <td>
                                    <!-- Tambahkan tombol aksi di sini -->
                                    <a href="{{ url('/kui/kegiatankerjasama/view/' . $item->dokumen_kegiatan) }}" class="btn btn-sm btn-primary">View</a>
                                    <a href="{{url('/kui/kegiatankerjasama/edit/'. $item->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ url('/kui/kegiatankerjasama/delete/'. $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <!-- <span> -->
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            Hapus
                                        </button>
                                        <!-- </span> -->

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