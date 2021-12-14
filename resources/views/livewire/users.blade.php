        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Server Users </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Server Users</li>
                </ol>
                @if (!$show_add_user_form)
                    <div class="row">
                        <div class="col-8 mb-2">
                            <button wire:click="show_add_user_form()" class="btn btn-success" type="button">Add
                                User</button>
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
                                    <th>Server</th>
                                    <th>User Name</th>
                                    <th>Groups</th>
                                    <th>PasswordEncoding</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @if ($users)
                                        @foreach ($users->last() as $user)
                                            <tr>
                                                <td>{{ $loop->index }}</td>
                                                <td>{{ $users->first() }}</td>
                                                <td>{{ $user['userName'] }}</td>
                                                <td>
                                                    @foreach ($user['groups'] as $group)
                                                        {{ $group }},
                                                    @endforeach
                                                </td>
                                                <td>{{ $user['passwordEncoding'] }}</td>
                                                <td>
                                                    <button wire:click="delete_server_user('{{ $user['userName'] }}')"
                                                        class="btn btn-danger" type="button">Remove</button>
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
                            <h4>Add Server User</h4>
                            {{-- <form> --}}
                                <center>
                                    <div wire:loading class="spinner-border text-success" role="status">
                                    </div>
                                </center>
                            <div class="form-group">
                                <label for="userName">Enter User Name</label>
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
                                    type="password" wire:model.defer="password" id="password"
                                    placeholder="Enter User Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert text-danger">
                                        <strong>{{ $message }}</strong>
                                    @enderror
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input class="form-control " type="password" id="password" name="password_confirmation"
                                    wire:model.defer="password_confirmation" placeholder="Enter Password Again">
                            </div>
                            <br>


                            <div class="form-group">
                                <label for="role">Role</label>
                                <select id="role" wire:model.defer="role" class="form-control" name="role">
                                    @forelse ($roles as $rl)
                                        <option value="{{ $rl->id }}">{{ $rl->name }}</option>
                                    @empty
                                        <option class="text-danger">No Role Found!</option>
                                    @endforelse
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert text-danger">
                                        <strong>{{ $message }}</strong>
                                    @enderror
                            </div>
                            <br>

                            <br>
                            <center><button class="btn btn-info" type="button"
                                    wire:click="show_add_user_form()">Back</button><button class="btn btn-success"
                                    type="button" wire:click="add_user_here()">Save</button>
                            </center>
                            {{-- </form> --}}
                        </div>
                    </div>
                @endif
            </div>
        </main>
