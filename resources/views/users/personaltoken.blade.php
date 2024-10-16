@extends('adminlte::page')
@section('title', 'Show User')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
				<div class="bg-light p-4 rounded">
					<h1>Personal Token</h1>
					<div class="lead">
						
					</div>
					
					<div class="container mt-4">
						<div>
							Name: {{ $user->name }}
						</div>
						<div>
							Username: {{ $user->username }}
						</div>
						<div>
							Token : <input type="text" value="{{ $user->personal_token }}" id="ttken" readonly><button onclick="myFunction()">Copy Token</button>
						</div><br>
						<form method="post" action="{{ route('users.personaltokensave') }}">
							@csrf
							<input type="hidden" name="user_id" value="{{ $user->id }}">
							<div class="mb-3">
								<label for="expired" class="form-label">Expired</label>
								<input type="text" name="expired" class="form-control"  value="{{ ($user->expired_personal_token!=null)?$user->expired_personal_token:"" }}" placeholder="2024-03-21"><br>
							</div>
							<button type="submit" name="Simpan" value="1" class="btn btn-info">{{ ($user->personal_token==null)?"Generate Token":"Simpan" }}</button>
							<button type="submit" name="Simpan" value="2" class="btn btn-danger">Hapus Token</button>
						</form>
					</div>

				</div>
				<div class="mt-4">
					<a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
				</div>
	
			</div>
        </div>
    </div>
</div>
@stop

@push('js')

    <script>
        function myFunction() {
			// Get the text field
			var copyText = document.getElementById("ttken");

			// Select the text field
			copyText.select();
			copyText.setSelectionRange(0, 99999); // For mobile devices

			// Copy the text inside the text field
			navigator.clipboard.writeText(copyText.value);

			// Alert the copied text
			alert("Copied the text: " + copyText.value);
		}
        
    </script>
@endpush