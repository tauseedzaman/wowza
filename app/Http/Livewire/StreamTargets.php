<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class StreamTargets extends Component
{
    public $show_add_streamTarget_form = false;
    public $app;

    public $userName;
    public $password;
    public $password_confirmation;
    public $entryName;
    public $sourceStreamName;
    public $profile;
    public $streamName;
    public $is_editing = false;

    public function add_user_here()
    {
        if ($this->is_editing) {
            return $this->update_stream();
        }

        $this->validate([
            'userName' => "required",
            "password" => "required|confirmed",
            "entryName" => "required",
            "sourceStreamName" => "required",
            "profile" => "required",
        ]);


        $response = $this->add_stream_target($this->sourceStreamName, $this->entryName, $this->profile, $this->app, $this->userName, $this->password, $this->streamName);

        if ($response->successful()) {
            $this->show_add_streamTarget_form();
            session()->flash('message', $response->collect()['message']);
            unset($this->userName);
            unset($this->password);
            unset($this->password_confirmation);
            unset($this->sourceStreamName);
            unset($this->entryName);
            unset($this->profile);
            unset($this->stramName);
        } else {
            $this->show_add_streamTarget_form();
            session()->flash('message', $response->collect()['message']);
        }
    }

    public function add_stream_target($sourceStreamName, $entryName, $profile, $app, $userName, $password, $streamName)
    {
        return Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->post(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/pushpublish/mapentries/' . $this->entryName, [
            "serverName" => "_defaultServer_",
            "sourceStreamName" => $sourceStreamName,
            "entryName" => $entryName,
            "profile" => $profile,
            "host" => env("WOWZA_HOST_URL"),
            "application" => $app,
            "userName" => $userName,
            "password" => $password,
            "streamName" => $streamName
        ]);
    }


    //edit
    public function edit($name)
    {
        //get form data
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/pushpublish/mapentries/' . $name);

        //now set those valuse to our variables
        $data = $response->collect();
        $this->userName = $data["userName"];
        $this->password = $data["password"];
        $this->password_confirmation = $data["password"];
        $this->entryName = $data["entryName"];
        $this->sourceStreamName = $data["sourceStreamName"];
        $this->profile = $data["profile"];
        $this->streamName = $data["streamName"];

        // show form with old data
        $this->show_add_streamTarget_form();
        $this->is_editing = true;
    }


    //update
    public function update_stream()
    {

        $this->validate([
            'userName' => "required",
            "password" => "required|confirmed",
            "entryName" => "required",
            "sourceStreamName" => "required",
            "streamName" => "required",
            "profile" => "required",
        ]);


        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/pushpublish/mapentries/' . $this->entryName, [
            "sourceStreamName" => $this->sourceStreamName,
            "entryName" => $this->entryName,
            "profile" => $this->profile,
            "host" => env("WOWZA_HOST_URL"),
            "application" => $this->app,
            "userName" => $this->userName,
            "password" => $this->password,
            "streamName" => $this->streamName
        ]);

        if ($response->successful()) {
            $this->show_add_streamTarget_form();
            session()->flash('message', $response->collect()['message']);
            unset($this->userName);
            unset($this->password);
            unset($this->password_confirmation);
            unset($this->sourceStreamName);
            unset($this->entryName);
            unset($this->profile);
            unset($this->stramName);
            $this->is_editing = false;
        } else {
            $this->show_add_streamTarget_form();
            session()->flash('message', $response->collect()['message']);
        }
    }

    public function delete_server_stream($name)
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->delete(env('WOWZA_HOST_FULL_API_URL') . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/pushpublish/mapentries/'.$name);
        if ($response->successful()) {
            session()->flash('message', $response->collect()['message']);
        } else {
            session()->flash('message', $response->collect()['message']);
        }
    }

    public function show_add_streamTarget_form()
    {
        $this->show_add_streamTarget_form = !$this->show_add_streamTarget_form;
    }

    public function mount($app)
    {
        $this->app = $app;
        $this->Enable_Stream_Targets();
        $this->Start_App();


    }

    public function Enable_Stream_Targets()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/adv', [
            "enablePushPublish" => "true"
        ]);
        // dd($response->json());
        /*  [
            // "serverName": "_defaultServer_",
            "advancedSettings"=> [
              [
                "enabled" => true,
                "canRemove"=> false,
                "name"=> "pushPublishMapPath",
                "value"=> "${com.wowza.wms.context.VHostConfigHome}/conf/${com.wowza.wms.context.Application}/PushPublishMap.txt",
                "defaultValue"=> null,
                "type"=> "String",
                "sectionName"=> "Application",
                "section"=> "/Root/Application",
                "documented"=> false
              ]
            ],
            "modules"=> [
              [
                "order"=> 0,
                "name"=> "base",
                "description"=> "Base",
                "class"=> "com.wowza.wms.module.ModuleCore"
              ],
              [
                "order"=> 1,
                "name"=> "logging",
                "description"=> "Client Logging",
                "class"=> "com.wowza.wms.module.ModuleClientLogging"
              ],
              [
                "order"=> 2,
                "name"=> "flvplayback",
                "description"=> "FLVPlayback",
                "class"=> "com.wowza.wms.module.ModuleFLVPlayback"
              ],
              [
                "order"=> 3,
                "name"=> "ModuleCoreSecurity",
                "description"=> "Core Security Module for Applications",
                "class"=> "com.wowza.wms.security.ModuleCoreSecurity"
              ],
              [
                "order"=> 4,
                "name"=> "ModulePushPublish",
                "description"=> "ModulePushPublish",
                "class"=> "com.wowza.wms.pushpublish.module.ModulePushPublish"
              ]
            ]
        ]
    */
    }


    public function Restart_App()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/actions/shutdown');
        if ($response->successful()) {
            session()->flash('message', $response->collect()['message']);
        } else {
            session()->flash('message', $response->collect()['message']);
        }
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

    public function enable_this_stream($name)
    {
        $response =  Http::accept('application/json')->withHeaders([
                    "Accept:application/json; charset=utf-8",
                    'Content-Type:application/json; charset=utf-8',
                ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/pushpublish/mapentries/'.$name.'/actions/enable');
                session()->flash('message', $response->collect()['message']);
    }

    public function disable_stream_target($name)
    {
        $response =  Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/pushpublish/mapentries/'.$name.'/actions/disable');
        session()->flash('message', $response->collect()['message']);
    }

    public function render()
    {
        //get all applications stream targets
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/pushpublish/mapentries');

        return view('livewire.stream-targets', [
            'streamsTargets' => $response->collect()['mapEntries']
        ])->layout('layouts.livewire');
    }
}


// mapentries/rajstreamdemo/actions/enable”
