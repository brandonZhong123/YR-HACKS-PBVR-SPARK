<!-- filepath: c:\xampp\htdocs\score\resources\views\pages\dashboard\dashboard.blade.php -->
<x-layout :pageHeading="'Dashboard'">
    <div class="flex-1 flex flex-col">
        <div class="flex-1 p-6 overflow-auto">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-gray-800">Overview of Your Activities</h1>
                <p class="text-sm text-gray-500 mt-2">Here’s a summary of your sessions, courses, and assessments.</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                    <!-- Upcoming Sessions -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-gray-700">Upcoming Sessions</h2>
                        @if($dashboardContent['sessions']->isEmpty())
                            <p class="text-sm text-gray-600 mt-2">No upcoming sessions.</p>
                        @else
                            <div class="overflow-x-auto mt-4">
                                <table class="min-w-full bg-white rounded-lg">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b text-left">Subject</th>
                                            <th class="py-2 px-4 border-b text-left">Date & Time</th>
                                            <th class="py-2 px-4 border-b text-left">Status</th>
                                            <th class="py-2 px-4 border-b text-left">
                                                {{ Auth::user()->role == 'tutor' ? 'Student' : 'Tutor' }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dashboardContent['sessions'] as $session)
                                            <tr>
                                                <td class="py-2 px-4 border-b">{{ $session->subject }}</td>
                                                <td class="py-2 px-4 border-b">
                                                    {{ date('l', strtotime($session->date)) }}, 
                                                    {{ (new DateTime($session->start_time))->format('h:i A') }}
                                                </td>
                                                <td class="py-2 px-4 border-b">
                                                    @if($session->status == 'Pending')
                                                        <span class="text-yellow-500">{{ $session->status }}</span>
                                                    @elseif($session->status == 'Accepted')
                                                        <span class="text-green-500">{{ $session->status }}</span>
                                                    @elseif($session->status == 'Denied')
                                                        <span class="text-red-500">{{ $session->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="py-2 px-4 border-b">
                                                    {{ Auth::user()->role == 'tutor' ? $session->student->first_name : ($session->tutor ? $session->tutor->first_name : 'Not Assigned') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Session Requests -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-gray-700">Session Requests</h2>
                        @if($dashboardContent['sessionRequests']->isEmpty())
                            <p class="text-sm text-gray-600 mt-2">No session requests found.</p>
                        @else
                            <div class="overflow-x-auto mt-4">
                                <table class="min-w-full bg-white rounded-lg">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b text-left">Subject</th>
                                            <th class="py-2 px-4 border-b text-left">Date & Time</th>
                                            <th class="py-2 px-4 border-b text-left">Status</th>
                                            <th class="py-2 px-4 border-b text-left">
                                                {{ Auth::user()->role == 'tutor' ? 'Student' : 'Tutor' }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dashboardContent['sessionRequests'] as $session)
                                            <tr>
                                                <td class="py-2 px-4 border-b">{{ $session->subject }}</td>
                                                <td class="py-2 px-4 border-b">
                                                    {{ date('l', strtotime($session->date)) }}, 
                                                    {{ (new DateTime($session->start_time))->format('h:i A') }}
                                                </td>
                                                <td class="py-2 px-4 border-b">
                                                    @if($session->status == 'Pending')
                                                        <span class="text-yellow-500">{{ $session->status }}</span>
                                                    @elseif($session->status == 'Accepted')
                                                        <span class="text-green-500">{{ $session->status }}</span>
                                                    @elseif($session->status == 'Denied')
                                                        <span class="text-red-500">{{ $session->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="py-2 px-4 border-b">
                                                    {{ Auth::user()->role == 'tutor' ? $session->student->first_name : ($session->tutor ? $session->tutor->first_name : 'Not Assigned') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Courses Section -->
                <div class="bg-gray-100 p-4 rounded-lg shadow mt-6">
                    <h2 class="text-lg font-semibold text-gray-700">Your Courses</h2>
                    @if(is_null($dashboardContent['schedule']))
                        <p class="text-sm text-gray-600 mt-2">You are not enrolled in any courses.</p>
                    @else
                        <ul class="list-disc pl-6 mt-4">
                            @if(Auth::user()->schedule && Auth::user()->schedule->period1 && Auth::user()->schedule->period1->course)
                                <li class="mb-2">
                                    <a href="{{ route('courses.show', Auth::user()->schedule->period1) }}" class="text-lg hover:bg-gray-700 p-2 rounded-lg">
                                        {{ Auth::user()->schedule->period1->course->code }}
                                    </a>
                                    <span class="text-green-500 font-semibold">Mark: {{ Auth::user()->schedule->period1->grade ?? 'N/A' }}</span>
                                </li>
                            @endif
                            @if(Auth::user()->schedule && Auth::user()->schedule->period2 && Auth::user()->schedule->period2->course)
                                <li class="mb-2">
                                    <a href="{{ route('courses.show', Auth::user()->schedule->period2) }}" class="text-lg hover:bg-gray-700 p-2 rounded-lg">
                                        {{ Auth::user()->schedule->period2->course->code }}
                                    </a>
                                    <span class="text-green-500 font-semibold">Mark: {{ Auth::user()->schedule->period2->grade ?? 'N/A' }}</span>
                                </li>
                            @endif
                            @if(Auth::user()->schedule && Auth::user()->schedule->period3 && Auth::user()->schedule->period3->course)
                                <li class="mb-2">
                                    <a href="{{ route('courses.show', Auth::user()->schedule->period3) }}" class="text-lg hover:bg-gray-700 p-2 rounded-lg">
                                        {{ Auth::user()->schedule->period3->course->code }}
                                    </a>
                                    <span class="text-green-500 font-semibold">Mark: {{ Auth::user()->schedule->period3->grade ?? 'N/A' }}</span>
                                </li>
                            @endif
                            @if(Auth::user()->schedule && Auth::user()->schedule->period4 && Auth::user()->schedule->period4->course)
                                <li class="mb-2">
                                    <a href="{{ route('courses.show', Auth::user()->schedule->period4) }}" class="text-lg hover:bg-gray-700 p-2 rounded-lg">
                                        {{ Auth::user()->schedule->period4->course->code }}
                                    </a>
                                    <span class="text-green-500 font-semibold">Mark: {{ Auth::user()->schedule->period4->grade ?? 'N/A' }}</span>
                                </li>
                            @endif
                            @if(Auth::user()->schedule && Auth::user()->schedule->period5 && Auth::user()->schedule->period5->course)
                                <li class="mb-2">
                                    <a href="{{ route('courses.show', Auth::user()->schedule->period5) }}" class="text-lg hover:bg-gray-700 p-2 rounded-lg">
                                        {{ Auth::user()->schedule->period5->course->code }}
                                    </a>
                                    <span class="text-green-500 font-semibold">Mark: {{ Auth::user()->schedule->period5->grade ?? 'N/A' }}</span>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>

                <!-- Assessments Section -->
                <div class="bg-gray-100 p-4 rounded-lg shadow mt-6">
                    <h2 class="text-lg font-semibold text-gray-700">Your Assessments</h2>
                    @if($dashboardContent['assessments']->isEmpty())
                        <p class="text-sm text-gray-600 mt-2">You have no assessments.</p>
                    @else
                        <ul class="list-disc pl-6 mt-4">
                            @foreach($dashboardContent['assessments'] as $assessment)
                                <li class="mb-2">
                                    <span class="font-semibold">Assessment:</span> {{ $assessment->name ?? 'N/A' }} <br>
                                    <span class="font-semibold">Due Date:</span> {{ $assessment->due_date ?? 'N/A' }} <br>
                                    <span class="font-semibold">Course:</span> {{ $assessment->individualCourse->course->code ?? 'N/A' }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>