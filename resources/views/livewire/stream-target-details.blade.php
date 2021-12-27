<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Streams / {{ $stream }} / Details </h3>
        <hr>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-primary btn-lg"
                    href="{{ route('server_streamTargets', ['app' => $app, 'stream' => $stream]) }}">Back</a>
            </div>
            <br>
            <table class="table table-light table-striped">
                <thead class="thead-light">
                    <tr>
                        <th class="text-capitalize">Property Name</th>
                        <th class="text-capitalize">Property Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $key => $detail)
                        <tr>
                            <th class="text-capitalize">{{ $key }}</th>
                            <th class="text-capitalize">{{ $detail }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
