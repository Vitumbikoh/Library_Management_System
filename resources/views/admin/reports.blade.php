@extends('admin.layout')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Reports</h2>
        <p class="text-gray-700 mb-4">View and manage system reports here.</p>

        <!-- Sample Report Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4 border-b">#</th>
                        <th class="py-2 px-4 border-b">Report Name</th>
                        <th class="py-2 px-4 border-b">Date Generated</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="py-2 px-4">1</td>
                        <td class="py-2 px-4">Monthly Borrowing Report</td>
                        <td class="py-2 px-4">2025-02-12</td>
                        <td class="py-2 px-4">
                            <a href="#" class="text-blue-500 hover:underline">View</a> |
                            <a href="#" class="text-green-500 hover:underline">Download</a>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 px-4">2</td>
                        <td class="py-2 px-4">Overdue Books Report</td>
                        <td class="py-2 px-4">2025-02-11</td>
                        <td class="py-2 px-4">
                            <a href="#" class="text-blue-500 hover:underline">View</a> |
                            <a href="#" class="text-green-500 hover:underline">Download</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
