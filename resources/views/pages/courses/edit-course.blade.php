<x-layout :pageHeading="'Course Edit'">
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit a course </h1>
        <!-- Booking Form -->
        <form action="{{ route('courses.update',  $course->id) }}" method="POST" class="bg-white shadow-lg rounded-lg p-6">
            @method('PUT')
            @csrf

            <!-- Code input -->
            <div class="mb-4">
                <label for="code" class="block text-gray-700">Code</label>
                <input value="{{$course->code}}"type="text" id="code" name="code" class="w-full p-2 border border-gray-300 rounded-lg" required>
                @error('code')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Subject input -->
            <div class="mb-4">
                <label for="subject" class="block text-gray-700">Subject</label>
                <input value="{{$course->subject}}" type="text" id="subject" name="subject" class="w-full p-2 border border-gray-300 rounded-lg" required>
                @error('subject')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Type input -->
            <div class="mb-4">
                <label for="type" class="block text-gray-700">Type</label>
                <input value="{{$course->type}}" type="text" id="type" name="type" class="w-full p-2 border border-gray-300 rounded-lg" required>
                @error('type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Grade input -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Grade</label>
                <select name="grade" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @for($i = 9; $i <= 12; $i++ )
                        <option value="{{ $i }}" {{ old('grade', $course->grade ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                @error('grade')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-full hover:bg-blue-600 ml-6">Update Course</button>
        </form>
    </div>
</x-layout>