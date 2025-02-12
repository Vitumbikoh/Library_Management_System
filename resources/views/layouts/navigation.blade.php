<nav class="bg-white shadow-md border-b border-gray-200 fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left Side -->
            <div class="flex items-center space-x-4">
                <!-- Logo and System Name -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <x-application-logo class="h-9 w-auto text-gray-800" />
                    <span class="text-lg font-semibold text-gray-800">Library Management System</span>
                </a>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                <!-- User Profile -->
                <div class="relative">
                    <button id="profile-btn" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-6 h-6 rounded-full border border-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14a4 4 0 100-8 4 4 0 000 8zm0 2c-4 0-8 2-8 4h16c0-2-4-4-8-4z" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg py-2 hidden">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Content Below the Navbar -->
<div class="mt-16">
    <!-- The rest of your page content goes here -->
</div>

<script>
    // Get elements
    const profileBtn = document.getElementById('profile-btn');
    const dropdownMenu = document.getElementById('dropdown-menu');

    // Toggle dropdown visibility on button click
    profileBtn.addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent click event from bubbling up
        dropdownMenu.classList.toggle('hidden');
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', function(event) {
        if (!profileBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>
