@extends('admin.layout')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Select a User</h2>
    <p class="text-gray-700 mb-4">Choose a user to view their loaned books.</p>

    @if ($users->isEmpty())
        <p class="text-red-600">No users have loan records.</p>
    @else
        <ul class="list-disc pl-5">
            @foreach($users as $user)
                <li>
                    <a href="{{ route('view-loaned-books', $user->id) }}" class="text-blue-600 hover:underline">
                        {{ $user->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
