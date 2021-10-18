<?php

namespace App\Http\Services;

use App\Game;
use App\Http\Traits\ErrorTrait;
use App\User;

class UserService
{
    use ErrorTrait;

    public function getUser(string $nickname)
    {
        $user = User::firstWhere('nickname', $nickname);

        if (!$user) {
            $user = $this->createUser($nickname);
        }

        return $user;
    }

    public function createUser(string $nickname)
    {
        $user = new User(['nickname' => $nickname]);

        if (!$user->save()) {
            return false;
        }

        return $user;
    }

    public function getUserLastGame(int $userId)
    {
        return Game::where('user_id', $userId)->orderBy('id', 'DESC')->with('gameGuesses')->first();
    }
}
