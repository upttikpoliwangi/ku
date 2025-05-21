@extends('adminlte::page')

@section('title', 'Dasbor Simlitabmas')

@section('content_header')
    <h1 class="m-0 text-dark">Tim Kerja</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="bg-white p-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#timKerjaModal">
                        Buat Tim Kerja
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="timKerjaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="POST" action="{{ url('penilaian/tim-kerja/store') }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Tim Kerja</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset>
                                          <div class="form-group">
                                            <label for="parent_tim_kerja_id">Parent Tim Kerja</label>
                                            <select class="custom-select my-1 mr-sm-2" id="parent_tim_kerja_id" name="parent_tim_kerja_id">
                                                <option>Choose...</option>
                                                @foreach ($timKerja as $item)
                                                    <option value="{{ $item->tim_kerja_id }}">{{ $item->nama_tim_kerja }}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                          <div class="form-group">
                                            <label for="nama_tim_kerja">Nama Tim Kerja</label>
                                            <input name="nama_tim_kerja" type="text" id="nama_tim_kerja" class="form-control" placeholder="Nama Tim Kerja">
                                          </div>
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Tim Kerja</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($timKerja as $item)
                                <tr>
                                    <td>{{ $item->nama_tim_kerja }}</td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#anggotaModal">Tambah Anggota</button>
                                        <div class="modal fade" id="anggotaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ url('penilaian/tim-kerja/store') }}">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                              <div class="form-group">
                                                                <label for="parent_tim_kerja_id">Tim Kerja</label>
                                                                <select class="custom-select my-1 mr-sm-2" id="parent_tim_kerja_id" name="parent_tim_kerja_id">
                                                                    <option>Choose...</option>
                                                                    @foreach ($timKerja as $item)
                                                                        <option value="{{ $item->tim_kerja_id }}">{{ $item->nama_tim_kerja }}</option>
                                                                    @endforeach
                                                                </select>
                                                              </div>
                                                              <div class="form-group">
                                                                <label for="nama_tim_kerja">Anggota</label>
                                                                <select class="custom-select my-1 mr-sm-2" id="parent_tim_kerja_id" name="parent_tim_kerja_id">
                                                                    <option>Choose...</option>
                                                                    @foreach ($timKerja as $item)
                                                                        <option value="{{ $item->tim_kerja_id }}">{{ $item->nama_tim_kerja }}</option>
                                                                    @endforeach
                                                                </select>
                                                              </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    textarea {
        border-color: #ced4da;
    }
    textarea:focus {
        outline: none !important;
        box-shadow: none !important;
    }
</style>
@stop

@push('js')
@endpush
