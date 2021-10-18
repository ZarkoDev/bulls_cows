<?php

namespace App\Http\Services;

use App\Game;
use App\GameGuess;
use App\Http\Traits\ErrorTrait;
use Illuminate\Support\Facades\DB;

class StatisticsService
{
    use ErrorTrait;

    const BEST_GUESSES_ROWS_DEFAULT = 10;
    const MOST_WINS_BY_NICKNAME_ROWS_DEFAULT = 10;

    public function getBestGuessesScores(int $rows = self::BEST_GUESSES_ROWS_DEFAULT)
    {
        return GameGuess::select(DB::raw('game_id, MAX(score) as score'))
            ->orderBy('score', 'DESC')
            ->groupBy('game_id')
            ->limit($rows)
            ->with('game.user')
            ->get();
    }

    public function getMostWinsByNickname(int $rows = self::MOST_WINS_BY_NICKNAME_ROWS_DEFAULT)
    {
        return Game::select(DB::raw('u.nickname, COUNT(games.id) as wins'))
            ->join('users AS u', 'games.user_id', '=', 'u.id')
            ->whereNotNull ('completed_at')
            ->groupBy('user_id')
            ->orderBy('wins', 'DESC')
            ->limit($rows)
            ->get();
    }
}
