<x-layout :pageHeading="'Cancel Session'">
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Cancel Session</h1>
        
         <!-- Cancel Session Form -->
        <form action="{{ $session->id }}" method="POST" class="bg-white shadow-lg rounded-lg p-6">
            @csrf
            @method('PUT')

             <!-- Reason Input -->
            <div class="mb-4">
                <label for="reason" class="block text-gray-700"> Reason for Cancellation </label>
                <textarea id="reason" name="reason" class="w-full p-2 border border-gray-300 rounded-lg" required></textarea>
                @error('reason')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-full hover:bg-red-600">Cancel Session</button>
        </form>

    </div>
</x-layout>