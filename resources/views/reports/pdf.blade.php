<!DOCTYPE html>
<html>
<head>
    <title>Laporan Inventaris Inlife</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #10b981; padding-bottom: 10px; }
        .header h1 { margin: 0; color: #0f172a; font-size: 20px; }
        .header p { margin: 5px 0 0 0; color: #64748b; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #cbd5e1; padding: 8px 10px; text-align: left; }
        th { background-color: #f1f5f9; color: #0f172a; font-weight: bold; }
        .status-selesai { color: #059669; font-weight: bold; }
        .status-pinjam { color: #d97706; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h1>INLIFE INVENTORY SYSTEM</h1>
        <p>Laporan Resmi Sirkulasi Peminjaman Aset Logistik</p>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Transaksi</th>
                <th>Peminjam</th>
                <th>Barang Logistik</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>TRX-{{ str_pad($item->borrowing_id, 4, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $item->borrowing->user->name ?? '-' }}</td>
                <td>{{ $item->product->name ?? '-' }} <br><small>({{ $item->product->code ?? '-' }})</small></td>
                <td>{{ \Carbon\Carbon::parse($item->borrowing->borrow_date)->format('d/m/Y') }}</td>
                <td>{{ $item->return_date ? \Carbon\Carbon::parse($item->return_date)->format('d/m/Y') : '-' }}</td>
                @php $isReturned = !empty($item->return_date); @endphp
                <td class="{{ $isReturned ? 'status-selesai' : 'status-pinjam' }}">
                    {{ $isReturned ? 'Selesai' : 'Dipinjam' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>