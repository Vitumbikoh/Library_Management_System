<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index($section = 'dashboard')
    {
        if ($section === 'dashboard') {
            // Get all books count
            $totalBooks = Book::sum('quantity_available');


            // Get borrowed and overdue books count
            $borrowedBooks = Loan::whereIn('status', ['borrowed', 'overdue'])->count();

            // Get returned books count
            $returnedBooks = Loan::where('status', 'returned')->count();

            // Get overdue books count
            $overdueBooks = Loan::where('status', 'overdue')->count();

            // Today's dues (Books due today with book and user details)
            $todayDues = Loan::whereDate('due_date', today())->with(['book', 'user'])->get();


            // Tomorrow's dues (Books due tomorrow with book and user details)
            $tomorrowDues = Loan::whereDate('due_date', today()->addDay())->with(['book', 'user'])->get();

            // Most issued books (Top 5 most issued books with book details)
            $mostIssuedBooks = Loan::select('book_id', DB::raw('count(*) as total'))
                ->groupBy('book_id')
                ->orderByDesc('total')
                ->take(5)
                ->with('book')
                ->get();

            // Books issued till date count
            $booksIssuedTillDate = Loan::count();
            $returnedBooks = Loan::where('status', 'returned')->count();
            $overdueBooks = Loan::where('status', 'overdue')->count();


            // Return the view with data
            return view('admin.dashboard', compact(
                'totalBooks',
                'borrowedBooks',
                'returnedBooks',
                'overdueBooks',
                'todayDues',
                'tomorrowDues',
                'mostIssuedBooks',
                'booksIssuedTillDate'
            ));


        }

        // If a different section is requested, return the layout view
        return view('admin.layout', ['content' => $section]);
    }
}
