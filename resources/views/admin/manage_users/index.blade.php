@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Manage Users</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search and Pagination Controls -->
    <div class="flex justify-between items-center mb-4">
        <div class="flex space-x-2">
            <label for="show" class="text-gray-600">Show</label>
            <select id="show" name="per_page"
                class="border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
            </select>
            <span class="text-gray-600">entries</span>
        </div>

        <div class="w-1/3">
            <form action="{{ route('admin.manage_users.index') }}" method="GET" id="search-form">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Search users..." id="search-input">
                <input type="hidden" name="per_page" id="show-input" value="{{ request('per_page', 10) }}">
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-3 text-left">#</th>
                    <th class="border p-3 text-left">Name</th>
                    <th class="border p-3 text-left">Email</th>
                    <th class="border p-3 text-left">Phone Number</th>
                    <th class="border p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $users->firstItem() + $index }}</td>
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3">{{ $user->phone_number ?? 'N/A' }}</td>
                        <td class="p-3 flex space-x-2">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.manage_users.edit', $user->id) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.manage_users.delete', $user->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Info and Links -->
    <div class="flex justify-between items-center mt-4">
        <p class="text-gray-600">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries</p>
        <div>
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
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
