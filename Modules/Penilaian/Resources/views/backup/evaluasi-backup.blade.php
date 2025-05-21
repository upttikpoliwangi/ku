@extends('adminlte::page')

@section('title', 'Dasbor Simlitabmas')

@section('content_header')
    <h1 class="m-0 text-dark">Evaluasi SKP</h1>
@stop
@php
    $users = [
        [
            'id' => 1,
            'name' => 'Widura Sasangka',
            'jabatan' => 'Analis Kinerja',
            'status' => 'Belum Dievaluasi',
            'predikatKinerja' => '-',
        ],
        [
            'id' => 2,
            'name' => 'Hasta Sasangka',
            'jabatan' => 'Pimpinana',
            'status' => 'Belum Ajukan Realisasi',
            'predikatKinerja' => '-',
        ],
        [
            'id' => 3,
            'name' => 'Widura Hasta',
            'jabatan' => 'Pimpinana',
            'status' => 'Sudah Dievaluasi',
            'predikatKinerja' => '-',
        ],
    ];
@endphp
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Predikat Kinerja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user => $item)
                            @php
                                switch ($item['status']) {
                                    case 'Belum Dievaluasi':
                                        $badgeClass = 'badge-secondary';
                                        break;
                                    case 'Belum Ajukan Realisasi':
                                        $badgeClass = 'badge-danger';
                                        break;
                                    case 'Sudah Dievaluasi':
                                        $badgeClass = 'badge-success';
                                        break;
                                    default:
                                        $badgeClass = 'badge-secondary';
                                        break;
                                }
                            @endphp
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['jabatan'] }}</td>
                                    <td id="td-status">
                                        <span class="badge {{ $badgeClass }}">{{ $item['status'] }}</span>
                                    </td>
                                    <td>{{ $item['predikatKinerja'] }}</td>
                                    <td><button onclick="window.location.href='{{ url('skp/penilaian/evaluasi/' . $item['id'] . '/detail') }}'" type="button" class="btn btn-primary"><i class="nav-icon fas fa-pencil-alt "></i></button></td>
                                    {{-- <td><a href="{{ route('evaluasi-detail', $item['id']) }}" class="btn btn-primary"><i class="nav-icon fas fa-pencil-alt "></i></a></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
	 <!--some css
    <link rel="stylesheet" href="/assets/css/admin_custom.css">-->
@stop

@push('js')
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true,
            autoWidth: false
        });
    });

    // const tdStatus = document.querySelector('#td-status')
    // console.log(tdStatus.innerText)

    const colorStatus = (status) => {
        if(status == 'Belum Dievaluasi') {
            return `<span class="">${status}</span>`
        }else if (status == 'Belum Ajukan Realisasi') {
            return `<span class="badge badge-danger">${status}</span>`
        } else {
            return `<span class="badge badge-success">${status}</span>`
        }
    }
</script>
@endpush
