@extends('layout', ['title' => __('custom.play_game')])

@section('content')
    <div class="row">
        <div class="mx-auto">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{ __('custom.number') }}</span>
            </div>
            <input id="numberGuess" type="text" class="form-control" required />
            <button id="checkNumber" type="button" class="btn btn-primary ml-1">{{ __('custom.guess') }}</button>
        </div>

        <h3 class="text-center">Previous Guesses</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">{{ __('custom.number') }}</th>
                <th scope="col">{{ __('custom.bulls') }}</th>
                <th scope="col">{{ __('custom.cows') }}</th>
                </tr>
            </thead>
            <tbody id="previousGuessesBody">
                <tr id="guessExample" hidden>
                    <td class="guessNumber"></td>
                    <td class="guessBulls"></td>
                    <td class="guessCows"></td>
                </tr>
                @foreach ($game->gameGuesses->reverse() as $gameGuess)
                    <tr>
                        <td>{{ $gameGuess->number }}</td>
                        <td>{{ $gameGuess->bulls }}</td>
                        <td>{{ $gameGuess->cows }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

    
    
@endsection
