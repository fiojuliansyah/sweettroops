<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Otp as ModelsOtp;
use App\Models\User;
use App\Notifications\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PhoneAuthenticatedSessionController extends Controller
{
    public function whatsappLogin()
    {
        return view('auth.login-phone');
    }

    public function whatsappStore(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'min:10', 'max:15'],
        ]);

        $phone = $request->phone;
        $lastSevenDigits = substr($phone, -7);

        $existingUsers = User::where('phone', 'like', '%' . $lastSevenDigits)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($existingUsers->count() === 1) {
            $user = $existingUsers->first();

            Auth::login($user);
            $request->session()->regenerate();
            session(['auth_method' => 'otp']);

            $otp = rand(100000, 999999);

            $user->notify(new Otp($phone, $otp));

            ModelsOtp::create([
                'number' => $phone,
                'otp' => $otp,
                'type' => 'verify_phone',
                'user_id' => $user->id,
                'status' => 'pending',
            ]);

            return redirect()->route('login.verified');
        }

        if ($existingUsers->count() > 1) {
            foreach ($existingUsers as $existingUser) {
                if ($existingUser->phone !== $phone) {
                    $existingUser->delete();
                }
            }
        }

        $user = User::create([
            'phone' => $phone,
            'name' => 'Troopers ' . $phone,
            'password' => bcrypt('defaultpassword'),
            'phone_verified' => 'unverified',
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        session(['auth_method' => 'otp']);

        $otp = rand(100000, 999999);

        $user->notify(new Otp($phone, $otp));

        ModelsOtp::create([
            'number' => $phone,
            'otp' => $otp,
            'type' => 'verify_phone',
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        return redirect()->route('login.verified');
    }

    public function sendOTPNew(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login-phone');
        }

        $otp = rand(100000, 999999);

        $user->notify(new Otp($user->phone, $otp));

        ModelsOtp::create([
            'number' => $user->phone,
            'otp' => $otp,
            'type' => 'verify_phone',
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        return back()->with('status', 'verification-link-sent');
    }

    public function phoneVerified()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login-phone');
        }

        return view('auth.verify-phone', compact('user'));
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'digits:6'],
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login-phone');
        }

        $otpRecord = ModelsOtp::where('user_id', $user->id)
            ->where('type', 'verify_phone')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$otpRecord || $otpRecord->created_at->addMinutes(2)->isPast()) {
            return back()->withErrors([
                'otp' => 'The OTP is invalid or has expired.',
            ]);
        }

        if ($otpRecord->otp !== $request->otp) {
            return back()->withErrors([
                'otp' => 'The OTP is invalid.',
            ]);
        }

        $otpRecord->update([
            'status' => 'verified',
        ]);

        $user->update([
            'phone_verified' => 'verified',
        ]);

        return redirect()->route('troopers.my-course');
    }
}
