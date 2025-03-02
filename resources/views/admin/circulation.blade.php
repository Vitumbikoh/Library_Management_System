@extends('admin.layout')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold mb-4 text-gray-800">Manage Circulation</h2>
        <p class="text-lg text-gray-600 mb-8">View and manage book circulation, including borrowed and returned books.</p>

        <!-- Circulation Management Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Issue a Book -->
            <div class="bg-gray-100 p-6 rounded-lg shadow-lg transition transform hover:scale-105 hover:shadow-xl">
                <h3 class="text-xl font-semibold mb-4 text-teal-600">Issue a Book</h3>
                <p class="text-gray-600 mb-4">Lend a book to a member, and track the circulation.</p>
                <a href="{{ route('select-user') }}"
                    class="inline-block bg-teal-600 text-white px-6 py-3 rounded-lg hover:bg-teal-700 transition">
                    Issue Book
                </a>
            </div>

            <!-- Return a Book -->
            <div class="bg-gray-100 p-6 rounded-lg shadow-lg transition transform hover:scale-105 hover:shadow-xl">
                <h3 class="text-xl font-semibold mb-4 text-yellow-600">Return a Book</h3>
                <p class="text-gray-600 mb-4">Process book returns and update the system accordingly.</p>
                <a href="{{ route('select-user-with-loans') }}" class="inline-block bg-yellow-600 text-white px-6 py-3 rounded-lg hover:bg-yellow-700 transition">
                    Return Book
                </a>
            </div>

            <!-- View Borrowing History -->
            <div class="bg-gray-100 p-6 rounded-lg shadow-lg transition transform hover:scale-105 hover:shadow-xl">
                <h3 class="text-xl font-semibold mb-4 text-gray-700">Borrowing History</h3>
                <p class="text-gray-600 mb-4">Track borrowing and return records for each member.</p>
                <a href="" class="inline-block bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition">
                    View History
                </a>
            </div>
        </div>

        <!-- Circulation Records -->
        <div class="mt-12">
            <h3 class="text-2xl font-semibold mb-6 text-gray-800">Current Circulation Records</h3>
            <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="min-w-full bg-white border border-gray-300 text-gray-700">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left border-b">#</th>
                            <th class="py-3 px-4 text-left border-b">Book Title</th>
                            <th class="py-3 px-4 text-left border-b">Borrower</th>
                            <th class="py-3 px-4 text-left border-b">Borrowed Date</th>
                            <th class="py-3 px-4 text-left border-b">Due Date</th>
                            <th class="py-3 px-4 text-left border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                            <tr class="border-b">
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">{{ $loan->book->title }}</td>
                                <td class="py-3 px-4">{{ $loan->user->name }}</td>
                                <td class="py-3 px-4">
                                    {{ $loan->loan_date ? $loan->loan_date->format('Y-m-d') : 'N/A' }}
                                </td>
                                <td class="py-3 px-4">
                                    {{ $loan->due_date ? $loan->due_date->format('Y-m-d') : 'N/A' }}
                                </td>
                                <td class="py-3 px-4
                                          @if ($loan->status == 'Borrowed') text-green-600 @elseif ($loan->status == 'Returned') text-gray-600 @else text-red-600 @endif">
                                    {{ $loan->status }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
