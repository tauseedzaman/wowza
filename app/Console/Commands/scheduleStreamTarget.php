<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class scheduleStreamTarget extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scheduleStreamTarget';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'schedule a stream target on a specific time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "this is at ;)";
        return Command::SUCCESS;
    }
}