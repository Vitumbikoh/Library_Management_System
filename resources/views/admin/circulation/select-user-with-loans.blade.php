@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Select a User</h2>
    <p class="text-gray-700 mb-4">Choose a user to view their loaned books.</p>

    <!-- Search and Pagination Controls -->
    <div class="flex justify-between items-center mb-4">
        <div class="flex space-x-2">
            <label for="show" class="text-gray-600">Show</label>
            <select id="show" name="show"
                class="border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="5" {{ request('show') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('show') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('show') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('show') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('show') == 100 ? 'selected' : '' }}>100</option>
            </select>
            <span class="text-gray-600">entries</span>
        </div>

        <div class="w-1/3">
            <form action="{{ route('select-user-with-loans') }}" method="GET" id="search-form">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Search users..." id="search-input">
                <input type="hidden" name="show" id="show-input" value="{{ request('show', 10) }}">
            </form>
        </div>
    </div>

    <!-- Users Table -->
    @if ($users->isEmpty())
        <p class="text-red-600">No users have loan records.</p>
    @else
        <table class="w-full border-collapse border border-gray-300 text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-3 text-left">#</th>
                    <th class="border p-3 text-left">Name</th>
                    <th class="border p-3 text-left">Email</th>
                    <th class="border p-3 text-left">Phone Number</th>
                    <th class="border p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $users->firstItem() + $index }}</td>
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3">{{ $user->phone_number }}</td>
                        <td class="p-3 text-center">
                            <a href="{{ route('view-loaned-books', $user->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600">
                                View Loaned Books
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Info and Links -->
        <div class="flex justify-between items-center mt-4">
            <p class="text-gray-600">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries</p>
            <div>
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    @endif
</div>

<!-- JavaScript for Search and Pagination -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const searchForm = document.getElementById('search-form');
        const showSelect = document.getElementById('show');
        const showInput = document.getElementById('show-input');

        searchInput.addEventListener('input', function () {
            searchForm.submit();
        });

        showSelect.addEventListener('change', function () {
            showInput.value = this.value;
            searchForm.submit();
        });
    });
</script>
@endsection