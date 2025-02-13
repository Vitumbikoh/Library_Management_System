@extends('admin.layout')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Admin Panel</h2>
        <p class="text-gray-700 mb-4">Manage administrative tasks and user permissions.</p>

        <!-- Admin Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Manage Users -->
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Manage Users</h3>
                <p class="text-gray-600 mb-2">Add, edit, or remove users.</p>
                <a href="" 
                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Go to Users
                </a>
            </div>

            <!-- System Logs -->
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">View System Logs</h3>
                <p class="text-gray-600 mb-2">Monitor system activities.</p>
                <a href="" 
                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    View Logs
                </a>
            </div>

            <!-- Settings -->
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Settings</h3>
                <p class="text-gray-600 mb-2">Modify system configurations.</p>
                <a href="" 
                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Go to Settings
                </a>
            </div>
        </div>
    </div>
@endsection
