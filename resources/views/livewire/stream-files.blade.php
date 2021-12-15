<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ $app }} Stream Files</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">{{ $app }} Stream Files</li>
        </ol>
        @if (!$show_add_streamFiles_form)
            <div class="row">
                <div class="col-8 mb-2">
                    <button wire:click="show_add_streamFiles_form()" class="btn btn-success" type="button">Add
                        Stream Files</button>
                </div>
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

                <div class="col">
                    <table class="table table-light border shadow rounded">
                        <thead class="thead-light">
                            <th>#</th>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @if ($streamFiles)
                                @foreach ($streamFiles->last() as $stream)
                                    <tr>
                                        <td>{{ $loop->index }}</td>
                                        <td><a style="text-decoration:none"
                                                href="{{ route('server_streamFile', ['app' => $app, 'file' => $stream['id']]) }}">{{ $stream['id'] }}</a>
                                        </td>
                                        <td><small><a style="text-decoration:none" class="text-success"
                                                    href="{{ env('WOWZA_HOST_FULL_URL') . $stream['href'] }}">{{ env('WOWZA_HOST_URL') . $stream['href'] }}</a></small>
                                        </td>
                                        <td>
                                            none
                                            {{-- <center>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    Connected
                                                    <button class="btn btn-success" type="button"
                                                        wire:click="connect({{ $stream['id'] }})">Connect</button>
                                                    <button class="btn btn-warning" type="button"
                                                        wire:click="disconnect({{ $stream['id'] }})">Disconnect</button>
                                                </div>
                                            </center> --}}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Button group">
                                                {{-- @if ($stream['enabled'] == true)
                                                    <button
                                                        wire:click="disable_stream_file('{{ $stream['entryName'] }}')"
                                                        class="btn btn-warning" type="button">Disable</button>
                                                @else
                                                    <button
                                                        wire:click="enable_this_stream('{{ $stream['entryName'] }}')"
                                                        class="btn btn-success" type="button">Enable</button>
                                                @endif --}}
                                                @if (App\Models\users_roles::where('user_id', auth()->id())->first()->role->name === 'Super Admin' || users_roles::where('user_id', auth()->id())->first()->role->name === 'Admin')
                                                    <button
                                                        wire:click="delete_server_stream_file('{{ $stream['id'] }}')"
                                                        class="btn btn-danger" type="button">Remove</button>
                                                @else
                                                    ----
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="row shadow rounded bg-light p-3">
                <div class="col">
                    <h4>Add {{ $app }} Stream File</h4>
                    <center>
                        <div wire:loading class="spinner-border text-success" role="status">
                        </div>
                    </center>

                    {{-- stream file name --}}
                    <div class="form-group">
                        <label for="name">Stream File Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                            wire:model.defer="name" id="name" placeholder="Enter Stream File Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>

                    {{-- stream file url --}}
                    <div class="form-group">
                        <label for="url">Link</label>
                        <input class="form-control @error('url') is-invalid @enderror" type="url" wire:model.defer="url"
                            id="url" placeholder="Enter Stream File Link">
                        @error('url')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>

                    <center>
                        <button class="btn btn-info mx-3" type="button"
                            wire:click="show_add_streamFiles_form()">Back</button>
                        <button class="btn btn-success mx-3" type="button"
                            wire:click="add_streamFile_here()">Save</button>
                    </center>
                </div>
            </div>
        @endif
    </div>
</main>
