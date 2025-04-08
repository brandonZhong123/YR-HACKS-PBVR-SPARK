<x-layout :pageHeading="'Sessions'">
    <!-- Main Content -->
    <div class="p-6 flex-1 overflow-y-auto">
        <!-- Page heading -->
        <h2 class="text-2xl font-semibold mb-6">Scheduled Sessions</h2>

        <!-- Check if there are any sessions -->
        @if ($sessions->isEmpty())
            <!-- Display message based on the user's role -->
            @if(Auth::user()->role != 'admin')
                <p class="text-gray-600">You have no pending sessions.</p> 
            @else 
                <p class="text-gray-600">No pending sessions.</p> 
            @endif
        @else
            <!-- Display table for sessions -->
            <div class="overflow-x-auto w-full">
                <table class="w-full bg-white shadow-md rounded-lg border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 border-b border-gray-300">
                            <!-- Table headers -->
                            <th class="py-3 px-6 text-left border-r border-gray-300">Status</th>
                            <th class="py-3 px-6 text-left border-r border-gray-300">Date</th>
                            <th class="py-3 px-6 text-left border-r border-gray-300">Start Time</th>
                            <th class="py-3 px-6 text-left border-r border-gray-300">End Time</th>
                            <th class="py-3 px-6 text-left border-r border-gray-300">Tutor</th>
                            <th class="py-3 px-6 text-left border-r border-gray-300">Student</th>
                            <th class="py-3 px-6 text-left border-r border-gray-300">Subject</th>
                            <th class="py-3 px-6 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through each session -->
                        @foreach($sessions as $session)
                            <tr class="hover:bg-gray-100">
                                <!-- Display session status with different colors -->
                                <td class="py-4 px-6 border-r border-gray-300"> 
                                    @if($session->status == 'Ongoing')
                                        <p class="text-yellow-500">{{ $session->status }}</p>
                                    @elseif($session->status == 'Completed')
                                        <p class="text-green-500">{{ $session->status }}</p>
                                    @elseif($session->status == 'Cancelled')
                                        <p class="text-red-500">{{ $session->status }}</p>
                                    @endif
                                </td>
                                <!-- Display session details -->
                                <td class="py-4 px-6 border-r border-gray-300">{{ $session->date }}</td>
                                <td class="py-4 px-6 border-r border-gray-300">{{ (new DateTime($session->start_time))->format('h:i A') }}</td>
                                <td class="py-4 px-6 border-r border-gray-300">{{ (new DateTime($session->end_time))->format('h:i A') }}</td>
                                <td class="py-4 px-6 border-r border-gray-300">{{ $session->tutor->user->first_name }}</td>
                                <td class="py-4 px-6 border-r border-gray-300">{{ $session->student->first_name }}</td>
                                <td class="py-4 px-6 border-r border-gray-300">{{ $session->subject }}</td>

                                <!-- Display actions based on session status -->
                                @if($session->status == 'Ongoing')
                                    <td class="py-4 px-6">  
                                        <div class="flex items-center gap-1">
                                            <!-- Button to mark session as completed -->
                                            @if(Auth::user()->role == 'tutor' || Auth::user()->role == 'admin')
                                                <form action="{{ 'sessions/complete-session/' . $session->id }}" method="POST" class="">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="bg-blue-500 whitespace-nowrap text-white py-2 px-4 rounded-full hover:bg-blue-600">Mark As Completed</button>  
                                                </form>      
                                            @endif
                                            <!-- Button to cancel the session -->
                                            <a href="{{ route('sessions.cancel-session-reason', $session->id) }}">
                                                <button class="bg-red-500 text-white py-2 px-4 rounded-full hover:bg-red-600">Cancel</button>
                                            </a>
                                        </div>
                                    </td>
                                @elseif($session->status == 'Completed' || $session->status == 'Cancelled')
                                    <td class="py-4 px-6">  
                                        <div class="flex space-x-3">
                                            <!-- Button to archive session -->
                                            <form action="{{ 'sessions/archive-session/' . $session->id }}" method="POST">
                                                @csrf
                                                <!-- Hidden input fields for session data -->
                                                <input type="hidden" name="session_id" value="{{ $session->id }}">
                                                <input type="hidden" name="tutor_id" value="{{ $session->tutor_id }}">
                                                <input type="hidden" name="subject" value="{{ $session->subject }}">
                                                <input type="hidden" name="date" value="{{ $session->date }}">
                                                <input type="hidden" name="start_time" value="{{ $session->start_time }}">
                                                <input type="hidden" name="end_time" value="{{ $session->end_time }}">
                                                <input type="hidden" name="location" value="{{ $session->location }}">
                                                <input type="hidden" name="student_id" value="{{ $session->student_id }}">
                                                <input type="hidden" name="reason" value="{{ $session->reason }}">
                                                <input type="hidden" name="status" value="{{ $session->status }}">
                                                <button type="submit" class="bg-gray-500 text-white py-2 px-4 rounded-full hover:bg-gray-600">Archive</button>  
                                            </form>      
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layout>
