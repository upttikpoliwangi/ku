@extends('adminlte::page')
@section('title', 'Kelola Profil PPID')
@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Form Kelola Profil PPID</h5>
                <form
                    action="{{ isset($kelola_profil) ? route('kelolaprofil.update', $kelola_profil->id) : route('kelolaprofil.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($kelola_profil))
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label for="nama_direktur" class="form-label">Nama Direktur</label>
                        <input type="text" name="nama_direktur" id="nama_direktur" class="form-control"
                            value="{{ old('nama_direktur', $kelola_profil->nama_direktur ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sambutan" class="form-label">Sambutan</label>
                        <textarea name="sambutan" id="sambutan" class="form-control" required>{{ old('sambutan', $kelola_profil->sambutan ?? '') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="media" class="form-label">Link Embed Media (Foto/Video)</label>
                        <input type="text" name="media" id="media" 
                               class="form-control @error('media') is-invalid @enderror"
                               placeholder="Contoh: https://www.youtube.com/embed/xxxx atau link gambar"
                               value="{{ old('media', $kelola_profil->media ?? '') }}">
                        @error('media')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if(isset($kelola_profil) && $kelola_profil->media)
                            <small class="form-text text-muted">Link saat ini: <a href="{{ $kelola_profil->media }}" target="_blank">Lihat Media</a></small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="ppid" class="form-label">PPID</label>
                        <textarea name="ppid" id="ppid" class="form-control">{{ old('ppid', $kelola_profil->ppid ?? '') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foto_organisasi" class="form-label">Link Embed Foto Organisasi</label>
                        <input type="text" name="foto_organisasi" id="foto_organisasi" 
                               class="form-control @error('foto_organisasi') is-invalid @enderror"
                               placeholder="Contoh: https://www.youtube.com/embed/xxxx atau link gambar"
                               value="{{ old('foto_organisasi', $kelola_profil->foto_organisasi ?? '') }}">
                        @error('foto_organisasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if(isset($kelola_profil) && $kelola_profil->foto_organisasi)
                            <small class="form-text text-muted">Link saat ini: <a href="{{ $kelola_profil->foto_organisasi }}" target="_blank">Lihat Foto</a></small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="tugas_fungsi" class="form-label">Tugas dan Fungsi</label>
                        <textarea name="tugas_fungsi" id="tugas_fungsi" class="form-control">{{ old('tugas_fungsi', $kelola_profil->tugas_fungsi ?? '') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="visi" class="form-label">Visi</label>
                        <textarea name="visi" id="visi" class="form-control">{{ old('visi', $kelola_profil->visi ?? '') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="misi" class="form-label">Misi</label>
                        <textarea name="misi" id="misi" class="form-control">{{ old('misi', $kelola_profil->misi ?? '') }}</textarea>
                    </div>
                    <button type="submit"
                        class="btn btn-primary">{{ isset($kelola_profil) ? 'Update' : 'Simpan' }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sambutan').summernote({
                placeholder: 'Tulis sambutan direktur...',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

        $(document).ready(function() {
            $('#ppid').summernote({
                placeholder: 'Tulis profil PPID...',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });


        $(document).ready(function() {
            $('#tugas_fungsi').summernote({
                placeholder: 'Tulis tugas & fungsi PPID...',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });


        $(document).ready(function() {
            $('#visi').summernote({
                placeholder: 'Tulis visi...',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

        $(document).ready(function() {
            $('#misi').summernote({
                placeholder: 'Tulis misi...',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endpush