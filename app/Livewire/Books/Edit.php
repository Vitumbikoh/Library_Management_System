<?php

namespace App\Livewire\Books;

use App\Models\Book;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public Book $book;

    #[Validate('required|min:3')]
    public string $title = '';

    #[Validate('required|min:3')]
    public string $author = '';

    #[Validate('required|min:3')]
    public string $publisher = '';

    #[Validate('required|integer|min:1900|max:'.date('Y'))]
    public int $year_of_publication;

    #[Validate('required|min:3')]
    public string $category = '';

    #[Validate('required|unique:books,isbn,' . ($this->book->id ?? 'NULL'))]
    public string $isbn = '';

    #[Validate('required|integer|min:1')]
    public int $quantity_available;

    #[Validate('nullable|max:1000')]
    public string $description = '';

    #[Validate('required|min:3')]
    public string $location = '';

    public function mount(Book $book): void
    {
        $this->book = $book;
        $this->title = $book->title;
        $this->author = $book->author;
        $this->publisher = $book->publisher;
        $this->year_of_publication = $book->year_of_publication;
        $this->category = $book->category;
        $this->isbn = $book->isbn;
        $this->quantity_available = $book->quantity_available;
        $this->description = $book->description;
        $this->location = $book->location;
    }

    public function render(): View
    {
        return view('livewire.books.edit');
    }

    public function save(): void
    {
        $this->validate();

        $this->book->update([
            'title' => $this->title,
            'author' => $this->author,
            'publisher' => $this->publisher,
            'year_of_publication' => $this->year_of_publication,
            'category' => $this->category,
            'isbn' => $this->isbn,
            'quantity_available' => $this->quantity_available,
            'description' => $this->description,
            'location' => $this->location,
        ]);

        session()->flash('message', 'Book updated successfully');

        $this->redirectRoute('books.index');
    }
}
