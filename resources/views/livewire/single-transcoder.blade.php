<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Applications / {{ $app }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"> {{ $app }} Transcode Settings</li>
        </ol>
        <div class="row">
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
        </div>
        <div class="row">
            <div class="col">
                <div class="btn-group" role="group" aria-label="Button group">
                    <button class="btn btn-primary" type="button" wire:click="show_Encoding_Presets()">Encoding Presets</button>
                    <button class="btn btn-info" type="button" wire:click="show_Decoding_Presets()">Decoding Presets</button>
                    <button class="btn btn-success" type="button" wire:click="show_Stream_Name_Groups()">Stream Name Groups</button>
                </div>
            </div>
        </div>
        @if ($Encoding_Presets)

        @livewire('transcoder.encoding-presets',['app'=>$app, 'transcoder'=> $transcoder, 'data'=>$data['encodes']])

        @elseif ($Decoding_Presets)
            @livewire('transcoder.decoding-presets',['app'=>$app, 'transcoder'=> $transcoder, 'data'=>$data['encodes']])
        @elseif ($Stream_Name_Groups)
        @livewire('transcoder.stream-name-groups',['app'=>$app, 'transcoder'=> $transcoder, 'data'=>$data['encodes']])
        @endif
    </div>

</main>
