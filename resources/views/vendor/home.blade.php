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
                    {{($events->count() > 0 ? $events->count() : 0) }} 
                </div>
                <div class="event-list-text">
                    Active events created by you
                </div>
                <div class="event-list-view">
                    <a href="{{ route(Auth::user()->roles[0]->name.'.events.index') }}" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn" type="submit">View</a>
                </div>
                <hr />
            </li>
            <li class="event-list-row blue-list">
                <div class="event-list-icon event-list-icon-status">
                    <img src="{{ asset('public/assets/images/Incentives-icon.svg') }}" alt="" />
                </div>
                <div class="event-list-count">
                    {{($rewards_incentives > 0 ? $rewards_incentives : 0) }}
                </div>
                <div class="event-list-text">
                    Active Rewards & Incentives created by you
                </div>
                <div class="event-list-view">
                    <a href="{{ route(Auth::user()->roles[0]->name.'.rewards-incentives.index') }}" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn">View</a>
                </div>
                <hr />
            </li>
            <li class="event-list-row blue-list">
                <div class="event-list-icon event-list-icon-status">
                    <img src="{{ asset('public/assets/images/LearnAndGrow-icon.svg') }}" alt="" />
                </div>
                <div class="event-list-count">
                    {{($offers > 0 ? $offers : 0) }}
                </div>
                <div class="event-list-text">
                    Active Product Promotions & Offers created by you
                </div>
                <div class="event-list-view">
                    <a href="{{ route(Auth::user()->roles[0]->name.'.offers.index') }}" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn" type="submit">View</a>
                </div>
                <hr />
            </li>
            <li class="event-list-row blue-list">
                <div class="event-list-icon event-list-icon-status">
                    <img src="{{ asset('public/assets/images/Announcements-icon.svg') }}" alt="" />
                </div>
                <div class="event-list-count">
                    {{($technical_education > 0 ? $technical_education : 0) }}
                </div>
                <div class="event-list-text">
                    Active Technical Education created by you
                </div>
                <div class="event-list-view">
                    <a href="{{ route(Auth::user()->roles[0]->name.'.technical-education.index') }}" class="btn btn-light my-2 my-sm-0 btn-shadow float-right nextbtn" type="submit">View</a>
                </div>
                <hr />
            </li>
           <!--  <li class="event-list-row blue-list">
                <div class="event-list-icon event-list-icon-status">
                    <img src="{{ asset('public/assets/images/Collaborate-icon.svg') }}" alt="" />
                </div>
                <div class="event-list-count">
                    2
                </div>
                <div class="event-list-text">
                    Active collaborations created by you
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