@extends('layouts.app')

@section('content')
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Streams Targets </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Streams Targets</li>
                </ol>
                <div class="row">
                    <div class="col-8 mb-2">
                        <button class="btn btn-success" type="button">Add Stream Target</button>
                    </div>
                    <div class="col">
                        <table class="table table-light border shadow rounded">
                            <thead class="thead-light">
                                <th>#</th>
                                <th>App Name</th>
                                <th>URL</th>
                                <th>App Type</th>
                                <th>Driver Enabled</th>
                                <th>DRM Enabled</th>
                                <th>Transcoder Enabled</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>vod</td>
                                    <td>https://url_to_app/bla/bla#bla</td>
                                    <td>VOD</td>
                                    <td>True</td>
                                    <td>False</td>
                                    <td>False</td>
                                    <td>
                                        <button class="btn btn-info" type="button">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>vod</td>
                                    <td>https://url_to_app/bla/bla#bla</td>
                                    <td>VOD</td>
                                    <td>True</td>
                                    <td>False</td>
                                    <td>False</td>
                                    <td>
                                        <button class="btn btn-info" type="button">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>vod</td>
                                    <td>https://url_to_app/bla/bla#bla</td>
                                    <td>VOD</td>
                                    <td>True</td>
                                    <td>False</td>
                                    <td>False</td>
                                    <td>
                                        <button class="btn btn-info" type="button">View</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

@endsection
