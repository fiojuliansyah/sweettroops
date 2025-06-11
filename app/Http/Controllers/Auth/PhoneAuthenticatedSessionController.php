<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Notifications\Otp;
use Illuminate\Http\Request;
use App\Models\Otp as ModelsOtp;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        if ($existingUsers->count() > 0) {
            if ($existingUsers->count() == 1) {
                $existingUser = $existingUsers->first();

                Auth::login($existingUser);

                if ($existingUser->phone_verified == 'verified') {
                    Log::info('Phone already verified for user ID: ' . $existingUser->id);

                    $otp = rand(100000, 999999);
                    Log::info('Generated OTP for verified user: ' . $otp);

                    $existingUser->notify(new Otp($phone, $otp));

                    ModelsOtp::create([
                        'number' => $phone,
                        'otp' => $otp,
                        'type' => 'verify_phone',
                        'user_id' => $existingUser->id,
                        'status' => 'pending',
                    ]);

                    return redirect()->route('login.verified');
                }

                return redirect()->route('login.verified');
            }

            foreach ($existingUsers as $existingUser) {
                if ($existingUser->phone != $phone) {
                    Log::info('Deleting user ID: ' . $existingUser->id . ' because phone does not match.');
                    $existingUser->delete();
                }
            }
        }

        // Buat pengguna baru
        Log::info('No user found with similar last seven digits, creating new user for phone: ' . $phone);

        $user = User::create([
            'phone' => $phone,
            'name' => 'Troopers ' . $phone,
            'password' => bcrypt('defaultpassword'),
            'phone_verified' => 'unverified',
        ]);

        Log::info('New user created with ID: ' . $user->id);

        Auth::login($user);

        // Update phone_verified status
        $user->phone_verified = 'unverified';
        $user->save();

        Log::info('User ID ' . $user->id . ' phone_verified set to unverified.');

        // Generate OTP
        $otp = rand(100000, 999999);
        Log::info('Generated OTP: ' . $otp);

        $user->notify(new Otp($phone, $otp));

        ModelsOtp::create([
            'number' => $phone,
            'otp' => $otp,
            'type' => 'verify_phone',
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        Log::info('OTP sent to new user ID: ' . $user->id);

        return redirect()->route('login.verified');
    }


    public function sendOTPNew(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login-phone');
        }

        $phone = $user->phone;
        $otp = rand(100000, 999999);

        $user->notify(new Otp($phone, $otp));

        ModelsOtp::create([
            'number' => $phone,
            'otp' => $otp,
            'type' => 'verify_phone',
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'OTP sent successfully')->with('status', 'verification-link-sent');
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

        $otpRecord = ModelsOtp::where('user_id', $user->id)->where('otp', $request->input('otp'))->where('type', 'verify_phone')->orderBy('created_at', 'desc')->first();

        if ($otpRecord && $otpRecord->created_at->addMinutes(2) > now()) {
            $otpRecord->status = 'verified';
            $otpRecord->save();

            $user->phone_verified = 'verified';
            $user->save();

            return redirect()->route('troopers.dashboard');
        } else {
            return redirect()
                ->back()
                ->withErrors(['otp' => 'The OTP is invalid or has expired.']);
        }
    }
}
