<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - IE Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center font-sans">

    <div class="bg-white p-10 rounded-[2rem] shadow-2xl w-full max-w-md border border-gray-100">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-black text-[#2c3821] mb-2">IE<span class="text-[#C5D89D]">ADMIN</span></h1>
            <p class="text-gray-500 font-light">Silakan login untuk mengakses panel</p>
        </div>

        @if(session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl">
                <p class="text-sm font-bold text-red-600">{{ session('error') }}</p>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" class="space-y-6">
            @csrf <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Username</label>
                <input type="text" name="username" required class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#2c3821] transition-all" placeholder="Masukkan username admin">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#2c3821] transition-all" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-[#2c3821] text-white font-bold py-3.5 rounded-xl hover:bg-black transition-colors shadow-lg shadow-[#2c3821]/30">
                Sign In
            </button>
        </form>
    </div>
</body>
</html>