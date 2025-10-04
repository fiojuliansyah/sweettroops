@extends('layouts.guest')

@section('content')
<section class="section-20">
    <div class="w-layout-blockcontainer container-17 w-container">
        <div class="div-block-15">
            {{-- Bagian Form Login --}}
            <div class="div-block-16">
                <h1 id="w-node-cf091dca-a881-c9a0-6eb9-366c4b218767-61f5beb9" class="heading-11">Hello Again! 👋</h1>
                <h1 id="w-node-eec3016b-5f0f-4237-22b2-c223bfc79e36-61f5beb9" class="heading-12">Your Kitchen Awaits!</h1>
                <div class="text-block-5">Oh look who's here - our favourite whisk wizard! <br>
                So happy to see you back in the kitchen. <br>
                Your mixing bowl missed you - time to whip up more delicious memories.</div>
                
                <div class="form-block-3 w-form">
                    <form action="{{ route('login') }}" method="POST" class="form">
                        @csrf

                        {{-- Input Email --}}
                        <input class="text-field-3 w-input" type="email" name="email" placeholder="Your Email Address" value="{{ old('email') }}" required autofocus autocomplete="username">
                        @error('email')
                            <div class="text-danger" style="font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                        @enderror

                        {{-- Input Password --}}
                        <input class="text-field-3 w-input" style="margin-top: 15px;" type="password" name="password" placeholder="Your Password" required autocomplete="current-password">
                        @error('password')
                            <div class="text-danger" style="font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                        @enderror

                        {{-- Remember Me & Forgot Password --}}
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; margin-bottom: 20px; font-size: 14px;">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                <label class="form-check-label" for="remember_me">Remember Me</label>
                            </div>
                            <a href="{{ route('password.request') }}" style="color: #ff85a2; text-decoration: underline;">Forgot Password?</a>
                        </div>
                        
                        {{-- Tombol Submit --}}
                        <button type="submit" class="button-7 w-button">Log in</button>

                        {{-- Link Alternatif --}}
                        <div style="text-align: center; margin-top: 24px; font-size: 14px;">
                            <a href="{{ route('login-phone') }}" style="color: #ff85a2; text-decoration: underline;">Login dengan No Handphone / Email OTP</a>
                        </div>
                    </form>
                </div>
            </div>
            
            {{-- Bagian Ajakan Registrasi --}}
            <div class="div-block-17">
                <h1 id="w-node-_803d5886-e670-2807-d25c-ebd36aea8283-61f5beb9" class="heading-13">Be Part of SweetTroops</h1>
                <div id="w-node-_183be123-2e6e-a3f4-9515-ad2d10d9731d-61f5beb9" class="text-block-4">Welcome to SweetTroops, your new baking home!
We're so excited to have you join our big, flour-dusted family.
Unlock step-by-step classes, secret recipes, and a sprinkle of inspiration in every lesson. Here, every recipe comes with a smile, every class feels like baking with friends, and there's always room at the table for you.
Let's roll up our sleeves and make something sweet together!</div>
                <a id="w-node-d254ce7d-e13d-e853-35ff-71a56911d398-61f5beb9" href="{{ route('register') }}" class="button w-button">COUNT ME IN!</a>
            </div>
        </div>
    </div>
</section>
@endsection