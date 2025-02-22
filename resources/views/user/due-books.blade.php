@extends('user.layout')

@section('content')
<div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
    <h3 class="text-lg font-semibold mb-4">My Due Books</h3>
    @if ($dueBooks->isEmpty())
        <p>No Due Books</p>
    @else
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Book Name</th>
                    <th class="border p-2">Due Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dueBooks as $loan)
                    <tr>
                        <td class="border p-2">{{ optional($loan->book)->title ?? 'Unknown' }}</td>
                        <td class="border p-2">{{ optional($loan->due_date)->format('d M Y') ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
