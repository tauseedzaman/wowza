<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class StreamTarget extends Component
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
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/pushpublish/mapentries/'.$this->stream)->collect();
        dd($response);
        return view('livewire.stream-target', [
            'details' => $response
        ])->layout('layouts.livewire');
    }
}
