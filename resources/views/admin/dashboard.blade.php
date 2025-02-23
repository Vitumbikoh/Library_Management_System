@extends('admin.layout')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            <div class="bg-blue-600 text-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <h3 class="text-4xl font-semibold">{{ $totalBooks }}</h3>
                <p class="mt-2 text-xl">Total Books</p>
                <a href="{{ route('admin.books.index') }}"
                    class="mt-4 inline-block bg-blue-700 text-white py-2 px-6 rounded-full hover:bg-blue-800 transition duration-300">
                    More Info
                </a>
            </div>
            <div class="bg-green-600 text-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <h3 class="text-4xl font-semibold">{{ $borrowedBooks }}</h3>
                <p class="mt-2 text-xl">Borrowed Books</p>
                <a href="{{ route('circulation.select-user') }}"
                    class="mt-4 inline-block bg-green-700 text-white py-2 px-6 rounded-full hover:bg-green-800 transition duration-300">
                    Issue a Book
                </a>
            </div>
            <div class="bg-red-600 text-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <h3 class="text-4xl font-semibold">{{ $returnedBooks }}</h3>
                <p class="mt-2 text-xl">Returns</p>
                <a href="{{ route('select-user-with-loans') }}"
                    class="mt-4 inline-block bg-red-700 text-white py-2 px-6 rounded-full hover:bg-red-800 transition duration-300">
                    Return Books
                </a>
            </div>
            <div class="bg-orange-600 text-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <h3 class="text-4xl font-semibold">{{ $overdueBooks }}</h3>
                <p class="mt-2 text-xl">Overdue Books</p>
                <a href="{{ route('admin.notify') }}"
                    class="mt-4 inline-block bg-orange-700 text-white py-2 px-6 rounded-full hover:bg-orange-800 transition duration-300">
                    Follow Up
                </a>
            </div>
        </div>

        <!-- Due Books Section -->
        <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-3xl font-semibold mb-4">Today’s Dues</h3>
            <table class="w-full border-collapse border border-gray-300 rounded-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-4 text-left text-gray-700">Book Name</th>
                        <th class="border p-4 text-left text-gray-700">Borrower Name</th>
                        <th class="border p-4 text-left text-gray-700">Date Borrowed</th>
                        <th class="border p-4 text-left text-gray-700">Contact</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($todayDues as $due)
                        <tr>
                            <td class="border p-4">{{ $due->book->title }}</td>
                            <td class="border p-4">{{ $due->user->name }}</td>
                            <td class="border p-4">{{ $due->created_at->format('d-m-Y') }}</td>
                            <td class="border p-4">{{ $due->user->phone_number }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border p-4 text-center" colspan="4">No Dues for Today</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-3xl font-semibold mb-4">Tomorrow’s Dues</h3>
            <table class="w-full border-collapse border border-gray-300 rounded-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-4 text-left text-gray-700">Book Name</th>
                        <th class="border p-4 text-left text-gray-700">Borrower Name</th>
                        <th class="border p-4 text-left text-gray-700">Date Borrowed</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($tomorrowDues as $due)
                        <tr>
                            <td class="border p-4">{{ $due->book->title }}</td>
                            <td class="border p-4">{{ $due->user->name }}</td>
                            <td class="border p-4">{{ $due->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border p-4 text-center" colspan="3">No Dues for Tomorrow</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Statistics & Charts -->
        <div class="mt-8 flex flex-col lg:flex-row space-y-8 lg:space-y-0 lg:space-x-8">
            <div class="w-full lg:w-2/3 bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-3xl font-semibold mb-6">Most Issued Books</h3>
                <canvas id="booksChart" class="h-80 bg-gray-50 rounded-md shadow-sm"></canvas>
            </div>

            <div class="w-full lg:w-1/3 bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-3xl font-semibold mb-6">Books Issued Till Date</h3>
                <div class="h-80 flex items-center justify-center bg-gray-50 rounded-md">
                    <p class="text-6xl font-bold text-gray-800">{{ $booksIssuedTillDate }}</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Prepare data for the chart
        const labels = @json($mostIssuedBooks->pluck('book.title'));
        const mostIssuedData = @json($mostIssuedBooks->pluck('total'));
        const returnedBooksData = @json($returnedBooks);
        const overdueBooksData = @json($overdueBooks);

        // Create the chart
        const ctx = document.getElementById('booksChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Most Issued Books',
                    data: mostIssuedData,
                    backgroundColor: '#4CAF50', // Green
                    borderColor: '#388E3C',
                    borderWidth: 1
                }, {
                    label: 'Returned Books',
                    data: Array(labels.length).fill(returnedBooksData),
                    backgroundColor: '#FFEB3B', // Yellow
                    borderColor: '#FBC02D',
                    borderWidth: 1
                }, {
                    label: 'Overdue Books',
                    data: Array(labels.length).fill(overdueBooksData),
                    backgroundColor: '#F44336', // Red
                    borderColor: '#D32F2F',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endsection
