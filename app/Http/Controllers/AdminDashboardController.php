<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;



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

    public function viewUsers(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10);

        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })->paginate($perPage);

        return view('admin.manage_users.users', compact('users', 'search', 'perPage'));
    }

    public function getUsers(Request $request)
    {
        $query = User::where('role', 'user');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Pagination with configurable number of rows
        $perPage = $request->input('per_page', 10); // Default 10 rows per page
        $users = $query->paginate($perPage);

        return view('admin.manage_users.index', compact('users'));
    }
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.manage_users.edit', compact('user'));
    }
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.manage_users.index')->with('success', 'User updated successfully.');
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.manage_users.index')->with('success', 'User deleted successfully.');
    }
    public function showLogs()
    {
        $logs = ActivityLog::latest()->get(); // Retrieve logs from the most recent

        return view('admin.system_logs.index', compact('logs'));
    }
    public function showSettings()
    {
        // You can retrieve current settings from a config file or database.
        return view('admin.settings', [
            'site_name' => config('app.name'),
            'admin_email' => config('mail.from.address'),
            'maintenance_mode' => app()->isDownForMaintenance() ? 'on' : 'off',
        ]);
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'admin_email' => 'required|email',
            'maintenance_mode' => 'required|in:on,off',
        ]);

        // Update settings in the config or database (or cache for simplicity)
        Config::set('app.name', $validated['site_name']);
        Config::set('mail.from.address', $validated['admin_email']);

        if ($validated['maintenance_mode'] === 'on') {
            // Put application in maintenance mode
            Artisan::call('down');
        } else {
            // Bring application out of maintenance mode
            Artisan::call('up');
        }

        // Optionally, store the settings in the database or in a configuration file

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');
    }



}
