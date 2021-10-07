@extends('layouts.basic')

@section('content')
<div class="main-container logins-screen">
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
                        <h1>{{ __('Reset Password') }}</h1>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="">
                                            <input class="btn-shadow @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required placeholder="Work email" autofocus>
                                            <div class="inputInnerShadow"></div>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="">
                                            <input class="btn-shadow  @error('password') is-invalid @enderror" id="password-confirm" type="password" name="password_confirmation" value="" placeholder="Password" required>
                                            <div class="eye" onclick="passShowHide1()"></div>
                                            <div class="inputInnerShadow"></div>
                                            @error('password-confirm')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="validationNote">
                                    • At least 8 characters in length<br />
                                    • Contain at least 3 of the following 4 types of characters:<br />
                                        &nbsp;&nbsp;&nbsp;1.	Lower case letters (a-z)<br />
                                        &nbsp;&nbsp;&nbsp;2.	Upper case letters (A-Z)<br />
                                        &nbsp;&nbsp;&nbsp;3.	Numbers (i.e. 0-9)<br />
                                        &nbsp;&nbsp;&nbsp;4.	Special characters (e.g. !@#$%^&*)
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <!--<a href="signUpForm.html" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn">Login</a>-->
                                    <button type="submit" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn">{{ __('Reset Password') }}</button>
                                </div>
                            </div>
                        </form>
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
    function passShowHide1() {
        var x = document.getElementById("password-confirm");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endpush