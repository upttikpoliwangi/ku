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
				<h2>Struktur Organisasi</h2>
				<div class="box-header with-border">
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="col">
						<form method="POST" action="{{url('/kui/strukturorganisasi/store')}}" enctype="multipart/form-data">
							@csrf
							<div class="mb-3">
								<label for="judul" class="form-label">Nama Struktur</label>
								<input type="text" class="form-control rounded-pill" name="judul" id="judul" placeholder="Inputkan Nama File" required>
							</div>

							<div class="row">
								<div class="mb-3">
									<div class="form-group">
										<label for="foto_struktur" class="form-label">Foto Struktur Organisasi <span class="text-danger">*</span></label>
										<input class="form-control" type="file" id="foto_struktur" name="foto_struktur" accept="image/jpeg, image/jpg, image/png" required>
										<small class="form-text text-muted">Upload dengan format: jpeg/jpg/png</small>
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
<script src="{{asset('backend/js/pages/form-validation.js')}}"></script>
@endpush





