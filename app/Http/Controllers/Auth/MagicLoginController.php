<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\MagicLoginLinkMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class MagicLoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.magic-login');
    }

    public function sendLoginLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'We couldn\'t find a user with that email address.'
        ]);

        $user = User::where('email', $request->email)->first();

        $loginUrl = URL::temporarySignedRoute(
            'magic-login.verify',
            now()->addMinutes(60),
            ['user' => $user->id]
        );
        
        Mail::to($user->email)->send(new MagicLoginLinkMail($loginUrl, $user->name));

        return back()->with('status', 'We have emailed your login link. Please check your inbox!');
    }

    public function loginWithLink(Request $request, User $user)
    {
        Auth::login($user);
        $request->session()->regenerate();
        session(['auth_method' => 'magic_link']);
        
        return redirect()->route('troopers.my-course');
    }
}