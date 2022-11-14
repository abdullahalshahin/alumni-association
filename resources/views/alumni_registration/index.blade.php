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
                <h2 class="text-white fw-normal hero-title">
                    European University of Bangladesh
                </h2>
                <form action="" method="post">
                    <div class="row g-2">
                        <div class="mb-3 col-md-4">
                            <label for="registration_no" class="text-white">Student ID</label>
                            <input type="number" name="registration_no" class="form-control" id="registration_no" required>
                        </div>
                    
                        <div class="mb-3 col-md-6">
                            <label for="name" class="text-white">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Write your name" readonly required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-5">
                            <label for="department" class="text-white">Department</label>
                            <input type="text" name="department" class="form-control" id="department" readonly required>
                        </div>
                    
                        <div class="mb-3 col-md-5">
                            <label for="batch" class="text-white">Batch</label>
                            <input type="text" name="batch" class="form-control" id="batch" readonly required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-5">
                            <label for="session" class="text-white">Session</label>
                            <input type="text" name="session" class="form-control" id="session" readonly required>
                        </div>
                    
                        <div class="mb-3 col-md-5">
                            <label for="group_id" class="text-white">Group</label>
                            <select id="group_id" name="group_id" class="form-select" required>
                            </select>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-5">
                            <label for="topic_name" class="text-white">Topic Name</label>
                            <input type="text" name="topic_name" class="form-control" id="topic_name" readonly required>
                        </div>
                    
                        <div class="mb-3 col-md-5">
                            <label for="teacher" class="text-white">Teacher</label>
                            <input type="text" name="teacher" class="form-control" id="teacher" readonly required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-6">
                            <label for="date" class="text-white">Date</label>
                            <div class="input-group">
                                <input type="text" name="date" class="form-control date" id="date" data-toggle="date-picker" data-single-date-picker="true" required>
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="mdi mdi-calendar-range font-13"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="mb-3 col-md-10">
                            <label for="details" class="text-white">Details</label>
                            <textarea name="details" class="form-control" id="details" rows="6"></textarea>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </section>

        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#registration_no').on('input',function() {
                    let registration_no = document.getElementById('registration_no').value;

                    if (registration_no.length == 9) {
                        $.ajax({
                            url: "{{url('api/fetch-student-data')}}",
                            type: "GET",
                            data: {
                                registration_no: registration_no
                            },
                            dataType: 'json',
                            success: function (response) {
                                console.log(response);
                                $('#group_id').html('<option value="">-- Select Group --</option>');
                                $.each(response.groups, function (key, value) {
                                    $("#group_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>
