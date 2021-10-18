<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    
    protected $fillable = [
        'nickname',
    ];

    public function games()
    {
        return $this->hasMany('App\Game', 'user_id');
    }
}
