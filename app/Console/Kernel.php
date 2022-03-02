<?php

namespace App\Console;

use App\Models\streamTargetSchedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;

class Kernel extends ConsoleKernel
{
    public $input_data;
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $this->input_data = streamTargetSchedule::latest()->first();

        $schedule->call(function () {
            echo "this is at ;)";
        })->when(false);

        if ($this->input_data) {
            $schedule->call(function () {
                echo "starting success....\n\n";
                // send api request to wowza for starting stream
                if (streamTargetSchedule::count()) {
                    $stream = streamTargetSchedule::latest()->first();
                    $this->enable_this_stream($stream->app, $stream->stream);
                }
            })->when(function () {
                return \Carbon\Carbon::createFromFormat('m/d/Y H:i', $this->input_data->start_time->format('m/d/Y H:i'))->isPast();
            });




            if (\Carbon\Carbon::createFromFormat('m/d/Y H:i', $this->input_data->start_time->format('m/d/Y H:i'))->isPast() && \Carbon\Carbon::createFromFormat('m/d/Y H:i', $this->input_data->end_time->format('m/d/Y H:i'))->isPast()) {
                echo "Stoped success....\n\n";
                // delete schedule from the database
                $stream = streamTargetSchedule::latest()->first();
                $this->disable_stream_target($stream->app, $stream->stream);
                $this->input_data->delete();
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
        $response =  Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $app . '/pushpublish/mapentries/' . $name . '/actions/enable');
        return $response;
    }

    public function disable_stream_target($app, $name)
    {
        $response =  Http::accept('application/json')->withHeaders([
            "Accept:application/json; charset=utf-8",
            'Content-Type:application/json; charset=utf-8',
        ])->put(env("WOWZA_HOST_FULL_API_URL") . '/v2/servers/_defaultServer_/vhosts/_defaultVHost_/applications/' . $app . '/pushpublish/mapentries/' . $name . '/actions/disable');
        return $response;
    }
}
