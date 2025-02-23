@extends('admin.layout')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">System Logs</h2>
        <p class="text-gray-700 mb-4">Monitor all key system activities below.</p>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @elseif($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="overflow-x-auto bg-gray-100 rounded-lg shadow">
            @if(count($logs) > 0)
                <table class="w-full table-auto">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 text-left">#</th>
                            <th class="p-2 text-left">User</th>
                            <th class="p-2 text-left">Action</th>
                            <th class="p-2 text-left">Description</th>
                            <th class="p-2 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $index => $log)
                            <tr class="border-t">
                                <td class="p-2">{{ $index + 1 }}</td>
                                <td class="p-2">{{ $log->user }}</td>
                                <td class="p-2">{{ $log->action }}</td>
                                <td class="p-2 text-sm text-gray-700">{{ $log->description }}</td>
                                <td class="p-2">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500 p-4 text-center">No logs available.</p>
            @endif
        </div>

        <a href="{{ route('admin.dashboard') }}"
            class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
            Back to Admin Panel
        </a>
    </div>
@endsection