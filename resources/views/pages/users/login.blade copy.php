<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.js"></script>
  @vite('resources/css/app.css')
</head>
<body class="font-sans bg-gray-100 flex justify-center items-center h-screen m-0 p-5">

<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm text-center border border-gray-300">
  <h2 class="mb-5 text-gray-800 font-semibold">Login</h2>
  <form id="loginForm">

    <div class="mb-4 text-left w-full">
      <label for="email" class="text-sm font-medium text-gray-600 mb-2">Email</label>
      <input type="text" id="email" name="email" placeholder="Enter your email" required class="w-full p-3 border border-gray-300 rounded-md text-gray-800 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition-colors">
      <span class="text-red-600 text-xs mt-1" id="emailError"></span>
    </div>

    <div class="mb-4 text-left w-full">
      <label for="password" class="text-sm font-medium text-gray-600 mb-2">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter Password" required class="w-full p-3 border border-gray-300 rounded-md text-gray-800 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition-colors">
      <span class="text-red-600 text-xs mt-1" id="passwordError"></span>
    </div>

    <div class="mt-6 space-y-4">
      <button type="submit" class="w-full py-3 bg-purple-500 text-white font-medium rounded-md border border-purple-400 hover:bg-purple-400 transition-colors">Login</button>
      <button type="button" class="w-full py-3 bg-gray-100 text-gray-800 font-medium rounded-md border border-gray-300 hover:bg-gray-200 transition-colors" onclick="window.location.href='register';">Create an account</button>
    </div>
  </form>
</div>

<script src="login.js"></script>
</body>
</html>
