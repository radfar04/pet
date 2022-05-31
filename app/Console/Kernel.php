<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\MailController;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('type nul > c:\xampp\php\logs\php_error_log & 
                            type nul > c:\jet\storage\logs\laravel.log &
                            del/f/q C:\xampp\tmp\* & 
                            del/f/q C:\jet\storage\app\livewire-tmp\* & 
                            del/f/q C:\xampp\apache\logs\* ');
        $schedule->command('send:allemails');
        $schedule->command('email:cron');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
