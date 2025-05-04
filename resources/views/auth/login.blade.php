{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - My Laravel App</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-purple-600 to-blue-500 min-h-screen flex items-center justify-center px-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Login</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    autocomplete="email" placeholder="you@example.com"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        placeholder="********"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" />
                    <span class="absolute inset-y-0 right-2 flex items-center cursor-pointer"
                        onclick="togglePasswordVisibility()">
                        👁️
                    </span>
                </div>
            </div>


            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox"
                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" />
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
                </div>
                <div class="text-sm">
                    <a href="{{ route('password.request') }}"
                        class="font-medium text-purple-600 hover:text-purple-500">Forgot your password?</a>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-md font-semibold transition">
                Log in
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">
            Don't have an account?
            <a href="register" class="text-purple-700 font-semibold hover:underline ml-1">Register</a>
        </p>
    </div>
</body>
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const passwordType = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', passwordType);
    }
</script>

</html>
