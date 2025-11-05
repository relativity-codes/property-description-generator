<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Register custom commands here if needed
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        // No scheduled tasks for this minimal app
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        // Load commands if present
    }
}
