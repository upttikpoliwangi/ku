<!-- @extends('admin.layouts.app')
@section('content') -->
@extends('adminlte::page')
@section('title', 'List Menu')
@section('plugins.Select2', true)
@section('content_header')

@stop

    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Data Kerjasama</h4>
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
                            <form action="{{ url('/kui/kerjasama/store') }}" method="POST" enctype="multipart/form-data"
                                id="form-tambah">
                                @method('post')
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        @if (Auth::user()->role === 'admin')
                                            <div class="form-group">
                                                <label for="exampleInputmou1">Nomor Mou </label>
                                                <input type="text"
                                                    class="form-control @error('nomor_mou')
                                                is-invalid
                                            @enderror"
                                                    id="exampleInputmou1" name="nomor_mou" aria-describedby="mouHelp"
                                                    placeholder="Masukkan Nomor Mou " value="{{ old('nomor_mou') }}"
                                                    {{ Auth::user()->role !== 'admin' ? 'readonly' : '' }}>
                                                @error('nomor_mou')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="exampleInputmou1">Kriteria</label>
                                            <input type="text"
                                                class="form-control @error('kriteria')
                                                is-invalid
                                            @enderror"
                                                id="exampleInputmou1" name="kriteria" aria-describedby="mouHelp"
                                                placeholder="Masukkan Kriteria" value="{{ old('kriteria') }}">
                                            @error('kriteria')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputinstansi1">Email Instansi</label>
                                            <input type="text" name="email_instansi"
                                                class="form-control  @error('email_instansi')
                                                is-invalid
                                            @enderror"
                                                id="exampleInputinstansi1" aria-describedby="instansiHelp"
                                                placeholder="Masukkan Email Instansi" value="{{ old('email_instansi') }}">
                                            @error('email_instansi')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputinstansi1">Nama Instansi</label>
                                            <input type="text" name="nama_instansi"
                                                class="form-control  @error('nama_instansi')
                                                is-invalid
                                            @enderror"
                                                id="exampleInputinstansi1" aria-describedby="instansiHelp"
                                                placeholder="Masukkan Nama Instansi" value="{{ old('nama_instansi') }}">
                                            @error('nama_instansi')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputinstansi1">Alamat Instansi</label>
                                            <input type="text" name="alamat_instansi"
                                                class="form-control  @error('alamat_instansi')
                                                is-invalid
                                            @enderror"
                                                id="exampleInputinstansi1" aria-describedby="instansiHelp"
                                                placeholder="Masukkan Alamat Instansi"
                                                value="{{ old('alamat_instansi') }}">
                                            @error('alamat_instansi')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputinstansi1">Nama Contact Person</label>
                                            <input type="text" name="nama_contact_person"
                                                class="form-control  @error('nama_contact_person')
                                        is-invalid
                                        @enderror"
                                                id="exampleInputinstansi1" aria-describedby="instansiHelp"
                                                placeholder="Masukkan Nama Contact Person"
                                                value="{{ old('nama_contact_person') }}">
                                            @error('nama_contact_person')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputinstansi1">Contact Person</label>
                                            <input type="text" name="contact_person"
                                                class="form-control  @error('contact_person')
                                                is-invalid
                                            @enderror"
                                                id="exampleInputinstansi1" aria-describedby="instansiHelp"
                                                placeholder="Masukkan Contact Person" value="{{ old('contact_person') }}">
                                            @error('contact_person')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputkegiatan1">Jenis Kegiatan</label>
                                            <input type="text" name="jenis_kegiatan"
                                                class="form-control @error('jenis_kegiatan')
                                                is-invalid
                                            @enderror"
                                                id="exampleInputkegiatan1" aria-describedby="kegiatanHelp"
                                                placeholder="Masukkan Jenis Kegiatan" value="{{ old('jenis_kegiatan') }}">
                                            @error('jenis_kegiatan')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan">Masukkan Jurusan</label>
                                            <select
                                                class="form-control @error('jurusan')
                                                is-invalid
                                            @enderror jurusan"
                                                id="jurusan" name="jurusan[]">
                                                @foreach ($jurusan as $item)
                                                    <option value="{{ $item->id_jurusan }}">
                                                        {{ $item->nama_jurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('jurusan')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan">Masukkan Kategori</label>
                                            <select
                                                class="form-control @error('kategori')
                                                is-invalid
                                            @enderror kategori"
                                                id="kategori" name="kategori">
                                                <option value=""></option>
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item->id_kategori }}"
                                                        {{ old('kategori') == $item->id_kategori ? 'selected' : '' }}>
                                                        {{ $item->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kategori')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputmou1">File Mou</label>
                                            <input type="file"
                                                class="form-control @error('mou')
                                                is-invalid
                                            @enderror"
                                                name="mou" id="" value="{{ old('mou') }}">
                                            @error('mou')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="hard_file">Hard File</label>
                                            <select
                                                class="form-control @error('hard_file')
                                        is-invalid
                                            @enderror hard_file"
                                                id="hard_file" name="hard_file">
                                                <option value=""></option>

                                                <option value="0" selected>
                                                    Tidak Ada
                                                </option>
                                                <option value="1">
                                                    Ada
                                                </option>
                                            </select>
                                            @error('hard_file')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="exampleFormControldate1">Tanggal Mulai</label>
                                                    <input type="date" name="tgl_mulai"
                                                        class="form-control @error('tgl_mulai')
                                                    is-invalid
                                                    @enderror"
                                                        id="exampleFormControldate1" value="{{ old('tgl_mulai') }}">
                                                    @error('tgl_mulai')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <label for="exampleFormControldate2">Tanggal Berakhir</label>
                                                    <input type="date" name="tgl_berakhir"
                                                        class="form-control @error('tgl_berakhir')
                                                    is-invalid
                                                    @enderror"
                                                        id="exampleFormControldate2" value="{{ old('tgl_berakhir') }}">
                                                    @error('tgl_berakhir')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                        @if (Auth::user()->role === 'admin')
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select
                                                    class="form-control @error('hard_file')
                                        is-invalid
                                            @enderror hard_file"
                                                    aria-label="Default select example">
                                                    <option selected>Pilih Status</option>
                                                    <option value="0">Pending</option>
                                                    <option value="1">Diterima</option>
                                                    <option value="2">Ditolak</option>
                                                </select>
                                                @error('mou')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endif
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
