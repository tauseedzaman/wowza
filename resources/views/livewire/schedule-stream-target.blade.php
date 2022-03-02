<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4 py-3 border-bottom ">Schedule {{ $stream ?? "Test" }} </h3>
        @if ($show_schedule_form)
            <div class="row">
                <div class="col-12 mt-2">
                    <center>
                        <div wire:loading class="spinner-border text-success" role="status">
                        </div>
                    </center>
                </div>
                <div class="col-md-6 mx-auto">
                    <div class="form-group">
                        <label for="stream">Stream</label>
                        <input id="stream" class="form-control" wire:model.lazy="stream" type="text" disabled name="stream">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input id="start_time" class="form-control" wire:model.lazy="start_time" type="datetime-local" name="start_time">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="end_time">End Time</label>
                        <input id="end_time" class="form-control" wire:model.lazy="end_time" type="datetime-local" name="end_time">
                    </div>
                    <br>
                    <button class="btn  btn-block btn-success" wire:click="schedule_stream_target()" type="button">Set Schedule</button>
                    <button class="btn  btn-block btn-warning" wire:click="toggle_form()" type="button">Cancel</button>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-success btn-block"
                        href="{{ route('server_applications', ['app' => $app ?? "test"]) }}">Back</a>
                        <button wire:click="toggle_form()" class="btn btn-info">Set Schedule</button>
                </div>
                {{-- <p>Now {{ now() }}</p> --}}
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
                <div class="    mx-auto col my-3">
                    <h4 class="py-2 border-bottom ">Stream : <span class="ml-4 text-success px-3"> {{ $stream ?? "test" }}</span></h4>
                    <h4 class="py-2 border-bottom ">Start Time : <span class="ml-4 text-success px-3"> {{ $schedule->start_time ?? "00:00   " }} </span>
                    </h4>
                    <h4 class="py-2 border-bottom ">End Time : <span class="ml-4 text-success px-3"> {{ $schedule->end_time ?? "00:00" }} </span>
                    </h4>
                    @if ($schedule)

                    <small> from <span class="text-info text-italic">{{ $schedule->start_time->diffForhumans() ?? "" }}</span> to <span class="text-info text-italic">{{ $schedule->end_time->diffForhumans() ?? "" }}</span></small>
                    <br>
                    <br>
                    <p>Current Time : <span class="text-info text-italic">{{ now()->format("m/d/Y -- H:i") }}</span></p>
                    @endif
                </div>
            </div>
        @endif
        {{-- <p class="text-info p-2 border shadow rounded">
            Please note that. only the one schudler will work at a time so please schedule just one stream at a time.
        </p> --}}
    </div>
</main>
