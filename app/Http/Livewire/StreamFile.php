<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class StreamFile extends Component
{
    public $app;
    public $file;
    public $url;
    public $edited_url;
    public $show_edit_streamFile_form = false;



    public $connected;

    //edit
    public function edit()
    {
            $this->show_edit_streamFile_form();
            $this->edited_url = $this->url;
            $this->is_editing = true;
    }

    //show hide form
    public function show_edit_streamFile_form()
    {
        $this->show_edit_streamFile_form = !$this->show_edit_streamFile_form;
    }

    public function update()
    {
        $this->validate([
            "url" => "required",
        ]);

        $this->update_stream($this->edited_url);
    }

    //update at
    public function update_stream($url)
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . ':/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/streamfiles/' . $this->file, [
            "uri" => $url,
        ]);

        if ($response->successful()) {
            $this->show_edit_streamFile_form();
            session()->flash('message', 'Stream URL Updated Successfully.');
            unset($this->name);
            unset($this->url);
            $this->is_editing = false;
        } else {
            $this->show_edit_streamFile_form();
            session()->flash('message', 'Whoops: Something Went Wrong.');
        }
    }



    //connect a stream file
    public function connect()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->post(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/streamfiles/' . $this->file . '/actions/connect?connectAppName=/' . $this->app . '&appInstance=_definst_&mediaCasterType=rtp');
            dd($response->collect());
        if ($response->successful()) {
            session()->flash('message', '' . $this->file . ' Connected Successfully.');
        } else {
            session()->flash('message', 'Whoops! Something Went Wrong.');
        }
    }

    // disconnect
    public function disconnect()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->post(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/instances=_definst_/incomingstreams/' . $this->file . '.stream/actions/disconnectStream');

        if ($response->successful()) {
            session()->flash('message', '' . $this->file . ' Disconnected Successfully.');
        } else {
            session()->flash('message', 'Whoops! Something Went Wrong.');
        }
    }

    public function mount($app, $file)
    {
        $this->app = $app;
        $this->file = $file;
    }

    public function render()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/streamfiles/' . $this->file.'/adv')->collect();
            // $this->url = $response["uri"];
        dd($response);
        return view('livewire.stream-file', [
            'details' => $response,
        ])->layout('layouts.livewire');
    }
}
/*
Illuminate\Support\Collection {#1377 ▼
  #items: array:3 [▼
    "version" => "1639280842383"
    "serverName" => "_defaultServer_"
    "advancedSettings" => array:73 [▼
      0 => array:9 [▼
        "enabled" => true
        "canRemove" => true
        "name" => "uri"
        "value" => "https://www.jysocemigelugaq.me"
        "defaultValue" => null
        "type" => "String"
        "sectionName" => "Common"
        "section" => null
        "documented" => true
      ]
      1 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "streamTimeout"
        "value" => "0"
        "defaultValue" => "12000"
        "type" => "Integer"
        "sectionName" => "Common"
        "section" => null
        "documented" => true
      ]
      2 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "reconnectWaitTime"
        "value" => "0"
        "defaultValue" => "3000"
        "type" => "Integer"
        "sectionName" => "Common"
        "section" => null
        "documented" => true
      ]
      3 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "igmpV3IPV4SourceAddress"
        "value" => null
        "defaultValue" => "0.0.0.0"
        "type" => "String"
        "sectionName" => "Common"
        "section" => null
        "documented" => true
      ]
      4 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsAudioPID"
        "value" => null
        "defaultValue" => ""
        "type" => "String"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      5 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsVideoPID"
        "value" => null
        "defaultValue" => ""
        "type" => "String"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      6 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsProgramID"
        "value" => null
        "defaultValue" => ""
        "type" => "String"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      7 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsAudioLanguage"
        "value" => null
        "defaultValue" => ""
        "type" => "String"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      8 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsAudioBitrate"
        "value" => "0"
        "defaultValue" => "0"
        "type" => "Integer"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      9 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsVideoBitrate"
        "value" => "0"
        "defaultValue" => "0"
        "type" => "Integer"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      10 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsAudioIsAligned"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      11 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsVideoIsAligned"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      12 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsAdjustBFrameTimecodes"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      13 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsDropIncompleteVideoFrames"
        "value" => "false"
        "defaultValue" => "true"
        "type" => "Boolean"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      14 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsLogIncompleteVideoFrames"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      15 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsMapTimeToSystemTime"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      16 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsMapTimeToSystemTimeWindow"
        "value" => "0"
        "defaultValue" => "2000"
        "type" => "Integer"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      17 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtsImportAC3"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "MPEG-TS"
        "section" => null
        "documented" => true
      ]
      18 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "rtpTransportMode"
        "value" => null
        "defaultValue" => "interleave"
        "type" => "String"
        "sectionName" => "RTSP"
        "section" => null
        "documented" => true
      ]
      19 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "rtspValidationFrequency"
        "value" => "0"
        "defaultValue" => "15000"
        "type" => "Integer"
        "sectionName" => "RTSP"
        "section" => null
        "documented" => true
      ]
      20 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "rtspFilterUnknownTracks"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "RTSP"
        "section" => null
        "documented" => true
      ]
      21 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "rtspStreamAudioTrack"
        "value" => "false"
        "defaultValue" => "true"
        "type" => "Boolean"
        "sectionName" => "RTSP"
        "section" => null
        "documented" => true
      ]
      22 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "rtspStreamVideoTrack"
        "value" => "false"
        "defaultValue" => "true"
        "type" => "Boolean"
        "sectionName" => "RTSP"
        "section" => null
        "documented" => true
      ]
      23 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "rtspDebugSession"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "RTSP"
        "section" => null
        "documented" => true
      ]
      24 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "rtpIgnoreProfileLevelId"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "RTSP"
        "section" => null
        "documented" => true
      ]
      25 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "rtpIgnoreSPropParameterSets"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "RTSP"
        "section" => null
        "documented" => true
      ]
      26 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "rtspBindIpAddress"
        "value" => null
        "defaultValue" => ""
        "type" => "String"
        "sectionName" => "RTSP"
        "section" => null
        "documented" => true
      ]
      27 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "rtspRemoveUserInfo"
        "value" => "false"
        "defaultValue" => "true"
        "type" => "Boolean"
        "sectionName" => "RTSP"
        "section" => null
        "documented" => true
      ]
      28 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "rtspSessionTimeout"
        "value" => "0"
        "defaultValue" => "8000"
        "type" => "Integer"
        "sectionName" => "RTSP"
        "section" => null
        "documented" => true
      ]
      29 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "rtspConnectionTimeout"
        "value" => "0"
        "defaultValue" => "8000"
        "type" => "Integer"
        "sectionName" => "RTSP"
        "section" => null
        "documented" => true
      ]
      30 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "lsrSecureTokenOriginSharedSecret"
        "value" => null
        "defaultValue" => ""
        "type" => "String"
        "sectionName" => "LiveStreamRepeater"
        "section" => null
        "documented" => true
      ]
      31 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "lsrCallFCSubscribe"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "LiveStreamRepeater"
        "section" => null
        "documented" => true
      ]
      32 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "lsrRemoveDefaultAppInstance"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "LiveStreamRepeater"
        "section" => null
        "documented" => true
      ]
      33 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "lsrResetOnStreamNotFound"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "LiveStreamRepeater"
        "section" => null
        "documented" => true
      ]
      34 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "shoutcastCharacterEncoding"
        "value" => null
        "defaultValue" => "8859_1"
        "type" => "String"
        "sectionName" => "SHOUTcast-Icecast"
        "section" => null
        "documented" => true
      ]
      35 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "shoutcastMP3GroupCount"
        "value" => "0"
        "defaultValue" => "1"
        "type" => "Integer"
        "sectionName" => "SHOUTcast-Icecast"
        "section" => null
        "documented" => true
      ]
      36 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "shoutcastAACGroupCount"
        "value" => "0"
        "defaultValue" => "1"
        "type" => "Integer"
        "sectionName" => "SHOUTcast-Icecast"
        "section" => null
        "documented" => true
      ]
      37 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "shoutcastSourceHostName"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "SHOUTcast-Icecast"
        "section" => null
        "documented" => true
      ]
      38 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "shoutcastSetTimecodesBasedOnSystemClock"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "SHOUTcast-Icecast"
        "section" => null
        "documented" => true
      ]
      39 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtKeyLength"
        "value" => "0"
        "defaultValue" => "0"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      40 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtPassPhrase"
        "value" => null
        "defaultValue" => ""
        "type" => "String"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      41 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtKeyRefreshRate"
        "value" => "0"
        "defaultValue" => "16777216"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      42 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtKeyAnnounce"
        "value" => "0"
        "defaultValue" => "4096"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      43 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtLatency"
        "value" => "0"
        "defaultValue" => "400"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      44 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtTooLatePacketDrop"
        "value" => "false"
        "defaultValue" => "true"
        "type" => "Boolean"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      45 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtTimestampBasedDeliveryMode"
        "value" => "false"
        "defaultValue" => "true"
        "type" => "Boolean"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      46 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtMaximumSegmentSize"
        "value" => "0"
        "defaultValue" => "1500"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      47 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtFlightFlagSize"
        "value" => "0"
        "defaultValue" => "25600"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      48 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtMaximumBandwidth"
        "value" => "0"
        "defaultValue" => "-1"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      49 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtInputBandwidth"
        "value" => "0"
        "defaultValue" => "0"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      50 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtOverheadBandwidth"
        "value" => "0"
        "defaultValue" => "25"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      51 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtSendNakReports"
        "value" => "false"
        "defaultValue" => "true"
        "type" => "Boolean"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      52 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtPacketLossTolerance"
        "value" => "0"
        "defaultValue" => "0"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      53 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtReconnectWaitTime"
        "value" => "0"
        "defaultValue" => "3000"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      54 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtReceiveBufferSize"
        "value" => "0"
        "defaultValue" => "12058624"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      55 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtReceiveBufferSizeUDP"
        "value" => "0"
        "defaultValue" => "12288000"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      56 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtTimesToPrintStats"
        "value" => "0"
        "defaultValue" => "0"
        "type" => "Integer"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      57 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "srtDebug"
        "value" => "false"
        "defaultValue" => "false"
        "type" => "Boolean"
        "sectionName" => "SRT"
        "section" => null
        "documented" => true
      ]
      58 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "cupertinoManifestLimit"
        "value" => "0"
        "defaultValue" => "-1"
        "type" => "Integer"
        "sectionName" => "CupertinoHLS"
        "section" => null
        "documented" => true
      ]
      59 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "cupertinoManifestIndex"
        "value" => null
        "defaultValue" => ""
        "type" => "String"
        "sectionName" => "CupertinoHLS"
        "section" => null
        "documented" => true
      ]
      60 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "cupertinoRestGroupOnSingleFailure"
        "value" => "false"
        "defaultValue" => "true"
        "type" => "Boolean"
        "sectionName" => "CupertinoHLS"
        "section" => null
        "documented" => true
      ]
      61 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "cupertinoAutoSegmentBuffer"
        "value" => "false"
        "defaultValue" => "true"
        "type" => "Boolean"
        "sectionName" => "CupertinoHLS"
        "section" => null
        "documented" => true
      ]
      62 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "cupertinoManifestBufferBlockCount"
        "value" => "0"
        "defaultValue" => "2"
        "type" => "Integer"
        "sectionName" => "CupertinoHLS"
        "section" => null
        "documented" => true
      ]
      63 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "cupertinoManifestMaxBufferBlockCount"
        "value" => "0"
        "defaultValue" => "15"
        "type" => "Integer"
        "sectionName" => "CupertinoHLS"
        "section" => null
        "documented" => true
      ]
      64 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "cupertinoAutoSegmentBufferTime"
        "value" => "0"
        "defaultValue" => "30000"
        "type" => "Integer"
        "sectionName" => "CupertinoHLS"
        "section" => null
        "documented" => true
      ]
      65 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "cupertinoChunkMaxDurationAllowed"
        "value" => "0"
        "defaultValue" => "30000"
        "type" => "Integer"
        "sectionName" => "CupertinoHLS"
        "section" => null
        "documented" => true
      ]
      66 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "cupertinoPacketDeliveryTime"
        "value" => "0"
        "defaultValue" => "200"
        "type" => "Integer"
        "sectionName" => "CupertinoHLS"
        "section" => null
        "documented" => true
      ]
      67 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "mpegtstcpSourceHostName"
        "value" => "false"
        "defaultValue" => "true"
        "type" => "Boolean"
        "sectionName" => "MPEG-TSOverTCP"
        "section" => null
        "documented" => true
      ]
      68 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "sourceControlConnectionTimeout"
        "value" => "0"
        "defaultValue" => "1000"
        "type" => "Integer"
        "sectionName" => "SourceControl"
        "section" => null
        "documented" => true
      ]
      69 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "sourceControlReadWriteTimeout"
        "value" => "0"
        "defaultValue" => "3000"
        "type" => "Integer"
        "sectionName" => "SourceControl"
        "section" => null
        "documented" => true
      ]
      70 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "sourceControlSessionTimeout"
        "value" => "0"
        "defaultValue" => "10000"
        "type" => "Integer"
        "sectionName" => "SourceControl"
        "section" => null
        "documented" => true
      ]
      71 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "sourceControlImageRefreshRate"
        "value" => "0"
        "defaultValue" => "2000"
        "type" => "Integer"
        "sectionName" => "SourceControl"
        "section" => null
        "documented" => true
      ]
      72 => array:9 [▼
        "enabled" => false
        "canRemove" => true
        "name" => "sourceControlImageRefreshMinimumRate"
        "value" => "0"
        "defaultValue" => "1000"
        "type" => "Integer"
        "sectionName" => "SourceControl"
        "section" => null
        "documented" => true
      ]
    ]
  ]
  #escapeWhenCastingToString: false
}
*/
