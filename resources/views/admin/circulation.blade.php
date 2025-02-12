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
                <a href="" 
                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Issue Book
                </a>
            </div>

            <!-- Return a Book -->
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Return a Book</h3>
                <p class="text-gray-600 mb-2">Process book returns from members.</p>
                <a href="" 
                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Return Book
                </a>
            </div>

            <!-- View Borrowing History -->
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Borrowing History</h3>
                <p class="text-gray-600 mb-2">Track borrowing and return records.</p>
                <a href="" 
                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
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
                        <!-- Example row (Replace with dynamic data) -->
                        <tr class="border-b">
                            <td class="py-2 px-4">1</td>
                            <td class="py-2 px-4">The Great Gatsby</td>
                            <td class="py-2 px-4">John Doe</td>
                            <td class="py-2 px-4">2025-02-01</td>
                            <td class="py-2 px-4">2025-02-15</td>
                            <td class="py-2 px-4 text-green-600">Borrowed</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 px-4">2</td>
                            <td class="py-2 px-4">To Kill a Mockingbird</td>
                            <td class="py-2 px-4">Jane Smith</td>
                            <td class="py-2 px-4">2025-01-28</td>
                            <td class="py-2 px-4">2025-02-10</td>
                            <td class="py-2 px-4 text-red-600">Overdue</td>
                        </tr>
                        <!-- End example row -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
