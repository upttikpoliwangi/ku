<!-- resources/views/pdf/export.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kerjasama->nama_instansi }}</title>
    <!-- Tambahkan link CSS jika diperlukan -->
    @stack('css')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .main-content {
            margin-top: 20px;
            padding: 20px;
        }

        .card {
            border: 1px solid #e1e5eb;
            border-radius: 0.375rem;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e1e5eb;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            background-color: #ffffff;
            color: #495057;
        }

        textarea {
            resize: vertical;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #dc3545;
            color: #ffffff;
        }

        .btn:hover {
            background-color: #c82333;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #e1e5eb;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header"
                            style="display: flex; justify-content: space-between; align-items: center;">
                            <h4>Data Kerjasama - {{ $kerjasama->nama_instansi }}</h4>
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
                            <table class="table">
                                <tr>
                                    <th>Nomor Mou Poliwangi</th>
                                    <td>{{ $kerjasama->nomor_mou }}</td>
                                </tr>
                                <tr>
                                    <th>Kriteria</th>
                                    <td>{{ $kerjasama->kriteria }}</td>
                                </tr>
                                <tr>
                                    <th>Email Instansi</th>
                                    <td>{{ $kerjasama->email_instansi }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Instansi</th>
                                    <td>{{ $kerjasama->nama_instansi }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Instansi</th>
                                    <td>{{ $kerjasama->alamat_instansi }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Contact Person</th>
                                    <td>{{ $kerjasama->nama_contact_person }}</td>
                                </tr>
                                <tr>
                                    <th>Contact Person</th>
                                    <td>{{ $kerjasama->contact_person }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kegiatan</th>
                                    <td>{{ $kerjasama->jenis_kegiatan }}</td>
                                </tr>
                                <tr>
                                    <th>Prodi</th>
                                    <td>
                                        @foreach ($kerjasama->prodi as $prodi)
                                            {{ $prodi->nama_prodi }}
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>{{ $kerjasama->kategori->nama_kategori }}</td>
                                </tr>
                                <tr>
                                    <th>Hard File</th>
                                    <td>{{ $kerjasama->hard_file == 1 ? 'Ada' : 'Tidak Ada' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Mulai</th>
                                    <td>{{ $kerjasama->tgl_mulai }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Berakhir</th>
                                    <td>{{ $kerjasama->tgl_berakhir }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Tambahkan script JavaScript jika diperlukan -->
    @push('js')
        <!-- Tambahkan script JavaScript jika diperlukan -->
    @endpush
</body>

</html>
