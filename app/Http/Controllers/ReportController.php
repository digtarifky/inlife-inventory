<?php

namespace App\Http\Controllers;

use App\Models\BorrowingDetail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BorrowingsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new BorrowingsExport, 'Laporan_Inventaris_Inlife.xlsx');
    }

    public function exportPdf()
    {
        $items = BorrowingDetail::with(['borrowing.user', 'product'])->latest()->get();
        
        $pdf = Pdf::loadView('reports.pdf', compact('items'));
        
        // Atur ukuran kertas ke A4 (Landscape agar tabel tidak terpotong)
        $pdf->setPaper('a4', 'landscape');
        
        return $pdf->download('Laporan_Inventaris_Inlife.pdf');
    }
}