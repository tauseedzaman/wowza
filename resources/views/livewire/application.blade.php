<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Applications / {{ $app }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"> {{ $app }} Application Details</li>
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
        @if ($show_webrtc_settings)
            <div class="card">
                <div class="card-header">
                    WebRTC Settings for {{ $app }}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="webrtc_enablePublish">Enable Publish</label>
                        <select id="webrtc_enablePublish" wire:model.defer="webrtc_enablePublish"
                            class="form-control @error('webrtc_enablePublish') is-invalid @enderror"
                            name="webrtc_enablePublish">
                            <option value="true">Enable</option>
                            <option value="false">disable</option>
                        </select>
                        @error('webrtc_enablePublish')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="webrtc_enablePlay">Enable Play</label>
                        <select id="webrtc_enablePlay" wire:model.defer="webrtc_enablePlay"
                            class="form-control @error('webrtc_enablePlay') is-invalid @enderror"
                            name="webrtc_enablePlay">
                            <option value="true">Enable</option>
                            <option value="false">disable</option>
                        </select>
                        @error('webrtc_enablePlay')
                            <span class="invalid-feedback" role="alert text-danger">
                                <strong>{{ $message }}</strong>
                            @enderror
                    </div>
                    <br>


                    <div class="form-group">
                        <label for="webrtc_enableQuery">Enable Query</label>
                        <select id="webrtc_enableQuery" wire:model.defer="webrtc_enableQuery"
                            class="form-control @error('webrtc_enableQuery') is-invalid @enderror"
                            name="webrtc_enableQuery">
                            <option value="true">Enable</option>
                            <option value="false">disable</option>
                        </select>
                        @error('webrtc_enableQuery')
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
                    <a href="{{ route('server_applications') }}" class="btn btn-secondary"
                        type="button"><b>⬅️</b></a>
                </div>
            </div>
            <div class="row">
                <div class="btn-group" role="group" aria-label="Button group">
                    <a href="{{ route('server_streamFiles', $details['name']) }}" class="btn btn-success"
                        type="button">View Stream Files</a>

                    <a href="{{ route('server_streamTargets', $details['name']) }}" class="btn btn-primary"
                        type="button">View Stream Targets</a>
                    {{-- only super admin and admin can see these functions --}}
                    @if (App\Models\users_roles::where('user_id', auth()->id())->first()->role->name === 'Super Admin' || users_roles::where('user_id', auth()->id())->first()->role->name === 'Admin')
                        <button class="btn btn-success bg-lg" wire:click="Start_App()" type="button">Start</button>
                        <button class="btn btn-primary bg-lg" wire:click="Restart_App()" type="button">Restart</button>
                        <button class="btn btn-warning bg-lg" wire:click="Shutdown_App()"
                            type="button">Shutdown</button>
                        <a href="{{ route('server_application_transcode_settings', ['app' => $app]) }}"
                            class="btn btn-info bg-lg " type="button"
                            title="enable transcoder">Transcoder</a>

                        <button class="btn btn-success bg-lg" wire:click="show_webrtc_settings()"
                            title="webRTC settings" type="button">WebRTC</button>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-light table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Property Name</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>WebRTC Publish</td>
                                <td>{{ $details['webRTCConfig']['enablePublish'] == true ? 'Enabled' : 'Disabled' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">WebRTC enable Play</td>
                                <td>{{ $details['webRTCConfig']['enablePlay'] == true ? 'Enabled' : 'Disabled' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">WebRTC enable Query</td>
                                <td>{{ $details['webRTCConfig']['enableQuery'] == true ? 'Enabled' : 'Disabled' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-capitalize">WebRTC ice Candidate Ip Addresses</td>
                                <td>{{ $details['webRTCConfig']['iceCandidateIpAddresses'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">WebRTC preferred Codecs Audio</td>
                                <td>{{ $details['webRTCConfig']['preferredCodecsAudio'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">WebRTC preferredCodecsVideo</td>
                                <td>{{ $details['webRTCConfig']['preferredCodecsVideo'] }}</td>
                            </tr>

                            <tr>
                                <td class="text-capitalize">name</td>
                                <td class="text-capitalize">{{ $details['name'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">description</td>
                                <td class="text-capitalize">{{ $details['description'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Version</td>
                                <td class="text-capitalize">{{ $details['version'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">serverName</td>
                                <td class="text-capitalize">{{ $details['serverName'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">appType</td>
                                <td class="text-capitalize">{{ $details['appType'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">applicationTimeout</td>
                                <td class="text-capitalize">{{ $details['applicationTimeout'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">pingTimeout</td>
                                <td class="text-capitalize">{{ $details['pingTimeout'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">clientStreamReadAccess</td>
                                <td class="text-capitalize">{{ $details['clientStreamReadAccess'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">avSyncMethod</td>
                                <td class="text-capitalize">{{ $details['avSyncMethod'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">maxRTCPWaitTime</td>
                                <td class="text-capitalize">{{ $details['maxRTCPWaitTime'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">httpCORSHeadersEnabled</td>
                                <td class="text-capitalize">{{ $details['httpCORSHeadersEnabled'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">httpCORSHeadersEnabled</td>
                                <td class="text-capitalize">{{ $details['httpCORSHeadersEnabled'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">httpStreamers</td>
                                <td class="text-capitalize">{{ $details['httpStreamers'][0] }}</td>
                                {{-- @foreach ($xx = $details['httpCORSHeadersEnabled'] as $x) {{ $x }} @endforeach --}}
                            </tr>
                            <tr>
                                <td class="text-capitalize">mediaReaderRandomAccessReaderClass</td>
                                <td class="text-capitalize">{{ $details['mediaReaderRandomAccessReaderClass'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">httpOptimizeFileReads</td>
                                <td class="text-capitalize">
                                    {{ $details['httpOptimizeFileReads'] == false ? 'No' : 'Yes' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">mediaReaderBufferSeekIO</td>
                                <td class="text-capitalize">
                                    {{ $details['mediaReaderBufferSeekIO'] == false ? 'No' : 'Yes' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        @endif
    </div>
</main>
{{-- "" => array:2 [▼
      0 => "cupertinostreaming"
      1 => "mpegdashstreaming"
    ]
    "" => ""
    "" => false
    "" => false
    "captionLiveIngestType" => ""
    "vodTimedTextProviders" => array:1 [▼
      0 => "vodcaptionprovidermp4_3gpp"
    ]
    "securityConfig" => array:21 [▼
      "serverName" => "_defaultServer_"
      "secureTokenVersion" => 0
      "publishRequirePassword" => false
      "publishPasswordFile" => ""
      "publishRTMPSecureURL" => ""
      "publishIPBlackList" => ""
      "publishIPWhiteList" => ""
      "publishBlockDuplicateStreamNames" => false
      "publishValidEncoders" => ""
      "publishAuthenticationMethod" => "block"
      "playMaximumConnections" => 0
      "playRequireSecureConnection" => false
      "secureTokenSharedSecret" => ""
      "secureTokenUseTEAForRTMP" => false
      "secureTokenIncludeClientIPInHash" => false
      "secureTokenHashAlgorithm" => ""
      "secureTokenQueryParametersPrefix" => ""
      "secureTokenOriginSharedSecret" => ""
      "playIPBlackList" => ""
      "playIPWhiteList" => ""
      "playAuthenticationMethod" => "none"
    ]
    "streamConfig" => array:7 [▼
      "serverName" => "_defaultServer_"
      "streamType" => "default"
      "storageDir" => "${com.wowza.wms.context.VHostConfigHome}/content"
      "createStorageDir" => false
      "storageDirExists" => true
      "keyDir" => "${com.wowza.wms.context.VHostConfigHome}/keys"
      "httpRandomizeMediaName" => false
    ]
    "dvrConfig" => array:12 [▼
      "serverName" => "_defaultServer_"
      "licenseType" => "Trial"
      "inUse" => false
      "dvrEnable" => false
      "windowDuration" => 0
      "storageDir" => "${com.wowza.wms.context.VHostConfigHome}/dvr"
      "archiveStrategy" => "append"
      "dvrOnlyStreaming" => false
      "startRecordingOnStartup" => true
      "dvrEncryptionSharedSecret" => ""
      "dvrMediaCacheEnabled" => false
      "httpRandomizeMediaName" => false
    ]
    "drmConfig" => array:17 [▼
      "serverName" => "_defaultServer_"
      "licenseType" => "Trial"
      "inUse" => false
      "ezDRMUsername" => ""
      "ezDRMPassword" => ""
      "buyDRMUserKey" => ""
      "buyDRMProtectSmoothStreaming" => false
      "buyDRMProtectCupertinoStreaming" => false
      "buyDRMProtectMpegDashStreaming" => false
      "verimatrixProtectCupertinoStreaming" => false
      "verimatrixCupertinoKeyServerIpAddress" => ""
      "verimatrixCupertinoKeyServerPort" => 0
      "verimatrixCupertinoVODPerSessionKeys" => false
      "verimatrixProtectSmoothStreaming" => false
      "verimatrixSmoothKeyServerIpAddress" => ""
      "verimatrixSmoothKeyServerPort" => 0
      "cupertinoEncryptionAPIBased" => false
    ]
    "transcoderConfig" => array:10 [▼
      "serverName" => "_defaultServer_"
      "available" => true
      "licensed" => true
      "licenses" => 1
      "licensesInUse" => 0
      "templates" => array:2 [▼
        "vhostName" => "_defaultVHost_"
        "templates" => array:4 [▼
          0 => array:2 [▼
            "id" => "audioonly"
            "href" => "/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/zaman/transcoder/templates/audioonly"
          ]
          1 => array:2 [▼
            "id" => "transcode-h265"
            "href" => "/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/zaman/transcoder/templates/transcode-h265"
          ]
          2 => array:2 [▼
            "id" => "transcode"
            "href" => "/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/zaman/transcoder/templates/transcode"
          ]
          3 => array:2 [▼
            "id" => "transrate"
            "href" => "/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/zaman/transcoder/templates/transrate"
          ]
        ]
      ]
      "templatesInUse" => "${SourceStreamName}.xml,transrate.xml"
      "profileDir" => "${com.wowza.wms.context.VHostConfigHome}/transcoder/profiles"
      "templateDir" => "${com.wowza.wms.context.VHostConfigHome}/transcoder/templates"
      "createTemplateDir" => false
    ]
    "webRTCConfig" => array:8 [▼
      "serverName" => "_defaultServer_"
      "enablePublish" => false
      "enablePlay" => false
      "enableQuery" => false
      "iceCandidateIpAddresses" => "127.0.0.1,tcp,1935"
      "preferredCodecsAudio" => "opus,pcmu,pcma"
      "preferredCodecsVideo" => "vp8,h264"
      "debugLog" => false
    ]
    "modules" => array:2 [▼
      "serverName" => "_defaultServer_"
      "moduleList" => array:3 [▼
        0 => array:4 [▼
          "description" => "Base"
          "name" => "base"
          "order" => 0
          "class" => "com.wowza.wms.module.ModuleCore"
        ]
        1 => array:4 [▼
          "description" => "Client Logging"
          "name" => "logging"
          "order" => 1
          "class" => "com.wowza.wms.module.ModuleClientLogging"
        ]
        2 => array:4 [▼
          "description" => "FLVPlayback"
          "name" => "flvplayback"
          "order" => 2
          "class" => "com.wowza.wms.module.ModuleFLVPlayback"
        ]
      ]
    ]
  ]
*/ --}} --}}
