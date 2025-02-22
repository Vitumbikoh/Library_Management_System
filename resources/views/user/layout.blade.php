<x-app-layout>
    <div class="flex">
        <!-- Left Navigation -->
        <aside class="w-1/5 bg-gray-800 text-white min-h-screen p-4">
            <h3 class="text-lg font-semibold mb-4">Dashboard</h3>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('user.dashboard') }}"
                        class="block p-2 hover:bg-gray-700 {{ request()->routeIs('user.dashboard') ? 'bg-gray-700' : '' }}">
                        Home
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('user.borrowed-books') }}"
                        class="block p-2 hover:bg-gray-700 {{ request()->routeIs('user.borrowed-books') ? 'bg-gray-700' : '' }}">
                        Borrowed Books
                    </a>
                </li>

                <li class="mb-2">
                    <a href="{{ route('user.due-books') }}"
                        class="block p-2 hover:bg-gray-700 {{ request()->routeIs('user.due-books') ? 'bg-gray-700' : '' }}">
                        Due Books
                    </a>
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