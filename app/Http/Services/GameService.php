<?php

namespace App\Http\Services;

use App\Http\Traits\NumberTrait;
use App\Game;
use App\Http\Interfaces\GameInterface;
use App\Http\Traits\ErrorTrait;
use App\User;

class GameService implements GameInterface
{
    use NumberTrait, ErrorTrait;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createGame(string $nickname)
    {
        $user = $this->userService->getUser($nickname);

        if (!$user) {
            $this->setError('User is not created');
            return;
        }

        session(['user_id' => $user->id]);

        return $this->storeGame($user);
    }

    private function storeGame(User $user)
    {
        $game = new Game();
        $game->user_id = $user->id;
        $game->number = $this->generateNumber(Game::QUANTITY_DEFAULT);

        if (!$game->save()) {
            $this->setError('Game is not created');
            return false;
        }

        return true;
    }

    public function getGame()
    {
        $game = auth()->user()->games()->orderBy('id', 'desc')->first();
        $this->processValidations($game);

        return $game;
    }

    private function processValidations(Game $game)
    {
        if (!$game) {
            $this->setError('Game not found');
            return;
        }

        if ($this->isGameCompleted($game)) {
            $this->setError('Your last game is already completed');
            return;
        }
    }

    private function isGameCompleted(Game $game)
    {
        return !is_null($game->completed_at);
    }

    public function getBullsAndCows(int $guessNumber, GameGuessService $gameGuessService)
    {
        if (!$this->validateNumber($guessNumber)) {
            $this->setError('Number is invalid');
            return false;
        }

        $game = $this->getGame();

        if (!$game) {
            return false;
        }
        
        $gameGuess = $gameGuessService->storeGameGuess($game, $guessNumber);

        if (!$gameGuess) {
            $this->setError('GameGuess is not created');
            return false;
        }

        $results = $this->findBullsAndCows($game->number, $guessNumber);

        if (!$gameGuessService->updateBullsAndCows($gameGuess, $results)) {
            $this->setError('GameGuess update failed');
            return false;
        }
        
        $this->checkGameGuessIsCorrect($game, $results);
        
        return $results;
    }

    private function findBullsAndCows(int $gameNumber, int $guessNumber)
    {
        $gameNumbers = collect(str_split($gameNumber));
        $guessNumbers = collect(str_split(($guessNumber)));
        $results = [
            'bulls' => 0,
            'cows' => 0
        ];

        foreach ($guessNumbers as $guessPosition=>$number) {
            $foundPosition = $gameNumbers->search($number);

            if ($foundPosition === false) {
                continue;
            }

            if ($foundPosition == $guessPosition) {
                $results['bulls']++;
                continue;
            }

            $results['cows']++;
        }

        return $results;
    }

    private function checkGameGuessIsCorrect(Game $game, array &$results)
    {
        if (isset($results['bulls']) && $results['bulls'] == Game::QUANTITY_DEFAULT) {
            $this->completeGame($game);
            $results['isCompleted'] = true;
        }
    }

    private function completeGame(Game $game)
    {
        $game->completed_at = now();
        
        if (!$game->save()) {
            $this->setError('Game complete update failed');
        }
    }
}
