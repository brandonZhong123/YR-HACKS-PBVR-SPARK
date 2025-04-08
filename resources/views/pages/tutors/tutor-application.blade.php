<x-layout :pageHeading="'Tutor Application'">
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Apply for Tutor</h1>
        
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tutors.store-application') }}" method="POST" class="bg-white shadow-lg rounded-lg p-6">
            @csrf
            <!-- Multi-select Dropdown -->
            <div class="mb-4">
                <label for="subjects" class="block text-sm font-medium text-gray-700">Select Courses</label>
                <select id="subjects" name="subjects[]" multiple="multiple" class="select2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @foreach(App\Models\Course::all() as $course)
                        <option value="{{ $course->code }}">{{ $course->name }} {{ $course->code }}</option>
                    @endforeach
                </select>
                @error('subjects')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Availability Input -->
            <div class="mb-4">
                <label for="availability" class="block text-gray-700">Availability</label>
                <input placeholder="State periods you are available" type="text" id="availability" name="availability" class="w-full p-2 border border-gray-300 rounded-lg" required>
                @error('availability')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description Input -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" class="w-full p-2 border border-gray-300 rounded-lg" required></textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Experience Input -->
            <div class="mb-4">
                <label for="experience" class="block text-gray-700">Experience (Optional)</label>
                <textarea id="experience" name="experience" rows="4" class="w-full p-2 border border-gray-300 rounded-lg" required></textarea>
            </div>


            <!-- Phone Number Input -->
            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" class="w-full p-2 border border-gray-300 rounded-lg" required>
                @error('phone_number')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Submit Application</button>
            </div>
        </form>
    </div>

    <!-- Use the Select2 Partial -->
    @include('partials._select2', ['selector' => '#subjects', 'placeholder' => 'Select courses'])
</x-layout>