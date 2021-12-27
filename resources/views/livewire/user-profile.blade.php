<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Users / Profile </h1>
        <hr>
        <div class="row">
            <div class="col-12 mx">
                <center>
                    <div wire:loading class="spinner-border text-success" role="status">
                    </div>
                </center>
            </div>
            <div class="col">
                <table class="table table-light border shadow rounded">
                    <thead class="thead-light">
                        <th>Name</th>
                        <th>{{ auth()->user()->name }}</th>
                    </thead>
                    <thead class="thead-light">
                        <th>Username</th>
                        <th>{{ auth()->user()->username }}</th>
                    </thead>
                    <thead class="thead-light">
                        <th>Role</th>
                        <th>{{ auth()->user()->roles->role->name }}</th>
                    </thead>
                    <thead class="thead-light">
                        <th>Created At</th>
                        <th>{{ auth()->user()->created_at->diffForHumans() }}</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</main>
