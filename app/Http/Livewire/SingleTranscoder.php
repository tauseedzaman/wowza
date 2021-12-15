<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SingleTranscoder extends Component
{

    public $app;
    public $transcoder;

    public $Encoding_Presets;
    public $Decoding_Presets;
    public $Stream_Name_Groups;

    public function show_Encoding_Presets()
    {
        $this->Encoding_Presets=true;
        $this->Decoding_Presets=false;
        $this->Stream_Name_Groups=false;
    }

    public function show_Decoding_Presets()
    {
        $this->Encoding_Presets=false;
        $this->Decoding_Presets=true;
        $this->Stream_Name_Groups=false;
    }
    public function show_Stream_Name_Groups()
    {
        $this->Encoding_Presets=false;
        $this->Decoding_Presets=false;
        $this->Stream_Name_Groups=true;
    }

    public function mount($app, $transcoder)
    {
        $this->app= $app;
        $this->transcoder= $transcoder;
        $this->show_Encoding_Presets();
    }
    public function render()
    {

         // transrate
         $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/'.$this->app.'/transcoder/templates/'.$this->transcoder)->collect();

        // dd($response);

            return view('livewire.single-transcoder', [
            'data' => $response
            ])->layout('layouts.livewire');
    }
}
