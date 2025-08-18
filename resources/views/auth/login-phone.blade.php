@extends('layouts.guest')

@section('content')
    <section class="section-20">
        <div class="w-layout-blockcontainer container-17 w-container">
            <div class="div-block-15">
                {{-- Bagian Form Login --}}
                <div class="div-block-16">
                    <h1 id="w-node-cf091dca-a881-c9a0-6eb9-366c4b218767-61f5beb9" class="heading-11">Hello Again!</h1>
                    <h1 id="w-node-eec3016b-5f0f-4237-22b2-c223bfc79e36-61f5beb9" class="heading-12">Your Kitchen Awaits!</h1>
                    <div class="text-block-5">Oh look who's here - our favourite whisk wizard!<br>So happy to see you back in the kitchen.<br>Your mixing bowl missed you - time to whip up more delicious memories.</div>
                    
                    <div class="form-block-3 w-form">
                        {{-- Form diubah untuk mengarah ke route 'login-phone' dengan method POST --}}
                        <form action="{{ route('login-phone') }}" method="POST" id="email-form" name="email-form" data-name="Email Form" class="form">
                            @csrf {{-- Menambahkan CSRF token untuk keamanan --}}

                            {{-- Input untuk nomor telepon. Atribut 'name' disesuaikan menjadi 'phone' --}}
                            <input class="text-field-4 w-input" maxlength="256" name="phone" data-name="Phone Number" placeholder="Your Phone Number" type="tel" id="Phone-Number" value="{{ old('phone') }}" required autofocus>
                            
                            <label for="Phone-Number" class="field-label-8">Format: 62 / 08 (Only for Indonesian WA Phone Number)</label>
                            
                            {{-- Tag <a> diubah menjadi <button type="submit"> agar form bisa dikirim --}}
                            <button type="submit" class="button-7 w-button">OTP CODE REQUEST</button>
                        </form>
                        
                        {{-- Bagian ini untuk notifikasi dari Webflow, bisa dibiarkan saja --}}
                        <div class="w-form-done">
                            <div>Thank you! Your submission has been received!</div>
                        </div>
                        <div class="w-form-fail">
                            <div>Oops! Something went wrong while submitting the form.</div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Ajakan Registrasi --}}
                <div class="div-block-17">
                    <h1 id="w-node-_803d5886-e670-2807-d25c-ebd36aea8283-61f5beb9" class="heading-13">Be Part of SweetTroops</h1>
                    <div id="w-node-_183be123-2e6e-a3f4-9515-ad2d10d9731d-61f5beb9" class="text-block-4">Welcome to SweetTroops, your new baking home!<br>We're so excited to have you join our big, flour-dusted family.<br>Unlock step-by-step classes, secret recipes, and a sprinkle of inspiration in every lesson. Here, every recipe comes with a smile, every class feels like baking with friends, and there's always room at the table for you.<br>Let's roll up our sleeves and make something sweet together!</div>
                
                    <a id="w-node-d254ce7d-e13d-e853-35ff-71a56911d398-61f5beb9" href="{{ route('register') }}" class="button w-button">COUNT ME IN!</a>
                </div>
            </div>
        </div>
    </section>
@endsection