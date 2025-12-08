<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOtpStatus
{
    public function handle(Request $request, Closure $next)
    {
        // Jika belum login, lanjutkan saja
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        // Ambil OTP paling baru
        $latestOtp = $user->otps()->latest()->first();

        // Jika ada OTP dan status masih pending -> blokir akses
        if ($latestOtp && $latestOtp->status === 'pending') {
            return redirect()->route('login.verified')
                ->with('error', 'Anda harus verifikasi OTP terlebih dahulu.');
        }

        return $next($request);
    }
}
