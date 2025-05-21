<div class="max-w-6xl mx-auto p-4">
    <h2 class="text-2xl font-semibold text-blue-700 mb-4">Daftar Permintaan</h2>

    <input wire:model.debounce.300ms="search" type="text" placeholder="Cari berdasarkan nama barang..."
        class="border border-gray-300 rounded px-4 py-2 mb-4 w-full">

    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-blue-600 text-white sticky top-0">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Nama Barang</th>
                    <th class="p-3">Jumlah</th>
                    <th class="p-3">Pemohon</th>
                    <th class="p-3">Mengetahui</th>
                    <th class="p-3">Approval</th>
                    <th class="p-3">Keterangan</th>
                    <th class="p-3">Aksi</th> <!-- Kolom baru -->
                </tr>
            </thead>
            <tbody>
                @forelse ($permintaans as $index => $item)
                    <tr class="hover:bg-gray-100">
                        <td class="p-3">{{ $permintaans->firstItem() + $index }}</td>
                        <td class="p-3">{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td class="p-3">{{ $item->jumlah }}</td>
                        <td class="p-3">{{ $item->user->name ?? '-' }}</td>
                        <td class="p-3">{{ $item->mengetahuiUser->name ?? '-' }}</td>
                        <td class="p-3">{{ $item->approvalUser->name ?? '-' }}</td>
                        <td class="p-3">{{ $item->keterangan }}</td>
                        <td class="p-3 space-x-2">
                            @if (Auth::user()->hasRole('user') && $item->id_user === Auth::id())
                                @if (!$item->mengetahui && !$item->approval)
                                    <a href="{{ route('permintaan.user.edit', $item->id) }}"
                                        class="text-blue-500 hover:underline">Edit</a>
                                    <form action="{{ route('permintaan.user.destroy', $item->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                            class="text-red-500 hover:underline">Hapus</button>
                                    </form>
                                @endif
                            @elseif (Auth::user()->hasRole('spv') && !$item->mengetahui)
                                <form action="{{ route('permintaan.spv.setujui', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:underline">Setujui SPV</button>
                                </form>
                            @elseif (Auth::user()->hasRole('admin') && $item->mengetahui && !$item->approval)
                                <form action="{{ route('permintaan.admin.setujui', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:underline">Setujui Admin</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center p-4">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $permintaans->links() }}
    </div>
</div>
