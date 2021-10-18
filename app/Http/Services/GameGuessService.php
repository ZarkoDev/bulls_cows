<?php

namespace App\Http\Services;

use App\Game;
use App\GameGuess;
use App\Http\Traits\ErrorTrait;

class GameGuessService
{
    use ErrorTrait;

    public function storeGameGuess(Game $game, int $guessNumber)
    {
        $gameGuess = new GameGuess();
        $gameGuess->game_id = $game->id;
        $gameGuess->number = $guessNumber;

        if (!$gameGuess->save()) {
            return false;
        }

        return $gameGuess;
    }

    public function updateBullsAndCows(GameGuess $gameGuess, array $result)
    {
        $gameGuess->fill($result);
        
        if (!$gameGuess->save()) {
            return false;
        }

        return true;
    }
}
