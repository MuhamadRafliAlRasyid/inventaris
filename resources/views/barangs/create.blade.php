<!-- resources/views/barangs/create.blade.php -->
@extends('layouts.app')

@section('content')
    <style>
        .form-control {
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .form-control:hover,
        .form-control:focus {
            border-color: #2557d6;
            box-shadow: 0 0 8px rgba(37, 87, 214, 0.5);
            outline: none;
        }

        button.btn-primary {
            background-color: #2557d6;
            border-color: #2557d6;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        button.btn-primary:hover {
            background-color: #1a3db8;
            border-color: #1a3db8;
        }

        #preview {
            max-height: 300px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(37, 87, 214, 0.4);
            transition: transform 0.3s ease;
        }

        #preview:hover {
            transform: scale(1.05);
        }
    </style>
    </head>

    <body>
        <div class="container mt-5">
            <h1 class="mb-4 text-center">Tambah Barang</h1>
            <form method="POST" action="{{ route('barangs.store') }}" enctype="multipart/form-data" class="mx-auto"
                style="max-width: 480px;">
                @csrf
                <div class="mb-4">
                    <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" class="form-control" required
                        placeholder="Masukkan nama barang" />
                </div>
                <div class="mb-4">
                    <label for="stok" class="form-label fw-semibold">Stok</label>
                    <input type="number" id="stok" name="stok" class="form-control" required
                        placeholder="Masukkan jumlah stok" min="0" />
                </div>
                <div class="mb-4">
                    <label for="foto_barang" class="form-label fw-semibold">Foto Barang</label>
                    <input type="file" id="foto_barang" name="foto_barang" class="form-control" required
                        accept="image/*" />
                </div>
                <div class="mb-4 text-center">
                    <img id="preview" src="#" alt="Preview Gambar"
                        style="display:none; width: 100%; height: auto;" />
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                </div>
            </form>
        </div>

        <script>
            document.getElementById('foto_barang').addEventListener('change', function(event) {
                const [file] = event.target.files;
                const preview = document.getElementById('preview');
                if (file) {
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                } else {
                    preview.src = '#';
                    preview.style.display = 'none';
                }
            });
        </script>
    </body>

    </html>
@endsection
