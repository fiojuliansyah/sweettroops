@extends('layouts.guest')

@section('content')
<section class="section-21">
    <div class="w-layout-blockcontainer container-18 w-container">
        <div class="div-block-18">
            <div class="div-block-19">
                <h1 class="heading-14">Welcome to Our Kitchen 🧑‍🍳</h1>
                <div class="text-block-6">Yay! You're just a whisk away from joining our SweetTroops family.<br>Fill in your details below and get ready to unlock a world of delicious recipes, friendly faces, and all the sprinkles of baking joy you could ever want.</div>
                
                <div class="form-block-2 w-form">
                    {{-- Form disesuaikan untuk route 'register' dengan method POST --}}
                    <form method="POST" action="{{ route('register') }}" class="form-2">
                        @csrf

                        {{-- Input Full Name --}}
                        <label for="name" class="field-label-9">Full Name</label>
                        <input class="text-field-6 w-input" type="text" name="name" placeholder="Your full name" id="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                        @error('name')
                            <div class="text-danger" style="font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                        @enderror

                        {{-- Input Email Address --}}
                        <label for="email" class="field-label-10" style="margin-top: 15px;">Email Address</label>
                        <input class="text-field-7 w-input" type="email" name="email" placeholder="your@email.com" id="email" value="{{ old('email') }}" required autocomplete="username">
                        @error('email')
                             <div class="text-danger" style="font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                        @enderror

                        {{-- Input Phone Number --}}
                        <label for="phone" class="field-label-11" style="margin-top: 15px;">Phone Number</label>
                        <input class="text-field-8 w-input" type="tel" name="phone" placeholder="e.g., 08123456789" id="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                             <div class="text-danger" style="font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                        @enderror

                        {{-- Input Password --}}
                        <label for="password" class="field-label-12" style="margin-top: 15px;">Password</label>
                        <input class="text-field-9 w-input" type="password" name="password" placeholder="Must be at least 8 characters" id="password" required autocomplete="new-password">
                        @error('password')
                            <div class="text-danger" style="font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                        @enderror

                        {{-- Input Confirm Password (PENTING untuk validasi Laravel) --}}
                        <label for="password_confirmation" class="field-label-12" style="margin-top: 15px;">Confirm Password</label>
                        <input class="text-field-9 w-input" type="password" name="password_confirmation" placeholder="Retype your password" id="password_confirmation" required autocomplete="new-password">

                        {{-- Tombol Submit --}}
                        <button type="submit" class="submit-button-3 w-button" style="margin-top: 30px;">COUNT ME IN!</button>
                        
                        {{-- Link ke halaman Login --}}
                        <p style="text-align: center; margin-top: 24px; font-size: 14px;">
                            Already have an account? 
                            <a href="{{ route('login') }}" style="color: #ff85a2; text-decoration: underline;">Log In</a>
                        </p>
                    </form>
                    
                    {{-- Bagian ini dari Webflow, bisa dibiarkan --}}
                    <div class="w-form-done">
                        <div>Thank you! Your submission has been received!</div>
                    </div>
                    <div class="w-form-fail">
                        <div>Oops! Something went wrong while submitting the form.</div>
                    </div>
                </div>
            </div>
            <img src="/frontend/assets/images/Sign-up-page.jpg" loading="lazy" id="w-node-e220aaa3-d41f-4cf9-d512-650392af494d-3a45e423" alt="A person decorating a cake" class="image-9">
        </div>
    </div>
</section>
@endsection