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
                    <td>{{ $data[0]['enable']==false ? "No":"Yes" }}</td>
                    <td>{{ $data[0]['audioCodec'] }}</td>
                    <td>{{ $data[0]['streamName'] }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Button group">
                            <button class="btn btn-info" type="button" wire:click='edit'>Edit</button>
                            <button class="btn btn-danger" type="button" wire:click='Delete'>Delete</button>

                        </div>
                    </td>
                </tr>
            </tbody>
            </tfoot>
        </table>
    </div>
</div>
