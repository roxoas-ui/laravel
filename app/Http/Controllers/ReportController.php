<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facades\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\License;

class ReportController extends Controller
{
    public function generalStatusPdf(Request $request)
    {
        $licenses = License::all();
        $pdf = Pdf::loadView('reports.general_status', ['licenses' => $licenses]);
        return $pdf->download('status_licenses.pdf');
    }

    public function exportLicensesExcel(Request $request)
    {
        $licenses = License::all();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray(['ID', 'Number', 'Issuer', 'Issued At', 'Expires At', 'Status'], null, 'A1');
        $row = 2;
        foreach ($licenses as $l) {
            $sheet->fromArray([$l->id, $l->number, $l->issuer, $l->issued_at, $l->expires_at, $l->status], null, 'A'.$row);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filePath = sys_get_temp_dir().'/licenses.xlsx';
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
