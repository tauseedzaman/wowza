<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WOWZA C-Panel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
</head>


<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ url('/') }}">{{ config('app.name') }}</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            {{-- <li class="nav-item"> --}}
            <li class="nav-item"><a class="nav-link text-light" title="logout"
                    onclick="document.querySelector('#LogoutForm').submit()" style="cursor: pointer">Logout</a></li>
            <form id="LogoutForm" action="{{ route('logout') }}" hidden method="post">
                @csrf
            </form>
            </li>
        </ul>
    </nav>
    @include("layouts.Menu")
    <div id="layoutSidenav_content">
        @yield("content")
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; {{ config('app.name') }}
                        {{ (new Carbon\Carbon())->year }}</div>
                    <div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>

</html>
