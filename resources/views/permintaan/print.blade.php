<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Print Permintaan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <h2>Detail Permintaan</h2>

    <p><strong>Nama User:</strong> {{ $permintaan->user->name }}</p>
    <p><strong>Tanggal:</strong> {{ $permintaan->created_at->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Tanggal Permintaan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permintaan->details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->barang->nama_barang }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>{{ $detail->satuan }}</td>
                    <td>{{ \Carbon\Carbon::parse($detail->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $detail->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>
    <p><strong>Mengetahui:</strong> {{ $permintaan->mengetahuiUser->name ?? '-' }}</p>
    <p><strong>Disetujui:</strong> {{ $permintaan->approvalUser->name ?? '-' }}</p>
</body>

</html>
