<div class="bg-white d-flex p-4">
    <table class="table" style="width: 100%;">
        <thead>
          <tr>
            <th style="width: 10%;" scope="col">No</th>
            <th style="width: 90%;" colspan="2">Pegawai yang dinilai</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th style="width: 10%;" scope="row">1</th>
            <td style="width: 20%;">Nama</td>
            <td style="width: 70%;">{{ $pegawai->nama }}</td>
          </tr>
          <tr>
            <th style="width: 10%;" scope="row">2</th>
            <td style="width: 20%;">NIP</td>
            <td style="width: 70%;">{{ $pegawai->nip }}</td>
          </tr>
          <tr>
            <th style="width: 10%;" scope="row">3</th>
            <td style="width: 20%;">Pangkat / Gol</td>
            <td style="width: 70%;">-</td>
          </tr>
          <tr>
            <th style="width: 10%;" scope="row">4</th>
            <td style="width: 20%;">Jabatan</td>
            <td style="width: 70%;">-</td>
          </tr>
          <tr>
            <th style="width: 10%;" scope="row">5</th>
            <td style="width: 20%;">Unit Kerja</td>
            <td style="max-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                {{ $pegawai->timKerjaAnggota[0]->unit->nama }}
            </td>
          </tr>
        </tbody>
    </table>
    <table class="table" style="width: 100%;">
        <thead>
          <tr>
            <th style="width: 10%;" scope="col">No</th>
            <th style="width: 90%;" colspan="2">Pejabat Penilai Kinerja</th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <th style="width: 10%;" scope="row">1</th>
              <td style="width: 20%;">Nama</td>
              <td style="width: 70%;">{{ optional($pegawai->timKerjaAnggota[0]->parentUnit?->ketua?->pegawai)->nama ?? '-' }}</td>
            </tr>
            <tr>
              <th style="width: 10%;" scope="row">2</th>
              <td style="width: 20%;">NIP</td>
              <td style="width: 70%;">{{ optional($pegawai->timKerjaAnggota[0]->parentUnit?->ketua?->pegawai)->nip ?? '-' }}</td>
            </tr>
            <tr>
              <th style="width: 10%;" scope="row">3</th>
              <td style="width: 20%;">Pangkat / Gol</td>
              <td style="width: 70%;">-</td>
            </tr>
            <tr>
              <th style="width: 10%;" scope="row">4</th>
              <td style="width: 20%;">Jabatan</td>
              <td style="width: 70%;">-</td>
            </tr>
            <tr>
                <th style="width: 10%;" scope="row">5</th>
                <td style="width: 20%;">Unit Kerja</td>
                <td style="max-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    {{ $pegawai->timKerjaAnggota[0]->parentUnit?->unit?->nama ?? '-' }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
