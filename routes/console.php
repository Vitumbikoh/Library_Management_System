<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\UpdateOverdueLoans;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Registering the custom command for updating overdue loans
Artisan::command('loans:update-overdue', function () {
    $this->call(UpdateOverdueLoans::class);  // Call the command that updates overdue loans
})->purpose('Update the status of overdue loans');