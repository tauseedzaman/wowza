<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{ route("home") }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <a class="nav-link" href="{{ route("server_users") }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Users
                    </a>

                    <a class="nav-link" href="{{ route("server_applications") }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Applications
                    </a>

                    {{-- <a class="nav-link" href="{{ route("server_streams") }}"> --}}
                        {{-- <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> --}}
                        {{-- Streams --}}
                    {{-- </a> --}}
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ auth() ? auth()->user()->name:"none" }}
            </div>
        </nav>
    </div>
