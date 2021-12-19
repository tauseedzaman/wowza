<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class StreamStatistics extends Component
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
        // servers/_defaultServer_/vhosts/_defaultVHost_/applications/testlive/instances/_definst_/incomingstreams/myStream/monitoring/current

       $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/'.$this->app.'/instances/_definst_/incomingstreams/'.$this->stream.'/monitoring/current');


        // dd($response->collect());
        return view('livewire.stream-statistics', [
            'stream_details' => $response->collect(),
        ])->layout('layouts.livewire');
    }
}
/*
"serverName" => "_defaultServer_"
    "applicationInstance" => "_definst_"
    "name" => "Aline Nicholson"
    "" => 0
    "" => 0
    "bytesOut" => 0
    "bytesInRate" => 0
    "bytesOutRate" => 0
    "totalConnections" => 0
    "connectionCount" => array:6 [▼
      "RTMP" => 0
      "MPEGDASH" => 0
      "CUPERTINO" => 0
      "SANJOSE" => 0
      "SMOOTH" => 0
      "RTP" => 0
    ]
  ]*/
