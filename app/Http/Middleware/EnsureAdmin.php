<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::current();

        if (! $user || ! $user->isAdmin()) {
            return redirect()->route('login.admin')->with('error', 'Silakan masuk sebagai Administrator.');
        }

        return $next($request);
    }
}