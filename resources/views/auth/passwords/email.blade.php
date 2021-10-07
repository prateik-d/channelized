@extends('layouts.basic')

@section('content')
<div class="main-container logins-screen">
    <!-- <aside>
        </aside> -->
    <div class="container">
        <div class="middle-cnt d-flex align-items-center">
            <div class="row">
                <div class="col-sm-6 col-md-12 col-lg-6  getStarted-left">
                    <img  src="{{ asset('public/assets/images/getStartedImg.svg') }}" alt="channelised-icon" class="getStartedImg">
                    <div class="loginpage">
                        New to Channelised? <a href="{{ route('register') }}">Sign up now!</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-12 col-lg-6 getStarted-right">
                    <div class="getStarted-right-action">
                        <h1>{{ __('Reset Password') }}</h1>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
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
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn">{{ __('Send Password Reset Link') }}</button>
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