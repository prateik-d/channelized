@extends('layouts.basic')

@section('content')
<div class="main-container">
    <div class="container">
        <div class="middle-cnt signUpform">
            <div class="row">
                <div class="col-sm-6  getStarted-left">
                    <img src="{{ asset('public/assets/images/getStartedImg.svg') }}" alt="" class="getStartedImg" />
                    <div class="login">Already a member? <a href="{{ route('login') }}">Login</a></div>
                </div>
                <div class="col-sm-6 getStarted-right">
                    <div class="getStarted-right-action verification">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        <h3>
                            A verification link has been sent to your email account!
                        </h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <p>
                                    Please click on the link that has just been sent to your
                                    email account to verify your email and continue the
                                    registration process.
                                </p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{ route('verification.resend') }}" class="btn btn-light my-2 my-sm-0 btn-shadow float-left">
                                    Resend verification email
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection