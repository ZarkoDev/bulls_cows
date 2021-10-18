<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameStartRequest;
use App\Http\Services\GameGuessService;
use App\Http\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function startGame(GameStartRequest $request, GameService $gameService)
    {
        $attributes = $request->validated();

        if (!$gameService->createGame($attributes['nickname'])) {
            return back()->withInput()->withErrors($gameService->getErrors());
        }

        return redirect()->route('loadGame');
    }

    public function loadGame(GameService $gameService)
    {
        $game = $gameService->getGame();

        if ($gameService->hasErrors()) {
            return redirect()->route('startGame')->withErrors($gameService->getErrors());
        }

        return view('game', compact('game'));
    }

    public function guessNumber(Request $request, GameService $gameService)
    {
        $validator = Validator::make($request->all(), [
            'number'   => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            return ['error' => 'The number must be 4 digits'];
        }

        $results = $gameService->getBullsAndCows($request->number, new GameGuessService);
        
        if ($gameService->hasErrors()) {
            return $gameService->getErrors();
        }

        return $results;
    }
}
