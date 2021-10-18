<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    const QUANTITY_DEFAULT = 4;

    protected $fillable = [
        'user_id',
        'number',
        'completed_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function gameGuesses()
    {
        return $this->hasMany('App\GameGuess', 'game_id');
    }
}
