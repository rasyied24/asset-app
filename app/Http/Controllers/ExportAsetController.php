<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportAsetController extends Controller
{
    public function export()
    {
        $asets = Aset::all();

        $pdf = Pdf::loadView('exports.aset', compact('asets'));
        return $pdf->download('data-aset.pdf');
    }

}
