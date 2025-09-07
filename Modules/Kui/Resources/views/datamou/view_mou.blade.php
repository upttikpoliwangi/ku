@extends('adminlte::page')

@section('title', 'List Menu')

@section('plugins.Select2', true)

@section('content_header')


@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <!-- <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <h4>Data File MOU</h4> -->
                    <!-- @if (Auth::user()->role == 'admin')
                        <a href="{{ url('/kui/datamou/create') }}" class="btn btn-primary">Tambah File</a>
                        @endif -->
                    <!-- <a href="{{ url('/kui/datamou/create') }}" class="btn btn-primary">Tambah File</a>
                    </div> -->

                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Data File MOU</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ url('/kui/datamou/create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Tambah File
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="kerjasamaTable" class="table table-bordered table-striped">
                                <table id="example" class="table table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="60%">Nama File</th>
                                            <th width="40%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($file as $item)
                                        <tr>
                                            <th scope="row">{{ $file->firstItem() + $loop->index }}</th>
                                            <td>{{ $item->nama_file }}</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <a href="{{ url('/kui/datamou/edit/' . $item->id) }}" class="btn btn-sm btn-warning mr-2 mb-2">Edit</a>
                                                    <a href="{{ url('/kui/datamou/view/' . $item->id) }}" class="btn btn-sm btn-primary mr-2 mb-2">View</a>
                                                    {{-- Ganti link delete dengan form --}}
                                                    <form action="{{ url('/kui/datamou/delete/' . $item->id) }}" method="POST" style="display: inline; margin-right: 8px; margin-bottom: 8px;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                    <a href="{{ url('/kui/datamou/download/' . $item->id) }}" class="btn btn-success btn-sm mb-2">Download</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination pl-2 ml-4">
                                    {{ $file->links('pagination::bootstrap-4') }}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
@stop