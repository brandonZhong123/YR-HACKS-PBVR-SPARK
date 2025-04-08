@php
    $roles = ['admin', 'tutor', 'student'];
@endphp
<x-layout :pageHeading="'Users'">
    <div class="container mx-auto py-8 overflow-auto">
        <div class="flex items-center justify-between mb-6">
            <!-- Users Header -->
            <h2 class="text-2xl font-semibold text-gray-800">Users</h2>

            <!-- Search bar and pagination text-->
            @include('partials._pagination-text', ['paginator' => $users])
            @include('partials._search')
        </div>

        @include('partials._filter', ['list' => $roles, 'filter' => 'role', 'filter_name' => 'All Roles'])
        <!-- Data List -->
        <div class="bg-white rounded-lg overflow-auto">
            <table class=" w-full leading-normal border-spacing-8">
                <!-- Table headers -->
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Profile
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            User Name
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Role
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- User rows -->
                    @foreach($users as $user)
                        <tr class="mb-4">

                            <!-- User information -->
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-12 h-12">
                                        <img class="w-full h-full rounded-full" src="{{ asset('images/default.png') }}" alt="User Profile" />
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-lg">
                                <p class="text-gray-900 whitespace-no-wrap">{{$user->first_name . ' ' . $user->last_name}}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-lg">
                                <p class="text-gray-900 whitespace-no-wrap">{{$user->email}}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-lg text-center">
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Active</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-lg text-center">
                                <p class="text-gray-900 whitespace-no-wrap">{{ ucfirst($user->role) }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-lg text-center">
                                <div class="flex justify-center">
                                    <a href="{{route('users.show', $user->id)}}" class="text-blue-500 hover:text-blue-700 mr-3">View</a>
                                    <a href="#" class="text-red-500 hover:text-red-700">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Custom pagination -->
        <div class="mt-6">
            @include('partials._pagination', ['paginator' => $users])
        </div>
        
    </div>
</x-layout>