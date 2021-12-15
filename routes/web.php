<?php

use App\Http\Controllers\applicationController;
use App\Http\Controllers\streamsController;
use App\Http\Controllers\usersController;
use App\Http\Livewire\Application;
use App\Http\Livewire\Applications;
use App\Http\Livewire\AppStatistics;
use App\Http\Livewire\SingleTranscoder;
use App\Http\Livewire\StreamFile;
use App\Http\Livewire\StreamFileDetails;
use App\Http\Livewire\StreamFiles;
use App\Http\Livewire\StreamStatistics;
use App\Http\Livewire\StreamTarget;
use App\Http\Livewire\StreamTargetDetails;
use App\Http\Livewire\StreamTargets;
use App\Http\Livewire\TranscodeSettings;
use App\Http\Livewire\Users;
use App\Models\users_roles;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;


// get all server users
Route::get('/test', function () {
    // withBasicAuth('tauseedzaman', 'tauseedzaman')->
    $response = Http::accept('application/json')->withHeaders([
        "Accept:application/json; charset=utf-8",
        'Content-Type:application/json; charset=utf-8',
    ])->get("http://localhost:8087/v2/servers/_defaultServer_");
    dd($response->collect());
    // dd(App\Models\users_roles::find(auth()->id())->role->name === "Super Admin"); //

    //get list of users
    // $response = Http::accept('application/json')->withHeaders([
    //     "Accept:application/json; charset=utf-8",
    //     'Content-Type:application/json; charset=utf-8',
    // ])->get('http://localhost:8087/v2/servers/_defaultServer_/users');

    // app server user api call
    // $response = Http::accept('application/json')->withHeaders([
    //     "Accept:application/json; charset=utf-8",
    //     'Content-Type:application/json; charset=utf-8',
    // ])->post('http://'.env('WOWZA_HOST_URL').':8087/v2/servers/_defaultServer_/users', [
    //     "userName" => "test",
    //     "password" => "test",
    //     "groups" => [
    //         "admin"
    //     ],
    //     "passwordEncoding" => "bcrypt"
    // ]);
    // ])->get('http://139.162.34.167:8087/v2/servers/_defaultServer_/users');

    //get list of applications
    $response = Http::accept('application/json')->withHeaders([
        "Accept:application/json; charset=utf-8",
    ])->get('http://127.0.0.1:8000/json');
    dd($response->body());
    // dd($response->json());
    // dd($response->object());
    // dd($response->collect()->last());
    // dd($response->status());
    // dd($response->ok());
    // dd($response->successful());
    // dd($response->failed());
    // dd($response->serverError());
    // dd($response->clientError());
    // dd($response->header($header));
    // dd($response->headers());
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('Users', Users::class)->name("server_users");
});

Route::redirect('register', 'login', 301);

Route::middleware(['auth'])->group(function () {
    Route::get('users', function () {
        if(users_roles::where("user_id",auth()->id())->first()->role->name === "Super Admin" || users_roles::where("user_id",auth()->id())->first()->role->name === "Admin"){
            dd(users_roles::find(auth()->id())->role);
        }else{
            dd("NOT allowed");
        }
    });
    Route::get('Applications', Applications::class)->name("server_applications");

    Route::get('Applications/{app}', Application::class)->name("server_application");
    Route::get('Applications/{app}/Transcode-Settings', TranscodeSettings::class)->name("server_application_transcode_settings");
    Route::get('Applications/{app}/Transcode-Settings/{transcoder}', SingleTranscoder::class)->name("server_application_single_transcoder");
    Route::get('Applications/{app}/Stream-Targets', StreamTargets::class)->name("server_streamTargets");
    Route::get('Applications/{app}/Stream-Targets/{stream}', StreamTarget::class)->name("server_stream");
    Route::get('Applications/{app}/Stream-Targets/{stream}/Detailed', StreamTargetDetails::class)->name("server_streamTargetDetailed");

    Route::get('Applications/{app}/Stream-Files', StreamFiles::class)->name("server_streamFiles");
    Route::get('Applications/{app}/Stream-Files/{file}', StreamFile::class)->name("server_streamFile");
    Route::get('Applications/{app}/Stream-Files/{file}/Detailed', StreamFileDetails::class)->name("server_streamFileDetailed");

    Route::get('Applications/{app}/statistics', AppStatistics::class)->name("server_app_statistics");

});

Auth::routes();
