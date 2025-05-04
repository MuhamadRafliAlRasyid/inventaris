{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - My Laravel App</title>
    @vite('resources/css/app.css')
    <style>
        .password-toggle-button {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #7c3aed;
            /* Tailwind purple-600 */
            user-select: none;
            font-size: 1.25rem;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-purple-600 to-blue-500 min-h-screen flex items-center justify-center px-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Register</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="register" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                    autocomplete="name" placeholder="Your full name"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    autocomplete="email" placeholder="you@example.com"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" />
            </div>

            <div class="relative">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required autocomplete="new-password"
                    placeholder="********"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" />
                <br><span id="togglePassword" class="password-toggle-button" title="Show/Hide Password" tabindex="0"
                    role="button" aria-label="Toggle password visibility">&#128065;</span>
            </div>

            <div class="relative">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                    Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    autocomplete="new-password" placeholder="********"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" />
                <br><span id="togglePasswordConfirmation" class="password-toggle-button"
                    title="Show/Hide Confirm Password" tabindex="0" role="button"
                    aria-label="Toggle confirm password visibility">&#128065;</span>
            </div>

            <button type="submit"
                class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-md font-semibold transition">
                Register
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-purple-700 font-semibold hover:underline ml-1">Login</a>
        </p>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });

        togglePassword.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                togglePassword.click();
            }
        });

        const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
        const passwordConfirmationInput = document.getElementById('password_confirmation');

        togglePasswordConfirmation.addEventListener('click', function() {
            const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmationInput.setAttribute('type', type);
        });

        togglePasswordConfirmation.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                togglePasswordConfirmation.click();
            }
        });
    </script>
</body>

</html>
