<x-app-layout>
    <div class="flex">
        <!-- Left Navigation -->
        <aside class="w-1/5 bg-gray-800 text-white min-h-screen p-4">
            <h3 class="text-lg font-semibold mb-4">Dashboard</h3>
            <ul>
                <li class="mb-2"><a href="{{ route('admin.home') }}" class="block p-2 hover:bg-gray-700">Home</a></li>
                <li class="mb-2"><a href="{{ route('admin.books') }}" class="block p-2 hover:bg-gray-700">Books</a></li>
                <li class="mb-2"><a href="{{ route('admin.circulation') }}" 
                        class="block p-2 hover:bg-gray-700">Circulation</a></li>
                <li class="mb-2"><a href="{{ route('admin.notify') }}" class="block p-2 hover:bg-gray-700">Notify
                        Delayed Members</a></li>
                <li class="mb-2"><a href="{{ route('admin.panel') }}" class="block p-2 hover:bg-gray-700">Admin
                        Panel</a></li>
                <li class="mb-2"><a href="{{ route('admin.settings') }}"
                        class="block p-2 hover:bg-gray-700">Settings</a></li>
                <li class="mb-2"><a href="{{ route('admin.reports') }}" class="block p-2 hover:bg-gray-700">Reports</a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="py-12 w-4/5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Include Dynamic Content Based on the Section -->
                @yield('content')
            </div>
        </div>
    </div>
</x-app-layout>