<x-layout :pageHeading="'Book a Session'">
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Book a Session with {{ $tutor->user->first_name }}</h1>
        <p class="text-gray-600 mb-4">Availability: {{ $tutor->availability }}</p>

        <!-- Display Tutor's Sessions -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Scheduled Sessions</h2>
            @if($sessions->isEmpty())
                <p class="text-gray-600">No sessions scheduled.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                 <!-- Table headers -->
                                <th class="py-2 px-4 border-b">Status</th>
                                <th class="py-2 px-4 border-b">Subject</th>
                                <th class="py-2 px-4 border-b">Date</th>
                                <th class="py-2 px-4 border-b">Start Time</th>
                                <th class="py-2 px-4 border-b">End Time</th>
                                <th class="py-2 px-4 border-b">Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Display each session as a table row -->
                            @foreach ($sessions as $session)
                                <tr>
                                    <!-- Sessions status -->
                                    <td class="py-2 px-4 border-b text-center">
                                        @if($session->status == 'Ongoing')
                                            <p class="text-yellow-500">{{ $session->status }}</p>
                                        @elseif($session->status == 'Completed')
                                            <p class="text-green-500">{{ $session->status }}</p>
                                        @elseif($session->status == 'Cancelled')
                                            <p class="text-red-500">{{ $session->status }}</p>
                                        @endif
                                    </td>
                                    <!-- Session information -->
                                    <td class="py-2 px-4 border-b text-center">{{ $session->subject }}</td>
                                    <td class="py-2 px-4 border-b text-center">{{ $session->date }}</td>
                                    <td class="py-2 px-4 border-b text-center">{{ (new DateTime($session->start_time))->format('h:i A') }}</td>
                                    <td class="py-2 px-4 border-b text-center">{{ (new DateTime($session->end_time))->format('h:i A') }}</td>
                                    <td class="py-2 px-4 border-b text-center">{{ $session->location }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Booking Form -->
        <form action="{{ route('sessions.pending-session.store') }}" method="POST" class="bg-white shadow-lg rounded-lg p-6">
            @csrf
            <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">

            <!-- Subject input -->
            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium text-gray-700">Select Courses</label>
                <select name="subject" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="" disabled selected hidden>Select a course</option>
                    @foreach(json_decode($tutor->subjects) as $course)
                        <option value="{{$course}}" >{{$course}}</option>
                    @endforeach
                </select>
                @error('subject')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Date input -->
            <div class="mb-4">
                <label for="date" class="block text-gray-700">Date</label>
                <input type="date" id="date" name="date" class="w-full p-2 border border-gray-300 rounded-lg" required>
                @error('date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Start Time input -->
            <div class="mb-4">
                <label for="start_time" class="block text-gray-700">Start Time</label>
                <input type="time" id="start_time" name="start_time" class="w-full p-2 border border-gray-300 rounded-lg" required>
                @error('start_time')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            
            <!-- End Time input -->
            <div class="mb-4">
                <label for="end_time" class="block text-gray-700">End Time</label>
                <input type="time" id="time" name="end_time" class="w-full p-2 border border-gray-300 rounded-lg" required>
                @error('end_time')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Location -->
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

</x-layout>