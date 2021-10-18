@extends('layout', ['title' => __('custom.play_game')])

@section('content')
    <div class="d-flex">
        <div class="col-md-5">
            <h3 class="text-center">Best Score Games</h3>
            <h6 class="text-center">Bulls = 10 score; Cows = 1 score</h6>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Rank</th>
                        <th scope="col">#GameID</th>
                        <th scope="col">GameNumber</th>
                        <th scope="col">Nickname</th>
                        <th scope="col">Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bestScores as $row)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $row->game_id }}</td>
                            <td>{{ $row->game->number }}</td>
                            <td>{{ $row->game->user->nickname }}</td>
                            <td>{{ $row->score }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-5">
            <h3 class="text-center">Nicknames with most wins</h3>
            <h6 class="text-center">shows best 10 nicknames</h6>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Rank</th>
                        <th scope="col">Nickname</th>
                        <th scope="col">Wins</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mostWinsByNickname as $row)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $row->nickname }}</td>
                            <td>{{ $row->wins }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection
