@extends('admin.layout')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Manage Books</h2>
    <x-link-button href="{{ route('books.create') }}" class="mb-4 bg-blue-500 text-white px-4 py-2 rounded">
        {{ __('Add New Book') }}
    </x-link-button>
    
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Book Title</th>
                <th class="border p-2">Author</th>
                <th class="border p-2">ISBN</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td class="border p-2">{{ $book->title }}</td>
                    <td class="border p-2">{{ $book->author }}</td>
                    <td class="border p-2">{{ $book->isbn }}</td>
                    <td class="border p-2">
                        <a href="{{ route('books.edit', $book) }}" class="bg-green-500 text-white px-2 py-1 rounded">Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $books->links() }}
    </div>
@endsection
