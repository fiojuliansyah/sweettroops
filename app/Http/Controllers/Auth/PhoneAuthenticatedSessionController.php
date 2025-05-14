<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Notifications\Otp;
use Illuminate\Http\Request;
use App\Models\Otp as ModelsOtp;
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

        // Check if there are users with the same last 7 digits of the phone number
        $existingUsers = User::where('phone', 'like', '%' . $lastSevenDigits)
                            ->orderBy('created_at', 'desc')
                            ->get();  // Get all users with the same last 7 digits

        // If there's at least one existing user with the same last 7 digits
        if ($existingUsers->count() > 0) {
            // If there is only one matching user, no need to delete and create
            if ($existingUsers->count() == 1) {
                $existingUser = $existingUsers->first(); // Get the single user

                // Log in with the existing user
                Auth::login($existingUser);

                // If the user is already verified, proceed directly
                if ($existingUser->phone_verified == 'verified') {
                    return redirect()->route('login.verified');
                }

                // Mark the user as unverified and send OTP
                $otp = rand(100000, 999999);
                $existingUser->notify(new Otp($phone, $otp));

                // Save OTP data to ModelsOtp
                ModelsOtp::create([
                    'number' => $phone,
                    'otp' => $otp,
                    'type' => 'verify_phone',
                    'user_id' => $existingUser->id,
                    'status' => 'pending',
                ]);

                return redirect()->route('login.verified');
            }

            // If there are multiple users with the same last 7 digits, take appropriate action
            // This part ensures that only one user is found and deleted if needed
            foreach ($existingUsers as $existingUser) {
                // Find the user with the matching phone and delete the duplicate
                if ($existingUser->phone != $phone) {
                    $existingUser->delete();  // Delete duplicate users
                }
            }
        }

        // If no existing users with the same last 7 digits, create a new user
        $user = User::create([
            'phone' => $phone,
            'name' => 'Troopers ' . $phone,
            'password' => bcrypt('defaultpassword'),
            'phone_verified' => 'unverified',
        ]);

        // Log in with the new user
        Auth::login($user);

        // Mark the user as unverified and send OTP
        $user->phone_verified = 'unverified';
        $user->save();

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
            ->where('otp', $request->input('otp'))
            ->where('type', 'verify_phone')
            ->orderBy('created_at', 'desc') 
            ->first();
    
        if ($otpRecord && $otpRecord->created_at->addMinutes(2) > now()) {
            $otpRecord->status = 'verified';
            $otpRecord->save();
            
            $user->phone_verified = 'verified';
            $user->save();

            return redirect()->route('troopers.dashboard');
        } else {
            return redirect()->back()->withErrors(['otp' => 'The OTP is invalid or has expired.']);
        }
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
            'status' => 'pending'  
        ]);

        return redirect()->back()
                        ->with('success','OTP sent successfully')
                        ->with('status','verification-link-sent');
    }
}