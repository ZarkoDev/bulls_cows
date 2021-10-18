<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameStartRequest extends FormRequest
{

    public function rules()
    {
        return [
            'nickname'   => 'required|string|alpha_num'
        ];
    }
}
