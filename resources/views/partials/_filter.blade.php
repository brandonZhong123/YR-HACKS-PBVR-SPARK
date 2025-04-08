@props(['list', 'filter', 'filter_name'])
<form method="GET" class="mb-6 w-full sm:ml-auto sm:mt-0 sm:w-auto md:ml-0 relative flex items-center">
    <select name="{{$filter}}" class="border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring focus:border-purple-300 mr-2">
        <option value=""> {{$filter_name}}</option>
        @foreach($list as $item)
            <option value="{{ $item }}" {{ request($filter) == $item ? 'selected' : '' }}>{{ $item }}</option>
        @endforeach
    </select>
    <button type="submit" class="bg-purple-500 text-white py-2 px-4 rounded-lg">Filter</button>
</form>