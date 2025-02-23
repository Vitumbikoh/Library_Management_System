@extends('admin.layout')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Available Books</h2>
    <p class="text-gray-700 mb-4">Select a book to issue to {{ $user->name }}.</p>

    <ul class="list-disc pl-5">
        @foreach($books as $book)
            <li>
                <a href="{{ route('create-loan-form', ['user' => $user->id, 'book' => $book->id]) }}" 
                   class="text-blue-600 hover:underline">
                    {{ $book->title }} (Available: {{ $book->quantity_available }})
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
