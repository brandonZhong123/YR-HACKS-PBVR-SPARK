<x-layout :pageHeading="'Update Profile'">
    <div class="bg-gray-100 flex justify-center items-center mt-8" style="min-height: 80vh;">
        <div class="bg-white shadow-md rounded-lg w-full max-w-4xl p-6">

            <!-- Profile picture with first name and last name-->
            <div class="flex items-center mb-6">
                <img src="{{ asset('images/default.png') }}" alt="Profile Picture" class="w-20 h-20 rounded-full mr-4">
                <div>
                    <h2 class="text-xl font-bold">{{ $tutor->user->first_name . ' ' . $tutor->user->last_name }}</h2>
                </div>
            </div>
            
            <!-- Update Profile Form -->
            <form method="POST" action="{{ route('tutors.update', $tutor->id) }}">
                @csrf
                @method('PUT')
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Tutor Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Subjects input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Subjects</label>
                        <input type="text" name="subjects" value="{{ $tutor->subjects }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        @error('subjects')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Availability input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Availability</label>
                        <input type="text" name="availability" value="{{ $tutor->availability }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        @error('availability')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone Number input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ $tutor->phone_number }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        @error('phone_number')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tutor status input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="enabled" {{ $tutor->status == 'enabled' ? 'selected' : '' }}>Enabled</option>
                            <option value="disabled" {{ $tutor->status == 'disabled' ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>

                    <!-- Description input -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">{{ $tutor->description }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
             
                </div>
    
                <div class="flex justify-center mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 w-full">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>