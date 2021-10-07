@extends('layouts.dashboard')

@section('content')
    <div class="my-celender event-search-result">
        <div class="event-search-result-header">
            <h1>
                Hello {{ Auth::user()->firstname }}, don’t miss your next Event!
            </h1>
            <div class="event-search-result-action">
                <a href="{{ route(Auth::user()->roles[0]->name.'.events') }}" class="btn btn-light btn-shadow">
                    Search events
                </a>
                <a href="{{ route(Auth::user()->roles[0]->name.'.events.calender') }}" class="btn btn-primary btn-shadow">
                    My Calendar
                </a>
            </div>
        </div>
        <div class="event-search-result-container">    
            <div class="full-celender">
                <div id="calendar" class="calendar"></div>
                <div class="inputInnerShadow"></div>
            </div>
            <div class="upcomingEvent">
                @if(Session::has('info'))
                <div class="alert alert-block alert-info">
                    <i class=" fa fa-check cool-green "></i>
                    {{ nl2br(Session::get('info')) }}
                </div>
                @endif
                @if(Session::has('msg'))
                <div class="alert alert-block alert-success">
                    <i class=" fa fa-check cool-green "></i>
                    {{ nl2br(Session::get('msg')) }}
                </div>
                @endif
                <div class="upcomingEvent-title">
                  Your upcoming events:
                </div>
                @php
                    $cal_data = [];
                @endphp
                @foreach($events as $event)
                    @php
                        $data = new stdClass();
                        $data->id = $event->id;
                        $data->title = $event->name;
                        $data->start = $event->start_date.'T'.$event->start_duration;
                        $data->end = $event->end_date.'T'.$event->end_duration;
                        array_push($cal_data,$data);
                    @endphp
                    <div class="card">
                        <div class="card-title">
                            <h5>
                                <div class="card-text">
                                    {{$event->name}}
                                </div>
                                <button class="star-icon btn btn-light btn-shadow event-shortlist" data-href="{{route(Auth::user()->roles[0]->name.'.events.shortlist', ['event'=>Crypt::encrypt($event->id),'shortlist'=>0])}}" data-eid="{{$event->id}}">
                                    <img src="{{ asset('public/assets/images/card-white-star-icon.svg') }}">
                                </button>
                            </h5>
                        </div>  
                        <div class="card-ft">
                            <ul>
                                <li class="card-celender-icon">{{Carbon\Carbon::parse($event->start_date)->isoFormat('dddd').' | '.Carbon\Carbon::parse($event->start_date)->format('d M Y')}}</li>
                                <li class="card-location-icon">[Event venue]</li>
                                <li class="card-location-icon">{{$event->timezone}}</li>
                                <li class="card-time-icon">{{Carbon\Carbon::parse($event->start_duration)->format('h:i:s A')}}-{{Carbon\Carbon::parse($event->end_duration)->format('h:i:s A')}}</li>
                                @if($event->registration_link)
                                    <li class="card-doc-icon"><a href="javascript:void(0)" data-rhref="{{$event->registration_link}}" class="card-link event-view" data-href="{{route(Auth::user()->roles[0]->name.'.event.view', Crypt::encrypt($event->id))}}">View agenda</a></li>
                                @else
                                    <li class="card-doc-icon"><a href="javascript:void(0)" data-rhref="" class="card-link event-view" data-href="{{route(Auth::user()->roles[0]->name.'.event.view', Crypt::encrypt($event->id))}}">View agenda</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="card-ft-sub">
                            Link to my calendar: <a href="{{route('outlook_calendar_sync',Crypt::encrypt($event->id))}}"> Outlook</a>  |  <a href="{{ route('gcalendar_sync',Crypt::encrypt($event->id))}}">Google</a>  
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('js')

<script>
    var daad = '{{json_encode($cal_data)}}';
    var da = JSON.parse(daad.replace(/&quot;/g,'"'));
    /* console.log(typeof(da));
    console.log(da); */
    //return false;
    var partner_calendar =null;
    document.addEventListener("DOMContentLoaded", function() {
        var calendarEl = document.getElementById("calendar");
        partner_calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ["interaction", "dayGrid"],
            //defaultDate: "today",
            //left: "title",
            //editable: true,
            eventLimit: true, // allow "more" link when too many events
            header: {
                center: "title",
                right:  'next',
                left: "prev"
            },
            events: da,
        });
        partner_calendar.render();
    });

    $(function () {
        $(document).on('click','.event-shortlist', function(){
            /* debugger; */
            var ele = $(this);
            var datalink = ele.data('href');
            var eid = ele.data('eid');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: datalink,
                type: 'POST',
                data: {
                    "_token": token,
                },
                success: function (res){
                    /* var res = JSON.parse(res); */
                    /* console.log(res); */
                    if(res=="success"){
                        var cal_evnt = partner_calendar.getEventById(eid);
                        cal_evnt.remove();
                        ele.parents('div.card').remove();
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