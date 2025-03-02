@extends('admin.layout')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Manage Books</h2>

        <x-link-button href="{{ route('books.create') }}"
            class="mb-4 bg-gray-800 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ __('Add New Book') }}
        </x-link-button>

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
                <form action="{{ route('books.index') }}" method="GET" id="search-form">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Search books..." id="search-input">
                    <input type="hidden" name="show" id="show-input" value="{{ request('show', 10) }}">
                </form>
            </div>
        </div>

        <table class="w-full border-collapse border border-gray-300 text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-3 text-left">Book Title</th>
                    <th class="border p-3 text-left">Author</th>
                    <th class="border p-3 text-left">ISBN</th>
                    <th class="border p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $book->title }}</td>
                        <td class="p-3">{{ $book->author }}</td>
                        <td class="p-3">{{ $book->isbn }}</td>
                        <td class="p-3 flex justify-center space-x-3">
                            <a href="{{ route('books.edit', $book) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-between items-center mt-4">
            <p class="text-gray-600">Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }}
                entries</p>
            <div>
                {{ $books->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

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