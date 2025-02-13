@extends('admin.layout')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Settings</h2>
        <p class="text-gray-700 mb-4">Manage system settings and configurations here.</p>

        <!-- General Settings Form -->
        <form method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="site_name" class="block text-gray-700 font-medium">Site Name</label>
                <input type="text" id="site_name" name="site_name" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    value="{{ old('site_name', 'Library Management System') }}">
            </div>

            <div>
                <label for="admin_email" class="block text-gray-700 font-medium">Admin Email</label>
                <input type="email" id="admin_email" name="admin_email" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    value="{{ old('admin_email', 'admin@example.com') }}">
            </div>

            <div>
                <label for="maintenance_mode" class="block text-gray-700 font-medium">Maintenance Mode</label>
                <select id="maintenance_mode" name="maintenance_mode" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="off" {{ old('maintenance_mode', 'off') == 'off' ? 'selected' : '' }}>Off</option>
                    <option value="on" {{ old('maintenance_mode', 'off') == 'on' ? 'selected' : '' }}>On</option>
                </select>
            </div>

            <div>
                <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
@endsection
