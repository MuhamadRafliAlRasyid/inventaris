    <div class="max-w-7xl mx-auto p-6">
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-2xl font-bold text-blue-700 mb-6">Daftar Permintaan</h2>

            <!-- Search Input -->
            <input wire:model.debounce.300ms="search" type="text" placeholder="Cari berdasarkan nama barang..."
                class="w-full px-4 py-2 mb-6 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

            @if ($permintaans->count())
                <!-- Table -->
                <div class="overflow-x-auto rounded-xl shadow">
                    <table class="min-w-full text-sm text-left text-gray-700">
                        <thead class="bg-blue-600 text-white sticky top-0 z-10">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama User</th>
                                <th class="px-4 py-3">Jumlah Item</th>
                                <th class="px-4 py-3">Jumlah Barang</th>
                                <th class="px-4 py-3">Mengetahui</th>
                                <th class="px-4 py-3">Approval</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($permintaans as $index => $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">{{ $permintaans->firstItem() + $index }}</td>
                                    <td class="px-4 py-3">{{ $item->user->name ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $item->details->count() }}</td>
                                    <td class="px-4 py-3">{{ $item->details->sum('jumlah') }}</td>
                                    <td class="px-4 py-3">{{ $item->mengetahuiUser->name ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $item->approvalUser->name ?? '-' }}</td>
                                    <td class="px-4 py-3 space-y-1 text-center">
                                        {{-- Aksi untuk User --}}
                                        @if ($context === 'index' && Auth::user()->hasRole('user') && $item->user_id === Auth::id())
                                            @if (!$item->mengetahui && !$item->approval)
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('permintaan.user.editMultiple', $item->id) }}"
                                                    class="inline-block text-blue-600 hover:text-blue-800 font-semibold text-sm mr-2">Edit</a>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('permintaan.destroyUser', $item->id) }}"
                                                    method="POST" class="inline-block"
                                                    onsubmit="return confirm('Yakin ingin menghapus permintaan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-800 font-semibold text-sm">Hapus</button>
                                                </form>
                                            @endif
                                        @endif


                                        {{-- Aksi untuk SPV --}}
                                        @if (Auth::user()->hasRole('spv') && !$item->mengetahui)
                                            <a href="{{ route('permintaan.spv.detail', $item->id) }}"
                                                class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 text-sm font-semibold transition">
                                                Lihat
                                            </a>
                                        @endif


                                        {{-- Aksi untuk Admin --}}
                                        @if (Auth::user()->hasRole('admin') && $item->mengetahui && !$item->approval)
                                            <form action="{{ route('permintaan.admin.setujui', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-green-700 text-white px-3 py-1 rounded-lg hover:bg-green-800 text-sm font-semibold transition">
                                                    Setujui Admin
                                                </button>
                                            </form>
                                        @endif

                                        @if (
                                            $context === 'laporan' &&
                                                $item->mengetahui &&
                                                (Auth::user()->hasRole('admin') || (Auth::user()->hasRole('user') && $item->user_id === Auth::id())))
                                            <a href="{{ route('permintaan.cetak', $item->id) }}"
                                                class="inline-block bg-gray-200 text-gray-800 px-3 py-1 rounded-lg hover:bg-gray-300 text-sm font-semibold transition"
                                                target="_blank">
                                                Print
                                            </a>
                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $permintaans->links() }}
                </div>
            @else
                <div class="text-center text-gray-500 py-10">
                    Tidak ada data permintaan.
                </div>
            @endif
        </div>
    </div>
