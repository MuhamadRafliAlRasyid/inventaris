<!-- layout.blade.php -->
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

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-xl flex flex-col justify-between border-r">
            <div class="p-6">
                <!-- Logo -->
                <div class="flex items-center gap-3 mb-6">
                    <img src="{{ asset('assets/logos.png') }}" alt="Logo" class="w-8 h-8">
                    <h1 class="text-xl font-bold text-gray-800">INVENTORY</h1>
                </div>

                <!-- User Info -->
                @auth
                    <div class="mb-6">
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-400 capitalize">{{ Auth::user()->role }}</p>
                    </div>

                    <!-- Menu -->
                    <nav class="space-y-1">
                        <p class="uppercase text-gray-400 text-xs mb-2">Dashboard</p>
                        @if (Auth::user()->role === 'user')
                            <a href="{{ route('barangs.index') }}"
                                class="flex items-center px-3 py-2 rounded hover:bg-blue-50 text-gray-700">
                                <i class="fas fa-box mr-2 w-5"></i> Stok Barang
                            </a>
                            <a href="{{ route('permintaan.index') }}"
                                class="flex items-center px-3 py-2 rounded hover:bg-blue-50 text-gray-700">
                                <i class="fas fa-hand-holding mr-2 w-5"></i> Permintaan
                            </a>
                        @elseif (Auth::user()->role === 'spv')
                            <a href="{{ route('permintaan.index') }}"
                                class="flex items-center px-3 py-2 rounded hover:bg-blue-50 text-gray-700">
                                <i class="fas fa-file-alt mr-2 w-5"></i> Permintaan
                            </a>
                            <a href="#" class="flex items-center px-3 py-2 rounded hover:bg-blue-50 text-gray-700">
                                <i class="fas fa-chart-bar mr-2 w-5"></i> Laporan
                            </a>
                        @elseif (Auth::user()->role === 'admin')
                            <a href="{{ route('barangs.index') }}"
                                class="flex items-center px-3 py-2 rounded hover:bg-blue-50 text-gray-700">
                                <i class="fas fa-boxes mr-2 w-5"></i> Stok Barang
                            </a>
                            <a href="{{ route('permintaan.index') }}"
                                class="flex items-center px-3 py-2 rounded hover:bg-blue-50 text-gray-700">
                                <i class="fas fa-tasks mr-2 w-5"></i> Daftar Permintaan
                            </a>
                            <a href="{{ route('admin.index') }}"
                                class="flex items-center px-3 py-2 rounded hover:bg-blue-50 text-gray-700">
                                <i class="fas fa-users mr-2 w-5"></i> Daftar Anggota
                            </a>
                        @endif
                    </nav>
                @endauth

                <!-- Tools -->
                <div class="mt-6">
                    <p class="uppercase text-gray-400 text-xs mb-2">Tools</p>
                    <a href="{{ route('admin.edit', Auth::user()->id) }}"
                        class="flex items-center px-3 py-2 rounded hover:bg-gray-100 text-sm text-gray-600">
                        <i class="fas fa-user-cog mr-2 w-5"></i> Account & Security
                    </a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="flex items-center px-3 py-2 rounded hover:bg-gray-100 text-sm text-red-600">
                        <i class="fas fa-sign-out-alt mr-2 w-5"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-50 overflow-auto">
            <!-- Navbar -->
            @php
                $route = request()->route()->getName();

                $breadcrumbs = [
                    'barangs.index' => 'Stok Barang',
                    'permintaan.index' => 'Permintaan',
                    'admin.index' => 'Daftar Anggota',
                    'dashboard' => 'Dashboard',
                    // Tambahkan sesuai route lainnya
                ];

                $breadcrumb = $breadcrumbs[$route] ?? 'Halaman';
            @endphp

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Masukan Item</h2>
                    <nav class="text-sm text-gray-500">
                        Dashboard <span class="mx-1">›</span>
                        <span class="text-blue-600">{{ $breadcrumb }}</span>
                    </nav>
                </div>

                <div class="flex items-center gap-4">
                    <i class="fas fa-bell text-gray-400 text-lg"></i>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('img/profile_photo/' . Auth::user()->profile_photo_path) }}"
                            class="w-8 h-8 rounded-full border" alt="User Avatar">
                        <div class="text-sm">
                            <p class="font-medium">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 capitalize">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            @yield('content')
        </main>
    </div>

    @livewireScripts
</body>

</html>
