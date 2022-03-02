<?php

use App\Http\Controllers\{
    applicationController,
    streamsController,
    usersController,
};
use App\Http\Livewire\{
    Application,
    Applications,
    AppStatistics,
    ScheduleStreamTarget,
    SingleTranscoder,
    StreamFile,
    StreamFileDetails,
    StreamFiles,
    StreamStatistics,
    StreamTarget,
    StreamTargetDetails,
    StreamTargets,
    TranscodeSettings,
    UserProfile,
    Users,
};
use App\Models\users_roles;
use Illuminate\Support\Facades\Route;





Route::get('/hi-mom',function ()
{
    return "hi mom";
});














Auth::routes();



// get all server users
Route::get('/test', function () {
    $x = App\Models\streamTargetSchedule::create([
         'stream'=> "testStream",
         "start_time" => "2021-12-21 10:37:38",
         "end_time"=> "2021-12-21 10:40:38"
    ]);
    dd($x->start_time->format("m/d/Y H:i:s"));
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('Users', Users::class)->name("server_users");
});

Route::redirect('register', 'login', 301);

Route::middleware(['auth'])->group(function () {
    Route::get('users', function () {
        if (users_roles::where("user_id", auth()->id())->first()->role->name === "Super Admin" || users_roles::where("user_id", auth()->id())->first()->role->name === "Admin") {
            dd(users_roles::find(auth()->id())->role);
        } else {
            dd("NOT allowed");
        }
    });
    Route::get('Applications', Applications::class)->name("server_applications");
    Route::get('My-Profile', UserProfile::class)->name("user_profile");

    Route::get('Applications/{app}', Application::class)->name("server_application");
    Route::get('Applications/{app}/Transcode-Settings', TranscodeSettings::class)->name("server_application_transcode_settings");
    Route::get('Applications/{app}/Transcode-Settings/{transcoder}', SingleTranscoder::class)->name("server_application_single_transcoder");
    Route::get('Applications/{app}/Stream-Targets', StreamTargets::class)->name("server_streamTargets");
    Route::get('Applications/{app}/Stream-Targets/{stream}', StreamTarget::class)->name("server_stream");
    Route::get('Applications/{app}/Stream-Targets/{stream}/Detailed', StreamTargetDetails::class)->name("server_streamTargetDetailed");
    Route::get('Applications/{app}/Stream-Targets/{stream}/Schedule', ScheduleStreamTarget::class)->name("server_streamTarget_schedule");

    Route::get('Applications/{app}/Stream-Files', StreamFiles::class)->name("server_streamFiles");
    Route::get('Applications/{app}/Stream-Files/{file}', StreamFile::class)->name("server_streamFile");
    Route::get('Applications/{app}/Stream-Files/{file}/Detailed', StreamFileDetails::class)->name("server_streamFileDetailed");

    Route::get('Applications/{app}/statistics', AppStatistics::class)->name("server_app_statistics");
});
