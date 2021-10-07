@extends('layouts.dashboard')

@section('content')
    <div class="event-list-main even-hom-full">
        @hasanyroles(['vendor','partner'])
            @if(Auth::user()->step < 3 && Auth::user()->status!='Advanced')
                <div class="alert alert-info" role="alert">
                    <a href="{{ route(Auth::user()->roles[0]->name.'.user.profile') }}">Complete Your Profile to maximise your opportunity</a>
                </div>
            @endif
        @endhasanyroles
        <h1>Hello {{ Auth::user()->firstname }}, here is what happening in your world!</h1>
        <ul>
            <li class="event-list-row blue-list">
                <div class="event-list-icon event-list-icon-status">
                    <img src="{{ asset('public/assets/images/Events-icon.svg') }}" alt="" />
                </div>
                <div class="event-list-count">
                    {{$filter_events_count}}
                </div>
                <div class="event-list-text">
                    Matched events of total {{$events}}
                </div>
                <div class="event-list-view">
                    <a href="{{ route(Auth::user()->roles[0]->name.'.events') }}" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn" type="submit">View</a>
                </div>
                <hr />
            </li>
            <li class="event-list-row blue-list">
                <div class="event-list-icon event-list-icon-status">
                    <img src="{{ asset('public/assets/images/Incentives-icon.svg') }}" alt="" />
                </div>
                <div class="event-list-count">
                    {{$filter_rewards_incentives_count}}
                </div>
                <div class="event-list-text">
                    Matched Rewards & Incentives of total {{$rewards_incentives}}
                </div>
                <div class="event-list-view">
                    <a href="{{ route(Auth::user()->roles[0]->name.'.rewards-incentives') }}" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn" type="submit">View</a>
                </div>
                <hr />
            </li>
            <li class="event-list-row blue-list">
                <div class="event-list-icon event-list-icon-status">
                    <img src="{{ asset('public/assets/images/Promotions-icon.svg') }}" alt="" />
                </div>
                <div class="event-list-count">
                    {{$filter_offers_count}}
                </div>
                <div class="event-list-text">
                    Matched Product Promotions & Offers of total {{$offers}}
                </div>
                <div class="event-list-view">
                  <a href="{{ route(Auth::user()->roles[0]->name.'.product-promotions-offers') }}" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn" type="submit">View</a>
                </div>
                <hr />
            </li>
            <li class="event-list-row blue-list">
                <div class="event-list-icon event-list-icon-status">
                    <img src="{{ asset('public/assets/images/LearnAndGrow-icon.svg') }}" alt="" />
                </div>
                <div class="event-list-count">
                  {{$filter_technical_education_count}}  
                </div>
                <div class="event-list-text">
                    Matched Technical Education of total {{$technical_education}}
                </div>
                <div class="event-list-view">
                    <a href="{{ route(Auth::user()->roles[0]->name.'.technical-education') }}" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn" type="submit">View</a>
                </div>
                <hr />
            </li>
            <!-- <li class="event-list-row gray-list">
                <div class="event-list-icon event-list-icon-status">
                    <img src="{{ asset('public/assets/images/Announcements-icon.svg') }}" alt="" />
                </div>
                <div class="event-list-count">
                    X
                </div>
                <div class="event-list-text">
                    No selection made yet for announcements
                </div>
                <div class="event-list-view">
                    <a href="#" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn" type="submit">View</a>
                </div>
                <hr />
            </li> -->
            <!-- <li class="event-list-row blue-list">
                <div class="event-list-icon event-list-icon-status">
                    <img src="{{ asset('public/assets/images/Collaborate-icon.svg') }}" alt="" />
                </div>
                <div class="event-list-count">
                    2
                </div>
                <div class="event-list-text">
                    Matched collaborations of total 20
                </div>
                <div class="event-list-view">
                    <a href="#" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn" type="submit">View</a>
                </div>
                <hr />
            </li> -->
        </ul>
    </div>
@endsection
@push('js')
<script>

</script>
@endpush