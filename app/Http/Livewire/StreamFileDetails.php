<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class StreamFileDetails extends Component
{
    public $app;
    public $file;

    public function mount($app, $file)
    {
        $this->app = $app;
        $this->file = $file;
    }
    public function render()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->get(env("WOWZA_HOST_URL") . ':8087/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/streamfiles/' . $this->file . '/adv')->collect();

        return view('livewire.stream-file-details', [
            'details' => $response['advancedSettings']
        ])->layout('layouts.livewire');
    }
}
