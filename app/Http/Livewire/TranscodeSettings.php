<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
class TranscodeSettings extends Component
{
    public $app;
    public $show_trans_settings=false;
    public $show_webrtc_settings = false;
    public $show_transcoder_settings = false;
    public $data_for_webrtc_settings;

    public function transcoder()
    {
        $this->show_transcoder_settings = true;
    }

    public function save_webrtc_settings()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app, [
            "webRTCConfig" => [
                "enablePublish" => '',
                "enablePlay" => '',
                "enableQuery" => '',
                "iceCandidateIpAddresses" => '',
                "preferredCodecsAudio" => '',
                "preferredCodecsVideo" => '',
            ]
        ]);
        session()->flash('message', $response->collect()['message']);
        //unset all the values
    }

    public function mount($app)
    {
        $this->app=$app;
    }
    public function render()
    {
        //  $transcoder_audioonly_response = Http::accept('application/json')->withHeaders([
        //     "Accept:application/json; charset=utf-8",
        // ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/live/transcoder/templates')->collect();
        // audioonly
        // $transcoder_audioonly_response = Http::accept('application/json')->withHeaders([
        //     "Accept:application/json; charset=utf-8",
        // ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/live/transcoder/templates/audioonly')->collect();
        // transcode-h265
        // $transcoder_transcode_h265_response = Http::accept('application/json')->withHeaders([
        //     "Accept:application/json; charset=utf-8",
        // ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/live/transcoder/templates/transcode-h265')->collect();

        // transcode
        // $transcoder_transcode_response = Http::accept('application/json')->withHeaders([
        //     "Accept:application/json; charset=utf-8",
        // ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/live/transcoder/templates/transcode')->collect();

        // transrate
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/live/transcoder')->collect();

        // dd($response);

        return view('livewire.transcode-settings', [
            'transcode' => $response
        ])->layout('layouts.livewire');
    }
}
