<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inventory Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/1.png') }}?v={{ time() }}">
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
        <div class="flex justify-center mb-10">
            <div class="flex items-center border border-gray-200 rounded-md px-3 py-2">
                <img alt="Inventory logo" class="w-6 h-6" src="{{ asset('assets/logos.png') }}" />
                <span class="ml-2 text-xs font-semibold text-black">INVENTORY</span>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-xs font-normal text-gray-700 mb-1">Full Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400"
                    placeholder="Your name">
            </div>

            <div>
                <label for="email" class="block text-xs font-normal text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400"
                    placeholder="you@example.com">
            </div>

            <div>
                <label for="password" class="block text-xs font-normal text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <input id="password" name="password" type="password" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 pr-10 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400"
                        placeholder="********">
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm cursor-pointer"
                        onclick="toggleVisibility('password', this)">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-normal text-gray-700 mb-1">Confirm
                    Password</label>
                <div class="relative">
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 pr-10 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400"
                        placeholder="********">
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm cursor-pointer"
                        onclick="toggleVisibility('password_confirmation', this)">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white text-xs font-normal rounded-md py-2">
                Sign Up
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Sign In</a>
        </p>
    </div>

    <script>
        function toggleVisibility(id, iconElement) {
            const input = document.getElementById(id);
            const icon = iconElement.querySelector('i');
            const isPassword = input.getAttribute('type') === 'password';
            input.setAttribute('type', isPassword ? 'text' : 'password');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }
    </script>
</body>

</html>
