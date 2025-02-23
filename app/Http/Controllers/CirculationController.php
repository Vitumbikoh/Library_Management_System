<?php

namespace App\Http\Controllers;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Book;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CirculationController extends Controller
{
    public function index()
    {
        // Get all loans with related user and book data
        $this->checkOverdueLoans(); // Check and update overdue loans when accessing the circulation page

        // Get all loans with related user and book data
        $loans = Loan::with('user', 'book')->where('status', 'Borrowed')->get(); // You can adjust the status if needed

        // Pass the data to the view
        return view('admin.circulation', compact('loans'));
    }

    protected function logActivity($action, $description = null)
    {
        ActivityLog::create([
            'user' => auth()->user()->name,  // Assuming you have an authenticated user
            'action' => $action,
            'description' => $description,
        ]);
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
        // Ensure overdue loans are marked correctly
        $this->checkOverdueLoans(); // This will update loans' status to 'Overdue' if necessary.

        // Get overdue loans (status = 'Overdue')
        $overdueLoans = Loan::with('user', 'book')
            ->where('status', 'overdue') // Fetch only overdue loans
            ->get();

        if ($overdueLoans->isEmpty()) {
            return back()->with('error', 'No overdue loans found.');
        }

        $this->logActivity('Overdue Loans Notified', 'Notified users about overdue books');


        // Pass the overdue loans to the view
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
            ->with('user')
            ->with('book')// Assuming you have a relationship between loan and user
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

        $this->logActivity('Book Issued', "Book '{$book->title}' issued to {$user->name}");

        // Redirect to circulation page with a success message
        return redirect()->route('admin.circulation')->with('success', 'Book issued successfully!');
    }

    public function overdueMembers()
    {
        // Ensure overdue loans are marked correctly
        $this->checkOverdueLoans();

        // Get overdue loans with status 'overdue' or due_date passed
        $overdueLoans = Loan::where('status', 'overdue')
            ->orWhere(function ($query) {
                $query->where('due_date', '<', now())
                    ->whereNull('returned_at'); // Ensure loan hasn't been returned
            })
            ->with('user', 'book')
            ->get();

        return view('admin.overdue-members', compact('overdueLoans'));
    }



    public function checkOverdueLoans()
    {
        // Get all loans with a due_date that has passed and status not already 'Returned'
        $overdueLoans = Loan::where('status', '!=', 'Returned') // Exclude returned books
            ->where('due_date', '<', Carbon::now()) // Get loans where due_date is in the past
            ->get();

        foreach ($overdueLoans as $loan) {
            if ($loan->status !== 'overdue') {
                $loan->status = 'overdue';  // Ensure it's set to "Overdue"
                $loan->save();
            }
        }

        return back()->with('success', 'Overdue loans updated successfully!');
    }





    public function selectUser()
    {
        $users = User::where('role', 'user')->get(); // Get only normal users
        return view('admin.circulation.select-user', compact('users'));
    }

}
