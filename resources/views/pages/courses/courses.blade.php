
<x-layout :pageHeading="'Users'">
    <div class="container mx-auto py-8 overflow-auto">
        <div class="flex items-center justify-between mb-6">
            <!-- Courses Header -->
            <h2 class="text-2xl font-semibold text-gray-800">Courses</h2>

            @include('partials._pagination-text', ['paginator' => $courses])
            @include('partials._search')
        </div>
         <!-- Add new course button -->
        <div class="mb-6">
            <a href="{{ route('courses.add') }}" class="bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-600">
                Add New Course
            </a>
        </div>

        <!-- Courses Table -->
        <div class="bg-white rounded-lg overflow-auto w-full">
            <table class="min-w-full leading-normal border-spacing-8">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Code
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Subject
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Grade
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                     <!-- Course information loop -->
                    @foreach($courses as $course)
                        <tr class="mb-4">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-lg">
                                <p class="text-gray-900 whitespace-no-wrap">{{$course->code}}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-lg">
                                <p class="text-gray-900 whitespace-no-wrap">{{$course->subject}}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-lg ">
                                <p class="text-gray-900 whitespace-no-wrap">{{ ($course->type) }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-lg ">
                                <p class="text-gray-900 whitespace-no-wrap">{{ ($course->grade) }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-lg text-center">
                                <a href="{{route('courses.edit', $course->id)}}" class="text-purple-500 hover:text-purple-700 mr-3">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
         <!-- Paginator -->
        <div class="mt-6">
            @include('partials._pagination', ['paginator' => $courses])
        </div>
        
    </div>
</x-layout>