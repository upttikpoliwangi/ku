@extends('adminlte::page')
@section('title', 'Detail Permohonan Informasi')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Detail Permohonan Informasi</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Nama Pemohon</th>
                    <td>{{ $permohonaninformasi->nama_pemohon }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $permohonaninformasi->nik }}</td>
                </tr>
                <tr>
                    <th>Alamat Pemohon</th>
                    <td>{{ $permohonaninformasi->alamat_pemohon }}</td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td>{{ $permohonaninformasi->nomor_telepon }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $permohonaninformasi->email }}</td>
                </tr>
                <tr>
                    <th>Jenis Permohonan</th>
                    <td>{{ $permohonaninformasi->jenisPermohonan->jenis_permohonan ?? 'Tidak Diketahui' }}</td>
                <tr>
                    <th>Informasi yang Dibutuhkan</th>
                    <td>{{ $permohonaninformasi->informasi_yang_dibutuhkan }}</td>
                </tr>
                <tr>
                    <th>Alasan Permohonan</th>
                    <td>{{ $permohonaninformasi->alasan_permohonan }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($permohonaninformasi->status) }}</td>
                </tr>
                <tr>
                    <th>File</th>
                    <td>
                        @if($permohonaninformasi->file)
                            <a href="{{ Storage::url($permohonaninformasi->file) }}" target="_blank">Lihat File</a>
                        @else
                            Tidak ada file yang diunggah.
                        @endif
                <tr>
                    <th>Catatan</th>
                    <td>{{ $permohonaninformasi->catatan ?? '-' }}</td>
                <tr>
                    <th>Tanggal Permohonan</th>
                    <td>{{ $permohonaninformasi->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            </table>
            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
