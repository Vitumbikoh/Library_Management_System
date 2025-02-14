<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Get the current logged-in user
        $user = auth()->user();

        // Fetch all loans for the logged-in user
        $borrowedBooks = Loan::where('user_id', $user->id)
            ->where('status', 'borrowed')
            ->get();

        // Fetch due books for the logged-in user
        $dueBooks = Loan::where('user_id', $user->id)
            ->where('due_date', '<', now())
            ->where('status', 'borrowed')
            ->get();

        return view('user.dashboard', compact('borrowedBooks', 'dueBooks'));
    }
}
