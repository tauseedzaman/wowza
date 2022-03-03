<?php

namespace App\Console;

use App\Models\streamTargetSchedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;

class Kernel extends ConsoleKernel
{
    public $stream;
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        if (streamTargetSchedule::count()) {
            $streams = streamTargetSchedule::all();

            // loop thro all schedule stream targets and starts them if there time is to start
            foreach ($streams as $this->stream) {
                $schedule->call(function () {
                    $this->enable_this_stream($this->stream->app, $this->stream->stream);
                    // echo "starting success....\n\n";
                })->when(function () {
                    return \Carbon\Carbon::createFromFormat('m/d/Y H:i', $this->stream->start_time->format('m/d/Y H:i'))->isPast();
                });
            }


            // loop thro all schdule stream targets and disable and delete them if there time is expired
            foreach ($streams as $this->stream) {
                $schedule->call(function () {
                    $this->disable_stream_target($this->stream->app, $this->stream->stream);
                    $this->stream->delete();
                    // echo "Stoped success....\n\n";
                })->when(function () {
                    return \Carbon\Carbon::createFromFormat('m/d/Y H:i', $this->stream->start_time->format('m/d/Y H:i'))->isPast() && \Carbon\Carbon::createFromFormat('m/d/Y H:i', $this->stream->end_time->format('m/d/Y H:i'))->isPast();
                });
            }
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     **/
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    public function enable_this_stream($app, $name)
    {
        $reqest = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $app . '/pushpublish/mapentries')->collect()['mapEntries'];

        // check if the stream target is already enabled
        if (!$reqest[0]['enabled']) {
            try {
                Http::accept('application/json')->withHeaders([
                    "Accept:application/json; charset=utf-8",
                    'Content-Type:application/json; charset=utf-8',
                ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $app . '/pushpublish/mapentries/' . $name . '/actions/enable');
            } catch (\Throwable $th) {
                echo $th;
            }
        }
        echo "starting success....\n\n";
    }

    public function disable_stream_target($app, $name)
    {
        $reqest = Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
        ])->get(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $app . '/pushpublish/mapentries')->collect()['mapEntries'];

        // check if the stream target is already disabled
        if ($reqest[0]['enabled']) {
            try {
                Http::accept('application/json')->withHeaders([
                    "Accept:application/json; charset=utf-8",
                    'Content-Type:application/json; charset=utf-8',
                ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $app . '/pushpublish/mapentries/' . $name . '/actions/disable');
            } catch (\Throwable $th) {
                echo $th;
            }
        }
        echo "Stoped success....\n\n";
    }
}
