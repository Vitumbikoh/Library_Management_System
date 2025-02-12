<x-app-layout>
    

    <div class="flex">
        <!-- Left Navigation -->
        <aside class="w-1/5 bg-gray-800 text-white min-h-screen p-4">
            <h3 class="text-lg font-semibold mb-4">Dashboard</h3>
            <ul>
                <li class="mb-2"><a href="#" class="block p-2 hover:bg-gray-700">Home</a></li>
                <li class="mb-2"><a href="#" class="block p-2 hover:bg-gray-700">Books</a></li>
                <li class="mb-2"><a href="#" class="block p-2 hover:bg-gray-700">Circulation</a></li>
                <li class="mb-2"><a href="#" class="block p-2 hover:bg-gray-700">Notify Delayed Members</a></li>
                <li class="mb-2"><a href="#" class="block p-2 hover:bg-gray-700">Admin Panel</a></li>
                <li class="mb-2"><a href="#" class="block p-2 hover:bg-gray-700">Settings</a></li>
                <li class="mb-2"><a href="#" class="block p-2 hover:bg-gray-700">Reports</a></li>
            </ul>
        </aside>

        <div class="py-12 w-4/5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-4 gap-4">
                    <div class="bg-blue-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">10</h3>
                        <p>Books</p>
                        <button class="mt-2 bg-blue-700 px-4 py-2 rounded">More info</button>
                    </div>
                    <div class="bg-green-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">17</h3>
                        <p>Borrowed Books</p>
                        <button class="mt-2 bg-green-700 px-4 py-2 rounded">More info</button>
                    </div>
                    <div class="bg-red-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">Return</h3>
                        <button class="mt-2 bg-red-700 px-4 py-2 rounded">Return</button>
                    </div>
                    <div class="bg-orange-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">Issue</h3>
                        <button class="mt-2 bg-orange-700 px-4 py-2 rounded">Issue</button>
                    </div>
                </div>

                <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Today Dues</h3>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Book Name</th>
                                <th class="border p-2">Borrower Name</th>
                                <th class="border p-2">Date Borrow</th>
                                <th class="border p-2">Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border p-2" colspan="4">No Dues for Today</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Tomorrow Dues</h3>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Book Name</th>
                                <th class="border p-2">Borrower Name</th>
                                <th class="border p-2">Date Borrow</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border p-2" colspan="3">No Dues for Tomorrow</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex">
                    <div class="w-2/3 bg-white shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Most Issued Books</h3>
                        <div class="h-48 bg-gray-100 flex items-center justify-center">
                            <!-- Placeholder for chart -->
                            <p>Chart goes here</p>
                        </div>
                    </div>
                    <div class="w-1/3 bg-white shadow-sm sm:rounded-lg p-6 ml-4">
                        <h3 class="text-lg font-semibold mb-4">Books Issued Till Date</h3>
                        <div class="h-48 flex items-center justify-center">
                            <!-- Placeholder for circular chart -->
                            <p>26</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
