<x-app-layout>
    <div class="flex">
        <!-- Left Navigation -->
        <aside class="w-1/5 bg-gray-800 text-white min-h-screen p-4">
            <h3 class="text-lg font-semibold mb-4">User Dashboard</h3>
            <ul>
                <li class="mb-2"><a href="#" class="block p-2 hover:bg-gray-700">Home</a></li>
                <li class="mb-2"><a href="#" class="block p-2 hover:bg-gray-700">My Borrowed Books</a></li>
                <li class="mb-2"><a href="#" class="block p-2 hover:bg-gray-700">Due Books</a></li>
                <li class="mb-2"><a href="#" class="block p-2 hover:bg-gray-700">Profile</a></li>
                <li class="mb-2"><a href="#" class="block p-2 hover:bg-gray-700">Settings</a></li>
            </ul>
        </aside>

        <div class="py-12 w-4/5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">3</h3>
                        <p>Borrowed Books</p>
                    </div>
                    <div class="bg-red-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">1</h3>
                        <p>Due Books</p>
                    </div>
                </div>

                <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">My Borrowed Books</h3>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Book Name</th>
                                <th class="border p-2">Borrow Date</th>
                                <th class="border p-2">Return Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border p-2" colspan="3">No Borrowed Books</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Due Books</h3>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Book Name</th>
                                <th class="border p-2">Due Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border p-2" colspan="2">No Due Books</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
