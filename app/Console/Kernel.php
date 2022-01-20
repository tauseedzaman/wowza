<?php

namespace App\Console;

use App\Models\streamTargetSchedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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

        if ($this->input_data) {
            $schedule->call(function ()
            {
                    echo "starting success....\n\n";
                    // send api request to wowza for starting stream
            })->when(function (){
                return \Carbon\Carbon::createFromFormat('m/d/Y H:i', $this->input_data->start_time->format('m/d/Y H:i'))->isPast();
            });




            if (\Carbon\Carbon::createFromFormat('m/d/Y H:i', $this->input_data->start_time->format('m/d/Y H:i'))->isPast() && \Carbon\Carbon::createFromFormat('m/d/Y H:i', $this->input_data->end_time->format('m/d/Y H:i'))->isPast()) {
                    echo "Stoped success....\n\n";
                    // delete schedule from the database
                    $this->input_data->delete();

            }


                    $schedule->call(function ()
                    {
                        echo now();
                    })->everyMinute();


                }
            }

    /**
     * Register the commands for the application.
     *
     * @return void
     **/
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
