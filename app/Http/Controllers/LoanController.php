<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanController extends Controller
{
    /**
     * Display a listing of the loans.
     */
    public function index(): View
    {
        $loans = Loan::with('user', 'book')->paginate(10);

        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new loan.
     */
    public function create()
    {
        $users = User::all();
        $books = Book::all();

        return view('loans.create', compact('users', 'books'));
    }

    /**
     * Store a newly created loan in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:loan_date',
        ]);

        Loan::create($request->all());

        return redirect()->route('loans.index')->with('message', 'Loan created successfully');
    }

    /**
     * Remove the specified loan from storage.
     */
    public function destroy(Loan $loan)
    {
        $loan->delete();

        return redirect()->route('loans.index')
            ->with('message', 'Loan deleted successfully');
    }
}
