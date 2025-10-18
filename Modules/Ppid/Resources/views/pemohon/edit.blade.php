@extends('adminlte::page')
@section('title', 'Edit Permohonan Informasi')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Permohonan Informasi</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('permohonaninformasi.update', $permohonaninformasi->id) }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Pemohon</label>
                        <input type="text" name="nama_pemohon" class="form-control" 
                            placeholder="Masukkan nama lengkap" 
                            value="{{ old('nama_pemohon', $permohonaninformasi->nama_pemohon ?? '') }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control" 
                            placeholder="Masukkan NIK" 
                            value="{{ old('nik', $permohonaninformasi->nik ?? '') }}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" class="form-control" 
                            placeholder="Masukkan nomor telepon" 
                            value="{{ old('nomor_telepon', $permohonaninformasi->nomor_telepon ?? '') }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" 
                            placeholder="Masukkan email aktif" 
                            value="{{ old('email', $permohonaninformasi->email ?? '') }}" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Permohonan</label>
                    <select class="form-control select2" disabled>
                    <option value="">-- Pilih Jenis Permohonan --</option>
                    @foreach($jenis_permohonan as $jenis)
                        <option value="{{ $jenis->id }}" 
                            {{ (old('jenis_permohonan_id', $permohonaninformasi->jenis_permohonan_id ?? '') == $jenis->id) ? 'selected' : '' }}>
                            {{ $jenis->jenis_permohonan }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="jenis_permohonan_id" value="{{ $permohonaninformasi->jenis_permohonan_id }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Pemohon</label>
                    <textarea name="alamat_pemohon" class="form-control" rows="2" placeholder="Masukkan alamat lengkap" readonly>{{ old('alamat_pemohon', $permohonaninformasi->alamat_pemohon ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Informasi yang Dibutuhkan</label>
                    <textarea name="informasi_yang_dibutuhkan" class="form-control" rows="3" 
                        placeholder="Tuliskan informasi yang dibutuhkan" readonly>{{ old('informasi_yang_dibutuhkan', $permohonaninformasi->informasi_yang_dibutuhkan ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alasan Permohonan</label>
                    <textarea name="alasan_permohonan" class="form-control" rows="3" 
                        placeholder="Tuliskan alasan permohonan" readonly>{{ old('alasan_permohonan', $permohonaninformasi->alasan_permohonan ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="diproses" {{ $permohonaninformasi->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="disetujui" {{ $permohonaninformasi->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ $permohonaninformasi->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload File (PDF/Excel)</label>
                    <input type="file" name="file" id="file" class="form-control" accept=".pdf,.xls,.xlsx">
                    @if($permohonaninformasi->file)
                        <small class="text-muted">
                            File saat ini: <a href="{{ asset('storage/' . $permohonaninformasi->file) }}" target="_blank">Lihat File</a>
                        </small>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control" rows="2" placeholder="Catatan tambahan (opsional)">
                        {{ old('catatan', $permohonaninformasi->catatan ?? '') }}
                    </textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('permohonaninformasi.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

{{-- Script untuk handle disable input berdasarkan status --}}
@section('js')
<script>
    function toggleFields() {
        const status = document.getElementById('status').value;
        const fileInput = document.getElementById('file');
        const catatanInput = document.getElementById('catatan');

        // reset semua
        fileInput.disabled = false;
        catatanInput.disabled = false;

        if (status === 'disetujui') {
            catatanInput.disabled = true;
        } else if (status === 'ditolak') {
            fileInput.disabled = true;
        } else if (status === 'diproses') {
            fileInput.disabled = true;
            catatanInput.disabled = true;
        }
    }

    document.getElementById('status').addEventListener('change', toggleFields);

    // jalankan saat load pertama kali (biar sesuai status existing)
    window.addEventListener('DOMContentLoaded', toggleFields);
</script>
@endsection
@endsection
