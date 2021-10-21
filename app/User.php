<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthAuthenticatable;

class User extends AppModel implements AuthAuthenticatable
{
    use Authenticatable;

    protected $fillable = [
        'nickname',
    ];

    public function games()
    {
        return $this->hasMany('App\Game', 'user_id');
    }
}
