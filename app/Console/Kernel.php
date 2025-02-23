<?php
// app/Console/Kernel.php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Loan;  // Import Loan model
use Carbon\Carbon;    // For date comparisons

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Every hour, check and update overdue books
        $schedule->call(function () {
            // Get all loans where the due date is passed and status is not already 'overdue'
            $overdueLoans = Loan::where('status', '!=', 'overdue')
                                ->where('due_date', '<', Carbon::now())  // Ensure the due date is in the past
                                ->get();

            // Loop through each overdue loan and update status
            foreach ($overdueLoans as $loan) {
                $loan->status = 'overdue';
                $loan->save();
            }
        })->hourly(); // Runs every hour
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
