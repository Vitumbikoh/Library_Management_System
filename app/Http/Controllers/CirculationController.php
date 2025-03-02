<?php

namespace App\Http\Controllers;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Report;  
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class CirculationController extends Controller
{
    public function index()
    {
        // Get all loans with related user and book data
        $this->checkOverdueLoans(); // Check and update overdue loans when accessing the circulation page

        // Get all loans with related user and book data
        $loans = Loan::with('user', 'book')
            ->whereIn('status', ['Borrowed', 'Overdue'])
            ->get();

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

    public function selectUserWithLoans(Request $request)
    {
        $query = User::whereHas('loans');

        // Apply search filter
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Set pagination count
        $perPage = $request->get('show', 10);

        $users = $query->paginate($perPage);

        return view('admin.circulation.select-user-with-loans', compact('users'));
    }


    // New method to show loaned books for a selected user
    public function viewLoanedBooks(Request $request, User $user) 
{
    $query = Loan::where('user_id', $user->id)
        ->whereIn('status', ['Borrowed', 'Overdue', 'Returned'])
        ->with('book');

    // Apply search filter
    if ($request->has('search')) {
        $query->whereHas('book', function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%');
        });
    }

    // Paginate results
    $loans = $query->orderBy('loan_date', 'desc')->paginate($request->get('show', 10));

    return view('admin.circulation.view-loan-books', compact('user', 'loans'));
}



    public function returnBook(Loan $loan)
    {
        // Ensure the loan exists
        if (!$loan) {
            return back()->with('error', 'Loan record not found.');
        }

        // Find the book associated with the loan
        $book = Book::find($loan->book_id);

        if ($book) {
            // Increment book quantity by 1
            $book->increment('quantity_available');
        }

        // Mark the book as returned
        $loan->status = 'Returned';
        $loan->save();

        $this->logActivity('Book Returned', "Book '{$book->title}' returned by user ID {$loan->user_id}");

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
        $email = $user->email;
        $message = "You have a loan book that was borrowed. The penalty is K1000/week. Bring it as soon as possible.";

        $loans = Loan::with('user', 'book')
            ->where('status', 'Overdue')
            ->get();

        return view('admin.circulation', compact('loans', 'email', 'message'));
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
    public function showBooks(User $user, Request $request)
    {
        $query = Book::where('quantity_available', '>', 0);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('author', 'like', "%$search%")
                    ->orWhere('isbn', 'like', "%$search%");
            });
        }

        $books = $query->paginate($request->input('show', 10));

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

        // Ensure the book is available
        if ($book->quantity_available <= 0) {
            return back()->with('error', 'Book is not available.');
        }

        // Create a new loan record
        $loan = new Loan();
        $loan->user_id = $userId;
        $loan->book_id = $bookId;
        $loan->loan_date = now();
        $loan->status = 'Borrowed';  // Ensure correct case
        $loan->due_date = $request->due_date;
        $loan->save();

        // Reduce book quantity by 1
        $book->decrement('quantity_available');

        $this->logActivity('Book Issued', "Book '{$book->title}' issued to {$user->name}");

        // Redirect to circulation page with a success message
        return redirect()->route('admin.circulation')->with('success', 'Book issued successfully!');
    }

    public function overdueMembers()
    {
        // Check and update overdue loans when accessing the circulation page
        $this->checkOverdueLoans();

        // Get all loans with related user and book data
        $loans = Loan::with('user', 'book')
            ->whereIn('status', ['Overdue'])
            ->get();

        // Pass the data to the view
        return view('admin.notify', compact('loans'));
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

    public function selectUser(Request $request)
    {
        $query = User::where('role', 'user');

        // Apply search filter
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone_number', 'like', "%$search%");
            });
        }

        // Get pagination limit (default to 10)
        $perPage = $request->input('show', 10);
        $users = $query->paginate($perPage)->appends($request->query());

        return view('admin.circulation.select-user', compact('users'));
    }

    // Method to fetch all reports
    public function getReports()
{
    // Fetch reports from the database
    $reports = Report::all(); // Assuming you have a Report model

    // Pass the reports to the view
    return view('admin.reports.index', compact('reports'));
}

    
    // Method to generate a report as a PDF
    public function generateReport($id)
    {
        // Get the report details
        $report = Report::findOrFail($id);

        // Example: Generate a simple PDF report with the report name and generated date
        $pdf = new Dompdf();
        $pdfOptions = new Options();
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->set('isPhpEnabled', true);
        $pdf->setOptions($pdfOptions);

        $html = view('admin.reports.generate', compact('report'))->render();
        $pdf->loadHtml($html);

        // (Optional) Set paper size (A4)
        $pdf->setPaper('A4', 'portrait');

        // Render PDF
        $pdf->render();

        // Stream the generated PDF
        return $pdf->stream("report-{$report->name}.pdf");
    }
    public function generateNew()
    {
        // Your report generation logic here
        // For example, you might create a new report and save it to the database.
    
        // Redirect to the reports page with a success message.
        return redirect()->route('admin.reports.index')->with('success', 'Report generated successfully!');
    }
        
}
