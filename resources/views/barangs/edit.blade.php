@extends('layouts.app')
@section('content')

    <h1 class="text-center text-3xl font-normal mb-8 sm:mb-12">EDIT BARANG</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-sm sm:text-base">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barangs.update', $barang->id) }}" method="POST" enctype="multipart/form-data" novalidate
        class="space-y-8 sm:space-y-10">
        @csrf
        @method('PUT')

        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6">
            <label for="nama_barang" class="block text-base font-normal mb-2 sm:mb-0 sm:w-1/4">NAMA BARANG</label>
            <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}"
                required maxlength="255"
                class="w-full sm:w-3/4 bg-[#d9d9d9] h-12 px-4 text-black text-base font-normal rounded outline-none focus:ring-2 focus:ring-[#2557d6] @error('nama_barang') border border-red-500 @enderror" />
        </div>
        @error('nama_barang')
            <p class="text-red-600 text-sm sm:text-base mt-1 sm:ml-[25%]">{{ $message }}</p>
        @enderror

        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6">
            <label for="stok" class="block text-base font-normal mb-2 sm:mb-0 sm:w-1/4">STOK</label>
            <input type="number" id="stok" name="stok" value="{{ old('stok', $barang->stok) }}" required
                min="0"
                class="w-full sm:w-3/4 bg-[#d9d9d9] h-12 px-4 text-black text-base font-normal rounded outline-none focus:ring-2 focus:ring-[#2557d6] @error('stok') border border-red-500 @enderror" />
        </div>
        @error('stok')
            <p class="text-red-600 text-sm sm:text-base mt-1 sm:ml-[25%]">{{ $message }}</p>
        @enderror

        <div class="flex flex-col sm:flex-row sm:items-start sm:space-x-6">
            <label for="foto_barang" class="block text-base font-normal mb-2 sm:mb-0 sm:w-1/4">FOTO BARANG</label>
            <div class="w-full sm:w-3/4 flex flex-col sm:flex-row sm:items-center sm:space-x-6">
                @if ($barang->foto_barang)
                    <img src="{{ asset('img/' . $barang->foto_barang) }}" alt="Foto Barang"
                        class="w-32 h-32 object-cover rounded mb-4 sm:mb-0 flex-shrink-0" />
                @endif
                <div class="flex flex-col flex-grow">
                    <input type="file" id="foto_barang" name="foto_barang" accept="image/*"
                        class="w-full bg-[#d9d9d9] h-12 px-4 text-black text-base font-normal rounded outline-none cursor-pointer @error('foto_barang') border border-red-500 @enderror" />
                    @error('foto_barang')
                        <p class="text-red-600 text-sm sm:text-base mt-1">{{ $message }}</p>
                    @enderror
                    <div id="previewContainer" class="mt-4 hidden sm:mt-6">
                        <img id="previewImage" src="#" alt="Preview" class="w-32 h-32 object-cover rounded" />
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-4 mt-6 justify-start">
            <button type="submit"
                class="w-32 bg-[#2557d6] text-white text-base font-medium py-2 rounded hover:bg-[#1a3db8] transition">
                UPDATE
            </button>
            <a href="{{ route('barangs.index') }}"
                class="w-32 text-center bg-gray-100 text-[#2557d6] text-base font-medium py-2 rounded hover:underline hover:bg-gray-200 transition">
                BATAL
            </a>
        </div>

    </form>
    </div>
@endsection
<script>
    const fotoInput = document.getElementById('foto_barang');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');

    fotoInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            previewImage.src = '#';
            previewContainer.classList.add('hidden');
        }
    });
</script>
</body>

</html>
