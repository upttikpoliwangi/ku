@extends('adminlte::page')
@section('content')

<div class="main-content">
<section class="section">
    <div class="container p-4">
        {{-- <a class="btn btn-lg btn-danger" type="button" href="{{ url('/kui/aktivitas') }}">Kembali</a> --}}
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-12">
                <div class="text-center">
                    <h1 class="">Aktivitas Poliwangi</h1>
                    <hr>
                </div>
                <h3 class="text-center">{{ $post->kegiatan }}</h3>
                <div>
                    {!! $post->deskripsi !!}
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection