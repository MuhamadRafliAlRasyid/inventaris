<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Inventory</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/1.png') }}?v={{ time() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    @livewireStyles
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-700">

    <div class="min-h-screen flex flex-col md:flex-row">

        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-white border-r border-gray-200 p-4 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2 mb-6">
                    <img src="{{ asset('assets/logos.png') }}" alt="Logo" width="32" height="32" />
                    <span class="text-xl font-bold text-gray-700">Inventory</span>
                </div>

                @auth
                    <div class="mb-4">
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400 capitalize">{{ Auth::user()->role }}</p>
                    </div>

                    <nav class="space-y-2 text-sm">
                        @if (Auth::user()->role === 'user')
                            <a href="{{ route('barangs.index') }}"
                                class="block py-2 px-3 rounded hover:bg-blue-100 text-gray-700"><i
                                    class="fas fa-box mr-2"></i>Daftar Barang</a>
                            <a href="{{ route('permintaan.index') }}"
                                class="block py-2 px-3 rounded hover:bg-blue-100 text-gray-700"><i
                                    class="fas fa-hand-holding mr-2"></i>Permintaan</a>
                        @elseif(Auth::user()->role === 'spv')
                            <a href="{{ route('permintaan.index') }}"
                                class="block py-2 px-3 rounded hover:bg-blue-100 text-gray-700"><i
                                    class="fas fa-file-alt mr-2"></i>Permintaan</a>
                            <a href="#" class="block py-2 px-3 rounded hover:bg-blue-100 text-gray-700"><i
                                    class="fas fa-chart-bar mr-2"></i>Laporan</a>
                        @elseif(Auth::user()->role === 'admin')
                            <a href="{{ route('barangs.index') }}"
                                class="block py-2 px-3 rounded hover:bg-blue-100 text-gray-700"><i
                                    class="fas fa-boxes mr-2"></i>Daftar Barang</a>
                            <a href="{{ route('permintaan.index') }}"
                                class="block py-2 px-3 rounded hover:bg-blue-100 text-gray-700"><i
                                    class="fas fa-tasks mr-2"></i>Daftar Permintaan</a>
                            <a href="{{ route('admin.index') }}"
                                class="block py-2 px-3 rounded hover:bg-blue-100 text-gray-700"><i
                                    class="fas fa-users mr-2"></i>Daftar Anggota</a>
                        @endif
                    </nav>
                @endauth
            </div>

            <!-- Logout -->
            @auth
                <div class="mt-6">
                    <a href="{{ route('admin.edit', Auth::user()->id) }}"
                        class="block text-sm py-2 px-3 rounded hover:bg-gray-100 text-gray-600">
                        <i class="fas fa-user-cog mr-2"></i> Edit Akun
                    </a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="block text-sm py-2 px-3 rounded hover:bg-gray-100 text-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endauth
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-50 p-6 overflow-auto">
            <!-- Topbar -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>
                @auth
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('img/profile_photo/' . Auth::user()->profile_photo_path) }}"
                            class="w-8 h-8 rounded-full" alt="User Avatar">

                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                    </div>
                @endauth
            </div>

            <!-- Halaman Konten -->
            @yield('content')
        </main>

    </div>

    @livewireScripts
</body>

</html>
