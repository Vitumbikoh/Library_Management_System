@extends('user.layout')

@section('content')
    <div class="flex justify-center py-2">
        <div class="w-full max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-blue-500 text-white p-4 rounded-lg">
                    <h3 class="text-lg font-semibold">{{ $borrowedBooks->count() }}</h3>
                    <p>Borrowed Books</p>
                </div>
                <div class="bg-red-500 text-white p-4 rounded-lg">
                    <h3 class="text-lg font-semibold">{{ $dueBooks->count() }}</h3>
                    <p>Due Books</p>
                </div>
            </div>

            <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">My Borrowed Books</h3>
                @if ($borrowedBooks->isEmpty())
                    <p>No Borrowed Books</p>
                @else
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Book Name</th>
                                <th class="border p-2">Borrow Date</th>
                                <th class="border p-2">Return Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($borrowedBooks as $loan)
                                <tr>
                                    <td class="border p-2">{{ $loan->book->title }}</td>
                                    <td class="border p-2">{{ $loan->loan_date->format('d M Y') }}</td>
                                    <td class="border p-2">{{ $loan->due_date->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Due Books</h3>
                @if ($dueBooks->isEmpty())
                    <p>No Due Books</p>
                @else
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Book Name</th>
                                <th class="border p-2">Due Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dueBooks as $loan)
                                <tr>
                                    <td class="border p-2">{{ $loan->book->title }}</td>
                                    <td class="border p-2">{{ $loan->due_date->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
