{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pengaduan</title>
    <!-- Tailwind CSS (URL fixed: tanpa spasi) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-500 to-indigo-700 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md">
        
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">🔐 Login</h2>

        <!-- Validation Errors -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Session Messages -->
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2" for="email">Email</label>
                <input type="email" 
                       name="email" 
                       id="email"
                       value="{{ old('email') }}"
                       placeholder="siswa@sekolah.sch.id"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent outline-none transition @error('email') border-red-500 @enderror"
                       required 
                       autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label class="block text-gray-700 text-sm font-medium mb-2" for="password">Password</label>
                <input type="password" 
                       name="password" 
                       id="password"
                       placeholder="••••••••"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent outline-none transition @error('password') border-red-500 @enderror"
                       required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 transform hover:scale-[1.02] shadow-lg">
                Login
            </button>
        </form>

        <!-- Link Register -->
        <div class="mt-6 text-center text-gray-600 text-sm">
            <p>register siswa? 
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline transition">
                    Daftar disini
                </a>
            </p>
        </div>

        <!-- Footer -->
        <div class="mt-8 pt-4 border-t border-gray-200 text-center text-gray-500 text-xs">
            <p>&copy; {{ date('Y') }} Sistem Pengaduan Sekolah</p>
        </div>
    </div>

</body>
</html>