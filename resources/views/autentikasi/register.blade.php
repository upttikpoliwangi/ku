<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard

* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

@php($register_url = View::getSection('register_url') ?? 'register.perform')

@if (config('adminlte.use_route_url', false))
    @php($register_url = $register_url ? route($register_url) : '')
@else
    @php($register_url = $register_url ? url($register_url) : '')
@endif

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Register | {{ config('app.name') }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ url('favicon.png') }}" type="image/png">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('argon') }}/assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="{{ url('argon') }}/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css"
        type="text/css">
    <!-- Iconify -->
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ url('argon') }}/assets/css/argon.css?v=1.2.0" type="text/css">
    <script src="{{ url('js/util.js') }}"></script>
    <!-- Custom CSS -->
    <link href="{{ asset('/assets/css/halamanAwal.css') }}" rel="stylesheet">

</head>

<body class="bg-default">
    <!-- Main content -->
    <div class="main-content halaman_awal login_page">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7">
            <div class="container">
                <div class="header-body text-center mb-5">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-2">
                            <img src="{{ asset(config('adminlte.logo_img')) }}" height="50">
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-7">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7">
                    <div class="card bg-secondary mt-4 border-0 mb-0">
                        <div class="card-body">
                            <form action="{{ route('register.perform') }}" method="post">
                                @csrf

                                {{-- Nama field --}}
                                <div class="input-group mb-3">
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ old('nama') }}" placeholder="Nama" autofocus>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>

                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Email field --}}
                                <div class="input-group mb-3">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="Email">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Email field --}}
                                <div class="input-group mb-3">
                                    <input type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value="{{ old('username') }}" placeholder="username">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Password field --}}
                                <div class="input-group mb-3">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Register button --}}
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-block btn-primary">
                                            Daftar
                                        </button>
                                    </div>
                                </div>

                                <div class="text-center mt-3">
                                    <a href="{{ route('login.show') }}" class="btn btn-secondary btn-block">
                                        Kembali ke Login
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ url('argon') }}/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('argon') }}/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('argon') }}/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="{{ url('argon') }}/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{ url('argon') }}/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="{{ url('argon') }}/assets/js/argon.js?v=1.2.0"></script>

</body>

</html>

