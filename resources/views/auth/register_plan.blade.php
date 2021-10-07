@extends('layouts.basic')

@section('content')
<div class="main-container logins-screen">
    <div class="container">
        <div class="middle-cnt d-flex align-items-center">
            <div class="row">
                <div class="col-sm-6 col-md-12 col-lg-6  getStarted-left">
                    <img  src="{{ asset('public/assets/images/getStartedImg.svg') }}" alt="channelised-icon" class="getStartedImg">
                    <div class="loginpage">
                        Already a member? <a href="{{ route('login') }}">Login</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-12 col-lg-6 getStarted-right">
                    <div class="getStarted-right-action">
                        <h1>Get Started</h1>
                        <!-- <h3>Choose Signup type:</h3>
                        <a href="{{ route('auth/linkedin') }}" class="btn btn-primary btn-soundcloud btn-lg btn-block">Linkedin</a> -->
                  
                        <form method="POST" id="form-signup" action="{{ route('register_work') }}">
                            @csrf
                            <div class="row">
                           <div class="col-md-12">
                                <div class="form-group">
                                    <div>
                                        <input type="email" placeholder="Work email" class="btn-shadow @error('work_email') is-invalid @enderror" id="work_email" name="work_email" required/>
                                        <div class="inputInnerShadow"></div>
                                        @error('work_email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                         
                            <div class="col-md-12">
                            <div class="form-group">
                            <button type="submit" class="btn btn-light my-2 my-sm-0 btn-shadow float-right">Next</button>
                            </div>
                            </div>
                      
                            <!-- @foreach($plans as $plan)
                                @if($plan->name=="partner")
                                <a data-href="{{$plan->name}}" class="btn btn-light btn-shadow techPartner text-left">
                                    Tech Partner<br>
                                    <span>I need meaningful insights to grow my business</span>
                                </a>
                                @elseif($plan->name=="vendor")
                                <a data-href="{{$plan->name}}" class="btn btn-light btn-shadow techVendor text-left">
                                    Tech Vendor<br>
                                    <span>I need to deliver valuable insights to my partners</span>
                                </a>
                                @endif
                            @endforeach
                            <input type="hidden" name="type" id="type" class="@error('type') is-invalid @enderror" value="" />
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror -->
                           
                        </form>
                    </div>
                </div>
                <!-- <div class="col-sm-6 getStarted-right">
                    <div class="getStarted-right-action">
                        <h1>Get Started</h1>  
                        <h3>Choose your account type:</h3>
                        <span class="err-account text-danger" style="display: none;">Please select account type</span>
                        @foreach($plans as $plan)
                            @if($plan->name=="partner")
                            <a href="{{url('register/'.$plan->name)}}" data-href="{{url('register/'.$plan->name)}}" class="btn btn-light btn-shadow techPartner text-left">
                                Tech Partner<br>
                                <span>I need meaningful insights to grow my business</span>
                            </a>
                            @elseif($plan->name=="vendor")
                            <a href="{{url('register/'.$plan->name)}}" data-href="{{url('register/'.$plan->name)}}" class="btn btn-light btn-shadow techVendor text-left">
                                Tech Vendor<br>
                                <span>I need to deliver valuable insights to my partners</span>
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(function () {
        /* $(document).on('click', "a.btn-shadow", function(){
            $("a.btn-shadow").removeClass("active");
            $(this).addClass("active");
            $('#type').val($(this).data('href'));
        }); */
        /* $(document).on('click', "button.nextbtn", function() {
            var type = $('a.btn-shadow.active').data('href'); */
//            debugger;
           /*  if(typeof(type)!="undefined" && type.length > 0){ */
                //alert(type);
                //window.location = link;
               /*  $('#form-signup').submit();
                return false;
            }
            $('span.err-account').show();
        }); */
    });
</script>
@endpush