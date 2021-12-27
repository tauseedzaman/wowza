<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

    */
class StreamFiles extends Component
{
    public $show_add_streamFiles_form = false;
    public $app;

    public $name;
    public $url;

    public $is_editing = false;


    public function add_streamFile_here()
    {
        if ($this->is_editing) {
            return $this->update_stream($this->name, $this->url);
        }

        $this->validate([
            'name' => "required",
            "url" => "required",
        ]);


        $response = $this->add_wowza_stream_file($this->name, $this->url);

        if ($response->successful()) {
            $this->show_add_streamFiles_form();
            session()->flash('message', 'Stream File Created Successfully.');
            $this->name = '';
            $this->url = '';
        } else {
            $this->show_add_streamFiles_form();
            session()->flash('message', 'Whoops! Something Went Wrong.');
        }
    }
    public function add_wowza_stream_file($name, $url)
    {
        return Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->post(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/streamfiles', [
            "serverName" => "_defaultServer_",
            "uri" => $url,
            "name" => $name,
        ]);
    }

    //show hide form
    public function show_add_streamFiles_form()
    {
        $this->show_add_streamFiles_form = !$this->show_add_streamFiles_form;
    }


    public function delete_server_stream_file($name)
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->delete(env('WOWZA_HOST_FULL_API_URL') . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/streamfiles/' . $name);

        session()->flash('message', $response->collect()['message']);
    }

    // enable stream file
    public function enable_this_stream($name)
    {
        $response =  Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/streamfiles/' . $name . '/actions/enable');
        session()->flash('message', $response->collect()['message']);
    }


    //disable stream file
    public function disable_stream_file($name)
    {
        $response =  Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/streamfiles/' . $name . '/actions/disable');
        session()->flash('message', $response->collect()['message']);
    }

    public function show_add_streamTarget_form()
    {
        $this->show_add_streamTarget_form = !$this->show_add_streamTarget_form;
    }

    public function mount($app)
    {
        $this->app = $app;
    }

    public function render()
    {
        //get all applications stream files
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $this->app . '/streamfiles');
        // dd($response->collect());
        return view('livewire.stream-files', [
            'streamFiles' => $response->collect()
        ])->layout('layouts.livewire');
    }
}
