<?php

namespace App\Http\Controllers;

use App\Http\Services\StatisticsService;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function list(Request $request, StatisticsService $statisticsService)
    {
        $bestScores = $statisticsService->getBestGuessesScores();
        $mostWinsByNickname = $statisticsService->getMostWinsByNickname();

        return view('statistics', compact('bestScores', 'mostWinsByNickname'));
    }
}
