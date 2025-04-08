<x-layout :pageHeading="'Update Profile'">
    <div class="bg-gray-100 flex justify-center items-center" style="min-height: 80vh;">
        <div class="bg-white shadow-md rounded-lg w-full max-w-4xl p-6 ">

            <!-- User name, profile picture and role -->
            <div class="flex items-center mb-6">
                <img src="{{ asset('images/default.png') }}" alt="Profile Picture" class="w-20 h-20 rounded-full mr-4">
                <div>
                    <h2 class="text-xl font-bold">{{ $user->first_name . ' ' . $user->last_name }}</h2>
                    <p class="text-gray-500">{{ Str::ucFirst($user->role) }}</p>
                </div>
            </div>

                <h3 class="text-lg font-semibold mb-4 border-b pb-2">User Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                     <!-- User first name -->
                    <div>
                        <h1 class="block text-sm font-medium text-gray-700">First Name</label>
                        <p class="mt-1 block w-full rounded-md"> 
                            {{ $user->first_name }}
                        </p>
                    </div>

                     <!-- User last name -->
                    <div>
                        <h1 class="block text-sm font-medium text-gray-700">Last Name</label>
                        <p class="mt-1 block w-full rounded-md "> 
                            {{ $user->last_name }}
                        </p>
                    </div>

                     <!-- User email-->
                    <div>
                        <h1 class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 block w-full rounded-md "> 
                            {{ $user->email }}
                        </p>
                    </div>

                     <!-- User role -->
                    <div>
                        <h1 class="block text-sm font-medium text-gray-700">Role</label>
                        <p class="mt-1 block w-full rounded-md"> 
                            {{ $user->role }}
                        </p>
                    </div>
                    <div>
                        <h1 class="block text-sm font-medium text-gray-700">School</label>
                        <p class="mt-1 block w-full rounded-md"> 
                            Richmond Hill High School
                        </p>
                    </div>
                </div>
    
                <!-- Tutor Information -->
                @if (Auth::user()->role == 'admin')
                    <a href="{{route('users.edit', $user->id)}}" class= "text-blue-500 hover:text-blue-600 hover:underline cursor-pointer "> Edit profile </a>
                @endif

                @if (Auth::user()->role == 'tutor')
                    <a href="{{route('tutors.show', $user->tutor->id)}}" class= "text-blue-500 hover:text-blue-600 hover:underline cursor-pointer "> View tutor profile </a>
                @endif
            </div>
        </div>
    </div>
</x-layout>