<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#periodeModal">
    <i class="nav-icon fas fa-plus "></i> Tambah Periode
</button>
<div class="modal fade" id="periodeModal" tabindex="-1" role="dialog" aria-labelledby="hasilKerjaModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content" action="{{ url('penilaian/periode/store') }}">
            @csrf
            <div class="modal-header">Tambah Periode</div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="periode_awal">Periode awal</label>
                      <input type="date" class="form-control" id="periode_awal" name="periode_awal">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="periode_akhir">Periode Akhir</label>
                      <input type="date" class="form-control" id="periode_akhir" name="periode_akhir">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="tahun">Tahun</label>
                      <input type="number" class="form-control" id="tahun" placeholder="2024" name="tahun">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jenis_periode">Jenis Periode</label>
                        <select class="form-control" id="jenis_periode" name="jenis_periode">
                            <option value="Tahunan">Tahunan</option>
                            <option value="Triwulan 1">Triwulan 1</option>
                            <option value="Triwulan 2">Triwulan 2</option>
                            <option value="Triwulan 3">Triwulan 3</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>
