<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AppStatistics extends Component
{
    public $app;

    public function mount($app)
    {
        $this->app = $app;
    }

    public function render()
    {
        // http://localhost:8087/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/testlive/monitoring/current

        /*$response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->get(env("WOWZA_HOST_URL") . ':8087/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/'.$this->app.'/monitoring/current');
        */
        return view('livewire.app-statistics', [
            // 'app' => $response->collect(),
        ])->layout('layouts.livewire');

    }
}
/*
{
   "serverName": "_defaultServer_",
   "uptime": 0,
   "bytesIn": 0,
   "bytesOut": 0,
   "bytesInRate": 0,
   "bytesOutRate": 0,
   "totalConnections": 0,
   "connectionCount": {
      "WEBM": 0,
      "DVRCHUNKS": 0,
      "RTMP": 0,
      "MPEGDASH": 0,
      "CUPERTINO": 0,
      "SANJOSE": 0,
      "SMOOTH": 0,
      "RTP": 0
   }
}

*/
