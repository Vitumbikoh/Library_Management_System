@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Select a User</h2>
    <p class="text-gray-700 mb-4">Choose a user to issue a book.</p>

    <table class="w-full border-collapse border border-gray-300 text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-3 text-left">Name</th>
                <th class="border p-3 text-left">Email</th>
                <th class="border p-3 text-left">Phone Number</th>
                <th class="border p-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">{{ $user->phone_number }}</td>
                    <td class="p-3 text-center">
                        <a href="{{ route('view-available-books', $user->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600">
                            Issue a Book
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
