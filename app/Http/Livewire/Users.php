<?php

namespace App\Http\Livewire;

use App\Models\role;
use App\Models\User;
use App\Models\users_roles;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Users extends Component
{
    public $show_add_user_form = false;
    public $userName;
    public $password;
    public $password_confirmation;
    public $role;
    public $thisrole = [];


    public $advnc;

    public function add_user_here()
    {
        $this->validate([
            'userName' => "required",
            "password" => "required|confirmed",
            "role" => "required",
        ]);


        if ($this->role == 1) {
            $this->thisrole = "admin";
        } elseif ($this->role == 2) {

            $this->thisrole[] = "admin";
            $this->thisrole[] = "advUser";
        } elseif ($this->role == 3) {

            $this->thisrole[] = "basic";
            $this->thisrole[] = "advUser";
        } elseif ($this->role == 4) {

            $this->thisrole[] = "basic";
        }

        $response = $this->add_wowza_server_user($this->userName, $this->password, $this->thisrole);

        if ($response->successful()) {
            $user = User::create([
                'name' => $this->userName,
                'username' => $this->userName,
                'password' => bcrypt($this->password),
            ]);
            users_roles::create([
                'user_id' => $user->id,
                'role_id' => $this->role,
            ]);

            $this->show_add_user_form();
            session()->flash('message', 'User Created Successfully.');
            unset($this->userName);
            unset($this->password);
            unset($this->thisrole);
            unset($this->password_confirmation);
        } else {
            $this->show_add_user_form();
            session()->flash('message', 'Woops: Somethign Went Wrong!.');
        }
    }

    public function add_wowza_server_user($userName, $password, $thisrole)
    {
        return Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->post(env("WOWZA_HOST_URL") . ':8087/v2/servers/_defaultServer_/users', [
            "userName" => $userName,
            "password" => $password,
            "groups" => $thisrole,
            "passwordEncoding" => "bcrypt"
        ]);
    }

    public function delete_server_user($name)
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->delete(env("WOWZA_HOST_URL") . ':8087/v2/servers/_defaultServer_/users/' . $name);
        if ($response->successful()) {
            $user = User::where('username', $this->userName)->first();
            if ($user) {
                $role = users_roles::find($user->id);
                if ($role) {
                    $role->delete();
                    $user->delete;
                }
            }
            session()->flash('message', 'User Deleted Successfully.');
        } else {
            session()->flash('message', 'Something Went Wrong.');
        }
    }

    public function show_add_user_form()
    {
        $this->show_add_user_form = !$this->show_add_user_form;;
    }

    public function render()
    {
        $response = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->get(env("WOWZA_HOST_URL") . ':8087/v2/servers/_defaultServer_/users');

        return view('livewire.users', [
            'users' => $response->collect(),
            'roles' => role::all()
        ])->layout('layouts.livewire');
    }
}
