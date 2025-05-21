{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inventory Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .password-toggle-button {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: white;
            font-size: 1rem;
        }
    </style>
</head>

<body class="bg-white min-h-screen flex flex-col items-center justify-center p-6">
    <div class="flex items-center space-x-1 mb-10">
        <img alt="Inventory logo" class="w-16 h-16" src="assets/logos.png" />
        <h1 class="text-5xl font-sans font-normal">
            <span class="text-orange-600">Inven</span><span class="text-blue-800">tory</span>
        </h1>
    </div>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded w-full max-w-sm">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="w-full max-w-sm space-y-6 relative">
        @csrf

        <div>
            <label class="block text-black mb-1" for="name">Username</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                autocomplete="name" class="w-full rounded-lg bg-blue-800 h-12 px-4 text-white focus:outline-none"
                placeholder="Your full name" />
        </div>

        <div>
            <label class="block text-black mb-1" for="email">Gmail</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                autocomplete="email" class="w-full rounded-lg bg-blue-800 h-12 px-4 text-white focus:outline-none"
                placeholder="you@example.com" />
        </div>

        <div class="relative">
            <label class="block text-black mb-1" for="password">Password</label>
            <div class="relative">
                <input id="password" name="password" type="password" required autocomplete="new-password"
                    class="w-full rounded-lg bg-blue-800 h-12 px-4 pr-10 text-white focus:outline-none"
                    placeholder="********" />
                <span id="togglePassword"
                    class="absolute inset-y-0 right-3 flex items-center text-white cursor-pointer text-lg">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
        </div>

        <div class="relative">
            <label class="block text-black mb-1" for="password_confirmation">Confirm Password</label>
            <div class="relative">
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    autocomplete="new-password"
                    class="w-full rounded-lg bg-blue-800 h-12 px-4 pr-10 text-white focus:outline-none"
                    placeholder="********" />
                <span id="togglePasswordConfirmation"
                    class="absolute inset-y-0 right-3 flex items-center text-white cursor-pointer text-lg">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
        </div>


        <button type="submit"
            class="w-full rounded-lg bg-blue-800 h-12 text-white text-lg font-semibold hover:bg-blue-900 transition">
            Create Account
        </button>

        <p class="text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-800 font-semibold hover:underline ml-1">Login</a>
        </p>
    </form>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });

        const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        togglePasswordConfirmation.addEventListener('click', () => {
            const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmationInput.setAttribute('type', type);
        });
    </script>
</body>

</html>
