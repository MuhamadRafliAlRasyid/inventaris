@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold text-blue-700 mb-4">Ajukan Permintaan Barang</h2>

        <form action="{{ route('permintaan.store') }}" method="POST">
            @csrf

            <!-- Barang -->
            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Barang</label>
                <select name="barang_id" class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Jumlah -->
            <div class="mb-4">
                <label class="block font-semibold mb-1">Jumlah</label>
                <input type="number" name="jumlah"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none" required min="1">
            </div>

            <!-- Keterangan -->
            <div class="mb-4">
                <label class="block font-semibold mb-1">Keterangan</label>
                <textarea name="keterangan" class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none" rows="3"></textarea>
            </div>

            <!-- Submit -->
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Ajukan Permintaan
            </button>
        </form>
    </div>
@endsection
