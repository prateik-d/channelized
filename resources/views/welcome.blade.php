@extends('layouts.basic')

@section('content')
<section class="banner-main wh-bg">
    <div class="container">
        <div class="home-containt bar-top">
            <div class="row">
                <div class="col-md-5">
                    @if(session('status'))
                        <div class="alert alert-info">
                            <h4>{{session('status')}}</h4>
                        </div>
                    @endif
                    <div class="heroText">
                        <h1>Delivering meaningful insights to Technology Partners around the world</h1>
                    </div>
                    <div class="heroBtn">
                        <form method="POST" id="form-signup" action="{{ route('register_work') }}">
                            @csrf
                            <div class="form-group">
                                <div>
                                    <input type="email" placeholder="Enter Your Work email" style="width: 90%;" class="btn-shadow @error('work_email') is-invalid @enderror" id="work_email" name="work_email" required/>
                                    <div class="inputInnerShadow"></div>
                                    @error('work_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button type="submit" class="btn btn-danger" style="width: 90%; padding: 10px;">Express Signup</button>
                        </form>
                            <!-- <a href="{{ route('register') }}" class="btn btn-danger">
                                Express Signup
                            </a> -->
                    </div>
                </div>
                <div class="col-md-7">
                    <img src="{{ asset('public/assets/images/home-banner.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    </section>

<section class="wh-bg padtb-130">
    <div class="container">
        <div class="row">
            <div class="col-md-4 align-self-center">
                <div class="experience">
                    <h4>Exchanging timely, meaningful insights between Technology Partners & their Aligned Vendors to
                        generate <strong>New market opportunities.</strong></h4>
                </div>
            </div>
            <div class="col-md-8">
                <div class="vendors-det">
                    <ul>
                        <li>
                            <div class="vendors-icons"><img src="{{ asset('public/assets/images/star.png') }}" class="img-fluid"></div>
                            <div class="vendors-details">
                                <h5>Client Events</h5>
                                <p>Never miss an opportunity to interact with your clients & aligned vendors</p>
                            </div>
                        </li>
                        <li>
                            <div class="vendors-icons">
                                <img src="{{ asset('public/assets/images/dollor.png') }}" class="img-fluid">
                            </div>
                            <div class="vendors-details">
                                <h5>Rewards & Incentives</h5>
                                <p>Keep on top of your incentives and offers extended by your aligned vendors</p>
                            </div>
                        </li>
                        <li>
                            <div class="vendors-icons">
                                <img src="{{ asset('public/assets/images/handse.png') }}" class="img-fluid">
                            </div>
                            <div class="vendors-details">
                                <h5>Product Promotions & Offers</h5>
                                <p></p>
                            </div>
                        </li>
                        <li>
                            <div class="vendors-icons">
                                <img src="{{ asset('public/assets/images/grow.png') }}" class="img-fluid">
                            </div>
                            <div class="vendors-details">
                                <h5>Technical Education</h5>
                                <p>Keep yourself with the latest training, education and certification offers</p>
                            </div>
                        </li>
                        <li>
                            <div class="vendors-icons">
                                <img src="{{ asset('public/assets/images/collaborate-icon.png') }}" class="img-fluid">
                            </div>
                            <div class="vendors-details">
                                <h5>Collaborate</h5>
                                <p>Find relevant Tech Partner to collaborate on deals based on capability</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="card-pd0 wh-darks padtb-130">
    <div class="container">
        <div class="row">
            <div class="col-md-4 align-self-center">
                <div class="even-mains">
                    <div class="even-icon">
                        <img src="{{ asset('public/assets/images/event-star.png') }}" class="img-fluid">
                    </div>
                    <div class="even-titld">
                        <h2>Client Events</h2>
                        <p>No other experience to forge a new relationship than a face-to-face meetin</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    @foreach($events as $event)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-title">
                                    <h5>
                                        <div class="card-text">
                                            {{$event->name}}
                                        </div>
                                        <button class="star-icon btn btn-shadow">
                                            <img src="{{ asset('public/assets/images/card-star-icon.svg') }}" />
                                        </button>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    @if($event->banner)
                                        <img src="{{ asset('public/uploads/events') }}/{{$event->banner}}" height="200" width="200">
                                    @else
                                        <img src="{{ asset('public/uploads/events/no_image.jpg') }}" height="200" width="200">
                                    @endif
                                    <p class="card-text">
                                        {{substr($event->summary,0,90)}}
                                        @if($event->registration_link)
                                            <a href="javascript:void(0)" data-rhref="{{$event->registration_link}}" class="alert-link event-readmore" data-href="{{route('events.readmore', Crypt::encrypt($event->id))}}">Read more</a> 
                                        @else                                    
                                            <a href="javascript:void(0)" data-rhref="" class="alert-link event-readmore" data-href="{{route('events.readmore', Crypt::encrypt($event->id))}}">Read more</a>
                                        @endif
                                    </p>
                                </div>
                                <div class="card-ft">
                                    <ul>
                                        <li class="card-celender-icon">{{Carbon\Carbon::parse($event->start_date)->isoFormat('dddd').' | '.Carbon\Carbon::parse($event->start_date)->format('d M Y')}}</li>
                                        <li class="card-location-icon">{{$event->eventlocations[0]->location.(!isset($event->eventlocations[0]->eventLocationCity->name) ?: ', '.$event->eventlocations[0]->eventLocationCity->name )}}</li>
                                        <li class="card-time-icon">{{Carbon\Carbon::parse($event->start_duration)->format('h:i:s A')}}-{{Carbon\Carbon::parse($event->end_duration)->format('h:i:s A')}}</li>
                                        @if($event->registration_link)
                                            <li class="card-doc-icon"><a href="javascript:void(0)" data-rhref="{{$event->registration_link}}" class="card-link event-view" data-href="{{route('event.view', Crypt::encrypt($event->id))}}">View agenda</a></li>
                                        @else
                                            <li class="card-doc-icon"><a href="javascript:void(0)" data-rhref="" class="card-link event-view" data-href="{{route('event.view', Crypt::encrypt($event->id))}}">View agenda</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="card-pd0 wh-bg padtb-130">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    @foreach($reward_incentives as $event)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-title">
                                    <h5>
                                        <div class="card-text">
                                            {{$event->name}}
                                        </div>
                                        <button class="star-icon btn btn-shadow">
                                            <img src="{{ asset('public/assets/images/card-star-icon.svg') }}" />
                                        </button>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    @if($event->banner)
                                        <img src="{{ asset('public/uploads/events') }}/{{$event->banner}}" height="200" width="200">
                                    @else
                                        <img src="{{ asset('public/uploads/events/no_image.jpg') }}" height="200" width="200">
                                    @endif
                                    <p class="card-text">
                                        {{substr($event->summary,0,90)}}
                                        @if($event->registration_link)
                                            <a href="javascript:void(0)" data-rhref="{{$event->registration_link}}" class="alert-link event-readmore" data-href="{{route('events.readmore', Crypt::encrypt($event->id))}}">Read more</a> 
                                        @else                                    
                                            <a href="javascript:void(0)" data-rhref="" class="alert-link event-readmore" data-href="{{route('events.readmore', Crypt::encrypt($event->id))}}">Read more</a>
                                        @endif
                                    </p>
                                </div>
                                <div class="card-ft">
                                    <ul>
                                        <li class="card-celender-icon">{{Carbon\Carbon::parse($event->start_date)->isoFormat('dddd').' | '.Carbon\Carbon::parse($event->start_date)->format('d M Y')}}</li>
                                        <li class="card-location-icon">{{$event->eventlocations[0]->location.(!isset($event->eventlocations[0]->eventLocationCity->name) ?: ', '.$event->eventlocations[0]->eventLocationCity->name )}}</li>
                                        <li class="card-time-icon">{{Carbon\Carbon::parse($event->start_duration)->format('h:i:s A')}}-{{Carbon\Carbon::parse($event->end_duration)->format('h:i:s A')}}</li>
                                        @if($event->registration_link)
                                            <li class="card-doc-icon"><a href="javascript:void(0)" data-rhref="{{$event->registration_link}}" class="card-link event-view" data-href="{{route('event.view', Crypt::encrypt($event->id))}}">View agenda</a></li>
                                        @else
                                            <li class="card-doc-icon"><a href="javascript:void(0)" data-rhref="" class="card-link event-view" data-href="{{route('event.view', Crypt::encrypt($event->id))}}">View agenda</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 align-self-center">
                <div class="even-mains">
                    <div class="even-icon">
                    <img src="{{ asset('public/assets/images/event-dollor.png') }}" class="img-fluid">
                    </div>
                    <div class="even-titld">
                        <h2>Rewards & Incentives</h2>
                        <p>Call it what you want, incentives are what get people to work harder</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="card-pd0 card-pd0 wh-darks  padtb-130">
<div class="container">
        <div class="row">
            <div class="col-md-4 align-self-center">
                <div class="even-mains">
                    <div class="even-icon">
                        <img src="{{ asset('public/assets/images/handse.png') }}" class="img-fluid">
                    </div>
                    <div class="even-titld">
                        <h2>Product Promotions & Offers</h2>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    @foreach($product_promotion_offer as $event)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-title">
                                    <h5>
                                        <div class="card-text">
                                            {{$event->name}}
                                        </div>
                                        <button class="star-icon btn btn-shadow">
                                            <img src="{{ asset('public/assets/images/card-star-icon.svg') }}" />
                                        </button>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    @if($event->banner)
                                        <img src="{{ asset('public/uploads/events') }}/{{$event->banner}}" height="200" width="200">
                                    @else
                                        <img src="{{ asset('public/uploads/events/no_image.jpg') }}" height="200" width="200">
                                    @endif
                                    <p class="card-text">
                                        {{substr($event->summary,0,90)}}
                                        @if($event->registration_link)
                                            <a href="javascript:void(0)" data-rhref="{{$event->registration_link}}" class="alert-link event-readmore" data-href="{{route('events.readmore', Crypt::encrypt($event->id))}}">Read more</a> 
                                        @else                                    
                                            <a href="javascript:void(0)" data-rhref="" class="alert-link event-readmore" data-href="{{route('events.readmore', Crypt::encrypt($event->id))}}">Read more</a>
                                        @endif
                                    </p>
                                </div>
                                <div class="card-ft">
                                    <ul>
                                        <li class="card-celender-icon">{{Carbon\Carbon::parse($event->start_date)->isoFormat('dddd').' | '.Carbon\Carbon::parse($event->start_date)->format('d M Y')}}</li>
                                        <li class="card-location-icon">{{$event->eventlocations[0]->location.(!isset($event->eventlocations[0]->eventLocationCity->name) ?: ', '.$event->eventlocations[0]->eventLocationCity->name )}}</li>
                                        <li class="card-time-icon">{{Carbon\Carbon::parse($event->start_duration)->format('h:i:s A')}}-{{Carbon\Carbon::parse($event->end_duration)->format('h:i:s A')}}</li>
                                        @if($event->registration_link)
                                            <li class="card-doc-icon"><a href="javascript:void(0)" data-rhref="{{$event->registration_link}}" class="card-link event-view" data-href="{{route('event.view', Crypt::encrypt($event->id))}}">View agenda</a></li>
                                        @else
                                            <li class="card-doc-icon"><a href="javascript:void(0)" data-rhref="" class="card-link event-view" data-href="{{route('event.view', Crypt::encrypt($event->id))}}">View agenda</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="card-pd0 wh-bg padtb-130">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    @foreach($technical_educations as $event)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-title">
                                    <h5>
                                        <div class="card-text">
                                            {{$event->name}}
                                        </div>
                                        <button class="star-icon btn btn-shadow">
                                            <img src="{{ asset('public/assets/images/card-star-icon.svg') }}" />
                                        </button>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    @if($event->banner)
                                        <img src="{{ asset('public/uploads/events') }}/{{$event->banner}}" height="200" width="200">
                                    @else
                                        <img src="{{ asset('public/uploads/events/no_image.jpg') }}" height="200" width="200">
                                    @endif
                                    <p class="card-text">
                                        {{substr($event->summary,0,90)}}
                                        @if($event->registration_link)
                                            <a href="javascript:void(0)" data-rhref="{{$event->registration_link}}" class="alert-link event-readmore" data-href="{{route('events.readmore', Crypt::encrypt($event->id))}}">Read more</a> 
                                        @else                                    
                                            <a href="javascript:void(0)" data-rhref="" class="alert-link event-readmore" data-href="{{route('events.readmore', Crypt::encrypt($event->id))}}">Read more</a>
                                        @endif
                                    </p>
                                </div>
                                <div class="card-ft">
                                    <ul>
                                        <li class="card-celender-icon">{{Carbon\Carbon::parse($event->start_date)->isoFormat('dddd').' | '.Carbon\Carbon::parse($event->start_date)->format('d M Y')}}</li>
                                        <li class="card-location-icon">{{$event->eventlocations[0]->location.(!isset($event->eventlocations[0]->eventLocationCity->name) ?: ', '.$event->eventlocations[0]->eventLocationCity->name )}}</li>
                                        <li class="card-time-icon">{{Carbon\Carbon::parse($event->start_duration)->format('h:i:s A')}}-{{Carbon\Carbon::parse($event->end_duration)->format('h:i:s A')}}</li>
                                        @if($event->registration_link)
                                            <li class="card-doc-icon"><a href="javascript:void(0)" data-rhref="{{$event->registration_link}}" class="card-link event-view" data-href="{{route('event.view', Crypt::encrypt($event->id))}}">View agenda</a></li>
                                        @else
                                            <li class="card-doc-icon"><a href="javascript:void(0)" data-rhref="" class="card-link event-view" data-href="{{route('event.view', Crypt::encrypt($event->id))}}">View agenda</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 align-self-center">
                <div class="even-mains">
                    <div class="even-icon">
                        <img src="{{ asset('public/assets/images/event-grow.png') }}" class="img-fluid">
                    </div>
                    <div class="even-titld">
                        <h2>Technical Education</h2>
                        <p>Learn as if you were to live for ever.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
    <script>
        $(function() {
            $(document).on('click','.event-readmore', function(){
                var deltlink = $(this).data('href');
                var redirectlink = $(this).data('rhref');
                var token = $("meta[name='csrf-token']").attr("content");
                //alert(123);
                $.ajax({
                    url: deltlink,
                    type: 'POST',
                    data: {
                        "_token": token,
                    },
                    success: function (res){
                        if(res=="success"){
                            /* alert(redirectlink); */
                            if(redirectlink.length > 0){
                                window.open(redirectlink, '_blank');
                            }else{
                                alert('done read more');
                            }
                        }
                    }
                });
            });

            $(document).on('click','.event-view', function(){
                var deltlink = $(this).data('href');
                var redirectlink = $(this).data('rhref');
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url: deltlink,
                    type: 'POST',
                    data: {
                        "_token": token,
                    },
                    success: function (res){
                        if(res=="success"){
                            /* alert(redirectlink); */
                            if(redirectlink.length > 0){
                                window.open(redirectlink, '_blank');
                            }else{
                                alert('done read more');
                            }
                        }
                    }
                });
            });
        });
    </script>
@endpush