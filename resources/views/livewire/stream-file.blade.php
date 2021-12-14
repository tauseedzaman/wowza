<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Streams / {{ $file }} / </h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"> {{ $file }} Stream File Details</li>
        </ol>

        @if ($show_edit_streamFile_form)
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="url">Link</label>
                        <input id="url" class="form-control" wire:model.lazy="edited_url" type="url" name="url">
                    </div>
                    <br>
                    <button class="btn  btn-block btn-success" wire:click="update()" type="button">Save</button>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-success btn-block"
                        href="{{ route('server_streamFileDetailed', ['app' => $app, 'file' => $file]) }}">View Full
                        Details</a>
                </div>
                @if (session()->has('message'))
                    <div class="col-12 mt-2">
                        <div class="alert alert-info">
                            {{ session('message') }}
                        </div>
                    </div>
                @endif
                <div class="col-12 mt-2">
                    <center>
                        <div wire:loading class="spinner-border text-success" role="status">
                        </div>
                    </center>
                </div>
                <div class="col">
                    <table class="table table-light table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Link</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $details['name'] }}</td>
                                <td>{{ $details['uri'] }}</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Button group">
                                            @if ($connected)
                                                <button class="btn btn-warning btn-lg" type="button"
                                                    wire:click="disconnect()">Disconnect</button>
                                            @else
                                                <button class="btn btn-success btn-lg" type="button"
                                                    wire:click="connect()">Connect</button>

                                            @endif
                                            <button class="btn btn-primary btn-lg"
                                                wire:click="edit()" type="button">Edit</button>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @livewire('stream-statistics', ['app' => $app, 'stream' => $file])
        @endif
    </div>
</main>
