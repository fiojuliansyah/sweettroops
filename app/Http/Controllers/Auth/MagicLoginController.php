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
    /**
     * Display the form to request a login link.
     */
    public function showLoginForm()
    {
        // We assume your blade file is saved at: resources/views/auth/login.blade.php
        return view('auth.magic-login');
    }

    /**
     * Send a login link to the given user.
     */
    public function sendLoginLink(Request $request)
    {
        // 1. Validate the request
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'We couldn\'t find a user with that email address.'
        ]);

        // 2. Find the user
        $user = User::where('email', $request->email)->first();

        // 3. Generate a temporary signed URL
        // The link will be valid for 15 minutes.
        $loginUrl = URL::temporarySignedRoute(
            'magic-login.verify',
            now()->addMinutes(60),
            ['user' => $user->id]
        );
        
        // 4. Send the email to the user
        Mail::to($user->email)->send(new MagicLoginLinkMail($loginUrl, $user->name));

        // 5. Redirect back with a success message
        return back()->with('status', 'We have emailed your login link. Please check your inbox!');
    }

    /**
     * Log in the user with the given magic link.
     */
    public function loginWithLink(Request $request, User $user)
    {
        // The 'signed' middleware on the route has already verified the URL.
        // If it was invalid or expired, the user would get a 403 error.
        
        // 1. Log the user in
        Auth::login($user);

        // 2. Regenerate the session
        $request->session()->regenerate();
        
        // 3. Redirect them to their intended page (e.g., a dashboard)
        return redirect()->route('troopers.my-course'); // Change '/dashboard' to your home page
    }
}