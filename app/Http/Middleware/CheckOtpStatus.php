<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOtpStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $authMethod = session('auth_method');

        if ($authMethod !== 'otp') {
            return $next($request);
        }

        $user = Auth::user();

        $latestOtp = $user->otps()
            ->latest()
            ->first();

        if ($latestOtp && $latestOtp->status === 'pending') {
            return redirect()
                ->route('login.verified')
                ->with('error', 'Anda harus verifikasi OTP terlebih dahulu.');
        }

        return $next($request);
    }
}
