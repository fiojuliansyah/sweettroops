<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PhoneVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login-phone');
        }
        
        if (Auth::user()->phone_verified !== 'verified') {
            return redirect()->route('login.verified');
        }

        return $next($request);
    }
}