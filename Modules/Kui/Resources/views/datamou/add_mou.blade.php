@extends('adminlte::page')
@section('title', 'List Menu')
@section('plugins.Select2', true)
@section('content_header')

@stop
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Data File MOU</h4>
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
                            <form action="{{ url('/kui/datamou/store') }}" method="POST" enctype="multipart/form-data"
                                id="form-tambah" class="needs-validation" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nama_file">Nama File</label>
                                            <input type="text"
                                                class="form-control @error('nama_file') is-invalid @enderror"
                                                id="nama_file" name="nama_file" aria-describedby="mouHelp"
                                                placeholder="Masukkan Nama File" value="{{ old('nama_file') }}" required>
                                            <div class="invalid-feedback">
                                                Harap isi nama file
                                            </div>
                                            @error('nama_file')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="file_mou">File MOU (PDF)</label>
                                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                                id="file_mou" name="file" accept=".pdf" required>
                                            <div class="invalid-feedback">
                                                Harap pilih file PDF
                                            </div>
                                            <small class="form-text text-muted">
                                                Hanya file dengan format PDF yang diterima
                                            </small>
                                            @error('file')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="button-tambah" class="btn btn-primary" style="float: right">
                                    <i class="fas fa-save"></i> Simpan Data
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            /* Gaya untuk validasi form */
            .was-validated .form-control:invalid, 
            .form-control.is-invalid {
                border-color: #dc3545;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right calc(0.375em + 0.1875rem) center;
                background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
            }
            
            .invalid-feedback {
                display: none;
                color: #dc3545;
            }
            
            .was-validated .form-control:invalid ~ .invalid-feedback,
            .form-control.is-invalid ~ .invalid-feedback {
                display: block;
            }
        </style>
    @endpush
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                // Inisialisasi Select2
                $('#jurusan').select2({
                    tags: true,
                    placeholder: "Pilih Program Studi",
                });
                
                $('#kategori').select2({
                    tags: true,
                    placeholder: "Pilih Kategori"
                });
                
                // Validasi form sebelum menampilkan konfirmasi
                $('#button-tambah').on("click", function(e) {
                    e.preventDefault();
                    var form = $('#form-tambah');
                    
                    // Tambah kelas validasi
                    form.addClass('was-validated');
                    
                    // Cek validitas form
                    if (form[0].checkValidity()) {
                        // Jika form valid, tampilkan konfirmasi
                        Swal.fire({
                            icon: 'question',
                            title: 'Konfirmasi',
                            text: 'Apakah Anda yakin ingin menyimpan data ini?',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, Simpan',
                            cancelButtonText: 'Batal',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    } else {
                        // Jika form tidak valid, scroll ke field yang error
                        $('html, body').animate({
                            scrollTop: $(".is-invalid").first().offset().top - 100
                        }, 500);
                    }
                });
                
                // Validasi file PDF
                $('#file_mou').on('change', function() {
                    const file = this.files[0];
                    const fileInput = $(this);
                    
                    if (file) {
                        // Cek ekstensi file
                        if (file.type !== 'application/pdf') {
                            fileInput.addClass('is-invalid');
                            fileInput.next('.invalid-feedback').text('Hanya file PDF yang diperbolehkan');
                        } else {
                            fileInput.removeClass('is-invalid');
                        }
                    }
                });
                
                // Reset validasi saat user mulai mengisi
                $('input').on('input', function() {
                    if ($(this).val()) {
                        $(this).removeClass('is-invalid');
                    }
                });
            });
        </script>
    @endpush
@endsection