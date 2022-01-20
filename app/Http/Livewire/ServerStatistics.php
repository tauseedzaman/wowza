<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ServerStatistics extends Component
{
    public function render()
    {
        // (http://[wowza-ip-address]:8086/connectioncounts).
        // $response = Http::accept('application/json')->withHeaders([
        //     "Accept:application/json; charset=utf-8",
        // ])->get(env("WOWZA_HOST_URL") . ':8086/connectioncounts');
        // dd($response->collect());
        return view('livewire.server-statistics');
    }
}
// /*http://localhost:8087/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/live/instances/_definst_/incomingstreams/STREAMNAME/monitoring/current
// /*
