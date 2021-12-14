<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Applications / {{ $app }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"> {{ $app }} Application Details</li>
        </ol>
        <div class="row">
            <div class="col-12 align-between">
                <a href="{{ route('server_streamFiles', $app['id']) }}" class="btn btn-success" type="button">View Stream Files</a>

                <a href="{{ route('server_streamTargets', $app['id']) }}" class="btn btn-info"
                    type="button">View Stream Targets</a>
            </div>
            <table class="table table-light table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Property Name</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
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
                        <td class="text-capitalize">{{ $details['httpOptimizeFileReads'] == false ? 'No' : 'Yes' }}</td>
                    </tr>
                    <tr>
                        <td class="text-capitalize">mediaReaderBufferSeekIO</td>
                        <td class="text-capitalize">{{ $details['mediaReaderBufferSeekIO'] == false ? 'No' : 'Yes' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
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
