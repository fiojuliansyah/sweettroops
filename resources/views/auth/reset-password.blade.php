@extends('layouts.guest')

@section('content')
<section class="section-20">
    <div class="w-layout-blockcontainer container-17 w-container">
        <div class="div-block-15">
            <div class="div-block-16">
                <h1 id="w-node-cf091dca-a881-c9a0-6eb9-366c4b218767-61f5beb9" class="heading-11">Hello Again! 👋</h1>
                <h1 id="w-node-eec3016b-5f0f-4237-22b2-c223bfc79e36-61f5beb9" class="heading-12">Your Kitchen Awaits!</h1>
                <div class="text-block-5">Please Input New Password</div>
                <div class="form-block-3 w-form">
                    <form method="POST" action="{{ route('password.store') }}" class="form">
                    @csrf
                        
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

                        <input class="text-field-3 w-input" style="margin-top: 15px;" type="password" name="password" placeholder="Your Password" required autocomplete="current-password">
                        @error('password')
                            <div class="text-danger" style="font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                        @enderror

                        <input class="text-field-3 w-input" style="margin-top: 15px;" type="password" name="password_confirmation" placeholder="Your Password Confirmation" required autocomplete="current-password">
                        @error('password_confirmation')
                            <div class="text-danger" style="font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="button-7 w-button">Submit</button>

                    </form>
                </div>
            </div>
            
            <div class="div-block-17">
                <h1 id="w-node-_803d5886-e670-2807-d25c-ebd36aea8283-61f5beb9" class="heading-13">Be Part of SweetTroops</h1>
                <div id="w-node-_183be123-2e6e-a3f4-9515-ad2d10d9731d-61f5beb9" class="text-block-4">New on our platform? Welcome to SweetTroops, your new baking home! We're so excited to have you join our big, flour-dusted family. Let's roll up our sleeves and make something sweet together!</div>
                <a id="w-node-d254ce7d-e13d-e853-35ff-71a56911d398-61f5beb9" href="{{ route('register') }}" class="button w-button">CREATE AN ACCOUNT</a>
            </div>
        </div>
    </div>
</section>
@endsection
