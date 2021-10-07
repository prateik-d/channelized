@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    @error('plan')
                        <div class="alert alert-warning" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="hidden" name="plan" value="{{$plan}}" />
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus placeholder="First name">
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus placeholder="Last name">
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="companyname" type="text" class="form-control @error('companyname') is-invalid @enderror" name="companyname" value="{{ old('companyname') }}" required autocomplete="companyname" autofocus placeholder="Company name">
                                @error('companyname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Work email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="jobtitle" type="text" class="form-control @error('jobtitle') is-invalid @enderror" name="jobtitle" value="{{ old('jobtitle') }}" required autocomplete="jobtitle" placeholder="Job title">
                                @error('jobtitle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <select id="jobcategory" class="form-control @error('jobcategory') is-invalid @enderror" name="jobcategory" required>
                                    <option value="0" selected>Job category</option>
                                    @foreach($jobs as $job)
                                        <option value="{{$job->id}}" {{ (old('jobcategory')==$job->id?'selected':'') }}>{{$job->name}}</option>
                                    @endforeach
                                </select>
                                @error('jobcategory')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if($plan=="partner")
                        <div class="form-group">
                            <select id="businesstype" class="form-control @error('businesstype') is-invalid @enderror" name="businesstype" required>
                                <option value="0" selected>Select your type of business..</option>
                                @foreach($business as $busi)
                                    <option value="{{$busi->id}}" {{ (old('businesstype')==$busi->id?'selected':'') }}>{{$busi->name}}</option>
                                @endforeach
                            </select>
                            @error('businesstype')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @endif
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-0">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" aria-describedby="passwordHelpBlock">
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    <ul>
                                        <li>Upper and lowercase letters</li>
                                        <li>More than 8 characters</li>
                                        <li>Contains a number or symbol</li>
                                    </ul>
                                </small>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-0">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"  placeholder="Repeat Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 col-form-label col-form-label-lg p-0">Confirm your company address:</label>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">@</i></span>
                                </div>
                            </div>
                            @error('businesstype')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" required autocomplete="city" placeholder="City" value="{{old('city')}}">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" required autocomplete="state" placeholder="State" value="{{old('state')}}">
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" required autocomplete="postcode" placeholder="Post Code" value="{{old('postcode')}}">
                                @error('postcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-9">
                                <label class="col-sm-12 col-form-label col-form-label-sm p-0">
                                    By Clicking Agree & Join you agree to the Channelised User Agreement. Privacy Policy. and Cookie Policy.
                                </label>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary float-right">Agree & Join</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
