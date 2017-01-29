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
        Commands\MailNotification::class,
        Commands\MailSubscriberNotification::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('mail:inactiveUsersNotification')->dailyAt('16:00');
        $schedule->command('mail:subscriberNotification')->dailyAt('16:00');
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
