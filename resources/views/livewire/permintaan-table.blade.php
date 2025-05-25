<div class="max-w-7xl mx-auto p-6">
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-2xl font-bold text-blue-700 mb-6">Daftar Permintaan</h2>

        <!-- Search Input -->
        <input wire:model.debounce.300ms="search" type="text" placeholder="Cari berdasarkan nama barang..."
            class="w-full px-4 py-2 mb-6 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

        <!-- Table -->
        <div class="overflow-x-auto rounded-xl shadow">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-blue-600 text-white sticky top-0 z-10">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Barang</th>
                        <th class="px-4 py-3">Jumlah</th>
                        <th class="px-4 py-3">Pemohon</th>
                        <th class="px-4 py-3">Mengetahui</th>
                        <th class="px-4 py-3">Approval</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($permintaans as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $permintaans->firstItem() + $index }}</td>
                            <td class="px-4 py-3">{{ $item->barang->nama_barang ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->jumlah }}</td>
                            <td class="px-4 py-3">{{ $item->user->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->mengetahuiUser->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->approvalUser->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->keterangan }}</td>
                            <td class="px-4 py-3 space-y-1 text-center">
                                @if (Auth::user()->hasRole('user') && $item->id_user === Auth::id())
                                    @if (!$item->mengetahui && !$item->approval)
                                        <a href="{{ route('permintaan.user.edit', $item->id) }}"
                                            class="inline-block text-blue-600 hover:text-blue-800 font-semibold text-sm">Edit</a>
                                        <form action="{{ route('permintaan.user.destroy', $item->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 font-semibold text-sm">Hapus</button>
                                        </form>
                                    @endif
                                @elseif (Auth::user()->hasRole('spv') && !$item->mengetahui)
                                    <form action="{{ route('permintaan.spv.setujui', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 text-sm font-semibold transition">Setujui
                                            SPV</button>
                                    </form>
                                @elseif (Auth::user()->hasRole('admin') && $item->mengetahui && !$item->approval)
                                    <form action="{{ route('permintaan.admin.setujui', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-700 text-white px-3 py-1 rounded-lg hover:bg-green-800 text-sm font-semibold transition">Setujui
                                            Admin</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-6 text-gray-500">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $permintaans->links() }}
        </div>
    </div>
</div>
