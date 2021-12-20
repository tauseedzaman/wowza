<?php

namespace App\Http\Livewire\Transcoder;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class EncodingPresets extends Component
{

    public $app;
    public $data;
    public $transcoder;



    public function delete()
    {

    }

    public function edit()
    {

    }
    public function mount($app, $data, $transcoder)
    {
        $this->data = $data;
        $this->transcoder =  $transcoder;
        $this->app = $app;
        $this->add_encoding_preset();
    }

    public function add_encoding_preset()
    {
        $response = Http::accept('application/json')->withHeaders([
                "Accept:application/json; charset=utf-8",
                'Content-Type:application/json; charset=utf-8',
                ])->post(env('WOWZA_HOST_FULL_API_URL').'/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/'.$this->app.'/transcoder/templates/audioonly',[
                    "name" => "aac",
                    "enable" => true,
                    "streamName" => "mp4:\${SourceStreamName}_aac",
                    "videoCodec" => "PassThru",
                    "gpuid" => 0,
                    "videoBitrate" => "\${SourceVideoBitrate}",
                    "followSource" => false,
                    "interval" => 0,
                    "width" => 0,
                    "height" => 0,
                    "audioCodec" => "AAC",
                    "audioBitrate" => "48000",
                    "Overlays" => [],
                ]);

        dd($response->collect());








    //     $response = Http::accept('application/json')->withHeaders([
    //     "Accept:application/json; charset=utf-8",
    //     'Content-Type:application/json; charset=utf-8',
    //     ])->post(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/'.$this->app.'/transcoder/templates',[
    //         "name" => "80p",
    //         "enable" => false,
    //         "streamName" => "mp4:$\{SourceStreamName\}_1080p",
    //         "videoCodec" => "H.265",
    //         "implementation" => "Beamr",
    //         "gpuid" => -1,
    //         "profile" => "main",
    //         "videoBitrate" => "4500000",
    //         "followSource" => false,
    //         "interval" => 60,
    //         "fitMode" => "letterbox",
    //         "width" => 1920,
    //         "height" => 1080,
    //         "audioCodec" => "AAC",
    //         "audioBitrate" => "96000",
    //         "Overlays" =>[
    //           [
    //             "overlayName" => "WowzaLogoo",
    //             "enable" => false,
    //             "imagePath" => "$\{com.wowza.wms.context.VHostConfigHome\}/content/wowzalogo.png",
    //             "index" => 0,
    //             "checkForUpdates" => false,
    //             "opacity" => 100,
    //             "x" => 4,
    //             "y" => 4,
    //             "width" => "$\{ImageWidth\}",
    //             "height" => "$\{ImageHeight\}",
    //             "align" => "left,top",
    //         ]
    //       ]
    // ]);
    // dd($response->collect());
    }
    public function render()
    {
        $response =  $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/'.$this->app.'/transcoder/templates/'.$this->transcoder)->collect();
            dd($response);
        return view('livewire.transcoder.encoding-presets', [
            'data' => $this->data,
        ]);
    }
}
/*
 $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/'.$this->app.'/transcoder/templates/'.$this->transcoder)->collect();


        */
