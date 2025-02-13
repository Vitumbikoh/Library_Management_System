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
                    <a href="{{ route('books.edit', $book) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">Edit</a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
