@extends('admin.layout')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Loaned Books for {{ $user->name }}</h2>

    @if ($loans->isEmpty())
        <p class="text-red-600">This user has no loaned books.</p>
    @else
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">Book Title</th>
                    <th class="py-2 px-4 border">Loan Date</th>
                    <th class="py-2 px-4 border">Due Date</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    <tr>
                        <td class="py-2 px-4 border">{{ $loan->book->title }}</td>
                        <td class="py-2 px-4 border">{{ $loan->loan_date }}</td>
                        <td class="py-2 px-4 border">{{ $loan->due_date }}</td>
                        <td class="py-2 px-4 border">{{ $loan->status }}</td>
                        <td class="py-2 px-4 border">
                            <form action="{{ route('return-book', $loan->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to return this book?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-700">Return Book</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
