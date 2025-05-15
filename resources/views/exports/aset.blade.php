<!DOCTYPE html>
<html>
<head>
    <title>Laporan Aset</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Data Aset</h2>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Departemen</th>
                <th>Kondisi</th>
                <th>Tanggal Pembelian</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asets as $aset)
                <tr>
                    <td>{{ $aset->code }}</td>
                    <td>{{ $aset->name }}</td>
                    <td>{{ $aset->category }}</td>
                    <td>{{ $aset->departemen }}</td>
                    <td>{{ ucfirst($aset->condition) }}</td>
                    <td>{{ \Carbon\Carbon::parse($aset->purchase_date)->format('d-m-Y') }}</td>
                    <td>{{ $aset->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
