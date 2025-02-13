<?php

namespace App\Livewire\Books;

use App\Models\Book;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
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

    #[Validate('required|unique:books,isbn')]
    public string $isbn = '';

    #[Validate('required|integer|min:1')]
    public int $quantity_available;

    #[Validate('nullable|max:1000')]
    public string $description = '';

    #[Validate('required|min:3')]
    public string $location = '';

    public function render(): View
    {
        return view('livewire.books.create');
    }

    public function save(): void
    {
        $this->validate();

        Book::create([
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

        session()->flash('message', 'Book created successfully');

        $this->redirectRoute('books.index');
    }
}

