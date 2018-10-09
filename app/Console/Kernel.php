<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\EmailUser::class,
        Commands\ApprovalAttempts::class,
        Commands\Reminder7::class,
        Commands\feedbackReminders::class,
        Commands\feedbackReminders2::class,
        Commands\feedbackReminders3::class,
        Commands\ApprovalAttempts2::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('email:user');
        $schedule->command('reminder:7');
        $schedule->command('approval:reminder');
        $schedule->command('feedback:reminder');
        $schedule->command('feedback2:reminder');
        $schedule->command('feedback3:reminder');
        $schedule->command('approval2:reminder');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
