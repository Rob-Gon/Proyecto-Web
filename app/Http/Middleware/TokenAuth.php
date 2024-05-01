<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class TokenAuth
{
    public function handle(Request $request, Closure $next)
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect()->route('login.index');
        }

        $token = User::where('id', $userId)->first()->token;

        if (!$token) {
            return redirect()->route('login.index');
        }

        return $next($request);
    }
}