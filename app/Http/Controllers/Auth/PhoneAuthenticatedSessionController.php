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
        // Validasi input, pastikan nomor handphone memiliki minimal 10 karakter
        $request->validate([
            'phone' => ['required', 'string', 'min:10', 'max:15'],
        ]);

        $phone = $request->phone;

        // Ambil 7 digit terakhir dari nomor telepon
        $lastSevenDigits = substr($phone, -7);

        // Cari apakah sudah ada nomor telepon dengan 7 digit terakhir yang sama
        $existingUser = User::where('phone', 'like', '%' . $lastSevenDigits)
                            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu pembuatan
                            ->first(); // Ambil entri paling baru

        if ($existingUser) {
            // Jika ada user dengan 7 digit terakhir yang sama, login ke akun tersebut
            Auth::login($existingUser);

            // Hapus user yang baru akan dibuat (karena sudah ada yang lebih lama dengan 7 digit yang sama)
            $user = User::where('phone', $phone)->first();
            if ($user) {
                $user->delete();
            }

            // Set status verifikasi nomor telepon ke 'unverified'
            $existingUser->phone_verified = 'unverified';
            $existingUser->save();

            // Generate OTP dan kirim notifikasi ke pengguna
            $otp = rand(100000, 999999);
            $existingUser->notify(new Otp($phone, $otp));

            // Simpan OTP ke database
            ModelsOtp::create([
                'number' => $phone,
                'otp' => $otp,
                'type' => 'verify_phone',
                'user_id' => $existingUser->id,
                'status' => 'pending',
            ]);

            // Redirect ke halaman verifikasi
            return redirect()->route('login.verified');
        }

        // Jika tidak ada user dengan 7 digit terakhir yang sama, buat user baru
        $user = User::create([
            'phone' => $phone,
            'name' => 'Troopers ' . $phone,
            'password' => bcrypt('defaultpassword'),
            'phone_verified' => 'unverified',
        ]);

        // Login user
        Auth::login($user);

        // Set status verifikasi nomor telepon ke 'unverified'
        $user->phone_verified = 'unverified';
        $user->save();

        // Generate OTP dan kirim notifikasi ke pengguna
        $otp = rand(100000, 999999);
        $user->notify(new Otp($phone, $otp));

        // Simpan OTP ke database
        ModelsOtp::create([
            'number' => $phone,
            'otp' => $otp,
            'type' => 'verify_phone',
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        // Redirect ke halaman verifikasi
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