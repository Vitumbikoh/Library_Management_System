<?php

namespace App\Http\Controllers;
use App\Models\ActivityLog;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index(Request $request): View
    {
        $query = Book::query();

        // Apply search filter if any
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('isbn', 'like', '%' . $search . '%');
        }

        // Paginate the filtered results
        $books = $query->paginate($request->get('show', 10))->appends($request->query());

        return view('admin.books.index', compact('books'));
    }


    protected function logActivity($action, $description = null)
    {
        ActivityLog::create([
            'user' => auth()->user()->name,  // Assuming you have an authenticated user
            'action' => $action,
            'description' => $description,
        ]);
    }


    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        return view('admin.books.create'); // Update view path
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year_of_publication' => 'required|digits:4',
            'isbn' => 'required|string|unique:books,isbn',
            'quantity_available' => 'required|integer',
            'category' => 'required|string|max:255',
        ]);


        Book::create($request->all());

        $this->logActivity('Book Created', 'Created a new book: ' . $book->title);


        return redirect()->route('books.index')->with('message', 'Book created successfully');
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }


    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year_of_publication' => 'required|digits:4',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'quantity_available' => 'required|integer',
            'category' => 'required|string|max:255',
        ]);

        $book->update($request->all());

        return redirect()->route('admin.books.index')->with('message', 'Book updated successfully');
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        $this->logActivity('Book Deleted', 'Deleted book: ' . $book->title);

        return redirect()->route('books.index')
            ->with('message', 'Book deleted successfully');
    }
}

