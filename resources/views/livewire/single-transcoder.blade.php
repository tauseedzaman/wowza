<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Applications / {{ $app }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"> {{ $app }} Transcode Settings</li>
        </ol>
        <div class="row">
            <div class="col-12 mx">
                @if (session()->has('message'))
                    <div class="alert alert-info">
                        {{ session('message') }}
                    </div>
                @endif
                <center>
                    <div wire:loading class="spinner-border text-success" role="status">
                    </div>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="btn-group" role="group" aria-label="Button group">
                    <button class="btn btn-primary" type="button" wire:click="show_Encoding_Presets()">Encoding Presets</button>
                    <button class="btn btn-info" type="button" wire:click="show_Decoding_Presets()">Decoding Presets</button>
                    <button class="btn btn-success" type="button" wire:click="show_Stream_Name_Groups()">Stream Name Groups</button>
                </div>
            </div>
        </div>
        @if ($Encoding_Presets)
        <div class="row">
            <div class="col">
                <table class="table table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th>Enabled</th>
                            <th>Preset</th>
                            <th>Stream Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data['encodes'][0]['enable'] }}</td>
                            <td>{{ $data['encodes'][0]['audioCodec'] }}</td>
                            <td>{{ $data['encodes'][0]['streamName'] }}</td>
                            <td>
                                <button class="btn btn-info" type="button" wire:click='edit'>Edit</button>
                            </td>
                        </tr>
                    </tbody>
                    </tfoot>
                </table>
            </div>
        </div>
        @elseif ($Decoding_Presets)
        <div class="row">
            <div class="col">
                <h4>Description</h4>
                <p>something</p>

                <h4>Decoder Implementation</h4>
                <p>something</p>


                <h4>Source Options</h4>
                <p>something</p>


                <hr>

                <h4>Overlay Images</h4>
                <p>some imags here</p>
            </div>
        </div>
        @elseif ($Stream_Name_Groups)
        <div class="row">
            <div class="col">
                <h2>Stream Name Groups</h2>
                <button class="btn btn-info" type="button" >Add Stream Name Groups</button>
            </div>
            <div class="col">
                <table class="table table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Streem Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>Streem Name</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Button group">
                                    <button class="btn btn-primary" type="button">Edit</button>
                                    <button class="btn btn-danger" type="button">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
        @endif
    </div>

</main>
