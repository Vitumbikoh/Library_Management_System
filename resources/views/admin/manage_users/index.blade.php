@extends('admin.layout')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Manage Users</h2>

        <!-- Search and Rows per Page -->
        <div class="flex justify-between mb-4">
            <form method="GET" action="{{ route('admin.manage_users.index') }}" class="flex gap-2">
                <select name="per_page" onchange="this.form.submit()" class="border rounded-lg p-2 lg:mr-20">
                    @foreach([5, 10, 25, 50] as $size)
                        <option value="{{ $size }}" {{ request()->per_page == $size ? 'selected' : '' }}>
                            {{ $size }} per page
                        </option>
                    @endforeach
                </select>
                <input type="text" name="search" placeholder="Search users..." value="{{ request()->search }}"
                    class="border rounded-lg p-2 w-64 lg:ml-80">

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Search
                </button>
            </form>
        </div>
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif


        <!-- Users Table -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto bg-gray-100 rounded-lg shadow">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 text-left">#</th>
                        <th class="p-2 text-left">Name</th>
                        <th class="p-2 text-left">Email</th>
                        <th class="p-2 text-left">Created At</th>
                        <th class="p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr class="border-t">
                            <td class="p-2">{{ $users->firstItem() + $index }}</td>
                            <td class="p-2">{{ $user->name }}</td>
                            <td class="p-2">{{ $user->email }}</td>
                            <td class="p-2">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="p-2 flex space-x-2">
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


        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
@endsection