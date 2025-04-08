<x-layout :pageHeading="'Deny Session Request'">
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Deny Session Request</h1>
        
         <!-- Deny Session Form -->
        <form id="deny-session-form" action="{{ $session->id }}" method="POST" class="bg-white shadow-lg rounded-lg p-6">
            @csrf
            @method('PUT')

             <!-- Rason Input -->
            <div class="mb-4">
                <label for="reason" class="block text-gray-700">Reason for Denial</label>
                <textarea id="reason" name="reason" class="w-full p-2 border border-gray-300 rounded-lg" required></textarea>
                @error('reason')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="button" onclick="confirmDeny()" class="bg-red-500 text-white py-2 px-4 rounded-full hover:bg-red-600">Deny Request</button>
        </form>
    </div>

    <!-- Confirm Screen -->
    <script>
        function confirmDeny() {
            if (confirm('Are you sure you want to deny this session request?')) {
                document.getElementById('deny-session-form').submit();
            }
        }
    </script>
</x-layout>