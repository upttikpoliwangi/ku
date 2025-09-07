@extends('adminlte::page')
@section('title', 'List Menu')
@section('plugins.Select2', true)
@section('content_header')

@stop


@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h2>Kegiatan Kerjasama</h2>
				<div class="box-header with-border">
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="col">
						<form method="POST" action="{{url('/kui/kegiatankerjasama/store')}}" enctype="multipart/form-data">
							@csrf
							<div class="mb-3">
								<label for="jurusan" class="form-label">Jurusan</label>
								<select class="form-select rounded-pill @error('id_jurusan') is-invalid @enderror" name="id_jurusan" id="id_jurusan" required>
									<option value="" disabled {{ old('id_jurusan') ? '' : 'selected' }}>Pilih Jurusan</option>
									@foreach($jurusan as $j)
									<option value="{{ $j->id_jurusan }}" {{ old('id_jurusan') == $j->id_jurusan ? 'selected' : '' }}>
										{{ $j->nama_jurusan ?? $j->nama }}
									</option>
									@endforeach
								</select>
								@error('id_jurusan')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
							<div class="mb-3">
								<label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
								<input type="text" class="form-control rounded-pill" name="nama_kegiatan" id="nama_kegiatan" placeholder="Inputkan Nama Kegiatan" required>
							</div>

							<div class="float-left w-50 pr-2">
								<label>Tanggal Pelaksanaan Kegiatan</label>
								<input type="date" class="form-control rounded-pill" name="tanggal_kegiatan" id="kegiatan_kegiatan" placeholder="Inputkan Tanggal Kegiatan" required>
							</div>

							<!-- Biaya Kegiatan -->
							<div class="float-right w-50 pl-2">
								<label class="form-label">Biaya Kegiatan</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Rp.</span>
									</div>
									<input type="text" class="form-control currency-input" name="biaya_kegiatan" id="biaya_kegiatan" required>
								</div>
							</div>

							<div class="row">
								<!-- Dokumen Kegiatan -->
								<div class="col-md-6 pe-md-2">
									<div class="form-group">
										<label for="dokumen_kegiatan" class="form-label">Unggah Dokumen Kegiatan <span class="text-danger">*</span></label>
										<input class="form-control" type="file" id="dokumen_kegiatan" name="upload_dokumen" accept="application/pdf" required>
										<small class="form-text text-muted">Upload dengan format: pdf</small>
									</div>
								</div>

								<!-- Foto Kegiatan (Kanan) -->
								<div class="col-md-6 ps-md-2">
									<div class="form-group">
										<label for="foto_kegiatan" class="form-label">Unggah Foto Kegiatan <span class="text-danger">*</span></label>
										<input class="form-control" type="file" id="foto_kegiatan" name="upload_foto" accept="image/jpeg, image/jpg, image/png" required>
										<small class="form-text text-muted">Upload dengan format: jpg/jpeg/png</small>
									</div>
								</div>
							</div>

					</div>

					<!-- Submit Button -->
					<div class="form-group text-right mt-6">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@stop


@push('js')
<script>
	$(document).ready(function() {
		// Format input biaya kegiatan
		$('.currency-input').on('keyup', function() {
			let value = $(this).val().replace(/[^\d]/g, '');
			$(this).val(formatRupiah(value));
		});

		// Saat form disubmit, bersihkan format Rupiah
		$('form').on('submit', function() {
			let biaya = $('#biaya_kegiatan').val();
			biaya = biaya.replace(/[^\d]/g, '');
			$('#biaya_kegiatan').val(biaya);
		});

		function formatRupiah(angka) {
			if (!angka) return '';
			return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}
	});
</script>
@endpush





<!-- Vendor JS -->
<!-- <script src="{{asset('../assets/vendor_components/datatable/datatables.min.js')}}"></script>
	<script src="{{asset('backend/js/pages/data-table.js')}}"></script> -->