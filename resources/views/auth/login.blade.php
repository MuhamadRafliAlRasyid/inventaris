{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inventory Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-white min-h-screen flex flex-col items-center justify-center px-4">
    {{-- Logo dan Judul --}}
    <div class="flex items-center space-x-1 mb-12">
        <img alt="Logo" class="w-12 h-12" src="assets/logos.png" />
        <h1 class="text-5xl font-normal flex flex-wrap">
            <span class="text-orange-600">Inven</span><span class="text-blue-900">tory</span>
        </h1>
    </div>

    {{-- Error Validation --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded w-72 md:w-96">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Login Form --}}
    <form method="POST" action="{{ route('login') }}" class="flex flex-col items-center w-full space-y-4">
        @csrf
        {{-- Email --}}
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
            placeholder="Email"
            class="w-72 md:w-96 text-white bg-blue-900 rounded-md py-3 px-4 placeholder-white focus:outline-none" />

        {{-- Password --}}
        <div class="relative w-72 md:w-96">
            <input id="password" name="password" type="password" required placeholder="Password"
                class="text-white bg-blue-900 rounded-md py-3 px-4 placeholder-white focus:outline-none w-full pr-10" />
            <span id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                👁️
            </span>
        </div>


        {{-- Remember Me --}}
        <label for="remember_me" class="w-72 md:w-96 text-sm text-gray-700 flex items-center space-x-2">
            <input id="remember_me" name="remember" type="checkbox"
                class="h-4 w-4 text-blue-900 focus:ring-blue-500 border-gray-300 rounded">
            <span>Remember me</span>
        </label>

        {{-- Submit Button --}}
        <button type="submit"
            class="bg-blue-900 text-white text-lg rounded-md py-2 px-8 mb-4 hover:bg-blue-800 transition-colors">
            LOG IN
        </button>

        {{-- Register Button --}}
        <a href="{{ route('register') }}"
            class="bg-blue-900 text-white text-lg rounded-md py-2 px-8 hover:bg-blue-800 transition-colors">
            Create Account
        </a>

        {{-- Forgot Password --}}
        <div class="text-sm mt-4">
            <a href="{{ route('password.request') }}" class="text-blue-900 hover:underline">Forgot your password?</a>
        </div>
    </form>
</body>
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    togglePassword.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    });
</script>

</html>
