<?php

namespace App\Jobs;

use App\Models\streamTargetSchedule;
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


        // connect and disconnect the stream on a schedule time using laravel 8
        // $schedule->command('inspire')->everyMinute();
        // $now = Carbon::now();
        // printf($now);
        // $month = $now->format('F');
        // $year = $now->format('yy');

        // $schedule->job(new SendEmailJob)    ->monthlyOn($fourthFridayMonthly->format('d'), '13:46');


    }
}
