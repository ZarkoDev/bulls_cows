<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\User as AppUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NicknameAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = AppUser::find(session('user_id'));

        if (!$user) {
            return redirect()->route('startGame')->withErrors(['error' => 'User not found']);
        }

        Auth::login($user);

        return $next($request);
    }
}
