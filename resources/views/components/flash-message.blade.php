
<!-- Success Flash Message -->
@if (session('success'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Error Flash Message -->
@if (session('error'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="bg-red-500 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif