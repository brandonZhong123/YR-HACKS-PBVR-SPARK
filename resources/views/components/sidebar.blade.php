<!-- filepath: c:\xampp\htdocs\score\resources\views\components\sidebar.blade.php -->
<div x-data="{ open: false }" class="flex h-full">
    <!-- Sidebar -->
    <div :class="open ? 'w-64' : 'w-16'" class="bg-purple-500 text-white h-full shadow-lg overflow-auto transition-all duration-300">
        <div class="flex flex-col items-center p-4">
            <!-- Score Logo -->
            

            <!-- Toggle Button -->
            <button @click="open = !open" class="text-white focus:outline-none mb-4">
                <i class="fas fa-bars w-6 h-6"></i>
            </button>

            <!-- Sidebar Title -->
            

            <!-- Sidebar Links -->
            <ul class="space-y-4 mt-4">
                <!-- Dashboard link -->
                <li>
                    <a href="/dashboard" class="flex items-center text-lg hover:bg-gray-700 p-2 rounded-lg">
                        <i class="fas fa-tachometer-alt w-6 h-6 mr-3"></i>
                        <span x-show="open">Dashboard</span>
                    </a>
                </li>

                <!-- Sessions link -->
                <li>
                    <a href="/sessions" class="flex items-center text-lg hover:bg-gray-700 p-2 rounded-lg">
                        <i class="fas fa-calendar-alt w-6 h-6 mr-3"></i>
                        <span x-show="open">Sessions</span>
                    </a>
                </li>


                <!-- If user is tutor or admin display global session requests-->
                @if (Auth::user()->role == 'tutor' || Auth::user()->role == 'admin')
                    <li>
                        <a href="/sessions/pending-random-sessions" class="flex items-center text-lg hover:bg-gray-700 p-2 rounded-lg">
                            <i class="fas fa-user-clock w-6 h-6 mr-3"></i>
                            <span x-show="open">Global Session Requests</span>
                        </a>
                    </li>
                @endif

                <!-- Pending Sessions / Personal Session requests link-->
                <li>
                    <a href="/sessions/pending-sessions" class="flex items-center text-lg hover:bg-gray-700 p-2 rounded-lg">
                        <i class="fas fa-calendar-alt w-6 h-6 mr-3"></i>
                        <span x-show="open">
                            {{ Auth::user()->role == 'student' ? 'Outgoing Session Requests' : 'Personal Session Requests' }}
                        </span>
                    </a>
                </li>

                <!-- Users and Courses link for admins-->
                @if (Auth::user()->role == 'admin')
                    <li>
                        <a href="/users" class="flex items-center text-lg hover:bg-gray-700 p-2 rounded-lg">
                            <i class="fas fa-users w-6 h-6 mr-3"></i>
                            <span x-show="open">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('courses')}}" class="flex items-center text-lg hover:bg-gray-700 p-2 rounded-lg">
                            <i class="fas fa-book w-6 h-6 mr-3"></i>
                            <span x-show="open">Courses</span>
                        </a>
                    </li>
                    <
                @endif


                <!-- Courses Dropdown -->
                <li x-data="{ openDropdown: false }">
                    <button 
                        @click="if (open) openDropdown = !openDropdown" 
                        class="flex items-center text-lg hover:bg-gray-700 p-2 rounded-lg w-full"
                        :class="{ 'cursor-not-allowed': !open }"
                        :disabled="!open"
                    >
                        <i class="fas fa-book w-6 h-6 mr-3"></i>
                        <span x-show="open">Courses</span>
                        <i x-show="open" :class="{'rotate-180': openDropdown, 'rotate-0': !openDropdown}" class="fas fa-chevron-down ml-auto transition-transform duration-200"></i>
                    </button>
                    <ul x-show="open && openDropdown" class="pl-6 mt-2 space-y-2 border-l-2 border-gray-400">
                        @if(Auth::user()->schedule && Auth::user()->schedule->period1 && Auth::user()->schedule->period1->course)
                            <li class="relative">
                                <span class="absolute left-0 top-1/2 transform -translate-y-1/2 w-2 h-2 bg-gray-400 rounded-full"></span>
                                <a href="{{ route('courses.show', Auth::user()->schedule->period1) }}" class="ml-4 text-lg hover:bg-gray-700 p-2 rounded-lg block">
                                    {{ Auth::user()->schedule->period1->course->code }}
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->schedule && Auth::user()->schedule->period2 && Auth::user()->schedule->period2->course)
                            <li class="relative">
                                <span class="absolute left-0 top-1/2 transform -translate-y-1/2 w-2 h-2 bg-gray-400 rounded-full"></span>
                                <a href="{{ route('courses.show', Auth::user()->schedule->period2) }}" class="ml-4 text-lg hover:bg-gray-700 p-2 rounded-lg block">
                                    {{ Auth::user()->schedule->period2->course->code }}
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->schedule && Auth::user()->schedule->period3 && Auth::user()->schedule->period3->course)
                            <li class="relative">
                                <span class="absolute left-0 top-1/2 transform -translate-y-1/2 w-2 h-2 bg-gray-400 rounded-full"></span>
                                <a href="{{ route('courses.show', Auth::user()->schedule->period3) }}" class="ml-4 text-lg hover:bg-gray-700 p-2 rounded-lg block">
                                    {{ Auth::user()->schedule->period3->course->code }}
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->schedule && Auth::user()->schedule->period4 && Auth::user()->schedule->period4->course)
                            <li class="relative">
                                <span class="absolute left-0 top-1/2 transform -translate-y-1/2 w-2 h-2 bg-gray-400 rounded-full"></span>
                                <a href="{{ route('courses.show', Auth::user()->schedule->period4) }}" class="ml-4 text-lg hover:bg-gray-700 p-2 rounded-lg block">
                                    {{ Auth::user()->schedule->period4->course->code }}
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->schedule && Auth::user()->schedule->period5 && Auth::user()->schedule->period5->course)
                            <li class="relative">
                                <span class="absolute left-0 top-1/2 transform -translate-y-1/2 w-2 h-2 bg-gray-400 rounded-full"></span>
                                <a href="{{ route('courses.show', Auth::user()->schedule->period5) }}" class="ml-4 text-lg hover:bg-gray-700 p-2 rounded-lg block">
                                    {{ Auth::user()->schedule->period5->course->code }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li>
                        <a href="/assessments" class="flex items-center text-lg hover:bg-gray-700 p-2 rounded-lg">
                            <i class="fas fa-check-square w-6 h-6 mr-3"></i>
                            <span x-show="open">Assessments</span>
                        </a>
                    </li>
                <!-- Tutors link -->
                <li>
                    <a href="/tutors" class="flex items-center text-lg hover:bg-gray-700 p-2 rounded-lg">
                        <i class="fas fa-chalkboard-teacher w-6 h-6 mr-3"></i>
                        <span x-show="open">Tutors</span>
                    </a>
                </li>

                <li>
                    <a href="/guidance" class="flex items-center text-lg hover:bg-gray-700 p-2 rounded-lg">
                        <i class="fas fa-chalkboard-teacher w-6 h-6 mr-3"></i>
                        <span x-show="open">Guidance Counsellors </span>
                    </a>
                </li>

                <!-- Profile Link -->
                <li>
                    <a href="{{route('users.update', Auth::user()->id)}}" class="flex items-center text-lg hover:bg-gray-700 p-2 rounded-lg">
                        <i class="fas fa-user-circle mr-3"></i>
                        <span x-show="open">Profile</span>
                    </a>
                </li>

                <!-- Pending Applications link -->
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'student')
                    <li>
                        <a href="{{ route('tutors.pending-applications') }}" class="flex items-center text-lg hover:bg-gray-700 p-2 rounded-lg">
                            <i class="fas fa-clock mr-3"></i>
                            <span x-show="open">Outgoing tutor Applications</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <!-- Main Content -->
</div>