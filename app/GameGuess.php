<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameGuess extends Model
{
    const BULLS_POINTS = 10;
    const COWS_POINTS = 1;
    
    public $timestamps = false;
    protected $fillable = [
        'game_id',
        'number',
        'bulls',
        'cows',
        'score',
    ];
    
    public function setBullsAttribute($value)
    {
        $this->attributes['score'] = $value * self::BULLS_POINTS;
    }
    
    public function setCowsAttribute($value)
    {
        $this->attributes['score'] += $value * self::COWS_POINTS;
    }

    public function game()
    {
        return $this->belongsTo('App\Game', 'game_id');
    }
}
