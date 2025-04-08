<!DOCTYPE html>
@props(['pageHeading'])
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spark</title>
    <link rel="icon" href="{{ asset('images/Spark (2).png') }}" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.23/dist/tailwind.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>
<body>
    <div class="bg-gray-100 text-gray-800 w-full h-screen">
        <div class="flex h-full">
            <!-- Sidebar -->
            <x-sidebar />
            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <!-- Top Bar -->
                <x-topbar :pageHeading="$pageHeading" />
                <!-- Flash Message -->
                <div class="">
                    <x-flash-message />
                </div>
                <!-- Main Content Area -->
                <div class="flex-1 overflow-y-auto">
                    {{$slot}}
                </div>
            </div>
        </div>
    </div>
</body>
</html>