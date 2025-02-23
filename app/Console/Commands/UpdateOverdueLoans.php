<?php

namespace App\Console\Commands;

use App\Models\Loan;
use Illuminate\Console\Command;

class UpdateOverdueLoans extends Command
{
    // The name and signature of the console command.
    protected $signature = 'loans:update-overdue';

    // The console command description.
    protected $description = 'Check for overdue loans and update their status to overdue.';

    // Execute the console command.
    public function handle()
    {
        // Get all loans where due_date is less than now and the status is not yet 'overdue'
        $overdueLoans = Loan::where('due_date', '<', now())
            ->where('status', '!=', 'Overdue')
            ->get();

        if ($overdueLoans->isNotEmpty()) {
            foreach ($overdueLoans as $loan) {
                // Update the status to 'Overdue'
                $loan->status = 'Overdue';
                $loan->save();

                // Output to the console for tracking purposes
                $this->info("Loan for Book '{$loan->book->title}' by {$loan->user->name} marked as Overdue.");
            }
        } else {
            $this->info('No overdue loans found.');
        }
    }
}
