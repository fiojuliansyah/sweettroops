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
            'phone' => ['required', 'string', 'min:10'], 
        ]);
    
        $user = User::where('phone', $request->phone)->first(); 
    
        if (!$user) {
            $user = User::create([
                'phone' => $request->phone, 
                'name' => 'Troopers ' . $request->phone, 
                'password' => bcrypt('defaultpassword'), 
                'phone_verified' => 'unverified',
            ]);
        }
    
        Auth::login($user);
    
        $phone = Auth::user()->phone;
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