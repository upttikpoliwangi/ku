<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cetakEvaluasiModal">Cetak Evaluasi</button>
<div class="modal fade" id="cetakEvaluasiModal" tabindex="-1" role="dialog" aria-labelledby="cetakEvaluasiModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="GET" action="{{ url('/penilaian/cetak/evaluasi') }}">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pengaturan Halaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center">
                    <div class="mr-1" style="width:30%">Tanggal Cetak</div>
                    <div class="flex-grow" style="width: 100%">
                        <input type="text" class="form-control" name="print_date" id="inputPassword" placeholder="Contoh: Jakarta, 6 Mei 2025">
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="mr-1" style="width:30%">Margin Atas</div>
                    <div class="flex-grow" style="width: 100%">
                        <input type="number" class="form-control" id="inputPassword" placeholder="10" name="margin_top">
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="mr-1" style="width:30%">Margin Bawah</div>
                    <div class="flex-grow" style="width: 100%">
                        <input type="number" class="form-control" id="inputPassword" placeholder="10" name="margin_bottom">
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="mr-1" style="width:30%">Margin Kanan</div>
                    <div class="flex-grow" style="width: 100%">
                        <input type="number" class="form-control" id="inputPassword" placeholder="10" name="margin_right">
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="mr-1" style="width:30%">Margin Kiri</div>
                    <div class="flex-grow" style="width: 100%">
                        <input type="number" class="form-control" id="inputPassword" placeholder="10" name="margin_left">
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="mr-1" style="width:30%">Orientasi Halaman</div>
                    <div class="d-flex justify-content-start">
                        <div class="form-check mr-1">
                            <input class="form-check-input" type="radio" name="position" id="radio1" value="potrait" checked>
                            <label class="form-check-label" for="radio1">
                                Potrait
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="position" id="radio2" value="landscape">
                            <label class="form-check-label" for="radio2">
                                Landscape
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" target="_blank" class="btn btn-primary">Cetak</button>
            </div>
        </form>
    </div>
</div>
