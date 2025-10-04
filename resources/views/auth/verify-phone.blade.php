@extends('layouts.guest')

@section('content')
<section class="section-20">
    <div class="w-layout-blockcontainer container-17 w-container">
        <div class="div-block-15" style="justify-content: center;"> {{-- Dibuat ke tengah karena hanya satu kolom --}}
            
            {{-- Bagian Form Verifikasi OTP --}}
            <div class="div-block-16">
                <h1 class="heading-11">Two-Step Verification ✔️</h1>
                <div class="text-block-5">
                    Kami telah mengirimkan kode verifikasi ke nomor handphone Anda. Masukkan kode tersebut di bawah ini.
                    <span class="fw-medium d-block" style="margin-top: 8px;">***{{ substr($user->phone, -3) }}</span>
                </div>

                {{-- Menampilkan pesan sukses atau error --}}
                @if (session('success'))
                    <div class="alert alert-success" style="margin-top: 20px; text-align: left;">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" style="margin-top: 20px; text-align: left; padding-bottom: 0;">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="form-block-3 w-form">
                    <form action="{{ route('verify.otp') }}" method="POST" style="margin-top: 20px;">
                        @csrf
                        <label class="field-label-7">Ketik 6 digit kode keamanan Anda</label>
                        
                        {{-- Input untuk 6 digit OTP --}}
                        <div class="squire-input-wrapper" style="display: flex; justify-content: space-between; gap: 10px; margin-top: 10px; margin-bottom: 30px;">
                            <input type="text" class="squire-input text-field-4 w-input text-center" maxlength="1" id="digit-1" data-next="digit-2" pattern="[0-9]*" inputmode="numeric">
                            <input type="text" class="squire-input text-field-4 w-input text-center" maxlength="1" id="digit-2" data-next="digit-3" data-previous="digit-1" pattern="[0-9]*" inputmode="numeric">
                            <input type="text" class="squire-input text-field-4 w-input text-center" maxlength="1" id="digit-3" data-next="digit-4" data-previous="digit-2" pattern="[0-9]*" inputmode="numeric">
                            <input type="text" class="squire-input text-field-4 w-input text-center" maxlength="1" id="digit-4" data-next="digit-5" data-previous="digit-3" pattern="[0-9]*" inputmode="numeric">
                            <input type="text" class="squire-input text-field-4 w-input text-center" maxlength="1" id="digit-5" data-next="digit-6" data-previous="digit-4" pattern="[0-9]*" inputmode="numeric">
                            <input type="text" class="squire-input text-field-4 w-input text-center" maxlength="1" id="digit-6" data-previous="digit-5" pattern="[0-9]*" inputmode="numeric">
                        </div>
                        
                        {{-- Input tersembunyi untuk menampung nilai OTP gabungan --}}
                        <input type="hidden" name="otp" id="otp-value">
                        
                        <button type="submit" class="button-7 w-button">Verify Now</button>
                    </form>
                </div>

                <p style="margin-top: 24px; text-align: center;">
                    Tidak menerima kode?
                    <a href="javascript:void(0)" onclick="document.getElementById('resend-form').submit();" style="color: #ff85a2; text-decoration: underline;">
                        Kirim Ulang
                    </a>
                </p>

                {{-- Form tersembunyi untuk fitur kirim ulang OTP --}}
                <form id="resend-form" action="{{ route('resend.otp') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

            <div class="div-block-17">
                <h1 id="w-node-_803d5886-e670-2807-d25c-ebd36aea8283-61f5beb9" class="heading-13">Be Part of SweetTroops</h1>
                <div id="w-node-_183be123-2e6e-a3f4-9515-ad2d10d9731d-61f5beb9" class="text-block-4">Welcome to SweetTroops, your new baking home!<br>We're so excited to have you join our big, flour-dusted family.<br>Unlock step-by-step classes, secret recipes, and a sprinkle of inspiration in every lesson. Here, every recipe comes with a smile, every class feels like baking with friends, and there's always room at the table for you.<br>Let's roll up our sleeves and make something sweet together!</div>
            
                <a id="w-node-d254ce7d-e13d-e853-35ff-71a56911d398-61f5beb9" href="{{ route('register') }}" class="button w-button">COUNT ME IN!</a>
            </div>

        </div>
    </div>
</section>
@endsection

@push('js')
{{-- JavaScript dari template lama disalin sepenuhnya ke sini --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const digitInputs = document.querySelectorAll('.squire-input');
        const otpValueInput = document.getElementById('otp-value');
        
        digitInputs.forEach(input => {
            input.addEventListener('input', function() {
                const nextInput = document.getElementById(this.dataset.next);
                if (nextInput && this.value) {
                    nextInput.focus();
                }
                updateOtpValue();
            });
            
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !this.value) {
                    const prevInput = document.getElementById(this.dataset.previous);
                    if (prevInput) {
                        prevInput.focus();
                    }
                }
            });
        });
        
        function updateOtpValue() {
            let otp = '';
            digitInputs.forEach(input => {
                otp += input.value || '';
            });
            otpValueInput.value = otp;
        }
        
        if (digitInputs.length > 0) {
            digitInputs[0].focus();
        }
    });
</script>
@endpush