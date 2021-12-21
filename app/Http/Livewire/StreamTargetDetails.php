<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class StreamTargetDetails extends Component
{

    public $app;
    public $stream;

    public function mount($app, $stream)
    {
        $this->app = $app;
        $this->stream = $stream;
    }
    public function render()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/pushpublish/mapentries/' . $this->stream)->collect();

        return view('livewire.stream-target-details', [
            'details' => $response,
        ])->layout('layouts.livewire');
    }
}
/*

// Applications / live / Stream Targets
live Stream Targets
Add Stream Target
array:60 [▼
  "entryName" => "Faith Lynch"
  "sessionStatus" => "NotFound"
  "enabled" => true
  "autoStartTranscoder" => false
  "sourceStreamName" => "Sade Holmes"
  "profile" => "rtmp"
  "streamName" => "Kirk Lester"
  "application" => "live"
  "host" => "http://localhost"
  "port" => 1935
  "userName" => "puxuli"
  "password" => "Pa$$w0rd!"
  "adaptiveStreaming" => false
  "sendFCPublish" => true
  "sendReleaseStream" => true
  "sendStreamCloseCommands" => true
  "removeDefaultAppInstance" => true
  "sendOriginalTimecodes" => true
  "originalTimecodeThreshold" => "0x100000"
  "akamai.hdNetwork" => true
  "akamai.sendToBackupServer" => false
  "akamai.destinationServer" => "primary"
  "destinationServer" => "primary"
  "cupertino.renditions" => "audiovideo"
  "http.playlistCount" => 0
  "http.playlistAcrossSessions" => false
  "http.playlistTimeout" => 120000
  "http.fakePosts" => false
  "http.writerDebug" => false
  "streamWaitTimeout" => 5000
  "timeToLive" => 63
  "rtpWrap" => false
  "shoutcast.public" => false
  "icecast2.public" => false
  "srtKeyLength" => 0
  "srtLatency" => 400
  "srtTooLatePacketDrop" => true
  "srtTimestampBasedDeliveryMode" => true
  "srtSendBufferSize" => 12058624
  "srtSendBufferSizeUDP" => 65536
  "srtMaximumSegmentSize" => 1500
  "srtFlightFlagSize" => 25600
  "srtMaximumBandwidth" => -1
  "srtInputBandwidth" => 0
  "srtOverheadBandwidth" => 25
  "srtConnectTimeout" => 3000
  "srtMinimumVersion" => 0
  "srtStreamId" => ""
  "srtKeyRefreshRate" => 16777216
  "srtKeyAnnounce" => 4096
  "srtPeerIdleTimeout" => 5000
  "srtTimesToPrintStats" => 0
  "debugLogChildren" => false
  "debugLog" => false
  "debugPackets" => false
  "sendSSL" => false
  "facebook.useAppSecret" => true
  "facebook.continuousLive" => false
  "facebook.360Projection" => "none"
  "wowzaCloud.adaptiveStreaming" => true
]
#	Application	Source Stream Name	Entry Name	Profile	host & port	UserName & pass	Stream Name	Actions
*/
