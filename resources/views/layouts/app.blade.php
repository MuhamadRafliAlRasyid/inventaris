<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Inventory</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/1.png') }}?v={{ time() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js untuk interaktifitas dropdown -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    {{-- Livewire Styles --}}
    @livewireStyles
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo + Menu Kiri -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('barangs.index') }}" class="font-bold flex items-center space-x-2">
                    <img src="{{ asset('assets/logos.png') }}" alt="Logo" width="40" height="40">
                    <h4 class="text-2xl font-normal flex flex-wrap">
                        <span class="text-[#F97316]">Inven</span>
                        <span class="text-[#1E40AF]">tory</span>
                    </h4>
                </a>
                <!-- Menu kiri berdasarkan role -->
                @auth
                    @if (Auth::user()->role === 'user')
                        <a href="{{ route('barangs.index') }}" class="hover:underline">Daftar Barang</a>
                        <a href="{{ route('permintaan.index') }}" class="hover:underline">Permintaan</a>
                    @elseif(Auth::user()->role === 'spv')
                        <a href="{{ route('permintaan.index') }}" class="hover:underline">Permintaan</a>
                        <a href="#" class="hover:underline">Laporan</a> <!-- Ganti route jika ada -->
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('barangs.index') }}" class="hover:underline">Daftar Barang</a>
                        <a href="{{ route('permintaan.index') }}" class="hover:underline">Daftar Permintaan</a>
                        <a href="{{ route('admin.index') }}" class="hover:underline">Daftar Anggota</a>
                        {{-- <a href="#" class="hover:underline">Laporan</a> <!-- Ganti route jika ada --> --}}
                    @endif
                @endauth
            </div>

            <!-- Bagian Profil/Login Dropdown -->
            <!-- Gunakan Alpine.js untuk mengelola state dropdown -->
            <div class="relative" x-data="{ open: false }">
                <!-- Tombol untuk membuka/menutup dropdown -->
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <!-- Avatar default -->
                    <img src="{{ asset('assets/avatar.png') }}" alt="Avatar" class="w-8 h-8 rounded-full">

                    <!-- Jika sudah login, tampilkan nama user -->
                    @auth
                        <span>{{ Auth::user()->name }}</span>
                    @else
                        <!-- Jika belum login, tampilkan tulisan "Login" -->
                        <span>Login</span>
                    @endauth

                    <!-- Icon panah bawah -->
                    <i class="fas fa-caret-down"></i>
                </button>

                <!-- Dropdown Menu -->
                <!-- Tampil jika "open" bernilai true -->
                <!-- @click.away = tutup dropdown jika klik di luar -->
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-40 bg-white text-black rounded shadow-lg z-50 py-2">

                    @auth
                        <!-- Jika login, tampilkan opsi edit akun -->
                        <a href="{{ route('admin.edit', Auth::user()->id) }}" class="block px-4 py-2 hover:bg-gray-100">
                            Edit Akun
                        </a>

                        <!-- Logout button -->
                        <!-- Mencegah aksi default dan jalankan form logout -->
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="block px-4 py-2 hover:bg-gray-100">
                            Logout
                        </a>
                    @else
                        <!-- Jika belum login, arahkan ke halaman login -->
                        <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100">
                            Login
                        </a>
                    @endauth
                </div>

                <!-- Form logout tersembunyi -->
                <!-- Digunakan saat klik link logout -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
    </nav>

    <!-- Konten Halaman -->
    <div class="container mx-auto mt-6">
        @yield('content')
    </div>

    {{-- Livewire Scripts --}}
    @livewireScripts
</body>

</html>
