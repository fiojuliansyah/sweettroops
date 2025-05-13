@extends('layouts.auth')

@section('content')
    <section class="auth d-flex">
        <div class="auth-left bg-main-50 flex-center p-24">
            <img src="/pages/assets/img/logo.png" alt="Login illustration">
        </div>
        <div class="auth-right py-40 px-24 flex-center flex-column">
            <div class="auth-right__inner mx-auto w-100">
                <a href="/" class="auth-right__logo">
                    <h1>Sweettroops</h1>
                </a>
                <h2 class="mb-8">Welcome Back! &#128075;</h2>
                <p class="text-gray-600 text-15 mb-32">Please sign in to your account and start the adventure</p>

                <form action="{{ route('login-phone') }}" method="POST">
                    <!-- CSRF Token (jika Anda menggunakan Laravel) -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="mb-24">
                        <label for="phone" class="form-label mb-8 h6">No Handphone</label>
                        <div class="position-relative">
                            <input type="text" class="form-control py-11 ps-40" id="phone" name="phone" placeholder="Masukan No Handphone" value="{{ old('phone') }}" required autofocus autocomplete="username">
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-phone"></i></span>
                        </div>
                        <small>Contoh : 08121213131414 / 628121213131414</small>
                    </div>
                    
                    <button type="submit" class="btn btn-main rounded-pill w-100">Log in</button>

                    {{-- <div class="divider my-32 position-relative text-center">
                        <span class="divider__text text-gray-600 text-13 fw-medium px-26 bg-white">or</span>
                    </div>

                    <ul class="flex-align gap-10 flex-wrap justify-content-center">
                        <li>
                            <a href="https://www.facebook.com" class="w-38 h-38 flex-center rounded-6 text-facebook-600 bg-facebook-50 hover-bg-facebook-600 hover-text-white text-lg">
                                <i class="ph-fill ph-facebook-logo"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com" class="w-38 h-38 flex-center rounded-6 text-twitter-600 bg-twitter-50 hover-bg-twitter-600 hover-text-white text-lg">
                                <i class="ph-fill ph-twitter-logo"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.google.com" class="w-38 h-38 flex-center rounded-6 text-google-600 bg-google-50 hover-bg-google-600 hover-text-white text-lg">
                                <i class="ph ph-google-logo"></i>
                            </a>
                        </li>
                    </ul> --}}
                </form>
            </div>
        </div>
    </section>
@endsection