<div class="modal fade bd-example-modal-lg" id="create-cascading-{{ $indikator->id }}" tabindex="-1" role="dialog" aria-labelledby="create-cascadingTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" action="{{ url('/penilaian/matriks-peran-hasil/store/' . $indikator->id) }}">
            @csrf
            <div class="modal-header">Tambah Cascading {{ $indikator->id }}</div>
            <div class="modal-body">
                <div class="mb-4 border p-2">{{ $indikator->deskripsi }}</div>
                <table id="table-pegawai-cascading-{{ $indikator->id }}" class="table table-striped table-bordered" style="width:100%">
                    <thead style="width: 100%;">
                        <tr>
                            <th><input type="checkbox" name="cascading[]" value=""></th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="nav-icon fas fa-plus "></i>
                    Tambah Cascading
                </button>
            </div>
        </form>
    </div>
</div>
