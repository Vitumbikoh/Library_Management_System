@extends('admin.layout')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Manage Circulation</h2>
        <p class="text-gray-700 mb-4">View and manage book circulation, including borrowed and returned books.</p>

        <!-- Circulation Management Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Issue a Book -->
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Issue a Book</h3>
                <p class="text-gray-600 mb-2">Lend a book to a member.</p>
                <a href="{{ route('circulation.select-user') }}"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Issue Book
                </a>

            </div>

            <!-- Return a Book -->
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Return a Book</h3>
                <p class="text-gray-600 mb-2">Process book returns from members.</p>
                <a href="{{ route('select-user-with-loans') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Return Book
                </a>
            </div>

            <!-- View Borrowing History -->
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Borrowing History</h3>
                <p class="text-gray-600 mb-2">Track borrowing and return records.</p>
                <a href="" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    View History
                </a>
            </div>
        </div>

        <!-- Circulation Records -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-2">Current Circulation Records</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-2 px-4 border-b">#</th>
                            <th class="py-2 px-4 border-b">Book Title</th>
                            <th class="py-2 px-4 border-b">Borrower</th>
                            <th class="py-2 px-4 border-b">Borrowed Date</th>
                            <th class="py-2 px-4 border-b">Due Date</th>
                            <th class="py-2 px-4 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4">{{ $loan->book->title }}</td>
                                <td class="py-2 px-4">{{ $loan->user->name }}</td>
                                <td class="py-2 px-4">
                                    {{ $loan->loan_date ? $loan->loan_date->format('Y-m-d') : 'N/A' }}
                                </td>
                                <td class="py-2 px-4">
                                    {{ $loan->due_date ? $loan->due_date->format('Y-m-d') : 'N/A' }}
                                </td>

                                <td
                                    class="py-2 px-4
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