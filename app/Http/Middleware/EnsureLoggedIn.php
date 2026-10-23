<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureLoggedIn
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! User::current()) {
            $request->session()->forget('user_id');

            return redirect()->route('login.pengguna')->with('error', 'Silakan masuk terlebih dahulu.');
        }

        return $next($request);
    }
}