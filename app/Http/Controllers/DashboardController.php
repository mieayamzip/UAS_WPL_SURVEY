<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Skor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSurvey = Survey::count();
        $surveyLayak = Skor::where('kelayakan', 'Layak')->count();
        $surveyTidakLayak = Skor::where('kelayakan', 'Tidak Layak')->count();
        $surveyBelumLengkap = $totalSurvey - ($surveyLayak + $surveyTidakLayak);

        return view('dashboard.index', compact('totalSurvey', 'surveyLayak', 'surveyTidakLayak', 'surveyBelumLengkap'));
    }
}
