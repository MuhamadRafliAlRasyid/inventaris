<div class="overflow-x-auto max-w-4xl mx-auto">
    <!-- Input Pencarian -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-blue-800">Daftar Barang</h2>
        <input type="text" wire:model.debounce.300ms="search" placeholder="Cari barang..."
            class="border border-gray-300 rounded px-4 py-2 w-64 focus:outline-none focus:ring" />
    </div>

    <!-- Tabel -->
    <div class="bg-[#1e49e2] text-white rounded-md shadow-lg">
        <div class="max-h-[500px] overflow-y-auto">
            <table class="w-full min-w-[600px]">
                <thead class="sticky top-0 bg-[#1641c2] z-10">
                    <tr>
                        <th class="p-3 text-left">No</th>
                        <th class="p-3 text-center">Foto</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-center">Stok</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    @forelse ($barang as $index => $item)
                        <tr class="hover:bg-[#2a5ae8] transition">
                            <td class="text-center p-2">{{ $barang->firstItem() + $index }}</td>
                            <td class="text-center p-2">
                                <img src="{{ asset('img/' . $item->foto_barang) }}"
                                    class="w-12 h-12 rounded object-cover mx-auto" />
                            </td>
                            <td class="p-2">{{ $item->nama_barang }}</td>
                            <td class="text-center p-2">{{ $item->stok }}</td>
                            <td class="text-center p-2">
                                @if (auth()->user()->role === 'admin')
                                    <a href="{{ route('barangs.edit', $item->id) }}"
                                        class="bg-white text-blue-600 px-3 py-1 rounded-md text-sm font-semibold shadow hover:bg-gray-100">Edit</a>
                                    <form action="{{ route('barangs.destroy', $item->id) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded-md text-sm font-semibold hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                @elseif (auth()->user()->role === 'user')
                                    <a href="{{ route('permintaan.create', ['barang_id' => $item->id]) }}"
                                        class="bg-green-600 text-white px-3 py-1 rounded-md text-sm font-semibold shadow hover:bg-green-700">
                                        Ajukan Permintaan
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 bg-blue-100 text-blue-800 rounded-b-md">
            {{ $barang->links() }}
        </div>
    </div>
</div>
