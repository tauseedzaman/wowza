@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <hr>
            <div class="row">
                <div class="col-xl-3 col-md-6">

                    <div class="card bg-primary text-white mb-4">
                        <a class="small text-white stretched-link text-decoration-none" href="{{ route('server_users') }}"
                            style="text-decoration:none">
                            <div class="card-body "><b>Users</b></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                View Details
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </a>
                    </div>

                </div>
                <div class="col-xl-3 col-md-6">

                    <div class="card bg-success text-white mb-4">
                        <div class="card-body "><b>Applications</b></div>
                        <a class="small text-white stretched-link text-decoration-none"
                            href="{{ route('server_applications') }}" style="text-decoration:none">
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                View Details
                                <div class="small text-white"><i class="fas fa-angle-right"></i>
                                </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <hr>
        <div class="row">
            @livewire('server-statistics')
        </div>
        </div>
    </main>

@endsection
