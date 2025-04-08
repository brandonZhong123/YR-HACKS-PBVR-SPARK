<x-layout :pageHeading="'Guidance Counsellors'">
    <div class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Available Guidance Counsellors</h2>
            
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Tutor 1 -->
            <div class="bg-white shadow-lg rounded-lg p-4">
                <img src="{{ asset('images/default.png') }}" alt="John Doe" class="w-16 h-16 rounded-full mx-auto">
                <h2 class="text-lg font-semibold text-gray-700 mt-4">John Doe</h2>
                <a href="/tutors/1" class="text-purple-500 hover:underline mt-2 block">View Details</a>
                <a href="/tutors/1/book-session" class="bg-purple-500 text-white py-2 px-4 rounded-full hover:bg-purple-600 mt-4 block text-center">Book Session</a>
            </div>

            <!-- Tutor 2 -->
            <div class="bg-white shadow-lg rounded-lg p-4">
                <img src="{{ asset('images/default.png') }}" alt="Jane Smith" class="w-16 h-16 rounded-full mx-auto">
                <h2 class="text-lg font-semibold text-gray-700 mt-4">Jane Smith</h2>
                <a href="/tutors/2" class="text-purple-500 hover:underline mt-2 block">View Details</a>
                <a href="/tutors/2/book-session" class="bg-purple-500 text-white py-2 px-4 rounded-full hover:bg-purple-600 mt-4 block text-center">Book Session</a>
            </div>

            <!-- Tutor 3 -->
            <div class="bg-white shadow-lg rounded-lg p-4">
                <img src="{{ asset('images/default.png') }}" alt="Alice Johnson" class="w-16 h-16 rounded-full mx-auto">
                <h2 class="text-lg font-semibold text-gray-700 mt-4">Alice Johnson</h2>
                <a href="/tutors/3" class="text-purple-500 hover:underline mt-2 block">View Details</a>
                <a href="/tutors/3/book-session" class="bg-purple-500 text-white py-2 px-4 rounded-full hover:bg-purple-600 mt-4 block text-center">Book Session</a>
            </div>

            <!-- Tutor 4 -->
            <div class="bg-white shadow-lg rounded-lg p-4">
                <img src="{{ asset('images/default.png') }}" alt="Michael Brown" class="w-16 h-16 rounded-full mx-auto">
                <h2 class="text-lg font-semibold text-gray-700 mt-4">Michael Brown</h2>
               
                <a href="/tutors/4" class="text-purple-500 hover:underline mt-2 block">View Details</a>
                <a href="/tutors/4/book-session" class="bg-purple-500 text-white py-2 px-4 rounded-full hover:bg-purple-600 mt-4 block text-center">Book Session</a>
            </div>

        </div>
        <!-- Custom Pagination -->

    </div>
</x-layout>