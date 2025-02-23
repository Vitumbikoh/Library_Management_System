@extends('admin.layout')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-lg mx-auto">
    <h2 class="text-2xl font-semibold mb-4 text-center">Create Loan Record</h2>
    
    <p class="text-gray-700 mb-4 text-center">
        Issue <strong>{{ $book->title }}</strong> to <strong>{{ $user->name }}</strong>.
    </p>

    <form action="{{ route('issue-book.store', ['user' => $user->id, 'book' => $book->id]) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Borrowed Date</label>
            <input type="date" name="borrowed_date" value="{{ now()->format('Y-m-d') }}" 
                   class="w-full px-4 py-2 border rounded-lg bg-gray-100 cursor-not-allowed"
                   readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Due Date</label>
            <input type="date" name="due_date" required 
                   class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Confirm & Issue Book
        </button>
    </form>
</div>
@endsection
