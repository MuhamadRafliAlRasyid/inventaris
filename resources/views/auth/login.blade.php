<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inventory Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-white min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="flex justify-center mb-10">
            <div class="flex items-center border border-gray-200 rounded-md px-3 py-2">
                <img alt="Logo" class="w-6 h-6" src="{{ asset('assets/logos.png') }}" />
                <span class="ml-2 text-xs font-semibold text-black">INVENTORY</span>
            </div>
        </div>

        {{-- Error Validation --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-xs font-normal text-gray-700 mb-1">Email</label>
                <div class="relative">
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        class="w-full border border-blue-500 rounded-md px-3 py-2 pr-10 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-blue-600 focus:border-blue-600" />
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-600 text-sm">
                        <i class="fas fa-check-circle"></i>
                    </span>
                </div>
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-xs font-normal text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <input id="password" name="password" type="password" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 pr-10 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400" />
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm cursor-pointer"
                        onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye-slash" id="eyeIcon"></i>
                    </span>
                </div>
            </div>

            {{-- Remember & Forgot --}}
            <div class="flex items-center justify-between text-xs text-gray-700">
                <label class="flex items-center space-x-2">
                    <input name="remember" type="checkbox" class="w-3.5 h-3.5 border border-gray-400 rounded-sm" />
                    <span>Remember me?</span>
                </label>
                <a class="text-blue-600 hover:underline" href="{{ route('password.request') }}">
                    Forgot Password?
                </a>
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white text-xs font-normal rounded-md py-2">
                Sign In
            </button>

            {{-- Optional register --}}
            <a href="{{ route('register') }}"
                class="block text-center mt-4 text-blue-600 text-sm hover:underline">Create Account</a>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            eyeIcon.classList.toggle('fa-eye-slash');
            eyeIcon.classList.toggle('fa-eye');
        }
    </script>
</body>

</html>
