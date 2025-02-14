@extends('admin.layout')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Notify Delayed Members</h2>
        <p class="text-gray-700 mb-4">Send notifications to members with overdue books.</p>

        <!-- Notification Form -->
        <form action="" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="member_email" class="block text-gray-700 font-medium">Member Email</label>
                <input type="email" id="member_email" name="member_email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter member's email" required>
            </div>

            <div>
                <label for="message" class="block text-gray-700 font-medium">Message</label>
                <textarea id="message" name="message" rows="4"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter notification message" required></textarea>
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Send Notification
                </button>
            </div>
        </form>

        <!-- List of Overdue Members -->
        <!-- List of Overdue Members -->
        <div class="mt-6">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-2 px-4 border-b">#</th>
                            <th class="py-2 px-4 border-b">Member Name</th>
                            <th class="py-2 px-4 border-b">Book Name</th>
                            <th class="py-2 px-4 border-b">Overdue Days</th>
                            <th class="py-2 px-4 border-b">Email</th>
                            <th class="py-2 px-4 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($overdueLoans) && $overdueLoans->count())
                            @foreach ($overdueLoans as $index => $loan)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $index + 1 }}</td>
                                    <td class="py-2 px-4">{{ $loan->user->name }}</td>
                                    <td class="py-2 px-4">{{ $loan->book->title }}</td>
                                    <td class="py-2 px-4">{{ now()->diffInDays($loan->due_date) }} days</td>
                                    <td class="py-2 px-4">{{ $loan->user->email }}</td>
                                    <td class="py-2 px-4">
                                        <!-- Action column can be left empty or used for future features -->
                                        <span class="text-gray-500">-</span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="py-2 px-4 text-center">No overdue loans found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
