<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Streams / {{ $file }} / Details </h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"> {{ $file }} Stream File Details</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-primary btn-lg"
                    href="{{ route('server_streamFile', ['app' => $app, 'file' => $file]) }}">Go Back</a>
            </div>
            <table class="table table-light table-striped">
                <thead class="thead-light">
                    <tr>
                        <th class="text-capitalize">name</th>
                        <th class="text-capitalize">enabled</th>
                        <th class="text-capitalize">canRemove</th>
                        <th class="text-capitalize">value</th>
                        <th class="text-capitalize">defaultValue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <th class="text-capitalize">{{ $detail['name'] }}</th>
                            <th class="text-capitalize">{{ $detail['enabled'] }}</th>
                            <th class="text-capitalize">{{ $detail['canRemove'] }}</th>
                            <th class="text-capitalize"> {{ $detail['value'] }}</th>
                            <th class="text-capitalize">{{ $detail['defaultValue'] }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
