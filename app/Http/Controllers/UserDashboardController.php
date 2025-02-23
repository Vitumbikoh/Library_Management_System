<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
{
    // Get current logged-in user
    $user = auth()->user();

    // Fetch borrowed and due books for the user
    $borrowedBooks = Loan::where('user_id', $user->id)
        ->where('status', 'borrowed')
        ->get();

    $dueBooks = Loan::where('user_id', $user->id)
        ->where('due_date', '<', now())
        ->where('status', 'borrowed')
        ->get();

    // Return layout view with dynamic section content (like dashboard)
    return view('user.dashboard', compact('borrowedBooks', 'dueBooks'));
}

public function showBorrowedBooks()
{
    $user = auth()->user();
    $borrowedBooks = Loan::with('book')
        ->where('user_id', $user->id)
        ->where('status', 'borrowed')
        ->get();

    return view('user.borrowed-books', compact('borrowedBooks'));
}

public function showDueBooks()
{
    $user = auth()->user();
    $dueBooks = Loan::where('user_id', $user->id)
        ->where('due_date', '<', now())
        ->where('status', 'borrowed')
        ->get();

    return view('user.due-books', compact('dueBooks'));
}

}
