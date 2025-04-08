<!-- filepath: c:\xampp\htdocs\score\resources\views\pages\courses\assesments.blade.php -->
<x-layout :pageHeading="'Upcoming Assignments'">
    <div class="flex justify-center items-center h-screen bg-gray-100 p-4">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl border border-gray-300">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Upcoming Assignments</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full border-collapse mt-4">
                    <thead>
                        <tr class="bg-purple-500 text-white">
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Assignment</th>
                            <th class="p-3 text-left">Due Date</th>
                            <th class="p-3 text-left">Course</th>
                            <th class="p-3 text-left">Action</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignments as $assignment)
                            <tr class="border-b bg-gray-50 hover:bg-purple-100 transition">
                                <td class="p-3">{{ $assignment->completed == 0 ? 'Due' : 'Completed' }}</td>
                                <td class="p-3">{{ $assignment->name }}</td>
                                <td class="p-3">{{ $assignment->due_date }}</td>
                                <td class="p-3">{{ $assignment->individualCourse->course->code}}</td>
                                <td class="p-3">
                                    <form action="{{ route('assessments.complete', $assignment->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                                            Mark as Completed
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-3 text-center text-gray-500">No upcoming assignments.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>