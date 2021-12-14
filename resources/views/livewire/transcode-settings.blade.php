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
        @if ($show_trans_settings)
            <div class="card">
                <div class="card-header">
                    Edit Transcode Settings
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="enable">Enable</label>
                        <select id="enable" wire:model.defer="enable"
                            class="form-control @error('enable') is-invalid @enderror"
                            name="enable">
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                        @error('enable')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="videoCodec">videoCodec</label>
                       <input type="text" wire:model.defer="videoCodec"
                            class="form-control @error('videoCodec') is-invalid @enderror"
                            name="videoCodec" id="videoCodec" placeholder="videoCodec">
                        @error('videoCodec')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="implementation">implementation</label>
                       <input type="text" wire:model.defer="implementation"
                            class="form-control @error('implementation') is-invalid @enderror"
                            name="implementation" id="implementation" placeholder="implementation">
                        @error('implementation')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="gpuid">gpuid</label>
                       <input type="text" wire:model.defer="gpuid"
                            class="form-control @error('gpuid') is-invalid @enderror"
                            name="gpuid" id="gpuid" placeholder="gpuid">
                        @error('gpuid')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="profile">profile</label>
                       <input type="text" wire:model.defer="profile"
                            class="form-control @error('profile') is-invalid @enderror"
                            name="profile" id="profile" placeholder="profile">
                        @error('profile')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="videoBitrate">videoBitrate</label>
                       <input type="text" wire:model.defer="videoBitrate"
                            class="form-control @error('videoBitrate') is-invalid @enderror"
                            name="videoBitrate" id="videoBitrate" placeholder="videoBitrate">
                        @error('videoBitrate')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>






                    <div class="form-group">
                        <label for="followSource">followSource</label>
                        <select id="followSource" wire:model.defer="followSource"
                            class="form-control @error('followSource') is-invalid @enderror"
                            name="followSource">
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                        @error('followSource')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="interval">interval</label>
                       <input type="text" wire:model.defer="interval"
                            class="form-control @error('interval') is-invalid @enderror"
                            name="interval" id="interval" placeholder="interval">
                        @error('interval')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>



                    <div class="form-group">
                        <label for="webrtc_iceCandidateIpAddresses">ice Candidate Ip Addresses</label>
                        <input class="form-control @error('webrtc_iceCandidateIpAddresses') is-invalid @enderror"
                            type="text" wire:model.defer="webrtc_iceCandidateIpAddresses"
                            id="webrtc_iceCandidateIpAddresses" value="127.0.0.1,tcp,1935"
                            placeholder="Enter Application iceCandidateIpAddresses">
                        @error('webrtc_iceCandidateIpAddresses')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>


                    <div class="form-group">
                        <label for="webrtc_preferredCodecsAudio">Preferred Codecs Audio</label>
                        <input class="form-control @error('webrtc_preferredCodecsAudio') is-invalid @enderror"
                            type="text" wire:model.defer="webrtc_preferredCodecsAudio" id="webrtc_preferredCodecsAudio"
                            value="opus,pcmu,pcma" placeholder="Enter Application preferred Codecs Audio">
                        @error('webrtc_preferredCodecsAudio')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="webrtc_preferredCodecsVideo">preferred Codecs Video</label>
                        <input class="form-control @error('webrtc_preferredCodecsVideo') is-invalid @enderror"
                            type="text" wire:model.defer="webrtc_preferredCodecsVideo" id="webrtc_preferredCodecsVideo"
                            value="vp8,h264" placeholder="Enter Application preferred Codecs Audio">
                        @error('webrtc_preferredCodecsVideo')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>


                </div>
                <div class="card-footer">
                    <button class="btn btn-info btn-lg" wire:click="cancel()" type="button">Back</button>
                    <button class="btn btn-success btn-lg" wire:click="save_webrtc_settings()"
                        type="button">Save</button>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col mb-2">
                    <a href="{{ route('server_application', ['app' => $app]) }}" class="btn btn-secondary"
                        type="button"><b>⬅️</b></a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-light table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Properties Name</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 4; $i++)
                                @foreach ($transcode['encodes'][$i] as $key => $value)
                                    @if ($key == 'audioCodec')
                                        <thead>
                                            <th>Inner Properties</th>
                                            <th>Inner Value</th>
                                        </thead>
                                        @foreach ($transcode['encodes'][0]['Overlays'][0] as $key => $value)
                                            <tr>
                                                <td>{{ $key }}</td>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    @break
                                @else
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $value }}</td>
                                    </tr>
                                @endif

                            @endforeach
                            <tr>
                                <td></td>
                                <td>
                                    <button class="btn btn-info btn-lg" wire:click="edit_this_transcode({{ $i }})" type="button">Edit </button>
                                </td>
                            </tr>
                            <thead>
                                <th>-------------------------------------------------</th>
                                <th>-------------------------------------------------</th>
                            </thead>
        @endfor
        </tbody>
        </table>
    </div>
    @endif
    </div>
</main>
