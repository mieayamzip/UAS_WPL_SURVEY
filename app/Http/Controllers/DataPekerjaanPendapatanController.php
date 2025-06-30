<?php

namespace App\Http\Controllers;

use App\Models\DataPekerjaanPendapatan;
use App\Models\Pekerjaan;
use App\Models\Pendapatan;
use App\Models\Survey;
use Illuminate\Http\Request;

class DataPekerjaanPendapatanController extends Controller
{
    public function index()
    {
        $pekerjaans = DataPekerjaanPendapatan::with('survey', 'pekerjaan', 'pendapatan')->get();
        return view('pekerjaan.index', compact('pekerjaans'));
    }

    public function create()
    {
        $survey = Survey::latest()->first();
        $pekerjaan = Pekerjaan::all();
        $pendapatan = Pendapatan::all();

        return view('pekerjaan.form', compact('survey', 'pekerjaan', 'pendapatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'survey_id' => 'required|exists:surveys,id',
            'pekerjaan_id' => 'required|exists:pekerjaans,id',
            'pendapatan_id' => 'required|exists:pendapatans,id',
        ]);

        DataPekerjaanPendapatan::create($request->all());

        return redirect()->route('rumah.create', ['survey' => $request->survey_id]);
    }

    public function destroy(DataPekerjaanPendapatan $pekerjaan)
    {
        $pekerjaan->delete();
        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan berhasil dihapus.');
    }
}
