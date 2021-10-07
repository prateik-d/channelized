@extends('layouts.basic')
@section('content')
<div class="main-container">
    <div class="container">
        <div class="middle-cnt signUpform">
            <div class="row">
                <div class="col-sm-6  getStarted-left">
                    <img src="{{ asset('public/assets/images/getStartedImg.svg') }}" alt="channelised-icon" class="getStartedImg" />
                    <div class="login">Already a member? <a href="{{ route('login') }}">Login</a></div>
                </div>
                <div class="col-sm-6 getStarted-right">
                    <div class="getStarted-right-action">
                        <h3>Fill up your contact details:</h3>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="">
                                            <input class="btn-shadow @error('firstname') is-invalid @enderror" type="text" value="{{ old('firstname') }}" placeholder="First name" class="form-control" id="firstname" name="firstname" required autocomplete="firstname"/>
                                            <div class="inputInnerShadow"></div>
                                            @error('firstname')
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
                                            <input id="lastname" name="lastname" class="btn-shadow @error('lastname') is-invalid @enderror" type="text" value="{{ old('lastname') }}" placeholder="Last name" class="form-control" required autocomplete="lastname" />
                                            <div class="inputInnerShadow"></div>
                                            @error('lastname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-sm-6 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <div class="">
                                            <input id="jobtitle" name="jobtitle" class="btn-shadow @error('jobtitle') is-invalid @enderror" type="text" value="{{ old('jobtitle') }}" placeholder="Job title" class="form-control" required autocomplete="jobtitle"/>
                                            <div class="inputInnerShadow"></div>
                                            @error('jobtitle')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-12 col-lg-6 jobcategory">
                                    <div class="form-group">
                                        <div class="">
                                            <select id="jobcategory" class="btn-shadow @error('jobcategory') is-invalid @enderror" data-minimum-results-for-search="Infinity" name="jobcategory" required>
                                                <option disabled selected>Job category</option>
                                                {{-- @foreach($jobs as $job)
                                                    <option value="{{$job->id}}" {{ (old('jobcategory')==$job->id?'selected':'') }}>{{$job->name}}</option>
                                                @endforeach --}}
                                            </select>
                                            <div class="inputInnerShadow"></div>
                                            @error('jobcategory')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="">
                                            @php 
                                                $busi_id = [];
                                            @endphp
                                            <select id="businesstype" class="btn-shadow @error('businesstype') is-invalid @enderror"  name="businesstype" required>
                                                <option disabled selected>Business type</option>
                                                {{-- @foreach($business as $busi)
                                                    @php
                                                        $busi_id[] = $busi->id;
                                                    @endphp
                                                    <option value="{{$busi->id}}" {{ (old('businesstype')==$busi->id?'selected':'') }}>{{$busi->name}}</option>
                                                    @if($loop->last)
                                                        @if(old('businesstype') && !in_array(old('businesstype'),$busi_id))
                                                            <option value="{{old('businesstype')}}" selected="">{{old('businesstype')}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach --}}
                                            </select>
                                            <div class="inputInnerShadow"></div>
                                            @error('businesstype')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-sm-6 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <div class="input-shadow">
                                            <input id="password" class="btn-shadow  @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" required autocomplete="new-password"/>
                                            <div class="eye" onclick="passShowHide1()"></div>
                                            <div class="inputInnerShadow"></div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="validationNote">
                                            • At least 8 characters in length<br />
                                            • Contain at least 3 of the following 4 types of characters:<br />
                                                &nbsp;&nbsp;&nbsp;1.	Lower case letters (a-z)<br />
                                                &nbsp;&nbsp;&nbsp;2.	Upper case letters (A-Z)<br />
                                                &nbsp;&nbsp;&nbsp;3.	Numbers (i.e. 0-9)<br />
                                                &nbsp;&nbsp;&nbsp;4.	Special characters (e.g. !@#$%^&*)
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <div class="input-shadow">
                                            <input id="password-confirm" class="btn-shadow" name="password_confirmation" type="password" placeholder="Repeat password" autocomplete="new-password" required="" />
                                            <div class="eye" onclick="passShowHide2()"></div>
                                            <div class="inputInnerShadow"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                            <div class="companyAddress">
                                <!-- <h3>Confirm your company address:</h3> -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="">
                                                <!-- <input type="hidden" name="plan_type" value="{{ (old('plan_type') ? old('plan_type') : $email) }}" /> -->
                                                <input id="email" class="btn-shadow @error('email') is-invalid @enderror" type="email" name="email" value="{{ (old('email') ? old('email') : $email) }}" placeholder="Work email" class="form-control" required autocomplete="email" />
                                                <div class="inputInnerShadow"></div>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="">
                <input id="companyname" name="companyname" class="btn-shadow @error('companyname') is-invalid @enderror"
                    type="text" value="{{ (old('companyname') ? old('companyname') : $cmpnm) }}"
                    placeholder="Company name" class="form-control" required autocomplete="companyname" />
                <div class="inputInnerShadow"></div>
                @error('companyname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="">
                <select id="plan_type" class="btn-shadow @error('plan_type') is-invalid @enderror" name="plan_type"
                    required>
                    <option value="partner" {{ (old('plan_type')=='partner'?'selected':'') }}>Partner</option>
                    <option value="vendor" {{ (old('plan_type')=='vendor'?'selected':'') }}>Vendor</option>
                </select>
                <div class="inputInnerShadow"></div>
                @error('plan_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
   
</div>
                            </div>
                                    
                                </div>
                              
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="agreeAndJoin">
                                        By clicking Agree & Join, you agree to the Channelised
                                        <a href="#" style=" font-size: 12px;">User Agreement, Privacy Policy,</a> and <a style=" font-size: 12px;" href="#">Cookie Policy.</a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-light my-2 my-sm-0 btn-shadow float-right agreeAndJoinBtn" type="submit">
                                        Agree & Join
                                    </button>
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
<!-- <script src="{{ asset('public/assets/js/select2.min.js') }}"></script> -->
<script>
   /*  $(function () {
        $("select").on("select2:open", function(event) {
            $('input.select2-search__field').attr('placeholder', 'Please specify..');
        });
        
        $("#jobcategory").select2();
        
        $('#businesstype').select2({
            tags: true,
        });
    }); */

    function passShowHide1() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function passShowHide2() {
        var x = document.getElementById("password-confirm");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endpush