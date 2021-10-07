@extends('layouts.dashboard')

@section('content')
    @if($category == 'event')
    <div class="admin-container  table-full">
        <div class="event-search-result">
            <div class="event-search-result-header tableevent-name">
                <h1>
                    Your event is almost ready
                </h1>
                <div class="create-event-action">
                    <a href="{{route(Auth::user()->roles[0]->name.'.events.index')}}" class="btn btn-primary btn-shadow">
                        Current event
                    </a>
                    <a href="{{route(Auth::user()->roles[0]->name.'.events.create')}}" class="btn btn-primary btn-shadow">
                        + Create event
                    </a>
                    {{-- <a href="javascript:void(0)" class="btn btn-light  btn-shadow dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        + Create event
                    </a>
                    <div class="dropdown-menu creat-box" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route(Auth::user()->roles[0]->name.'.events.create','single')}}">Single event </a>
                        <a class="dropdown-item" href="{{route(Auth::user()->roles[0]->name.'.events.create','multiple')}}">One event - multiple cities</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="event-search-result-list vieweventperformance-sum">
        <div class="card-list scrollbar" id="scrollbar-custombox">
            <!-- <div class="panel"> -->
                <div>
                    You have successfully submitted your event form, we will get back to you within 24 hours.<br />
                    Please check the status of your event on your dashboard.
                </div>
                <a href="{{route(Auth::user()->roles[0]->name.'.events.index')}}" class="btn btn-primary btn-shadow event-sabbtn mt-5">
                    Check my event status
                </a>
            <!-- </div> -->
        </div>
  </div>
  
 @endif
 @if($category == 'reward_incentive')
    <div class="admin-container  table-full">
        <div class="event-search-result">
            <div class="event-search-result-header tableevent-name">
                <h1>
                    Your  Rewards & Incentives is almost ready
                </h1>
                <div class="create-event-action">
                    <a href="{{route(Auth::user()->roles[0]->name.'.rewards-incentives.index')}}" class="btn btn-primary btn-shadow">
                        Current  Rewards & Incentive
                    </a>
                    <a href="{{route(Auth::user()->roles[0]->name.'.rewards-incentives.create')}}" class="btn btn-primary btn-shadow">
                        + Create Rewards & Incentives 
                    </a>
                    {{-- <a href="javascript:void(0)" class="btn btn-light  btn-shadow dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        + Create  Rewards & Incentive
                    </a>
                    <div class="dropdown-menu creat-box" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route(Auth::user()->roles[0]->name.'.rewards-incentives.create','single')}}">Single  Rewards & Incentive </a>
                        <a class="dropdown-item" href="{{route(Auth::user()->roles[0]->name.'.rewards-incentives.create','multiple')}}">One  Rewards & Incentive - multiple cities</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="event-search-result-list vieweventperformance-sum">
        <div class="card-list scrollbar" id="scrollbar-custombox">
            <!-- <div class="panel"> -->
                <div>
                    You have successfully submitted your event form, we will get back to you within 24 hours.<br />
                    Please check the status of your event on your dashboard.
                </div>
                <a href="{{route(Auth::user()->roles[0]->name.'.rewards-incentives.index')}}" class="btn btn-primary btn-shadow event-sabbtn mt-5">
                    Check my event status
                </a>
            <!-- </div> -->
        </div>
  </div>
 @endif

 @if($category == 'product_promotion_offer')
    <div class="admin-container  table-full">
        <div class="event-search-result">
            <div class="event-search-result-header tableevent-name">
                <h1>
                    Your  Product Promotions & Offers is almost ready
                </h1>
                <div class="create-event-action">
                    <a href="{{route(Auth::user()->roles[0]->name.'.offers.index')}}" class="btn btn-primary btn-shadow">
                        Current  Product Promotions & Offers
                    </a>
                    <a href="{{route(Auth::user()->roles[0]->name.'.offers.create')}}" class="btn btn-light btn-shadow">
                        + Create  Product Promotions & Offers
                    </a>
                    {{-- <a href="javascript:void(0)" class="btn btn-light  btn-shadow dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        + Create  Product Promotions & Offers
                    </a>
                    <div class="dropdown-menu creat-box" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route(Auth::user()->roles[0]->name.'.offers.create','single')}}">Single  Product Promotions & Offers </a>
                        <a class="dropdown-item" href="{{route(Auth::user()->roles[0]->name.'.offers.create','multiple')}}">One  Product Promotions & Offers - multiple cities</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="event-search-result-list vieweventperformance-sum">
        <div class="card-list scrollbar" id="scrollbar-custombox">
            <!-- <div class="panel"> -->
                <div>
                    You have successfully submitted your event form, we will get back to you within 24 hours.<br />
                    Please check the status of your event on your dashboard.
                </div>
                <a href="{{route(Auth::user()->roles[0]->name.'.offers.index')}}" class="btn btn-primary btn-shadow event-sabbtn mt-5">
                    Check my Product Promotions & Offers status
                </a>
            <!-- </div> -->
        </div>
  </div>
 @endif

  @if($category == 'technical_education')
    <div class="admin-container  table-full">
        <div class="event-search-result">
            <div class="event-search-result-header tableevent-name">
                <h1>
                    Your   Technical Education is almost ready
                </h1>
                <div class="create-event-action">
                    <a href="{{route(Auth::user()->roles[0]->name.'.technical-education.index')}}" class="btn btn-primary btn-shadow">
                        Current Technical Education
                    </a>
                    <a href="{{route(Auth::user()->roles[0]->name.'.technical-education.create')}}" class="btn btn-primary btn-shadow">
                        + Create Technical Education
                    </a>
                    {{-- <a href="javascript:void(0)" class="btn btn-light  btn-shadow dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        + Create Technical Education
                    </a>
                    <div class="dropdown-menu creat-box" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route(Auth::user()->roles[0]->name.'.technical-education.create','single')}}">Single  Technical Education </a>
                        <a class="dropdown-item" href="{{route(Auth::user()->roles[0]->name.'.technical-education.create','multiple')}}">One  Technical Education - multiple cities</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="event-search-result-list vieweventperformance-sum">
        <div class="card-list scrollbar" id="scrollbar-custombox">
            <!-- <div class="panel"> -->
                <div>
                    You have successfully submitted your event form, we will get back to you within 24 hours.<br />
                    Please check the status of your event on your dashboard.
                </div>
                <a href="{{route(Auth::user()->roles[0]->name.'.technical-education.index')}}" class="btn btn-primary btn-shadow event-sabbtn mt-5">
                    Check my Technical Education status
                </a>
            <!-- </div> -->
        </div>
  </div>
 @endif
  
@endsection