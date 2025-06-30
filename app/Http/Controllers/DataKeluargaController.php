<?php

namespace App\Http\Controllers;

use App\Models\DataKeluarga;
use App\Models\StatusPernikahan;
use App\Models\Survey;
use Illuminate\Http\Request;

class DataKeluargaController extends Controller
{
    public function index()
    {
        $keluargas = DataKeluarga::with(['survey', 'statusPernikahan'])->get();
        return view('keluarga.index', compact('keluargas'));
    }

    public function create(Request $request)
    {
        $survey_id = $request->survey; // mengambil ?survey=xxx dari redirect
        $survey = Survey::findOrFail($survey_id);

        $statusPernikahans = \App\Models\StatusPernikahan::all(); // jika diperlukan di form

        return view('keluarga.form', compact('survey', 'statusPernikahans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'survey_id' => 'required|exists:surveys,id',
            'status_pernikahan_id' => 'required|exists:status_pernikahan,id',
            'jumlah_anak' => 'required|integer|min:0',
            'jumlah_tanggungan' => 'required|integer|min:0',
        ]);

        DataKeluarga::create($request->all());
        return redirect()->route('pekerjaan.create');
    }

    public function destroy(DataKeluarga $keluarga)
    {
        $keluarga->delete();
        return redirect()->route('keluarga.index')->with('success', 'Data keluarga berhasil dihapus.');
    }
}
