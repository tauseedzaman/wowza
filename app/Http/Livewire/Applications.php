<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Applications extends Component
{
    public $name;
    public $appType;
    public $streamType;
    public $description;
    public $show_add_app_form = false;


    public function add_app_here()
    {
        $this->validate([
            'appType' => "required",
            "streamType" => "required",
            "description" => "required",
        ]);


        $response = $this->add_server_application($this->name, $this->appType, $this->description, $this->streamType);

        if ($response->successful()) {
            $this->show_add_app_form();
            session()->flash('message', $response->collect()['message']);
            $this->name='';
            $this->description='';
            $this->streamType='';
            $this->appType='';
        }else{
            $this->show_add_app_form();
            session()->flash('message', $response->collect()['message']);
        }
    }

    public function add_server_application($name, $appType, $description, $streamType)
    {
        return Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->post(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $name, [
            "restURI" => env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $name,
            "name" => $name,
            "appType" => $appType,
            "clientStreamReadAccess" => "*",
            "clientStreamWriteAccess" => "*",
            "description" => $description,
            "streamConfig" => [
                "restURI" => env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $name . '/streamconfiguration',
                "streamType" => $streamType
            ],
        ]);
    }

    public function delete_app($name)
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->delete(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $name);
        session()->flash('message', $response->collect()['message']);
    }

    public function show_add_app_form()
    {
        $this->show_add_app_form = !$this->show_add_app_form;
    }

    public function render()
    {
        // try {
            $response = Http::accept('application/json')->withHeaders([
                "Accept:application/json; charset=utf-8",
            ])->get(env("WOWZA_HOST_FULL_API_URL") .'/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications');
        // } catch (\Throwable $th) {
            // session()->flash('message', $response->collect()['message']);

        // }

        //   dd($response->collect());
        return view('livewire.applications', [
            'apps' => $response->collect() ? :[]
        ])->layout('layouts.livewire');
    }
}
