@extends('admin.dashboard')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Manage Books</h2>
    <button class="mb-4 bg-blue-500 text-white px-4 py-2 rounded">Add New Book</button>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Book Title</th>
                <th class="border p-2">Author</th>
                <th class="border p-2">ISBN</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border p-2">Sample Book</td>
                <td class="border p-2">John Doe</td>
                <td class="border p-2">123456789</td>
                <td class="border p-2">
                    <button class="bg-green-500 text-white px-2 py-1 rounded">Edit</button>
                    <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
