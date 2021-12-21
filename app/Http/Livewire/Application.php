<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Application extends Component
{

    public $app;

    public $webrtc_enablePublish;
    public $webrtc_enablePlay;
    public $webrtc_enableQuery;
    public $webrtc_iceCandidateIpAddresses;
    public $webrtc_preferredCodecsAudio;
    public $webrtc_preferredCodecsVideo;

    public $show_webrtc_settings = false;
    public $show_transcoder_settings = false;

    public $data_for_webrtc_settings;

    public function transcoder()
    {
        $this->show_transcoder_settings = true;
    }

    public function save_webrtc_settings()
    {
        $this->validate([
            'webrtc_enablePublish' => 'required',
            'webrtc_enablePlay' => 'required',
            'webrtc_enableQuery' => 'required',
            'webrtc_iceCandidateIpAddresses' => 'required',
            'webrtc_preferredCodecsAudio' => 'required|string',
            'webrtc_preferredCodecsVideo' => 'required|string',
        ]);

        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app, [
            "webRTCConfig" => [
                "enablePublish" => $this->webrtc_enablePublish,
                "enablePlay" => $this->webrtc_enablePlay,
                "enableQuery" => $this->webrtc_enableQuery,
                "iceCandidateIpAddresses" => $this->webrtc_iceCandidateIpAddresses,
                "preferredCodecsAudio" => $this->webrtc_preferredCodecsAudio,
                "preferredCodecsVideo" => $this->webrtc_preferredCodecsVideo,
            ]
        ]);
        session()->flash('message', $response->collect()['message']);
        //unset all the values
        $this->webrtc_enablePublish = null;
        $this->webrtc_enablePlay = null;
        $this->webrtc_enableQuery = null;
        $this->webrtc_iceCandidateIpAddresses = null;
        $this->webrtc_preferredCodecsAudio = null;
        $this->webrtc_preferredCodecsVideo = null;
        $this->show_webrtc_settings = false;

    }

    public function cancel()
    {
        $this->show_webrtc_settings = !$this->show_webrtc_settings;
        // unset all the values
        $this->webrtc_enablePublish = null;
        $this->webrtc_enablePlay = null;
        $this->webrtc_enableQuery = null;
        $this->webrtc_iceCandidateIpAddresses = null;
        $this->webrtc_preferredCodecsAudio = null;
        $this->webrtc_preferredCodecsVideo = null;
    }


    public function show_webrtc_settings()
    {
        $this->show_webrtc_settings =true;
        // set vlaues for the form
        $this->webrtc_enablePublish = $this->data_for_webrtc_settings['enablePublish'];
        $this->webrtc_enablePlay = $this->data_for_webrtc_settings['enablePlay'];
        $this->webrtc_enableQuery = $this->data_for_webrtc_settings['enableQuery'];
        $this->webrtc_iceCandidateIpAddresses = $this->data_for_webrtc_settings['iceCandidateIpAddresses'];
        $this->webrtc_preferredCodecsAudio = $this->data_for_webrtc_settings['preferredCodecsAudio'];
        $this->webrtc_preferredCodecsVideo = $this->data_for_webrtc_settings['preferredCodecsVideo'];
    }

    public function Restart_App()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/actions/shutdown');
        session()->flash('message', $response->collect()['message']);
    }

    // start the wowza app
    public function Start_App()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/actions/start');
        session()->flash('message', $response->collect()['message']);
    }

    // shutdown app
    public function Shutdown_App()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/actions/shutdown');
        session()->flash('message', $response->collect()['message']);
    }

    public function mount($app)
    {
        $this->app = $app;
    }

    public function enable_transcoder()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app, [
            "transcoderConfig" => [
                "liveStreamTranscoder" => "transcoder",
            ]
        ])->collect();
        $this->Restart_App();
        $this->Start_App();
        return redirect()->route('server_applications')->with('message', 'Transcoder Enabled / Application Restarted');
    }
    public function disable_transcoder()
    {
        Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app, [
            "transcoderConfig" => [
                "liveStreamTranscoder" => "",
            ]
        ])->collect();
        $this->Restart_App();
        $this->Start_App();
        return redirect()->route('server_applications')->with('message', 'Transcoder Disabled / Application Restarted');
    }
    public function render()
    {
        // $transcoder_audioonly_response = Http::accept('application/json')->withHeaders([
        //     "Accept:application/json; charset=utf-8",
        // ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/live/transcoder/templates/audioonly')->collect();
        // dd($response);
        //
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app)->collect();
        // dd($response);
        $this->data_for_webrtc_settings=$response['webRTCConfig'];
        return view('livewire.application', [
            'details' => $response
        ])->layout('layouts.livewire');
    }
}
