@extends('admin.layout')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Select a User</h2>
    <p class="text-gray-700 mb-4">Choose a user to issue a book.</p>

    <ul class="list-disc pl-5">
        @foreach($users as $user)
            <li>
                <a href="{{ route('view-available-books', $user->id) }}" class="text-blue-600 hover:underline">
                    {{ $user->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
