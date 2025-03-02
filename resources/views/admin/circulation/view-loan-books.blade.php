@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Loaned Books for {{ $user->name }}</h2>

    @if ($loans->isEmpty())
        <p class="text-red-600">This user has no loaned books.</p>
    @else
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
                <form action="{{ route('view-loaned-books', $user->id) }}" method="GET" id="search-form">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Search loaned books..." id="search-input">
                    <input type="hidden" name="show" id="show-input" value="{{ request('show', 10) }}">
                </form>
            </div>
        </div>

        <!-- Loaned Books Table -->
        <table class="w-full border-collapse border border-gray-300 text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-3 text-left">#</th>
                    <th class="border p-3 text-left">Book Title</th>
                    <th class="border p-3 text-left">Loan Date</th>
                    <th class="border p-3 text-left">Due Date</th>
                    <th class="border p-3 text-left">Status</th>
                    <th class="border p-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $index => $loan)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $loans->firstItem() + $index }}</td>
                        <td class="p-3">{{ $loan->book->title }}</td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($loan->loan_date)->format('Y-m-d') }}</td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($loan->due_date)->format('Y-m-d') }}</td>
                        <td class="p-3">{{ ucfirst($loan->status) }}</td>
                        <td class="p-3 text-center">
                            @if (trim(strtolower($loan->status)) === 'returned')
                                <span class="text-teal-600 font-semibold">Returned</span>
                            @else
                                <form action="{{ route('return-book', $loan->id) }}" method="POST" 
                                    onsubmit="return confirm('Are you sure you want to return this book?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" 
                                        class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-700">
                                        Return Book
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Info and Links -->
        <div class="flex justify-between items-center mt-4">
            <p class="text-gray-600">Showing {{ $loans->firstItem() }} to {{ $loans->lastItem() }} of {{ $loans->total() }} entries</p>
            <div>
                {{ $loans->appends(request()->query())->links() }}
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
