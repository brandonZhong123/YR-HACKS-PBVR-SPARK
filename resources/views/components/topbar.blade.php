<div class="bg-white text-gray-800 shadow p-4 flex justify-between items-center w-full">

    <!-- Page heading -->
    <div class="text-xl font-semibold">
       {{ $pageHeading }} 
    </div>

    <!-- Dropdown Menu -->
    <div class="relative">
        <button class="bg-purple-500 px-4 py-2 rounded-full text-white hover:bg-purple-600 focus:outline-none" id="dropdownButton">
            Menu
        </button>
        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-300 z-10">
            <ul class="py-2">
                <!-- Score -->
                <li class="px-4 py-2 text-gray-800 hover:bg-gray-100 text-center">
                    SparkBux: {{ Auth::user()->score }}
                </li>

                <!-- Student-specific options -->
                @if(Auth::user()->role == 'student')
                    <li>
                        <a href="{{ route('tutors.submit-application') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-center">
                            Apply For Tutor
                        </a>
                    </li>
                @endif

                <!-- Tutor-specific options -->
                @if(Auth::user()->role == 'tutor')
                    @if(Auth::user()->tutor->status == 'enabled')
                        <li>
                            <form method="POST" action="{{ route('tutors.deactivate') }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100 text-center">
                                    Deactivate Tutor Profile
                                </button>
                            </form>
                        </li>
                    @elseif(Auth::user()->tutor->status == 'disabled')
                        <li>
                            <form method="POST" action="{{ route('tutors.activate') }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                                    Activate Tutor Profile
                                </button>
                            </form>
                        </li>
                    @endif
                @endif

                <!-- Random Session Request -->
                <li>
                    <a href="{{ route('sessions.book-random-session') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-center">
                        Request a Random Tutor Session
                    </a>
                </li>

                <!-- Logout -->
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-center px-4 py-2 text-red-500 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    // Dropdown toggle functionality
    document.getElementById('dropdownButton').addEventListener('click', function () {
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>