<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Applications / {{ $app }} / Stream Targets</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">{{ $app }} Stream Targets</li>
        </ol>
        @if (!$show_add_streamTarget_form)
            <div class="row">
                @if (App\Models\users_roles::where('user_id', auth()->id())->first()->role->name === 'Super Admin' || users_roles::where('user_id', auth()->id())->first()->role->name === 'Admin' || users_roles::where('user_id', auth()->id())->first()->role->name === 'Manager')
                    <div class="col-12 mb-2">
                        <button wire:click="show_add_streamTarget_form()" class="btn btn-success" type="button">Add
                            Stream Target</button>
                    </div>
                @endif
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

                <div class="col-12">
                    <table class="table table-light border shadow rounded">
                        <thead class="thead-light">
                            <th>#</th>
                            <th>Entry Name</th>
                            <th>Profile</th>
                            <th>Status</th>
                            <th>host & port</th>
                            <th>UserName & pass</th>
                            <th>Stream Name</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @if ($streamsTargets)
                                @foreach ($streamsTargets as $stream)
                                    <tr>
                                        <td>{{ $loop->index }}</td>
                                        <td>
                                            <a style="text-decoration: none"
                                                href="{{ route('server_streamTargetDetailed', ['app' => $app, 'stream' => $stream['entryName']]) }}">
                                                {{ $stream['entryName'] }}</a>
                                        </td>
                                        <td>{{ $stream['profile'] }}</td>
                                        <td>{{ $stream['enabled'] == true ? 'Enabled' : 'Disabled' }}</td>
                                        <td>{{ $stream['host'] . ':' . $stream['port'] }}</td>
                                        <td>{{ $stream['userName'] . ':' . $stream['password'] }}</td>
                                        <td>{{ $stream['streamName'] }}</td>
                                        <td>
                                            @if (App\Models\users_roles::where('user_id', auth()->id())->first()->role->name === 'Super Admin' || users_roles::where('user_id', auth()->id())->first()->role->name === 'Admin' || users_roles::where('user_id', auth()->id())->first()->role->name === 'Manager')
                                                <div class="btn-group" role="group" aria-label="Button group">

                                                    <button wire:click="edit('{{ $stream['entryName'] }}')"
                                                        class="btn btn-info" type="button">Edit</button>
                                                    <button
                                                        wire:click="delete_server_stream('{{ $stream['entryName'] }}')"
                                                        class="btn btn-danger" type="button">Remove</button>
                                                    @if ($stream['enabled'] == true)
                                                        <button
                                                            wire:click="disable_stream_target('{{ $stream['entryName'] }}')"
                                                            class="btn btn-warning" type="button">Disable</button>
                                                    @else
                                                        <button
                                                            wire:click="enable_this_stream('{{ $stream['entryName'] }}')"
                                                            class="btn btn-success" type="button">Enable</button>
                                                    @endif

                                                </div>
                                            @else
                                                ----
                                            @endif


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
                    <h4>Add {{ $app }} Stream Target</h4>
                    <center>
                        <div wire:loading class="spinner-border text-success" role="status">
                        </div>
                    </center>
                    {{-- source stream name --}}
                    <div class="form-group">
                        <label for="sourceStreamName">Source Stream Name</label>
                        <input class="form-control @error('sourceStreamName') is-invalid @enderror" type="text"
                            wire:model.defer="sourceStreamName" id="sourceStreamName"
                            placeholder="Enter Source Stream Name">
                        @error('sourceStreamName')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>

                    {{-- entry name --}}
                    <div class="form-group">
                        <label for="entryName">Entry Name</label>
                        <input class="form-control @error('entryName') is-invalid @enderror" type="text"
                            wire:model.defer="entryName" id="entryName" placeholder="Enter Entry Name">
                        @error('entryName')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>

                    {{-- Profile --}}
                    <div class="form-group">
                        <label for="profile">Profile</label>
                        <input class="form-control @error('profile') is-invalid @enderror" type="text"
                            wire:model.defer="profile" id="profile" placeholder="Enter Profile i.e rtmp, hls, dash"
                            value="rtmp">
                        @error('profile')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>


                    {{-- stream name --}}
                    <div class="form-group">
                        <label for="streamName">Stream Name</label>
                        <input class="form-control @error('streamName') is-invalid @enderror" type="text"
                            wire:model.defer="streamName" id="streamName" placeholder="Enter Stream Name">
                        @error('streamName')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>

                    {{-- userName --}}
                    <div class="form-group">
                        <label for="userName">User Name</label>
                        <input class="form-control @error('userName') is-invalid @enderror" type="text"
                            wire:model.defer="userName" id="userName" placeholder="Enter User Name">
                        @error('userName')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>



                    {{-- password --}}
                    <div class="form-group">
                        <label for="password">Enter User Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" name="password"
                            type="password" wire:model.defer="password" id="password" placeholder="Enter User Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input class="form-control " type="password" id="password" name="password_confirmation"
                            wire:model.defer="password_confirmation" placeholder="Password Confirmation ">
                    </div>
                    <br>
                    <center><button class="btn btn-info mx-3" type="button"
                            wire:click="show_add_streamTarget_form()">Back</button><button class="btn btn-success mx-3"
                            type="button" wire:click="add_user_here()">Save</button>
                    </center>
                    {{-- </form> --}}
                </div>
            </div>
        @endif
    </div>
</main>
