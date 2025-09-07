<!-- @extends('admin.layouts.app')
@section('content') -->
@extends('adminlte::page')
@section('title', 'Edit Panduan Kerjasama')
@section('plugins.Select2', true)
@section('content_header')
<h1 class="m-0 text-dark">Edit Data Kerjasama</h1>
@stop

    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Data Kerjasama</h4>
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
                            <form action="{{ url('/kui/kerjasama/update/' . $kerjasama->id_kerjasama) }}" method="POST"
                                enctype="multipart/form-data" id="form-tambah">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputmou1">Nomor Mou Poliwangi</label>
                                            <input type="hidden" name="nama_contact_person_old"
                                                value="{{ $kerjasama->nama_contact_person }}">
                                            <input type="hidden" name="file_mou" value="{{ $kerjasama->file_mou }}">
                                            <input value="{{ $kerjasama->nomor_mou }}" type="text"
                                                class="form-control @error('nomor_mou')
                                                is-invalid
                                            @enderror"
                                                id="exampleInputmou1" name="nomor_mou" aria-describedby="mouHelp"
                                                placeholder="Nomor Mou" value="{{ old('nomor_mou') }}">
                                            @error('nomor_mou')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputinstansi1">Kriteria</label>
                                            <input value="{{ $kerjasama->kriteria }}" type="text" name="kriteria"
                                                class="form-control  @error('kriteria')
                                                is-invalid
                                            @enderror"
                                                id="exampleInputinstansi1" aria-describedby="instansiHelp"
                                                placeholder="Masukkan Kriteria" value="{{ old('kriteria') }}">
                                            @error('kriteria')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputinstansi1">Email Instansi</label>
                                            <input value="{{ $kerjasama->email_instansi }}" type="text"
                                                name="email_instansi"
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
                                            <input value="{{ $kerjasama->nama_instansi }}" type="text"
                                                name="nama_instansi"
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
                                            <input value="{{ $kerjasama->alamat_instansi }}" type="text"
                                                name="alamat_instansi"
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
                                            <input value="{{ $kerjasama->nama_contact_person }}" type="text"
                                                name="nama_contact_person"
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
                                            <input value="{{ $kerjasama->contact_person }}" type="text"
                                                name="contact_person"
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
                                            <input value="{{ $kerjasama->jenis_kegiatan }}" type="text"
                                                name="jenis_kegiatan"
                                                class="form-control @error('jenis_kegiatan')
                                                is-invalid
                                            @enderror"
                                                id="exampleInputkegiatan1" aria-describedby="kegiatanHelp"
                                                placeholder="Jenis Kegiatan" value="{{ old('jenis_kegiatan') }}">
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
                                                id="jurusan" name="jurusan[]" multiple="multiple">
                                                @foreach ($jurusan as $item)
                                                    <option value="{{ $item->id_jurusan }}"
                                                        {{ old('jurusan', $item->id_jurusan) == in_array($item->id_jurusan, $selectedjurusan) ? 'selected' : '' }}>
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
                                                        {{ $kerjasama->id_kategori == $item->id_kategori ? 'selected' : '' }}>
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
                                                <option value="0" {{ $kerjasama->hard_file == 0 ? 'selected' : '' }}>
                                                    Tidak Ada
                                                </option>
                                                <option value="1" {{ $kerjasama->hard_file == 1 ? 'selected' : '' }}>
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
                                                    <input value="{{ $kerjasama->tgl_mulai }}" type="date"
                                                        name="tgl_mulai"
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
                                                    <input value="{{ $kerjasama->tgl_berakhir }}" type="date"
                                                        name="tgl_berakhir"
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
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control @error('status') is-invalid @enderror"
                                                name="status">
                                                @if ($kerjasama->status == 0)
                                                    <option value="0" selected>Pending</option>
                                                    <option value="1">Diterima</option>
                                                    <option value="2">Ditolak</option>
                                                @else
                                                    <option value="0">Pending</option>
                                                    <option value="1" selected>Diterima</option>
                                                    <option value="2" selected>Ditolak</option>
                                                @endif
                                            </select>
                                            @error('mou')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>                                      
                                    </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="exampleInputInstansi1">Catatan</label>
                                        <input 
                                            value="{{ old('catatan', $kerjasama->catatan) }}" 
                                            type="text"
                                            name="catatan"
                                            class="form-control @error('catatan') is-invalid @enderror"
                                            id="exampleInputInstansi1" 
                                            aria-describedby="instansiHelp"
                                            placeholder="Masukkan Catatan">
                                        @error('catatan')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
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
