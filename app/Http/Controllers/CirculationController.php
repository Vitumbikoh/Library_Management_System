<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class CirculationController extends Controller
{
    public function index()
    {
        // Get all loans with related user and book data
        $loans = Loan::with('user', 'book')->where('status', 'Borrowed')->get(); // You can adjust the status if needed

        // Pass the data to the view
        return view('admin.circulation', compact('loans'));
    }

    // Step 1: Show all normal users
    public function showUsers()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.circulation.select-user', compact('users'));
    }

    public function selectUserWithLoans()
    {
        $users = User::whereHas('loans')->get(); // Only users with loans

        return view('admin.circulation.select-user-with-loans', compact('users'));
    }

    // New method to show loaned books for a selected user
    public function viewLoanedBooks(User $user)
    {
        $loans = Loan::where('user_id', $user->id)->with('book')->get(); // Get books loaned by this user

        return view('admin.circulation.view-loan-books', compact('user', 'loans'));
    }

    public function returnBook(Loan $loan)
    {
        // Ensure the loan exists
        if (!$loan) {
            return back()->with('error', 'Loan record not found.');
        }

        // Mark the book as returned
        $loan->status = 'Returned';
        $loan->save();

        return back()->with('success', 'Book returned successfully!');
    }

    public function notifyOverdueMembers()
    {
        // Get users who have overdue books
        $overdueLoans = Loan::with('user')
            ->where('status', 'Overdue')
            ->where('due_date', '<', now())
            ->get();

        if ($overdueLoans->isEmpty()) {
            // Handle the case where no overdue loans exist
            return back()->with('error', 'No overdue loans found.');
        }

        return view('admin.notify', compact('overdueLoans'));

    }

    public function sendReminder(User $user)
    {
        // Example: Send an email notification (requires Mail setup)
        // Mail::to($user->email)->send(new OverdueReminderMail($user));

        return back()->with('success', "Reminder sent to {$user->name}!");
    }

    public function showNotifyPage()
    {
        // Get all overdue loans
        $overdueLoans = Loan::where('status', 'overdue')
            ->with('user') // Assuming you have a relationship between loan and user
            ->get();

        // Pass the overdue loans to the view
        return view('admin.notify', compact('overdueLoans'));
    }



    // Step 2: Show available books after selecting a user
    public function showBooks(User $user)
    {
        $books = Book::where('quantity_available', '>', 0)->get();
        return view('admin.circulation.view-available-books', compact('user', 'books'));
    }

    // Step 3: Show loan form before issuing book
    public function createLoanForm(User $user, Book $book)
    {
        return view('admin.circulation.create-loan-record', compact('user', 'book'));
    }

    // Step 4: Process issuing the book after form submission
    public function issueBook(Request $request, $userId, $bookId)
    {
        $book = Book::find($bookId);
        $user = User::find($userId);

        // Check if the book and user exist
        if (!$book || !$user) {
            return back()->with('error', 'Book or user not found.');
        }

        $loan = new Loan();
        $loan->user_id = $userId;
        $loan->book_id = $bookId;
        $loan->loan_date = now();
        $loan->status = 'borrowed';  // Ensure this value matches the column definition
        $loan->due_date = $request->due_date;
        $loan->save();

        // Redirect to circulation page with a success message
        return redirect()->route('admin.circulation')->with('success', 'Book issued successfully!');
    }



    public function selectUser()
    {
        $users = User::where('role', 'user')->get(); // Get only normal users
        return view('admin.circulation.select-user', compact('users'));
    }

}
