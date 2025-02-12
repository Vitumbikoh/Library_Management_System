<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     */
    public function index(): View
    {
        $reservations = Reservation::with('user', 'book')->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create()
    {
        $users = User::all();
        $books = Book::all();

        return view('reservations.create', compact('users', 'books'));
    }

    /**
     * Store a newly created reservation in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'reservation_date' => 'required|date',
        ]);

        Reservation::create($request->all());

        return redirect()->route('reservations.index')->with('message', 'Reservation created successfully');
    }

    /**
     * Remove the specified reservation from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('message', 'Reservation deleted successfully');
    }
}
