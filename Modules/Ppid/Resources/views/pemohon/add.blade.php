@extends('adminlte::page')
@section('title', 'Tambah Permohonan Informasi')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>Tambah Permohonan Informasi</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('permohonaninformasi.store') }}" method="POST">
                @csrf
                {{-- Nama Pemohon & Nomor Telepon --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Pemohon</label>
                        <input type="text"
                               name="nama_pemohon"
                               class="form-control @error('nama_pemohon') is-invalid @enderror"
                               value="{{ old('nama_pemohon', $permohonaninformasi->nama_pemohon ?? '') }}">
                        @error('nama_pemohon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nomor Telepon</label>
                        <input type="text"
                               name="nomor_telepon"
                               class="form-control @error('nomor_telepon') is-invalid @enderror"
                               value="{{ old('nomor_telepon', $permohonaninformasi->nomor_telepon ?? '') }}">
                        @error('nomor_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- NIK & Email --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>NIK</label>
                        <input type="text"
                               name="nik"
                               class="form-control @error('nik') is-invalid @enderror"
                               value="{{ old('nik', $permohonaninformasi->nik ?? '') }}">
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $permohonaninformasi->email ?? '') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Alamat Pemohon & Jenis Permohonan --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Permohonan</label>
                    <select name="jenis_permohonan_id" class="form-control select2" required>
                        <option value="">-- Pilih Jenis Permohonan --</option>
                        @foreach($jenis_permohonan as $jenis)
                            <option value="{{ $jenis->id }}" 
                                {{ (old('jenis_permohonan_id', $permohonaninformasi->jenis_permohonan_id ?? '') == $jenis->id) ? 'selected' : '' }}>
                                {{ $jenis->jenis_permohonan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Pemohon</label>
                    <textarea name="alamat_pemohon" class="form-control" rows="2" placeholder="Masukkan alamat lengkap" required>{{ old('alamat_pemohon', $permohonaninformasi->alamat_pemohon ?? '') }}</textarea>
                </div>

                {{-- Informasi yang Dibutuhkan --}}
                <div class="mb-3">
                    <label>Informasi yang Dibutuhkan</label>
                    <textarea name="informasi_yang_dibutuhkan"
                              class="form-control @error('informasi_yang_dibutuhkan') is-invalid @enderror"
                              rows="3">{{ old('informasi_yang_dibutuhkan', $permohonaninformasi->informasi_yang_dibutuhkan ?? '') }}</textarea>
                    @error('informasi_yang_dibutuhkan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Alasan Permohonan --}}
                <div class="mb-3">
                    <label>Alasan Permohonan</label>
                    <textarea name="alasan_permohonan"
                              class="form-control @error('alasan_permohonan') is-invalid @enderror"
                              rows="3">{{ old('alasan_permohonan', $permohonaninformasi->alasan_permohonan ?? '') }}</textarea>
                    @error('alasan_permohonan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('permohonaninformasi.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection