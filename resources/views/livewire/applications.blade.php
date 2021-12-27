        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Server Applications </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Server Applications</li>
                </ol>
                @if (!$show_add_app_form)
                    <div class="row">
                        @if (App\Models\users_roles::where('user_id', auth()->id())->first()->role->name === 'Super Admin' || users_roles::where('user_id', auth()->id())->first()->role->name === 'Admin')
                            <div class="col-8 mb-2">
                                <button wire:click="show_add_app_form()" class="btn btn-success" type="button">Add
                                    Application</button>
                            </div>
                        @endif
                        <div class="col-12 mx">
                            @if (session()->has('message'))
                                <div class="alert alert-warning">
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
                                    <th>URL</th>
                                    <th>Type</th>
                                    <th>Driver</th>
                                    <th>DRM</th>
                                    <th>Transcoder</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @if ($apps)
                                        @foreach ($apps->last() as $app)
                                            <tr>
                                                <td class="text-center">{{ $loop->index }}</td>
                                                <td><a class="a text-dark" style="text-decoration: none"
                                                        href="{{ route('server_application', $app['id']) }}">{{ $app['id'] }}</a>
                                                </td>
                                                <td class="text-sm"><a target="blenk"
                                                        style="text-decoration: none"
                                                        href="{{ env('WOWZA_HOST_URL') . ':8088/' . $app['href'] }}"><small>{{ $app['href'] }}</a></small>
                                                </td>
                                                <td class="text-center">{{ $app['appType'] ?: 'Default' }}</td>
                                                <td
                                                    class="text-center {{ $app['dvrEnabled'] == false ? 'text-warning' : 'text-success' }}  ">
                                                    {{ $app['dvrEnabled'] == false ? 'Disabled' : 'Enabled' }}</td>

                                                <td
                                                    class="text-center {{ $app['drmEnabled'] == false ? 'text-warning' : 'text-success' }}">
                                                    {{ $app['drmEnabled'] == false ? 'Disabled' : 'Enabled' }}</td>
                                                <td
                                                    class="text-center {{ $app['transcoderEnabled'] == true ? 'text-success' : 'text-warning' }} ">
                                                    {{ $app['transcoderEnabled'] == false ? 'Disabled' : 'Enabled' }}
                                                </td>
                                                <td>
                                                    @if (App\Models\users_roles::where('user_id', auth()->id())->first()->role->name === 'Super Admin' || users_roles::where('user_id', auth()->id())->first()->role->name === 'Admin')
                                                        <div class="btn-group" role="group"
                                                            aria-label="Button group">
                                                            <button wire:click="delete_app('{{ $app['id'] }}')"
                                                                class="btn btn-danger" type="button">Remove</button>
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
                            <h4>Add Application</h4>
                            {{-- <name> --}}
                            <div class="form-group">
                                <label for="name">Application Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                    wire:model.defer="name" id="name" placeholder="Enter Application Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert text-danger">
                                        <strong>{{ $message }}</strong>
                                    @enderror
                            </div>
                            <br>
                            {{-- appType --}}
                            <div class="form-group">
                                <label for="appType">Application Type</label>
                                <select id="appType" wire:model.defer="appType"
                                    class="form-control @error('appType') is-invalid @enderror" name="appType">
                                    <option value="Live" selected>Live</option>
                                    {{-- <option value="VOD">VOD</option>
                                    <option value="LiveEdge">LiveEdge</option>
                                    <option value="LiveHTTPOrigin">LiveHTTPOrigin</option> --}}
                                </select>
                                @error('appType')
                                    <span class="invalid-feedback" role="alert text-danger">
                                        <strong>{{ $message }}</strong>
                                    @enderror
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" wire:model.defer="description"
                                    placeholder="Enter Application Descriptions" name="description" rows="3"></textarea>
                            </div>
                            <br>
                            <h4 class="text-bolder text-dark mt-1"><b>Stream Config</b></h4>
                            <div class="form-group">
                                <label for="role">Stream Type</label>
                                <select id="role" wire:model.defer="streamType" class="form-control"
                                    name="streamType">
                                    <option value="live" selected>live</option>
                                    {{-- <option value="VOD">VOD</option>
                                    <option value="VODEdge">VODEdge</option>
                                    <option value="VODHTTPOrigin">VODHTTPOrigin</option> --}}

                                </select>
                                @error('streamType')
                                    <span class="invalid-feedback" role="alert text-danger">
                                        <strong>{{ $message }}</strong>
                                    @enderror
                            </div>
                            <br>

                            <br>
                            <center>
                                <button class="btn btn-info btn-block" type="button"
                                    wire:click="show_add_app_form()">Back</button>
                                <button class="btn btn-block btn-success" type="button"
                                    wire:click="add_app_here()">Save</button>
                            </center>
                            {{-- </form> --}}
                        </div>
                    </div>
                @endif
            </div>
        </main>
