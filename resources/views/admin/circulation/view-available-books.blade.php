@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Available Books</h2>
    <p class="text-gray-700 mb-4">Select a book to issue to {{ $user->name }}.</p>

    <table class="w-full border-collapse border border-gray-300 text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-3 text-left">Book Title</th>
                <th class="border p-3 text-left">Author</th>
                <th class="border p-3 text-left">ISBN</th>
                <th class="border p-3 text-left">Available Quantity</th>
                <th class="border p-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $book->title }}</td>
                    <td class="p-3">{{ $book->author }}</td>
                    <td class="p-3">{{ $book->isbn }}</td>
                    <td class="p-3">{{ $book->quantity_available }}</td>
                    <td class="p-3 text-center">
                        <a href="{{ route('create-loan-form', ['user' => $user->id, 'book' => $book->id]) }}" 
                           class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600">
                            Issue
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
