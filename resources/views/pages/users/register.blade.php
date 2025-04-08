<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="font-sans bg-gray-100 flex flex-col justify-center items-center min-h-screen m-0 p-5">
        <!-- Logo -->
        <div class=" w-64 h-64 flex justify-center items-center mb-4">
            <img src="{{ asset('images/Spark (3).png') }}" alt="Score Logo" class="w-full h-full object-contain">
        </div>

        <!-- Registration Form -->
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-semibold text-center mb-6">Register</h2>
            
            <!-- User register form -->
            <form action="{{ route('users.register') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}" class="w-full px-4 py-2 mt-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- First Name and Last Name Fields -->
                <div class="flex space-x-4">
                    <!-- First Name Field -->
                    <div class="flex-1">
                        <label for="first_name" class="block text-gray-700">First Name</label>
                        <input type="text" name="first_name" id="first_name" required value="{{ old('first_name') }}" class="w-full px-4 py-2 mt-2 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('first_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Last Name Field -->
                    <div class="flex-1">
                        <label for="last_name" class="block text-gray-700">Last Name</label>
                        <input type="text" name="last_name" id="last_name" required value="{{ old('last_name') }}" class="w-full px-4 py-2 mt-2 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('last_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Register Button -->
                <div class="mt-6 space-y-4">
                    <button type="submit" class="w-full py-3 bg-purple-500 text-white font-medium rounded-md border border-purple-400 hover:bg-purple-400 transition-colors">Register</button>
                    <button type="button" class="w-full py-3 bg-gray-100 text-gray-800 font-medium rounded-md border border-gray-300 hover:bg-gray-200 transition-colors" onclick="window.location.href='/';">Already Have an Account?</button>
                </div>    
            </form>
        </div>
    </div>
</body>
</html>