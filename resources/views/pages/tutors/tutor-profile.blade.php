<x-layout :pageHeading="'Profile'">
    <div class="bg-gray-100 flex items-center justify-center min-h-screen" style="min-height: 80vh;">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-xl w-full">
            <!-- Profile Picture -->
            <div class="flex justify-center">
                <img
                    class="w-32 h-32 rounded-full border-4 border-blue-500 object-cover"
                    src="{{ asset('images/default.png') }}"
                    alt="Profile Picture"
                />
            </div>
            <!-- Name and Title -->
            <div class="text-center mt-4">
                <h2 class="text-xl font-bold text-gray-800">{{ $tutor->user->first_name }} {{ $tutor->user->last_name }}</h2>
                <p class="text-gray-600">Tutor</p>
            </div>
            <!-- Bio -->
            <div class="mt-4 text-center">
                <h3 class="text-lg font-semibold text-gray-800">About</h3>
                <p class="text-gray-700 mt-2">{{ $tutor->description }}</p>
            </div>
            <!-- Subjects -->
            <div class="mt-4 text-center">
                <h3 class="text-lg font-semibold text-gray-800">Subjects</h3>
                <div class="flex flex-wrap justify-center gap-2 mt-2">
                    @foreach(json_decode($tutor->subjects) as $subject)
                        <span class="px-3 py-1 bg-purple-100 text-blue-800 rounded-full text-sm">
                            {{ trim($subject) }}
                        </span>
                    @endforeach
                </div>
            </div>
            <!-- Action Buttons -->
            <div class="mt-6 flex justify-around">
                @if(Auth::id() !== $tutor->user_id)
                    <a href="{{ route('tutors.book-session', $tutor) }}" class="bg-purple-500 w-full text-center text-white px-4 py-2 rounded-lg shadow hover:bg-purple-600">
                        Book Session
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-layout>