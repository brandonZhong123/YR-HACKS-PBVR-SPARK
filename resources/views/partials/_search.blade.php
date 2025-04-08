<form method="GET" class="w-full sm:ml-auto sm:mt-0 sm:w-auto md:ml-0 relative flex items-center">
    <input name="search" type="text" placeholder="Search tutors..." value="{{ request('search') }}" class="border border-gray-300 rounded-lg py-2 px-4 w-full focus:outline-none focus:ring focus:border-purple-300 mr-2">
    <button type="submit" class="bg-purple-500 text-white py-2 px-4 rounded-lg">Search</button>
</form>