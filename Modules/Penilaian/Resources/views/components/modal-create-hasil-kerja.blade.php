<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hasilKerjaModal">
    <i class="nav-icon fas fa-plus "></i>
</button>
<div class="modal fade" id="hasilKerjaModal" tabindex="-1" role="dialog" aria-labelledby="hasilKerjaModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content" action="{{ url('/penilaian/rencana/store-hasil-kerja/' . (is_null($rencana) ? '' : $rencana->id)) }}">
            @csrf
            <div class="modal-header">Tambah Hasil Kerja Utama</div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="peran-select">Peran</label>
                    <select class="form-control" id="peran-select" name="peran">
                        <option value="">-- Pilih Peran --</option>
                        @foreach ($pegawai->timKerjaAnggota as $item)
                            <option value="{{ $item->pivot->peran == 'Ketua' ? ($item->parentUnit->id ?? $item->id) : $item->id  }}">
                                {{ $item->pivot->peran }} {{ $item->unit->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <label for="hasil-kerja-diintervensi">Hasil Kerja yang diintervensi</label>
                  <select class="form-control" id="hasil-kerja-diintervensi" name="parent_hasil_kerja_id">
                    <option value="">-- Pilih hasil kerja yang diintervensi --</option>
                    @if (!is_null($parentHasilKerja))
                        @foreach ($parentHasilKerja as $index => $parent)
                            <option data-peran-id="{{ $parent->rencanakerja->pegawai->timKerjaAnggota[0]->id }}" value="{{ $parent->id }}">{{ $parent->deskripsi }}</option>
                        @endforeach
                    @endif
                  </select>
                </div>

                <div class="form-group">
                    <label for="hasil-kerja">Hasil Kerja</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="nav-icon fas fa-copy "></i>
                            </button>
                        </div>
                        <input name="deskripsi" type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                </div>

                <div class="form-group">
                  <label for="indikator">Indikator</label>
                  <textarea class="form-control" id="indikator" rows="3" name="indikators"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>
