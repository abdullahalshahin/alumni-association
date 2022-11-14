<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
        {{ $style ?? '' }}
    </head>
    <body class="loading" data-layout-config='{"darkMode":false}'>
        <nav class="navbar navbar-expand-lg py-lg-3 navbar-dark">
            <div class="container">
                <a href="index.html" class="navbar-brand me-lg-5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" class="logo-dark" height="18" />
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto align-items-center">
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link active" href="">Home</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link" href="">Event</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link" href="">Notice</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link" href="">FAQs</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link" href="">Contact</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item me-0">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" target="_blank" class="nav-link d-lg-none">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" target="_blank" class="nav-link d-lg-none">Log in</a>
                                @endauth
                            @endif

                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" target="_blank" class="btn btn-sm btn-light rounded-pill d-none d-lg-inline-flex">
                                        <i class="mdi mdi-basket me-2"></i> Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" target="_blank" class="btn btn-sm btn-light rounded-pill d-none d-lg-inline-flex">
                                        <i class="mdi mdi-basket me-2"></i> Log in
                                    </a>
                                @endauth
                            @endif
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="mt-md-4">
                            <h2 class="text-white fw-normal mb-4 mt-3 hero-title">
                                European University of Bangladesh
                            </h2>

                            <p class="mb-4 font-16 text-white-50">The European University of Bangladesh or EUB is a private university located at Dhaka, Bangladesh. 
                                The university was established in 2012 under the Private University Act, 1992. Eng. Md. Alim Dad is vice-chancellor of the university.</p>

                            <a href="{{ url('alumni-registration') }}" class="btn btn-success">Registration for Alumni <i class="mdi mdi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="text-md-end mt-3 mt-md-0">
                            <img src="{{ asset('assets/images/startup.svg') }}" alt="" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/sweetalert2@11') }}"></script>
        {{ $script ?? '' }}
    </body>
</html>
