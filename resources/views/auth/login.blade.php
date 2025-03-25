@extends('layouts.auth')

@section('content')
    <section class="auth d-flex">
        <div class="auth-left bg-main-50 flex-center p-24">
            <img src="/admin/assets/images/thumbs/auth-img1.png" alt="Login illustration">
        </div>
        <div class="auth-right py-40 px-24 flex-center flex-column">
            <div class="auth-right__inner mx-auto w-100">
                <a href="index.html" class="auth-right__logo">
                    <h1>Sweettroops</h1>
                </a>
                <h2 class="mb-8">Welcome Back! &#128075;</h2>
                <p class="text-gray-600 text-15 mb-32">Please sign in to your account and start the adventure</p>

                <form action="{{ route('login') }}" method="POST">
                    <!-- CSRF Token (jika Anda menggunakan Laravel) -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="mb-24">
                        <label for="email" class="form-label mb-8 h6">Email</label>
                        <div class="position-relative">
                            <input type="email" class="form-control py-11 ps-40" id="email" name="email" placeholder="Type your email" value="{{ old('email') }}" required autofocus autocomplete="username">
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-user"></i></span>
                            
                            <!-- Error Message (jika ada) -->
                            <div class="text-danger mt-2">
                                <!-- $errors->get('email') -->
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-24">
                        <label for="password" class="form-label mb-8 h6">Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control py-11 ps-40" id="password" name="password" placeholder="Enter Password" required autocomplete="current-password">
                            <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#password"></span>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-lock"></i></span>
                            
                            <!-- Error Message (jika ada) -->
                            <div class="text-danger mt-2">
                                <!-- $errors->get('password') -->
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-32 flex-between flex-wrap gap-8">
                        <div class="form-check mb-0 flex-shrink-0">
                            <input class="form-check-input flex-shrink-0 rounded-4" type="checkbox" id="remember_me" name="remember">
                            <label class="form-check-label text-15 flex-grow-1" for="remember_me">Remember Me</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-main-600 hover-text-decoration-underline text-15 fw-medium">Forgot Password?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-main rounded-pill w-100">Log in</button>

                    <p class="mt-32 text-gray-600 text-center">
                        <a href="{{ route('login-phone') }}" class="text-main-600 hover-text-decoration-underline">Login dengan No Handphone</a>
                    </p>

                    <p class="mt-32 text-gray-600 text-center">New on our platform?
                        <a href="{{ route('register') }}" class="text-main-600 hover-text-decoration-underline">Create an account</a>
                    </p>

                    <div class="divider my-32 position-relative text-center">
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
                    </ul>
                </form>
            </div>
        </div>
    </section>
@endsection