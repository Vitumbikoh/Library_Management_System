@extends('admin.layout')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Notify Delayed Members</h2>
        <p class="text-gray-700 mb-4">Send notifications to members with overdue books.</p>

        <!-- Notification Form -->
        <form id="notificationForm" class="space-y-4">
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

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg shadow">
                Send Notification
            </button>

            <p id="formStatus" class="text-green-500 font-medium hidden mt-2"></p>
        </form>
    </div>

    <!-- Overdue loans -->
    <div class="mt-12">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">Overdue Members Records</h3>
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full bg-white border border-gray-300 text-gray-700">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left border-b">#</th>
                        <th class="py-3 px-4 text-left border-b">Book Title</th>
                        <th class="py-3 px-4 text-left border-b">Borrower</th>
                        <th class="py-3 px-4 text-left border-b">Borrowed Date</th>
                        <th class="py-3 px-4 text-left border-b">Due Date</th>
                        <th class="py-3 px-4 text-left border-b">Status</th>
                        <th class="py-3 px-4 text-left border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4">{{ $loan->book->title }}</td>
                            <td class="py-3 px-4">{{ $loan->user->name }}</td>
                            <td class="py-3 px-4">{{ $loan->loan_date ? $loan->loan_date->format('Y-m-d') : 'N/A' }}</td>
                            <td class="py-3 px-4">{{ $loan->due_date ? $loan->due_date->format('Y-m-d') : 'N/A' }}</td>
                            <td class="py-3 px-4 @if ($loan->status == 'Borrowed') text-green-600 
                            @elseif ($loan->status == 'Returned') text-gray-600 
                            @else text-red-600 @endif">
                                {{ $loan->status }}
                            </td>
                            <td class="py-3 px-4">
                                <button type="button"
                                    class="notify-btn bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg shadow"
                                    data-email="{{ $loan->user->email }}" data-name="{{ $loan->user->name }}"
                                    data-due="{{ $loan->due_date ? $loan->due_date->format('Y-m-d') : 'N/A' }}">
                                    Notify
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include EmailJS SDK -->
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>
        (function () {
            emailjs.init("CXCM06Khq3wbqv0Eh"); // Replace with your EmailJS Public Key
        })();

        document.addEventListener('DOMContentLoaded', function () {
            const notifyButtons = document.querySelectorAll('.notify-btn');
            const emailInput = document.getElementById('member_email');
            const messageTextarea = document.getElementById('message');
            const form = document.getElementById('notificationForm');
            const formStatus = document.getElementById('formStatus');

            notifyButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const email = this.dataset.email;
                    const name = this.dataset.name;
                    const dueDateStr = this.dataset.due;
                    const dueDate = new Date(dueDateStr);
                    const currentDate = new Date();

                    const timeDiff = currentDate - dueDate;
                    const lateDays = Math.max(Math.floor(timeDiff / (1000 * 60 * 60 * 24)), 0);

                    const message = `Dear ${name},\n\nYou have a loaned book overdue since ${dueDateStr}, and you are ${lateDays} day(s) late. The penalty is K1000/day. Please return it ASAP.`;

                    emailInput.value = email;
                    messageTextarea.value = message;

                    // Scroll to the top of the page after clicking Notify button
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const emailInput = document.getElementById('member_email');  // Corrected ID
                const messageTextarea = document.getElementById('message');
                const memberName = "John Doe";  // Example member name, you can dynamically fetch this

                const memberEmail = emailInput.value;  // Capture the member's email

                const templateParams = {
                    to_name: memberName,  // Recipient name
                    from_name: 'Library System',  // Sender name (Library's system)
                    from_email: 'admin@library.com',  // Sender email (Library's system email)
                    message: messageTextarea.value,  // Message content
                    to_email: memberEmail  // Recipient email
                };

                // Send the email using EmailJS
                emailjs.send('service_bzc7l8r', 'template_atxpoqn', templateParams)
                    .then(() => {
                        formStatus.textContent = '✅ Notification sent successfully!';
                        formStatus.classList.remove('hidden', 'text-red-500');
                        formStatus.classList.add('text-green-500');
                        form.reset();
                    })
                    .catch((error) => {
                        formStatus.textContent = '❌ Failed to send notification. Try again!';
                        formStatus.classList.remove('hidden', 'text-green-500');
                        formStatus.classList.add('text-red-500');
                        console.error('EmailJS Error:', error);
                    });
            });
        });
    </script>
@endsection