<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScheduleStreamTarget implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Schedule $schedule)
    {
        // 07/07/2021 10:10:00 get time from the database in this formate and the same for the end date
        //  $schedule->command('your_command_here')->when(function (){
        //     return \Carbon\Carbon::createFromFormat('m/d/Y H:i:s', '07/07/2021 10:10:00')->isPast() && \Carbon\Carbon::createFromFormat('m/d/Y H:i:s', '07/07/2021 10:12:00')->isPast();
        // });

        // connect and disconnect the stream on a schedule time using laravel 8
        $schedule->command('inspire')->hourly();
        // $now = Carbon::now();
        // $month = $now->format('F');
        // $year = $now->format('yy');

        // $schedule->job(new SendEmailJob)    ->monthlyOn($fourthFridayMonthly->format('d'), '13:46');


    }
}
