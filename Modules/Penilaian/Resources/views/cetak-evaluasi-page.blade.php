<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Evaluasi Kinerja Pegawai</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            margin-top: {{ $margin_top ?? '0mm' }};
            margin-bottom: {{ $margin_bottom ?? '0mm' }};
            margin-left: {{ $margin_left ?? '0mm' }};
            margin-right: {{ $margin_right ?? '0mm' }};
        }
        body {
            font-size: 10px;
        }
        #table-evaluasi th, #table-evaluasi td {
            vertical-align: top;
            border: 0.5px solid rgb(113, 113, 113);
            border-collapse: collapse;
        }
        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 20px;
        }

        .width {
            width: 910px;
            margin: auto;
        }
        @media print {
            .width {
                width: auto;
                margin: auto;
            }
            .button-cetak {
                display: none;
            }

            body {
            font-size: 10px;
            }
            #table-evaluasi th, #table-evaluasi td {
                vertical-align: top;
                border: 0.5px solid rgb(113, 113, 113);
                border-collapse: collapse;
            }
            .section-title {
                font-weight: bold;
                text-transform: uppercase;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <div
    {{-- class="width" --}}
    >
        {{-- <button onclick="printPage()" class="button-cetak">Test cetak</button> --}}
        <div class="text-center mb-4">
            <h6>EVALUASI KINERJA PEGAWAI</h6>
            <p class="mb-0">PENDEKATAN HASIL KERJA KUANTITATIF <br> BAGI PEJABAT FUNGSIONAL PRANATA HUBUNGAN MASYARAKAT</p>
            <p class="mb-0"><strong>PERIODE: JANUARI–DESEMBER 2023</strong></p>
        </div>

        <table id="table-evaluasi" class="mb-2" cellspacing="0" cellpadding="5" width="100%" style="font-size: 10px;">
            <thead style="background-color: #f2f2f2;">
                <tr>
                    <th colspan="1" style="width: 4%">No</th>
                    <th colspan="2" style="width: 46%">Pegawai yang Dinilai</th>
                    <th colspan="1" style="width: 4%">No</th>
                    <th colspan="2" style="width: 46%">Pejabat Penilai Kinerja</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td><td style="width: 5%">Nama</td><td>{{ $pegawai->nama }}</td>
                    <td>1.</td><td style="width: 5%">Nama</td><td>{{ optional($pegawai->timKerjaAnggota[0]->parentUnit?->ketua?->pegawai)->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td>2.</td><td>NIP</td><td>{{ $pegawai->nip }}</td>
                    <td>2.</td><td>NIP</td><td>{{ optional($pegawai->timKerjaAnggota[0]->parentUnit?->ketua?->pegawai)->nip ?? '-' }}</td>
                </tr>
                <tr>
                    <td>3.</td><td>Pangkat/Gol</td><td>-</td>
                    <td>3.</td><td>Pangkat/Gol</td><td>-</td>
                </tr>
                <tr>
                    <td>4.</td><td>Jabatan</td><td>-</td>
                    <td>4.</td><td>Jabatan</td><td>-</td>
                </tr>
                <tr>
                    <td>5.</td><td>Unit Kerja</td><td>{{ $pegawai->timKerjaAnggota[0]->unit->nama }}</td>
                    <td>5.</td><td>Unit Kerja</td><td>{{ $pegawai->timKerjaAnggota[0]->parentUnit?->unit?->nama ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <table id="table-evaluasi" class="mb-2" cellspacing="0" cellpadding="5" width="100%" style="font-size: 10px;">
            <thead>
                <tr>
                    <th style="background-color: #f2f2f2;">CAPAIAN KINERJA ORGANISASI : ISTIMEWA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td  style="background-color: #f2f2f2;">
                        <p>POLA DISTRIBUSI :</p>
                        <div class="">
                            No Data
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table id="table-evaluasi" class="mb-2" cellspacing="0" cellpadding="5" width="100%" style="font-size: 10px;">
            <thead>
                <tr>
                    <tr>
                        <th colspan="2" style="width: 50%; background-color: #f2f2f2; text-align: left;">HASIL KERJA</th>
                        <th rowspan="2" class="text-center align-middle" style="width: 25%; background-color: #f2f2f2;">Realisasi Berdasarkan Bukti Dukung</th>
                        <th rowspan="2" class="text-center align-middle" style="width: 25%; background-color: #f2f2f2;">Umpan Balik Berkelanjutan Berdasarkan Bukti Dukung</th>
                    </tr>
                    <tr>
                        <th colspan="2" style="width: 50%; background-color: #f2f2f2; text-align: left;">A. Utama</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td style="width: 3%;">1</td>
                <td style="vertical-align: top;">
                  <strong>Manual book penggunaan aplikasi modul penyusunan SKP yang lengkap dan informatif</strong>
                  <br>(Penugasan dari Ketua Tim Perencanaan dan Sistem Informasi)
                  <br><br>
                  <strong>Ukuran keberhasilan / Indikator Kinerja Individu, dan Target:</strong>
                  <ul style="margin: 0; padding-left: 15px;">
                    <li>Draft manual book penggunaan aplikasi modul penyusunan rencana SKP yang lengkap sesuai dengan ketentuan dan diselesaikan maksimal satu bulan sebelum kegiatan sosialisasi</li>
                  </ul>
                </td>
                <td style="vertical-align: top;">
                  Draft manual book aplikasi untuk modul penyusunan rencana SKP telah selesai pada bulan April sesuai dengan proses bisnis aplikasi.
                </td>
                <td style="vertical-align: top;">
                  Baik dan tidak ada kesalahan
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top;">2.</td>
                <td style="vertical-align: top;">
                  <strong>Manual book penggunaan aplikasi modul penyusunan SKP yang lengkap dan informatif</strong>
                  <br>(Penugasan dari Ketua Tim Perencanaan dan Sistem Informasi)
                  <br><br>
                  <strong>Ukuran keberhasilan / Indikator Kinerja Individu, dan Target:</strong>
                  <ul style="margin: 0; padding-left: 15px;">
                    <li>Draft manual book penggunaan aplikasi modul penyusunan rencana SKP yang lengkap sesuai dengan ketentuan dan diselesaikan maksimal satu bulan sebelum kegiatan sosialisasi</li>
                  </ul>
                </td>
                <td style="vertical-align: top;">
                  Draft manual book aplikasi untuk modul penyusunan rencana SKP telah selesai pada bulan April sesuai dengan proses bisnis aplikasi.
                </td>
                <td style="vertical-align: top;">
                  Baik dan tidak ada kesalahan
                </td>
              </tr>
            </tbody>
        </table>

        <table id="table-evaluasi" class="mb-2" cellspacing="0" cellpadding="5" width="100%" style="font-size: 10px;">
            <tbody>
                <tr>
                    <td style="width: 50%; background-color: #f2f2f2;">RATING HASIL KERJA</td>
                    <td style="width: 50%; background-color: #f2f2f2;">SESUAI EKSPEKTASI</td>
                </tr>
            </tbody>
        </table>

        <p class="mb-2"><em>Dokumen milik ELI NURMALINDA (NIP 198607292020122002)</em></p>

        <table id="table-evaluasi" class="mb-2" cellspacing="0" cellpadding="5" width="100%" style="font-size: 10px;">
            <thead>
                <tr>
                    <th colspan="3" style="background-color: #f2f2f2; width: 75%;">PERILAKU KERJA</th>
                    <th colspan="1" style="background-color: #f2f2f2; width: 25%;" class="text-center">Umpan Balik Berkelanjutan Berdasarkan Bukti Dukung</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 3%;">10</td>
                    <td style="width: 47%;">Orientasi Pelayanan</td>
                    <td style="width: 25%;" class="text-center">Ekspektasi Khusus Pimpinan</td>
                    <td style="width: 25%;" class="text-center">Sangat Baik</td>
                </tr>
                <tr>
                    <td style="width: 3%;">10</td>
                    <td style="width: 47%;">Orientasi Pelayanan</td>
                    <td style="width: 25%;" class="text-center">Ekspektasi Khusus Pimpinan</td>
                    <td style="width: 25%;" class="text-center">Sangat Baik</td>
                </tr>
                <tr>
                    <td style="width: 3%;">10</td>
                    <td style="width: 47%;">Orientasi Pelayanan</td>
                    <td style="width: 25%;" class="text-center">Ekspektasi Khusus Pimpinan</td>
                    <td style="width: 25%;" class="text-center">Sangat Baik</td>
                </tr>
                <!-- Tambah baris lainnya sesuai kebutuhan -->
            </tbody>
        </table>

        <table id="table-evaluasi" class="mb-2" cellspacing="0" cellpadding="5" width="100%" style="font-size: 10px;">
            <tbody>
                <tr>
                    <td style="width:50%; background-color: #f2f2f2;">RATING PERILAKU</td>
                    <td style="width:50%; background-color: #f2f2f2;">{{ $pegawai->rencanakerja[0]->rating_perilaku }}</td>
                </tr>
                <tr>
                    <td style="width:50%; background-color: #f2f2f2;">PREDIKAT KINERJA PEGAWAI</td>
                    <td style="width:50%; background-color: #f2f2f2;">{{ $pegawai->rencanakerja[0]->predikat_akhir }}</td>
                </tr>
            </tbody>
        </table>

        <p class="mb-4"><em>Dokumen milik {{ $pegawai->nama }} (NIP {{ $pegawai->nip }})</em></p>

        <table cellspacing="0" width="100%" style="font-size: 10px;">
            <tbody>
                <tr>
                    <td style="width:50%; text-align: center;"></td>
                    <td style="width:50%; text-align: center;">{{ $print_date ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="width:50%; text-align: center;"></td>
                    <td style="width:50%; text-align: center;">Pejabat Penilai Kinerja</td>
                </tr>
                <tr>
                    <td style="height:100px; text-align: center;"></td>
                    <td style="height:100px; text-align: center;"></td>
                </tr>
                <tr>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">{{ optional($pegawai->timKerjaAnggota[0]->parentUnit?->ketua?->pegawai)->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">{{ optional($pegawai->timKerjaAnggota[0]->parentUnit?->ketua?->pegawai)->nip ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
<script>
    function printPage() {
        window.print();
    }
</script>
</html>
