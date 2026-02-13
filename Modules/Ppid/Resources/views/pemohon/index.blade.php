@extends('adminlte::page')
@section('title', 'Permohonan Informasi')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Daftar Permohonan Informasi</h5>

            {{-- Tombol tambah permohonan hanya muncul untuk user bukan admin --}}
            @if(Auth::user()->role_aktif == 'masyarakat')
                <a href="{{ route('permohonaninformasi.create') }}" class="btn btn-primary mb-3">Ajukan Permohonan</a>
            @endif

            {{-- Form Pencarian --}}
            <form method="GET" action="{{ route('permohonaninformasi.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="nama_pemohon" class="form-control" 
                               placeholder="Cari Nama Pemohon" value="{{ request('nama_pemohon') }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-primary w-100">Cari</button>
                    </div>
                    <div class="col-md-2 mb-2">
                        <a href="{{ route('permohonaninformasi.index') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </div>
            </form>

            {{-- Tabel data --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 50px; text-align: center;">No</th>
                            <th>Nama Pemohon</th>
                            <th>NIK</th>
                            <th>Alamat Pemohon</th>
                            <th>Nomor Telepon</th>
                            <th>Email</th>
                            <th>Jenis Permohonan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permohonaninformasi as $index => $item)
                        <tr>
                            <td class="text-center">{{ $permohonaninformasi->firstItem() + $index }}</td>
                            <td>{{ $item->nama_pemohon }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->alamat_pemohon }}</td>
                            <td>{{ $item->nomor_telepon }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->jenisPermohonan->jenis_permohonan ?? 'Tidak Diketahui' }}</td>
                            <td>
                                @if($item->status == 'menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($item->status == 'diproses')
                                    <span class="badge bg-primary">Diproses</span>
                                @elseif($item->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @elseif($item->status == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('permohonaninformasi.show', $item->id) }}"
                                       class="btn btn-primary btn-sm me-1">Detail</a>
                                @if(Auth::user()->role_aktif == 'admin')
                                    <a href="{{ route('permohonaninformasi.edit', $item->id) }}" 
                                       class="btn btn-warning btn-sm me-1">Edit</a>
                                @endif
                                    {{-- Hapus jika dibutuhkan --}}
                                    {{-- <form action="{{ route('permohonaninformasi.destroy', $item->id) }}" 
                                          method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-3">Data belum tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $permohonaninformasi->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection