@extends('layouts.dashboard')

@push('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
<div class="admin-container">
    <div class="create-event-header">
        <h1>Fill up all the questions below:</h1>
        @if(Auth::user()->roles[0]->name != "admin")
            <div class="create-event-action">
                <a href="{{route(Auth::user()->roles[0]->name.'.offers.index')}}" class="btn btn-light btn-shadow">
                    Current Product Promotions & Offers
                </a>
                <a href="{{route(Auth::user()->roles[0]->name.'.offers.create')}}" class="btn btn-light btn-shadow">
                    + Create  Product Promotions & Offers
                </a>
                {{-- <a href="javascript:void(0)" class="btn btn-primary btn-shadow dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    + Create Product Promotions & Offers
                </a>
                <div class="dropdown-menu creat-box" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route(Auth::user()->roles[0]->name.'.offers.create','single')}}">Single Product Promotions & Offers </a>
                    <a class="dropdown-item" href="{{route(Auth::user()->roles[0]->name.'.offers.create','multiple')}}">One Product Promotions & Offers - multiple cities</a>
                </div> --}}
            </div>
        @endif
    </div>
    <!-- @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $key=>$error)
                    <li>{{ $key.'='.$error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->
    @if($errors->has('location.*') || $errors->has('city.*') || $errors->has('state.*') || $errors->has('post_code.*'))
        <div class="alert alert-danger">
            <ul class="mt-0">
                @if($errors->has('location.*'))
                    <li>The location field is required.</li>
                @endif
                @if($errors->has('city.*'))
                    <li>The city field is required.</li>
                @endif
                @if($errors->has('state.*'))
                    <li>The state field is required.</li>
                @endif
                @if($errors->has('post_code.*'))
                    <li>The post code field is required.</li>
                @endif
            </ul>
        </div>
    @endif
    <form method="POST" id="event_update" class="event-add-form" action="{{ route(Auth::user()->roles[0]->name.'.offers.update',Crypt::encrypt($event->id)) }}"  enctype='multipart/form-data'>
        @csrf {{ method_field('PUT') }}
        <input type="hidden" name="tz" id="tz">
        @hasrole('admin')
            <div class="col-md-8">
                <div class="create-form">
                    <div class="create-event-form">
                        <div class="create-event-form-row">
                            <div class="create-event-form-label">Category</div>
                            <div class="create-event-form-input">
                                <div class="create-event-form-input">
                                    <select class="event-dropcreate" id="category" name="category" required="">
                                        <option value="event" {{ ('event' == (old('category') ? old('category') : $event->category) ? 'selected' : '') }}>Event</option>
                                        <option value="reward_incentive" {{ ('reward_incentive' == (old('category') ? old('category') : $event->category) ? 'selected' : '') }}>Rewards & Incentives</option>
                                        <option value="product_promotion_offer" {{ ('product_promotion_offer' == (old('category') ? old('category') : $event->category) ? 'selected' : '') }}>Product Promotions & Offers</option>
                                        <option value="technical_education" {{ ('technical_education' == (old('category') ? old('category') : $event->category) ? 'selected' : '') }}> Technical Education </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endhasrole
        <div class="col-md-8">
            <div class="create-form">
                <div class="create-event-form">
                    <div class="create-event-form-row">
                        <div for="name" class="create-event-form-label">Product name</div>
                        <div class="create-event-form-input">
                            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name',$event->name) }}" required="" autocomplete="name" placeholder="Give it a short distinct name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="create-event-form-row">
                        <div class="create-event-form-label">Location</div>
                        <div id="location_multi">
                            @if(old('location') || old('city') || old('state') || old('post_code'))
                                @for( $i =0; $i < count(old('location')); $i++)
                                    <div class="create-location-form-input {{ ($i==0?'':'mt-2') }}">
                                    <div class="create-event-form-input location-event">
                                        <input class="btn btn-light btn-shadow search @error('location'.$i) is-invalid @enderror" name="location[]" id="autocomplete_{{$i}}" onfocus="geolocate(this,{{$i}})" type="text"  value="{{ old('location.'.$i) }}" placeholder="Search for a venue or address" required>
                                    </div>
                                    @if($event->event_type=="multiple")
                                            <div class="col-md-1">
                                                <div class="input-50 mr-1 ml-1 plusevent-btn">
                                                @if($i==0)
                                                    <a href="javascript:void(0)" class="add_location">+</a>
                                                @else
                                                    <a href="javascript:void(0)" class="remove_location">-</a>
                                                @endif
                                                </div>
                                            </div>
                                    @endif
                                    <input type="hidden" id="city_{{$i}}"  value="{{ old('city.'.$i) }}" name="city[]">
                                    <input type="hidden" id="state_{{$i}}" value="{{ old('state.'.$i) }}" name="state[]">
                                    <input type="hidden" id="post_{{$i}}" value="{{ old('post_code.'.$i) }}" name="post_code[]">
                                </div>
                                @endfor
                            @elseif($event->eventlocations()->count() > 0)
                              @php $i=0;  @endphp
                                @foreach($event->eventlocations()->get() as $location)
                                    <div class="create-location-form-input {{ ($loop->first?'':'mt-2') }}">
                                        <div class="create-event-form-input location-event">
                                            <input class="btn btn-light btn-shadow search" name="location[]" id="autocomplete_{{$i}}" onfocus="geolocate(this,{{$i}})" type="text" placeholder="Search for a venue or address" value="{{ old('location',$location->location) }}" required>
                                        </div>
                                        @if($event->event_type=="multiple")
                                                <div class="col-md-1">
                                                    <div class="input-50 mr-1 ml-1 plusevent-btn">
                                                        @if($loop->first)
                                                            <a href="javascript:void(0)" class="add_location">+</a>
                                                        @else
                                                            <a href="javascript:void(0)" class="remove_location">-</a>
                                                        @endif
                                                    </div>
                                                </div>
                                        @endif
                                        <input type="hidden" id="city_{{$i}}"  value="{{ $location->eventLocationCity->name }}" name="city[]">
                                        <input type="hidden" id="state_{{$i}}" value="{{ preg_replace( '/\([^)]+\)/','',$location->eventLocationState->name) }}" name="state[]">
                                        <input type="hidden" id="post_{{$i}}" value="{{ $location->post_code }}" name="post_code[]">
                                    </div>
                                  @php $i++; @endphp
                                @endforeach
                            @else
                                <div class="create-location-form-input">
                                    <div class="create-event-form-input location-event">
                                        <input onfocus="geolocate(this,0)" id="autocomplete_0" class="btn btn-light btn-shadow search" name="location[]" type="text" placeholder="Search for a venue or address" autocomplete="off" required>
                                    </div>
                                    <input type="hidden" id="city_0"  value="" name="city[]">
                                    <input type="hidden" id="state_0" value="" name="state[]">
                                    <input type="hidden" id="post_0" value="" name="post_code[]">
                                    @if(@$etype=="multiple")
                                            <div class="col-md-1">
                                                <div class="input-50 mr-1 ml-1 plusevent-btn">
                                                    <a href="javascript:void(0)" class="add_location">+</a>
                                                    <!-- <a href="javascript:void(0)" class="remove_location">-</a> -->
                                                </div>
                                            </div>
                                        @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="create-event-form-row date-event">
                        <div class="row">
                            <div class="col-md-6">
                                <div for="stdt" class="create-event-form-label">Starts</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="create-event-form-input evdate">
                                            <input id="stdt" type="date" class="flatpickr-input @error('stdt') is-invalid @enderror" name="stdt" value="{{ old('stdt',$event->start_date) }}" required="" autocomplete="stdt" autofocus>
                                            @error('stdt')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="create-event-form-input">
                                            <input id="stdu" type="text" class="timepicker @error('stdu') is-invalid @enderror" name="stdu" value="{{ old('stdu', date('h:i A', strtotime($event->start_duration))) }}" required autocomplete="stdu" placeholder="hh:mm a">
                                            @error('stdu')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div for="etdt" class="create-event-form-label">Ends</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="create-event-form-input evdate">
                                            <input id="etdt" type="date" class="flatpickr-input @error('etdt') is-invalid @enderror" name="etdt" value="{{ old('etdt',$event->end_date) }}" required autocomplete="etdt" autofocus>
                                            @error('etdt')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="create-event-form-input">
                                            <input id="etdu" type="text" class="timepicker @error('etdu') is-invalid @enderror" name="etdu" value="{{ old('etdu', date('h:i A', strtotime($event->end_duration))) }}" required autocomplete="etdu" placeholder="hh:mm a">
                                            @error('etdu')
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
                    <div class="create-event-form-row">
                        <div class="create-event-form-label">Select your time zone</div>
                        <div class="create-event-form-input">
                            <div class="create-event-form-input">
                                <select class="event-dropcreate @error('time_zone') is-invalid @enderror" id="time_zone" name="time_zone" required="">
                                    <option value="0" {{(@old('time_zone',$event->timezone)==NULL ? 'selected':'')}}>Select</option>
                                    <option value="Australia/ACT" {{(@old('time_zone',$event->timezone)=='Australia/ACT' ? 'selected':'')}}>Australia/ACT</option>
                                    <option value="Australia/Canberra" {{(@old('time_zone',$event->timezone)=='Australia/Canberra' ? 'selected':'')}}>Australia/Canberra</option>
                                    <option value="Australia/West" {{(@old('time_zone',$event->timezone)=='Australia/West' ? 'selected':'')}}>Australia/West</option>
                                </select>
                                @error('time_zone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="create-event-form-row">
                        <div class="create-event-form-label">Select Product Promotions & Offers solution solution topic</div>
                        <div class="create-event-form-input">
                            <div class="create-event-form-input">
                                <select class="event-dropcreate @error('solution') is-invalid @enderror" id="solution" name="solution" required="">
                                    <option value="0" {{(@old('solution',$event->solution_id)==NULL ? 'selected':'')}}>Select</option>
                                    @foreach($solutions as $single)
                                        <option value="{{$single->id}}" {{(@old('solution',$event->solution_id)==$single->id ? 'selected':'')}}>{{$single->name}}</option>
                                    @endforeach
                                </select>
                                @error('solution')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="create-event-form-row">
                        <div class="create-event-form-label">Select industry</div>
                        <div class="create-event-form-input">
                            <div class="create-event-form-input">
                                <select class="event-dropcreate @error('industry') is-invalid @enderror" id="industry" name="industry" required="">
                                    <option value="0" {{(@old('industry',$event->industry_id)==NULL ? 'selected':'')}}>Select</option>
                                    @foreach($industries as $single)
                                        <option value="{{$single->id}}" {{(@old('industry',$event->industry_id)==$single->id ? 'selected':'')}}>{{$single->name}}</option>
                                    @endforeach
                                </select>
                                @error('industry')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="create-event-form-row">
                        <div class="create-event-form-label">Product Promotions & Offers type</div>
                        <div class="create-event-form-input">
                            <div class="create-event-form-input">
                                <select class="event-dropcreate @error('type') is-invalid @enderror" id="type" name="type" required="">
                                    <option value="0" {{(@old('type',$event->type_of_offer_id)==NULL ? 'selected':'')}}>Select</option>
                                    @foreach($type_of_events as $single)
                                        <option value="{{$single->id}}" {{(@old('type',$event->type_of_offer_id)==$single->id ? 'selected':'')}}>{{$single->name}}</option>
                                    @endforeach
                                </select>
                                @error('type')
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
        <div class="col-md-8">
            <div class="create-form">
                <div class="create-event-form">
                    <div class="create-event-form-row">
                        <div class="create-event-form-label">Product Promotions & Offers Description</div>
                        <div class="create-event-form-input">
                            <textarea rows="10" class="@error('summary') is-invalid @enderror" id="summary" name="summary" placeholder="Short description of your event (not more than 350 words)" required="">{{@old('summary', $event->summary)}}</textarea>
                            @error('summary')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="create-event-form-row">
                        <div class="create-event-form-label">Product Promotions & Offers Short Description</div>
                        <div class="create-event-form-input">
                            <textarea rows="5" class="@error('short_summary') is-invalid @enderror" id="short_summary" name="short_summary" placeholder="Short Description of your Product Promotions & Offers (not more than 150 words)" required>{{old('short_summary',$event->short_summary)}}</textarea>
                            @error('short_summary')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="create-event-form-row">
                        <div class="create-event-form-label">Organiser name</div>
                        <div class="create-event-form-input">
                            <input id="organised" type="text" class="@error('organised') is-invalid @enderror" name="organised" value="{{ old('organised',$event->organised_by) }}" required autocomplete="organised" autofocus placeholder="Organised">
                            @error('organised')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="create-form">
                <div class="create-event-form">
                    <div class="create-event-form-row">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="create-event-form-label">Registration link</div>
                            </div>
                            <div class="col-md-7">
                                <div class="create-event-form-input">
                                    <input id="registration" type="url" class="@error('registration') is-invalid @enderror" name="registration" value="{{ old('registration',$event->registration_link) }}" autocomplete="registration" placeholder="Registration link">
                                    @error('registration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="evnt-or">OR</div>
                            </div>
                            <div class="col-md-4">
                                <div class="create-event-form-label"></div>
                                <div class="create-event-form-input">
                                    <button href="#" class="btn btn-light my-2 my-sm-0 btn-shadow even-hostbtn" type="button">Host on Channelised for FREE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 event-filepad">
            <div class="create-form">
                <div class="create-event-form">
                    <div class="create-event-form-row">
                        <div class="create-event-form-label">Event image:</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if($event->logo!=null)
                                            <img src="{{asset('public/uploads/events/'.$event->logo)}}" width="180"/>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if($event->banner!=null)
                                            <img src="{{asset('public/uploads/events/'.$event->banner)}}" width="180"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="upload-btn-wrapper">
                                    <button class="btn btn-light btn-shadow upl-btn">
                                        <div class="upload-img"><img src="{{ asset('public/assets/images/file-upload.png') }}"></div>
                                        <div class="upload-txt">
                                            <p>Company Logo</p>
                                            <p>File format: jpg, png, eps</p>
                                        </div>
                                    </button>
                                    <input type="file" name="logo" class="@error('logo') is-invalid @enderror"/>
                                    @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="upload-btn-wrapper">
                                    <button class="btn btn-light btn-shadow upl-btn">
                                        <div class="upload-img"><img src="{{ asset('public/assets/images/file-upload.png') }}"></div>
                                        <div class="upload-txt">
                                            <p>Product Image </p>
                                            <p>File format: jpg, png, eps</p>
                                        </div>
                                    </button>
                                    <input type="file" name="banner"  class="@error('banner') is-invalid @enderror"/>
                                    @error('banner')
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
        </div>
        <div class="col-md-8 pb-5">
            <div class="create-form">
                <div class="create-event-form">
                    <div class="create-event-form-row mt-0">
                        <label class="event-check">I hereby declare that the information provided is true and correct.
                        <input type="checkbox" class="@error('declare') is-invalid @enderror" name="declare" id="declare" {{($event->declared==1 ? 'checked' : null)}}>
                        <span class="checkmarkevnt"></span>
                        </label>
                        @error('declare')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-4 mb-5">
            <div class="event-subsv-btn">
                <div id="hiden_fields_here"></div>
                @hasrole('admin')
                <input type="hidden" name="status" value="approved" />
                <button type="button" id="submit_btn" class="btn btn-primary btn-shadow">Approve</button>
                @endhasrole
                @hasrole('vendor')
                    <button type="button" id="submit_btn" class="btn btn-primary btn-shadow event-sabbtn">Update as Review</button>
                    <button type="button" id="draft_btn" class="btn btn-light btn-shadow ev-savbtn">Update as Draft</button>
                @endhasrole
            </div>
        </div>
    </form>
</div>
@endsection
@push('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(function () {

        jQuery(document).ready(function($) {
          jQuery('.flatpickr-input').each(function() {
            //const optionsJson = jQuery(this).attr('options') || '{}';    

           // const inputOptions = JSON.parse(optionsJson)
            const defaultOptions = {
              altInput: true,
              altFormat: 'd/m/Y',
              allowInput: true,
              clickOpens: true,
            };


            jQuery(this).flatpickr(defaultOptions);
          })
     });

        // guess user timezone 
        $('#tz').val(moment.tz.guess());
        
        $('.timepicker').timepicker({
            timeFormat: 'hh:mm p',
            scrollbar: true,
            interval: 30,
            dynamic: false
        });

        //submit
        $(document).on('click','#submit_btn',function(){
            if($('#status').length){
                $('#status').remove();
            }
            $('#event_update').submit();
        });

        //draft
        $(document).on('click','#draft_btn',function(){
            if(!$('#status').length){
                var draft_input = $("<input/>", {
                    type: "hidden",
                    name: "status",
                    value: "draft",
                    id: "status"
                });
                $('#hiden_fields_here').append(draft_input);
            }
            $('#event_update').submit();
        });

        $(document).on('click','.remove_agenda', function(){
            var this_act = $(this);
            if($('#agenda_multi div.create-event-form-input').length > 1){
                $(this_act).parents('div.create-event-form-input').remove();
            }else{
                alert('You can\'t remove this');
            }
        });

        var i = $('.search').length;


        // add location
        $(document).on('click','.add_location', function(){
            var fields = '<div class="create-location-form-input mt-2">'+
                            '<div class="create-event-form-input location-event">'+
                                '<input onfocus="geolocate(this,'+i+')" id="autocomplete_'+i+'" class="btn btn-light btn-shadow search" name="location[]" type="text" placeholder="Search for a venue or address" required>'+
                            '</div>'+
                            '<input type="hidden" id="city_'+i+'"  value="" name="city[]">'+
                            '<input type="hidden" id="state_'+i+'" value="" name="state[]">'+
                            '<input type="hidden" id="post_'+i+'" value="" name="post_code[]">'+
                                '<div class="col-md-1">'+
                                    '<div class="input-50 mr-1 ml-1 plusevent-btn">'+
                                        '<a href="javascript:void(0)" class="remove_location">-</a>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
            $('#location_multi').append(fields);
            i++;
            $(".event-dropcreate").select2();
        });

        //remove location
        $(document).on('click','.remove_location', function(){
            var this_act = $(this);
            if($('#location_multi div.create-location-form-input').length > 1){
                $(this_act).parents('div.create-location-form-input').remove();
            }else{
                alert('You can\'t remove this');
            }
        });
    });

    //event add dropdown
    $(".event-dropcreate").select2();
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYFwTawmCo9OcmiAgYpF5GJ8NsepmWtN4&libraries=places" async defer></script>
    <script>
        var placeSearch, autocomplete;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
        };

        function initAutocomplete(id,j) {
            autocomplete = new google.maps.places.Autocomplete(
                (document.getElementById(id)), {
                    types: ['geocode']
                });
            autocomplete.setComponentRestrictions({
                country: ["au"],
            });
            autocomplete.addListener('place_changed',  function(){
                fillInAddress(j);
            });
        }

        function fillInAddress(j) {
            var place = autocomplete.getPlace();
            // for (var component in componentForm) {
            //     document.getElementById(component).value = '';
            //     document.getElementById(component).disabled = false;
            // }
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
               
                if (addressType == 'locality') {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById('city_'+j).value = val;
                }
                if (addressType == 'administrative_area_level_1') {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById('state_'+j).value = val;
                }
                if (addressType == 'postal_code') {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById('post_'+j).value = val;
                }
            }
        }

        function geolocate(e,j) {
            console.log(j);
            initAutocomplete(e.attributes.id.value,j);
          
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }
    </script>
@endpush