
@php
    // Turn a course table field into an array
    $courses = App\Models\Course::pluck('code')->toArray();
@endphp

<x-layout :pageHeading="'Tutors'">
    <div class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Available Tutors</h2>
           
            <!-- Pagination text and search bar -->
            @include('partials._pagination-text', ['paginator' => $tutors])
            @include('partials._search')
            
        </div>
        <!-- Filter -->
        @include('partials._filter', ['list' => $courses, 'filter' => 'subject', 'filter_name' => 'All Subjects'])
        <!-- Tutors grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($tutors as $tutor)
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <!-- Display tutor name, subjects, details link and book session link -->
                    <img src="{{ asset('images/default.png') }}" alt="{{ $tutor->user->name }}" class="w-16 h-16 rounded-full mx-auto">
                    <h2 class="text-lg font-semibold text-gray-700 mt-4">{{ $tutor->user->first_name . ' ' . $tutor->user->last_name}}</h2>
                    <x-tutor-subjects :tutorSubjects="$tutor->subjects" />
                    <a href="/tutors/{{ $tutor->id }}" class="text-blue-500 hover:underline mt-2 block">View Details</a>
                    <a href="/tutors/{{ $tutor->id }}/book-session" class="bg-purple-500 text-white py-2 px-4 rounded-full hover:bg-purple-600 mt-4 block text-center">Book Session</a>
                </div>
            @endforeach
        </div>
        <!-- Custom Pagination -->
        <div class="mt-6">
            @include('partials._pagination', ['paginator' => $tutors])
        </div>
    </div>
</x-layout>