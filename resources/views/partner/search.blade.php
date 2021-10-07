@extends('layouts.dashboard')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/daterangepicker.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@section('content')
<div class="event-search-result">
    <div class="event-search-result-header">
        <h1>Hello {{ Auth::user()->firstname }}, you have {{$filter_events_count}} matched</h1>
    </div>
 
    <div class="event-search-result-list">
        <div class="float-righ mb-3 mt-3 float-right">
  <button class="btn btn-primary btn-grid grid-btn active" check="1"><i class="fa fa-th-large" aria-hidden="true"></i></button>
  <button class="btn btn-primary btn-list grid-btn" check="0"><i class="fa fa-list" aria-hidden="true"></i></button>
  
</div>
            <div class="card-list scrollbar event-crd" id="scrollbar-custombox">
                @foreach($events as $event)
                    @php
                        $event_shortlisted = ($event->eventShortlisted ? $event->eventShortlisted->short_list : 0);
                    @endphp
                    <div class="card">
                        
                        <div class="card-title">
                            <h5>
                                <div class="card-text">
                                    {{$event->name}}
                                </div>
                                <button class="star-icon event-shortlist btn btn-shadow {{($event_shortlisted==1 ? 'btn-shortcolor' : '' )}}"  data-href="{{route(Auth::user()->roles[0]->name.'.events.shortlist', ['event'=>Crypt::encrypt($event->id),'shortlist'=>':id'])}}" data-shortlist="{{$event_shortlisted}}">
                                    @if($event_shortlisted==1)
                                        <img src="{{ asset('public/assets/images/card-white-star-icon.svg') }}" />
                                    @else
                                        <img src="{{ asset('public/assets/images/card-star-icon.svg') }}" />
                                    @endif
                                </button>
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($event->banner)
                            <div class="card-bgimg" style="background:url('{{ asset('public/uploads/events/no_image.jpg') }}')">
                            
                            </div>
                            @else
                                <!-- <img src="{{ asset('public/uploads/events/no_image.jpg') }}" height="200" width="200"> -->
                                <div class="card-bgimg" style="background:url('{{ asset('public/uploads/events/no_image.jpg') }}')">
                            
                            </div>
                           
                            @endif
                          
                        </div>
                        <div class="card-ft">
                              <div class="card-event-dets">
                            <p class="card-text">
                                {{substr($event->summary,0,90)}}
                                @if($event->registration_link)
                                    <a href="javascript:void(0)" data-rhref="{{$event->registration_link}}" class="alert-link event-readmore" data-href="{{route(Auth::user()->roles[0]->name.'.events.readmore', Crypt::encrypt($event->id))}}">Read more</a>
                                @else                                    
                                    <a href="javascript:void(0)" data-rhref="" class="alert-link event-readmore" data-href="{{route(Auth::user()->roles[0]->name.'.events.readmore', Crypt::encrypt($event->id))}}">Read more</a>
                                @endif
                            </p>
                            </div>
                            <ul>
                                <li class="card-celender-icon">{{Carbon\Carbon::parse($event->start_date)->format('d M Y')}}  {{Carbon\Carbon::parse($event->start_duration)->format('h:i A')}}</li>
                                <li>{{Carbon\Carbon::parse($event->end_date)->format('d M Y')}}  {{Carbon\Carbon::parse($event->end_duration)->format('h:i A')}}</li>
                                <li class="card-location-icon">{{$event->eventlocations[0]->location.(!isset($event->eventlocations[0]->eventLocationCity->name) ?: ', '.$event->eventlocations[0]->eventLocationCity->name )}}</li>
                                <!-- <li class="card-time-icon">{{Carbon\Carbon::parse($event->start_duration)->format('h:i:s A')}}-{{Carbon\Carbon::parse($event->end_duration)->format('h:i:s A')}}</li> -->
                                @if($event->registration_link)
                                    <li class="card-doc-icon"><a href="javascript:void(0)" data-rhref="{{$event->registration_link}}" class="card-link event-view" data-href="{{route(Auth::user()->roles[0]->name.'.event.view', Crypt::encrypt($event->id))}}">View agenda</a></li>
                                @else
                                    <li class="card-doc-icon"><a href="javascript:void(0)" data-rhref="" class="card-link event-view" data-href="{{route(Auth::user()->roles[0]->name.'.event.view', Crypt::encrypt($event->id))}}">View agenda</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script> -->
<script src="{{ asset('public/js/daterangepicker.js') }}"></script>
<script src="{{ asset('public/assets/js/select2.full.js') }}"></script>
<script>
    $(function () {
        var startdt = null;
        var enddt = null;

        $('.daterange').daterangepicker({
            opens: 'left',
            showDropdowns: true,
            autoUpdateInput: false,
        });

        $('.daterange').on('apply.daterangepicker', function(ev, picker) {
            console.log("A new date selection was made: " + picker.startDate.format('DD-MM-YYYY') + ' to ' + picker.endDate.format('DD-MM-YYYY'));
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            startdt = picker.startDate.format('YYYY-MM-DD');
            enddt = picker.endDate.format('YYYY-MM-DD');
            filter_event();
        });

        $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            console.log("clear");
            startdt = null;
            enddt = null;
            filter_event();
        });

        
        $(document).on('click','.event-shortlist', function(){
            var ele = $(this);
            var datalink = ele.data('href');
            var token = $("meta[name='csrf-token']").attr("content");

            var shortlist = (ele.data('shortlist')==1) ? 0:1;
            /* alert(shortlist);
            alert(datalink.replace(":id", shortlist));
            return false; */
            datalink = datalink.replace(":id", shortlist);

            $.ajax({
                url: datalink,
                type: 'POST',
                data: {
                    "_token": token,
                },
                success: function (res){
                    /* var res = JSON.parse(res); */
                    if(res=="success"){
                        ele.data('shortlist',shortlist);
                        if(shortlist==1){
                            ele.addClass('btn-shortcolor');
                            var img = "{{ asset('public/assets/images/card-white-star-icon.svg') }}";
                            ele.html('<img src="'+img+'" />');
                        }else{
                            ele.removeClass('btn-shortcolor');
                            var img = "{{ asset('public/assets/images/card-star-icon.svg') }}";
                            ele.html('<img src="'+img+'" />');
                        }
                    }
                }
            });
        });
        
        $(document).on('click','.event-readmore', function(){
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

        $(".FilterPopupBtn").click(function() {
            $(".event-search-filter").toggleClass("active");
            $(this).toggleClass("active");
        });

        $(".filterevent").select2();

        $(document).on('change', '.filterevent', function(){
            filter_event();
        });


    });
</script>
<script>
$(document).ready(function(){
  $('.grid-btn').click(function(){
    var check = $(this).attr('check');
    $('.grid-btn').removeClass("active");
    $(this).addClass("active");
    if(check == 0){
        $('.card-list').addClass('full-cards');
    }else{
        $('.card-list').removeClass('full-cards'); 
    }

});
});
</script>
@endpush