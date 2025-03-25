@extends('layouts.auth')

@section('content')
<section class="auth d-flex">
    <div class="auth-left bg-main-50 flex-center p-24">
        <img src="assets/images/thumbs/auth-img5.png" alt="">
    </div>
    <div class="auth-right py-40 px-24 flex-center flex-column">
        <div class="auth-right__inner mx-auto w-100">
            <a href="index.html" class="auth-right__logo">
                <img src="assets/images/logo/logo.png" alt="">
            </a>
            <h2 class="mb-8">Two-Step Verification</h2>
            <p class="text-gray-600 text-15 mb-32">We sent a verification code to your mobile. Enter the code from the mobile in the field below. 
                <span class="fw-medium d-block">***{{ substr($user->phone, -3) }}</span>
            </p>

            <!-- Success message -->
            @if (session('success'))
                <div class="alert alert-success mb-24">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display validation errors if any -->
            @if ($errors->any())
                <div class="alert alert-danger mb-24">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('verify.otp') }}" method="POST">
                @csrf
                <div class="mb-32">
                    <label class="form-label mb-8 h6">Type your 6 digit security code</label>
                    <div class="squire-input-wrapper flex-align">
                        <input type="text" class="squire-input form-control text-center p-6" maxlength="1" id="digit-1" data-next="digit-2">
                        <input type="text" class="squire-input form-control text-center p-6" maxlength="1" id="digit-2" data-next="digit-3" data-previous="digit-1">
                        <input type="text" class="squire-input form-control text-center p-6" maxlength="1" id="digit-3" data-next="digit-4" data-previous="digit-2">
                        <input type="text" class="squire-input form-control text-center p-6" maxlength="1" id="digit-4" data-next="digit-5" data-previous="digit-3">
                        <input type="text" class="squire-input form-control text-center p-6" maxlength="1" id="digit-5" data-next="digit-6" data-previous="digit-4">
                        <input type="text" class="squire-input form-control text-center p-6" maxlength="1" id="digit-6" data-previous="digit-5">
                    </div>
                    <!-- Hidden input to store the combined OTP value -->
                    <input type="hidden" name="otp" id="otp-value">
                </div>
                <button type="submit" class="btn btn-main rounded-pill w-100">Verify Now</button>
            </form>

            <p class="mt-24 text-gray-600 text-center">Didn't get the code?
                <a href="javascript:void(0)" onclick="document.getElementById('resend-form').submit();" class="text-main-600 hover-text-decoration-underline">Resend</a>
                <form id="resend-form" action="{{ route('resend.otp') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </p>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all digit input fields
        const digitInputs = document.querySelectorAll('.squire-input');
        const otpValueInput = document.getElementById('otp-value');
        
        // Add event listeners to each digit input
        digitInputs.forEach(input => {
            // Auto-focus to next input when a digit is entered
            input.addEventListener('input', function() {
                const nextInput = document.getElementById(this.dataset.next);
                if (nextInput && this.value) {
                    nextInput.focus();
                }
                updateOtpValue();
            });
            
            // Handle backspace to go to previous input
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !this.value) {
                    const prevInput = document.getElementById(this.dataset.previous);
                    if (prevInput) {
                        prevInput.focus();
                    }
                }
            });
        });
        
        // Function to update the hidden OTP input with combined values
        function updateOtpValue() {
            let otp = '';
            digitInputs.forEach(input => {
                otp += input.value || '';
            });
            otpValueInput.value = otp;
        }
        
        // Focus on the first input when page loads
        if (digitInputs.length > 0) {
            digitInputs[0].focus();
        }
    });
</script>
@endpush