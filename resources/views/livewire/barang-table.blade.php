<div class="max-w-6xl mx-auto">
    <h1 class="text-lg font-semibold mb-1">Product</h1>
    <div class="flex items-center text-xs text-gray-500 mb-4 select-none">
        <span>Stok Barang</span>
        <i class="fas fa-chevron-right mx-1"></i>
        <span>Item</span>
    </div>

    <!-- Search Bar -->
    <div
        class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-white border border-gray-200 rounded-xl p-4 space-y-4 sm:space-y-0">
        <form class="flex items-center w-full sm:w-96 border border-gray-300 rounded-lg overflow-hidden">
            <input wire:model.debounce.300ms="search" placeholder="Search for id, name item"
                class="flex-grow px-4 py-2 text-xs text-gray-500 placeholder-gray-400 focus:outline-none"
                type="text" />
            <button type="submit" class="px-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <div class="flex items-center space-x-2">
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('barangs.create') }}"
                    class="flex items-center text-xs text-white bg-blue-600 hover:bg-blue-700 rounded-md px-4 py-2">
                    Add Item <i class="fas fa-plus ml-1"></i>
                </a>
            @elseif (auth()->user()->role === 'user')
                <a href="{{ route('permintaan.create') }}"
                    class="flex items-center text-xs text-white bg-green-600 hover:bg-green-700 rounded-md px-4 py-2">
                    Ajukan Permintaan <i class="fas fa-plus ml-1"></i>
                </a>
            @endif
        </div>
    </div>

    <!-- Table -->
    <div class="mt-4 border border-gray-200 rounded-xl overflow-hidden text-xs text-gray-700">
        <table class="w-full border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Product</th>
                    <th class="px-4 py-3 text-center">Stok</th>
                    @if (auth()->user()->role === 'admin')
                        <th class="px-4 py-3 text-center">Aksi</th>
                    @elseif (auth()->user()->role === 'user')
                        <th class="px-4 py-3 text-center">Status</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($barang as $index => $item)
                    <tr class="border-t border-gray-100 hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $barang->firstItem() + $index }}</td>
                        <td class="px-4 py-3 flex items-center space-x-3">
                            <img src="{{ asset('img/' . $item->foto_barang) }}" alt="{{ $item->nama_barang }}"
                                class="w-6 h-6 rounded object-cover" />
                            <div class="leading-tight text-left">
                                <span class="text-blue-600 text-xs font-semibold">
                                    {{ $item->kode_barang ?? 'Kode-' . $item->id }}
                                </span>
                                <div class="text-gray-500 text-[10px]">{{ $item->nama_barang }}</div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">{{ $item->stok }}</td>

                        @if (auth()->user()->role === 'admin')
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('barangs.edit', $item->id) }}"
                                    class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('barangs.destroy', $item->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        @elseif (auth()->user()->role === 'user')
                            <td class="px-4 py-3 text-center">
                                @if ($item->stok > 0)
                                    <span
                                        class="inline-block px-2 py-1 rounded-full bg-green-100 text-green-700 font-medium">Available</span>
                                @else
                                    <span
                                        class="inline-block px-2 py-1 rounded-full bg-red-100 text-red-700 font-medium">Not
                                        Available</span>
                                @endif
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 text-xs text-gray-500 flex justify-between items-center">
        <div>
            Menampilkan {{ $barang->firstItem() }} - {{ $barang->lastItem() }} dari {{ $barang->total() }} data
        </div>
        <div>
            {{ $barang->links('pagination::tailwind') }}
        </div>
    </div>
</div>
