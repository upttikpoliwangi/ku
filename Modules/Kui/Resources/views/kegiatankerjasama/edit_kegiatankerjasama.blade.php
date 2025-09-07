@extends('adminlte::page')
@section('title', 'Edit Kegiatan Kerjasama')
@section('plugins.Select2', true)
@section('content_header')
<h1 class="m-0 text-dark">Edit Kegiatan Kerjasama</h1>
@stop

<?php
if (!function_exists('format_rupiah')) {
    function format_rupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}
?>

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-black">
            <h3 class="mb-0">Form Edit Kegiatan</h3>
        </div>

        <div class="card-body">
            <form action="{{ url('/kui/kegiatankerjasama/update', $allDatakegiatankerjasama->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" value="{{ $nama_jurusan ?? '-' }}" readonly disabled>
                            <input type="hidden" name="id_jurusan" value="{{ $allDatakegiatankerjasama->id_jurusan }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                            <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                                value="{{ old('nama_kegiatan', $allDatakegiatankerjasama->nama_kegiatan) }}" required>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                            <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan"
                                value="{{ old('tanggal_kegiatan', $allDatakegiatankerjasama->tanggal_kegiatan) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="biaya_kegiatan">Biaya Kegiatan</label>
                            <input type="text" class="form-control currency-input" id="biaya_kegiatan" name="biaya_kegiatan"
                                value="{{ format_rupiah($allDatakegiatankerjasama->biaya_kegiatan) }}" required>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dokumen_kegiatan">Dokumen Kegiatan (PDF)</label>
                            <input type="file" class="form-control-file" id="dokumen_kegiatan" name="dokumen_kegiatan" accept=".pdf">
                            @if($allDatakegiatankerjasama->dokumen_kegiatan)
                            <small class="form-text text-muted">
                                Dokumen saat ini: {{ $allDatakegiatankerjasama->dokumen_kegiatan }}
                            </small>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="foto_kegiatan">Foto Kegiatan (JPG/PNG)</label>
                            <input type="file" class="form-control-file" id="foto_kegiatan" name="foto_kegiatan" accept="image/*">
                            @if($allDatakegiatankerjasama->foto_kegiatan)
                            <small class="form-text text-muted">
                                Foto saat ini: {{ $allDatakegiatankerjasama->foto_kegiatan }}
                            </small>
                            @endif
                        </div>
                    </div>

        </div>

        <div class="form-group text-right mt-6">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
    </div>
</div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
@stop

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    $(document).ready(function() {});
</script>
<script>
    $(document).ready(function() {
        // Format input biaya kegiatan
        $('.currency-input').on('keyup', function() {
            let value = $(this).val().replace(/[^\d]/g, '');
            $(this).val(formatRupiah(value));
        });

        // Saat form disubmit, bersihkan format Rupiah
        $('form').on('submit', function() {
            let biaya = $('#biaya_kegiatan').val();
            biaya = biaya.replace(/[^\d]/g, '');
            $('#biaya_kegiatan').val(biaya);
        });

        function formatRupiah(angka) {
            if (!angka) return '';
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    });
</script>
@endpush