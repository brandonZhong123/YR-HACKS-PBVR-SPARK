<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.js"></script>
  <link rel="icon" href="{{ asset('images/Spark (2).png') }}" type="image/png">
  @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
  <div class="font-sans bg-gray-100 flex flex-col justify-center items-center h-screen m-0 p-5">
    <!-- Logo -->
    <div class="mb-4 w-48 h-48 flex justify-center items-center">
      <img src="{{ asset('images/Spark (3).png') }}" alt="Score Logo" class="w-full h-full object-contain">
    </div>

    <!-- Login Form -->
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm text-center border border-gray-300">
      <h2 class="mb-5 text-gray-800 font-semibold text-2xl">Login</h2>

      <form action="{{ route('users.authenticate') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Email Field -->
        <div class="mb-4 text-left w-full">
          <label for="email" class="text-sm font-medium text-gray-600 mb-2">Email</label>
          <input type="email" name="email" id="email" required value="{{ old('email') }}" class="w-full p-3 border border-gray-300 rounded-md text-gray-800 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition-colors">
          @error('email')
            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
          @enderror
        </div>

        <!-- Password Field -->
        <div class="mb-4 text-left w-full">
          <label for="password" class="text-sm font-medium text-gray-600 mb-2">Password</label>
          <input type="password" name="password" id="password" required class="w-full p-3 border border-gray-300 rounded-md text-gray-800 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition-colors">
          @error('password')
            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
          @enderror
        </div>

        <!-- Login Button -->
        <div class="mt-6 space-y-4">
          <button type="submit" class="w-full py-3 bg-purple-500 text-white font-medium rounded-md border border-purple-400 hover:bg-purple-400 transition-colors">Login</button>
          <button type="button" class="w-full py-3 bg-gray-100 text-gray-800 font-medium rounded-md border border-gray-300 hover:bg-gray-200 transition-colors" onclick="window.location.href='/register';">Create an account</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>