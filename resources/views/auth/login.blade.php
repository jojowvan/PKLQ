@extends('layouts.master')

@section('content')
<div class="limiter">
  <div class="container-login100" style="background-image: url('page/login/images/bg-01.jpg');">
    <div class="wrap-login100 p-t-30 p-b-50">
      <span class="login100-form-title p-b-41">
        Account Login
      </span>

      <form method="POST" action="{{ route('login') }}" class="login100-form validate-form p-b-33 p-t-5">
        @csrf
        <div class="wrap-input100 validate-input" data-validate = "Enter username">
          <input id="email" type="email" class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

          @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
          <span class="focus-input100" data-placeholder="&#xe82a;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Enter password">
          <input id="password" type="password" class="input100{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

          @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
          <span class="focus-input100" data-placeholder="&#xe80f;"></span>
        </div>

        <div class="container-login100-form-btn m-t-32">
          <!-- <button class="login100-form-btn">
            Login
          </button> -->
          <button type="submit" class="btn btn-primary">
              {{ __('Login') }}
          </button>
        </div>

      </form>

    </div>
  </div>
</div>


<div id="dropDownSelect1"></div>
@endsection
