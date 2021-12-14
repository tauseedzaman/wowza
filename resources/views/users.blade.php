@extends('layouts.app')

@section('content')
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Server Users </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Server Users</li>
                </ol>
                <div class="row">
                    <div class="col-8 mb-2">
                        <button class="btn btn-success" type="button">Add User</button>
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
                                @foreach ($users->last() as $user)
                                <tr>
                                    <td>{{ $loop->index }}</td>
                                    <td>{{ $users->first() }}</td>
                                    <td>{{ $user["userName"] }}</td>
                                    <td>
                                        @foreach ($user['groups'] as $group)
                                            {{ $group }},
                                        @endforeach
                                    </td>
                                    <td>{{ $user["passwordEncoding"] }}</td>
                                    <td>
                                        <form action="{{ route("server_user_delete") }}" method="post">
                                            @csrf
                                            <input type="hidden" name="userName" value="{{ $user['userName'] }}">
                                            <button class="btn btn-danger" type="submit">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

@endsection
