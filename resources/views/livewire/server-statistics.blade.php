<main>
    <div class="container-fluid px-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Server Statistics</li>
        </ol>
        <div class="row shadow rounded bg-light p-3">
            <div class="col-12  shadow border rounded border-info p-2">
                <h2 class="text-center text-dark">Up Time: <b class="text-success">02:50:30</b> </h2>
                {{-- <div class="progress shadow">
                    <div class="progress-bar  bg-success progress-bar-striped progress-bar-animated"
                        role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 50%"><b>50</b></div>
                </div> --}}
                {{-- <br> --}}
            </div>
            <div class="col-md-6 shadow border rounded border-success p-2">
                <h4>Bytes In</h4>
                <div class="progress shadow">
                    <div class="progress-bar  bg-dark progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuemin="0" aria-valuemax="100" style="width: 70%"><b>70</b></div>
                </div>
                <br>
                <h4>Bytes Out</h4>
                <div class="progress shadow">
                    <div class="progress-bar  bg-warning progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuemin="0" aria-valuemax="100" style="width: 20%"><b>20</b></div>
                </div>
                <br>
            </div>
            <div class="col-md-6 shadow border rounded border-success p-2">
                <h4>Bytes-In Rate</h4>
                <div class="progress shadow">
                    <div class="progress-bar  bg-dark progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuemin="0" aria-valuemax="100" style="width: 10%"><b>10</b></div>
                </div>
                <br>

                <h4>Bytes-Out Rate</h4>
                <div class="progress shadow">
                    <div class="progress-bar  bg-warning progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuemin="0" aria-valuemax="100" style="width: 60%"><b>60</b></div>
                </div>
                <br>
            </div>
        </div>
    </div>
</main>
