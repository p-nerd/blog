<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsNotVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * @var mixed $user
         */
        $user = Auth::user();
        if (Auth::check() && $user->hasVerifiedEmail()) {
            return redirect('/')->with('success', 'Your email is already verified');
        }

        return $next($request);
    }
}
