<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\DataKeluarga;
use App\Models\DataRumah;
use App\Models\DataPekerjaanPendapatan;
use App\Models\DataKendaraan;
use Barryvdh\DomPDF\Facade\Pdf;


class ExportController extends Controller
{
    public function index()
    {
        $surveys = Survey::all();
        return view('export.index', compact('surveys'));
    }

    public function exportPdf($id)
    {
        $survey = Survey::findOrFail($id);
        $keluarga = DataKeluarga::where('survey_id', $id)->first();
        $rumah = DataRumah::where('survey_id', $id)->first();
        $pekerjaan = DataPekerjaanPendapatan::where('survey_id', $id)->first();
        $kendaraan = DataKendaraan::where('survey_id', $id)->get();

        $pdf = Pdf::loadView('export.pdf_template', compact('survey', 'keluarga', 'rumah', 'pekerjaan', 'kendaraan'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('Survey_' . $survey->code . '.pdf');
    }
}
