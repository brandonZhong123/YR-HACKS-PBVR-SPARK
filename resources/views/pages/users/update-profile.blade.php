<x-layout :pageHeading="'Update Profile'">
    <div class="bg-gray-100 flex justify-center items-center" style="min-height: 80vh;">
        <div class="bg-white shadow-md rounded-lg w-full max-w-4xl p-6 ">

            <!-- User profile picture, first name, last name, role -->
            <div class="flex items-center mb-6">
                <img src="{{ asset('images/default.png') }}" alt="Profile Picture" class="w-20 h-20 rounded-full mr-4">
                <div>
                    <h2 class="text-xl font-bold">{{ $user->first_name . ' ' . $user->last_name }}</h2>
                    <p class="text-gray-500">{{ Str::ucFirst($user->role) }}</p>
                </div>
            </div>
            
            <!-- Update form -->
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">User Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">

                    <!-- First Name Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" value="{{ $user->first_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        @error('first_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Last Name Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        @error('last_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Role Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <select name="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="tutor" {{ $user->role == 'tutor' ? 'selected' : '' }}>Tutor</option>
                            <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>student</option>
                        </select>
                    </div>
                </div>
    
                <!-- Tutor Information -->  
                @if ($user->role == 'tutor')
                    <a href="{{route('tutors.edit', $user->tutor->id)}}" class= "text-blue-500 hover:text-blue-600 hover:underline cursor-pointer "> View Tutor Profile </a>
                @endif
                <div class="flex justify-center mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 w-full">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>