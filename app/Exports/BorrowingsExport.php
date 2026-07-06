<?php

namespace App\Exports;

use App\Models\BorrowingDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BorrowingsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        // Mengambil semua data sirkulasi beserta relasinya
        return BorrowingDetail::with(['borrowing.user', 'product'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No. Transaksi',
            'Nama Peminjam',
            'Nama Barang Logistik',
            'Kode Barang',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status'
        ];
    }

    public function map($item): array
    {
        $isReturned = !empty($item->return_date);

        return [
            'TRX-' . str_pad($item->borrowing_id, 4, '0', STR_PAD_LEFT),
            $item->borrowing->user->name ?? 'User Dihapus',
            $item->product->name ?? 'Barang Dihapus',
            $item->product->code ?? '-',
            \Carbon\Carbon::parse($item->borrowing->borrow_date)->format('d/m/Y'),
            $isReturned ? \Carbon\Carbon::parse($item->return_date)->format('d/m/Y') : '-',
            $isReturned ? 'Selesai' : 'Sedang Dipinjam',
        ];
    }
}