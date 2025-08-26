@extends('layouts.guest')

@section('content')
  {{-- Judul Halaman --}}
  <section class="sec-title">
    <div class="w-layout-blockcontainer cont-title w-container">
      <h1 class="heading-title">{{ __('Profile') }}</h1>
    </div>
  </section>
  
  {{-- Bagian Form Utama --}}
  <section class="section-13">
    <div class="w-layout-blockcontainer container-10 w-container">

      {{-- Form 1: Informasi Profil --}}
      <div class="w-layout-layout quick-stack wf-layout-layout">
        <div class="w-layout-cell cell-8">
          <h1 class="heading-8">{{ __('Profile Information') }}</h1>
          <div class="text-block-3">
            {{ __("Update your account's profile information and email address.") }}
          </div>
        </div>
        <div class="w-layout-cell">
          <div class="form-block w-form">
            <form method="post" action="{{ route('troopers.profile.update') }}">
              @csrf
              @method('patch')

              <label for="name" class="field-label">{{ __('Name') }}</label>
              <input class="text-field-2 name w-input" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
              @error('name')
                <div class="error-message w-form-fail" style="display:block;">
                  <div><strong>{{ $message }}</strong></div>
                </div>
              @enderror

              <label for="email" class="field-label-2">{{ __('Email Address') }}</label>
              <input class="text-field email w-input" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
              @error('email')
                <div class="error-message w-form-fail" style="display:block;">
                  <div><strong>{{ $message }}</strong></div>
                </div>
              @enderror

              <label for="phone" class="field-label-2">{{ __('Phone') }}</label>
              <input class="text-field email w-input" type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required>
              @error('phone')
                <div class="error-message w-form-fail" style="display:block;">
                  <div><strong>{{ $message }}</strong></div>
                </div>
              @enderror
              
              <input type="submit" class="submit-button w-button" value="{{ __('Save Changes') }}">
              <br>
              <br>

              @if (session('status') === 'profile-updated')
                <div class="success-message w-form-done" style="display:block;">
                    <div>{{ __('Profile saved successfully.') }}</div>
                </div>
              @endif
            </form>
          </div>
        </div>
      </div>
      
      {{-- Pembatas --}}
      <hr style="margin: 40px 0;">

      {{-- Form 2: Ubah Password --}}
      <div class="w-layout-layout quick-stack wf-layout-layout">
        <div class="w-layout-cell cell-8">
          <h1 class="heading-8">{{ __('Update Password') }}</h1>
           <div class="text-block-3">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
          </div>
        </div>
        <div class="w-layout-cell">
          <div class="form-block w-form">
            <form method="post" action="{{ route('password.update') }}">
              @csrf
              @method('put')

              <label for="current_password" class="field-label">{{ __('Current Password') }}</label>
              <input class="text-field w-input" type="password" name="current_password" id="current_password">
              @error('current_password', 'updatePassword')
                <div class="error-message w-form-fail" style="display:block;">
                  <div><strong>{{ $message }}</strong></div>
                </div>
              @enderror

              <label for="password" class="field-label-2">{{ __('New Password') }}</label>
              <input class="text-field w-input" type="password" name="password" id="password">
              @error('password', 'updatePassword')
                 <div class="error-message w-form-fail" style="display:block;">
                  <div><strong>{{ $message }}</strong></div>
                </div>
              @enderror

              <label for="password_confirmation" class="field-label-3">{{ __('Confirm Password') }}</label>
              <input class="text-field w-input" type="password" name="password_confirmation" id="password_confirmation">

              <input type="submit" class="submit-button w-button" value="{{ __('Update Password') }}">
                <br>
                <br>
                
               @if (session('status') === 'password-updated')
                <div class="success-message w-form-done" style="display:block;">
                    <div>{{ __('Password updated successfully.') }}</div>
                </div>
              @endif
            </form>
          </div>
        </div>
      </div>

      {{-- Pembatas --}}
      <hr style="margin: 40px 0;">

      {{-- Form 3: Hapus Akun --}}
      <div class="w-layout-layout quick-stack wf-layout-layout">
        <div class="w-layout-cell cell-8">
          <h1 class="heading-8">{{ __('Delete Account') }}</h1>
           <div class="text-block-3">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
          </div>
        </div>
        <div class="w-layout-cell">
          <div class="form-block w-form">
            <form method="post" action="{{ route('troopers.profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
              @csrf
              @method('delete')
              
              <label for="password_delete" class="field-label">{{ __('Enter Your Password to Confirm') }}</label>
              <input class="text-field w-input" type="password" name="password" id="password_delete" required>
              @error('password', 'userDeletion')
                 <div class="error-message w-form-fail" style="display:block;">
                  <div><strong>{{ $message }}</strong></div>
                </div>
              @enderror
              
              <input type="submit" class="submit-button w-button" style="background-color: #dc3545;" value="{{ __('Delete My Account') }}">
            </form>
          </div>
        </div>
      </div>

    </div>
  </section>

  {{-- Bagian informasi tambahan (jika diperlukan) bisa meniru section 14 --}}
  {{-- <section class="section-14"> ... </section> --}}
@endsection