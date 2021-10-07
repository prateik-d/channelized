@extends('layouts.basic')

@section('content')
<div class="main-container login-screen">
    <!-- <aside>    
        </aside> -->
    <div class="container">
        <div class="middle-cnt d-flex align-items-center">  <div class="row">
                <div class="col-sm-6 col-md-12 col-lg-6  getStarted-left">
                    <img  src="{{ asset('public/assets/images/getStartedImg.svg') }}" alt="channelised-icon" class="getStartedImg">
                    <div class="loginpage">
                        New to Channelised? <a href="{{ route('register') }}">Sign up now!</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-12 col-lg-6 getStarted-right">
                    <div class="getStarted-right-action">
                        <h1>Welcome Back</h1>
                        @if(session('email_verification_failed'))
                        <div class="alert alert-warning">
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                        </div>
                        @endif
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="">
                                            <input class="btn-shadow @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Work email" autofocus>
                                            <div class="inputInnerShadow"></div>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="">
                                            <input class="btn-shadow  @error('password') is-invalid @enderror" id="password" type="password" name="password" value="" placeholder="Password" required autocomplete="current-password">
                                            <div class="eye" onclick="passShowHide()"></div>
                                            <div class="inputInnerShadow"></div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-right forgot-link">
                                    <a href="{{ route('password.request') }}">Forgot password?</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="signedMain">
                                        <div class="signedIn">
                                            Stay signed in
                                        </div>
                                        <div class="button b2" id="button-13">
                                            <input type="checkbox" class="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                   <div class="knobs">
                                                <span></span>
                                            </div>
                                            <div class="layer"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!--<a href="signUpForm.html" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn">Login</a>-->
                                    <button type="submit" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn">Login</button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    function passShowHide() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endpush
