@extends('admin.layout')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Summary Cards -->
        <div class="grid grid-cols-4 gap-4">
            <div class="bg-blue-500 text-white p-4 rounded-lg">
                <h3 class="text-2xl font-semibold">10</h3>
                <p>Books</p>
                <a href="" 
                   class="mt-2 inline-block bg-blue-700 px-4 py-2 rounded hover:bg-blue-800 transition">
                    More info
                </a>
            </div>
            <div class="bg-green-500 text-white p-4 rounded-lg">
                <h3 class="text-2xl font-semibold">17</h3>
                <p>Borrowed Books</p>
                <a href="" 
                   class="mt-2 inline-block bg-green-700 px-4 py-2 rounded hover:bg-green-800 transition">
                    More info
                </a>
            </div>
            <div class="bg-red-500 text-white p-4 rounded-lg">
                <h3 class="text-2xl font-semibold">Return</h3>
                <a href="" 
                   class="mt-2 inline-block bg-red-700 px-4 py-2 rounded hover:bg-red-800 transition">
                    Return
                </a>
            </div>
            <div class="bg-orange-500 text-white p-4 rounded-lg">
                <h3 class="text-2xl font-semibold">Issue</h3>
                <a href="" 
                   class="mt-2 inline-block bg-orange-700 px-4 py-2 rounded hover:bg-orange-800 transition">
                    Issue
                </a>
            </div>
        </div>

        <!-- Due Books Section -->
        <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Today’s Dues</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">Book Name</th>
                        <th class="border p-2">Borrower Name</th>
                        <th class="border p-2">Date Borrowed</th>
                        <th class="border p-2">Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border p-2 text-center" colspan="4">No Dues for Today</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Tomorrow’s Dues</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">Book Name</th>
                        <th class="border p-2">Borrower Name</th>
                        <th class="border p-2">Date Borrowed</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border p-2 text-center" colspan="3">No Dues for Tomorrow</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Statistics & Charts -->
        <div class="mt-6 flex">
            <div class="w-2/3 bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Most Issued Books</h3>
                <div class="h-48 bg-gray-100 flex items-center justify-center">
                    <!-- Placeholder for chart -->
                    <p>Chart goes here</p>
                </div>
            </div>
            <div class="w-1/3 bg-white shadow-sm sm:rounded-lg p-6 ml-4">
                <h3 class="text-xl font-semibold mb-4">Books Issued Till Date</h3>
                <div class="h-48 flex items-center justify-center">
                    <!-- Placeholder for circular chart -->
                    <p class="text-3xl font-bold">26</p>
                </div>
            </div>
        </div>
    </div>
@endsection
