<x-layout :pageHeading="'Book a Session'">
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Book a Session </h1>


        <!-- Booking Form -->
        <form action="{{ route('sessions.random-pending-session.store') }}" method="POST" class="bg-white shadow-lg rounded-lg p-6">
            @csrf

            <!-- Subject Input -->
            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium text-gray-700">Select Courses</label>
                <select name="subject"class="select2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option disabled selected hidden> Pick a course</option>
                    @foreach(App\Models\Course::all() as $course)
                        <option value="{{ $course->code }}"> {{ $course->code }}</option>
                    @endforeach
                </select>
                @error('subject')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

             <!-- Date Input -->
            <div class="mb-4">
                <label for="date" class="block text-gray-700">Date</label>
                <input type="date" id="date" name="date" class="w-full p-2 border border-gray-300 rounded-lg" required>
                @error('date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

             <!-- Start Time Input -->
            <div class="mb-4">
                <label for="start_time" class="block text-gray-700">Start Time</label>
                <input type="time" id="start_time" name="start_time" class="w-full p-2 border border-gray-300 rounded-lg" required>
                @error('start_time')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

             <!-- End Time Input -->
            <div class="mb-4">
                <label for="end_time" class="block text-gray-700">End Time</label>
                <input type="time" id="end_time" name="end_time" class="w-full p-2 border border-gray-300 rounded-lg" required>
                @error('end_time')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

             <!-- Location Input -->
            <div class="mb-4">
                <label for="location" class="block text-gray-700">Location</label>
                <input type="text" id="location" name="location" class="w-full p-2 border border-gray-300 rounded-lg" required>
                @error('location')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-full hover:bg-blue-600">Book Session</button>
        </form>
    </div>


    @include('partials._select2', ['selector' => '#subjects', 'placeholder' => 'Select courses'])
</x-layout>