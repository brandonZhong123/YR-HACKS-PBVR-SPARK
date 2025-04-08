<x-layout :pageHeading="'Pending Sessions'">
    <!-- Page title -->
    <div class="p-6 w-full">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Pending Sessions</h1>

        <!-- Check if there are any pending sessions -->
        @if($pendingSessions->isEmpty())

            <!-- Display different messages based on the user's role -->
            @if(Auth::user()->role != 'admin')
                <p class="text-gray-600">You have no pending sessions.</p> 
            @else 
                <p class="text-gray-600"> No pending sessions.</p> 
            @endif
        @else
            <div class="overflow-x-auto">
                <!-- Table to display session requests -->
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
                            <th class="py-2 px-4 border-b">Tutor</th>
                            <th class="py-2 px-4 border-b">Student</th>
                            <th class="py-2 px-4 border-b">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                         <!-- Loop through all pending session requests -->
                        @foreach ($pendingSessions as $session)
                            <tr>
                                <!-- Display session status with different colors -->
                                <td class="py-2 px-4 border-b text-center"> 
                                    @if($session->status == 'Pending')
                                        <p class="text-yellow-500">{{ $session->status }}</p>
                                    @elseif($session->status == 'Accepted')
                                        <p class="text-green-500">{{ $session->status }}</p>
                                    @elseif($session->status == 'Denied')
                                        <p class="text-red-500">{{ $session->status }}</p>
                                    @endif
                                </td>
                                 <!-- Display session details -->
                                <td class="py-2 px-4 border-b text-center">{{ $session->subject }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $session->date }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ (new DateTime($session->start_time))->format('h:i A') }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ (new DateTime($session->end_time))->format('h:i A') }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $session->location }}</td>

                                <!-- If there is a tutor -->
                                @if(!is_null($session->tutor))
                                    <td class="py-2 px-4 border-b text-center">{{ $session->tutor->user->first_name }}</td> 
                                @else 
                                    <td class="py-2 px-4 border-b text-center"> Finding Tutor </td> 
                                @endif
                                <td class="py-2 px-4 border-b text-center"> {{$session->student->first_name}}</td>

                                 <!-- Session is pending -->
                                @if($session->status == 'Pending')
                                    <td class="py-2 px-4 flex justify-center items-center gap-2">
                                        @auth
                                            <!-- If user is a tutor or student id matches -->
                                            @if(Auth::user()->role == 'tutor' && Auth::user()->tutor->id == $session->tutor_id)
                                                <form action="{{ route('sessions.accept-session-request', $session->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <!-- Hidden fields for session data -->
                                                    <input type="hidden" name="session_id" value="{{ $session->id }}">
                                                    <input type="hidden" name="tutor_id" value="{{ $session->tutor_id }}">
                                                    <input type="hidden" name="subject" value="{{ $session->subject }}">
                                                    <input type="hidden" name="date" value="{{ $session->date }}">
                                                    <input type="hidden" name="start_time" value="{{ $session->start_time }}">
                                                    <input type="hidden" name="end_time" value="{{ $session->end_time }}">
                                                    <input type="hidden" name="location" value="{{ $session->location }}">
                                                    <input type="hidden" name="student_id" value="{{ $session->student_id }}">
                                                    <input type="hidden" name="reason" value="{{ $session->reason}}">
                                                    <input type="hidden" name="status" value="{{ $session->status}}">
                                                    <button type="submit" class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600">Accept</button>
                                                </form>
                                                <!-- Decline button for admins -->
                                                <a href="{{ route('sessions.deny-session', $session->id) }}">
                                                    <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Decline</button>
                                                </a>
                                            @elseif(Auth::user()->role == 'student' || Auth::user()->id == $session->student_id)
                                                <!-- Cancel button for students -->
                                                <form action="{{ route('sessions.cancel-session-request', $session->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                            
                                                    <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Cancel</button>
                                                </form>
                                            @endif
                                        @endauth
                                    </td>
                                <!-- If session has been accepted or declined -->  
                                @elseif($session->status == 'Accepted' || $session->status == 'Denied')
                                <td class="py-2 px-4 border-b flex justify-center">
                                    <!-- Archive action for completed/denied sessions -->
                                    <form action="{{'archive-session-request/' . $session->id}}" method="POST" class="inline-block">
                                        @csrf
                                        <!-- Hidden fields for session data -->
                                        <input type="hidden" name="session_id" value="{{ $session->id }}">
                                        <input type="hidden" name="tutor_id" value="{{ $session->tutor_id }}">
                                        <input type="hidden" name="subject" value="{{ $session->subject }}">
                                        <input type="hidden" name="date" value="{{ $session->date }}">
                                        <input type="hidden" name="start_time" value="{{ $session->start_time }}">
                                        <input type="hidden" name="end_time" value="{{ $session->end_time }}">                                    
                                        <input type="hidden" name="location" value="{{ $session->location }}">
                                        <input type="hidden" name="student_id" value="{{ $session->student_id }}">
                                        <input type="hidden" name="reason" value="{{ $session->reason}}">
                                        <input type="hidden" name="status" value="{{ $session->status}}">
                                        <!-- Archive button -->
                                        <button type="submit" class="bg-gray-500 text-white py-1 px-3 rounded hover:bg-gray-600">Archive</button>
                                    </form>
                                @endif
                                </td>
                            
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layout>