<?php

namespace App\Http\Interfaces;

interface GameInterface
{
    public function createGame(string $nickname);
    public function getGame();
}