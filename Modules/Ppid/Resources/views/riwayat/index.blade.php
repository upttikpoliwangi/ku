@extends('adminlte::page')

@section('title', 'Riwayat Permohonan')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-0">Riwayat Permohonan</h5>
            @if(Auth::user()->role == 'admin')
                <div>
                    <a href="{{ route('riwayat.cetak.pdf') }}" class="btn btn-danger btn-sm me-2">
                        <i class="fas fa-file-pdf"></i> Cetak PDF
                    </a>
                    <a href="{{ route('riwayat.cetak.excel') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel"></i> Cetak Excel
                    </a>
                </div>
            @endif
        </div>

        <div class="card-body">
            @if($riwayat->isEmpty())
                <p class="text-center text-muted">Belum ada riwayat permohonan.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Permohonan</th>
                                <th>Nama Pemohon</th>
                                <th>Jenis Permohonan</th>
                                <th>Informasi Dibutuhkan</th>
                                <th>Status</th>
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_permohonan)->format('d M Y') }}</td>
                                    <td>{{ $item->nama_pemohon }}</td>
                                    <td>{{ $item->jenisPermohonan->jenis_permohonan ?? '-' }}</td>
                                    <td>{{ $item->informasi_dibutuhkan }}</td>
                                    <td class="text-center">
                                        @if($item->status == 'diproses')
                                            <span class="badge bg-warning text-dark">Diproses</span>
                                        @elseif($item->status == 'ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @elseif($item->status == 'disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                        @endif
                                    </td>
                                    {{-- @if(Auth::user()->role == 'admin')
                                        <td class="text-center">
                                            <a href="{{ route('riwayat.show', $item->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            <a href="{{ route('riwayat.delete', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus riwayat ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td> --}}
                                    {{-- @endif --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection