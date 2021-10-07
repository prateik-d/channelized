@extends('layouts.dashboard')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/daterangepicker.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@section('content')
<div class="event-search-result">
    <div class="event-search-result-header">
        <h1>Hello {{ Auth::user()->firstname }}, you have {{$filter_events_count}} matched</h1>
        <div class="event-search-result-action">
            <a href="{{ route(Auth::user()->roles[0]->name.'.technical-education') }}" class="btn btn-primary btn-shadow">Search Technical Education</a>
            <a href="{{ route(Auth::user()->roles[0]->name.'.technical-education.calender') }}" class="btn btn-light btn-shadow">My Calendar</a>
        </div>
    </div>
    @php
        $search_parameter = [];
        if(isset($partner_filter->city_id) && $partner_filter->city_id != 0){
            $search_parameter['city'] = $cities->where('id',$partner_filter->city_id)->first()->name;
        }
        if(isset($partner_filter->state_id) && $partner_filter->state_id != 0){
            $search_parameter['state'] =$states->where('id',$partner_filter->state_id)->first()->name;
        }
        if(isset($partner_filter->to_month) && $partner_filter->to_month != 0){
            $search_parameter['month'] = \Carbon\Carbon::parse($partner_filter->to_month)->format('d/M/Y').' - '.\Carbon\Carbon::parse($partner_filter->from_month)->format('d/M/Y'); 
        }
        if(isset($partner_filter->solution_id) && $partner_filter->solution_id != 0){
            $search_parameter['solution_id'] =$solutions->where('id',$partner_filter->solution_id)->first()->name;
        }
        if(isset($partner_filter->industry_id) && $partner_filter->industry_id != 0){
            $search_parameter['industry_id'] =$industries->where('id',$partner_filter->industry_id)->first()->name;
        }
        if(isset($partner_filter->vendor_id) && $partner_filter->vendor_id != 0){
            $search_parameter['vendor_id'] =$vendors->where('id',$partner_filter->vendor_id)->first()->name;
        }
        if(isset($partner_filter->type_of_technical_education_id) && $partner_filter->type_of_offer_id != 0){
            $search_parameter['type_of_technical_education_id'] = $type_of_technical_educations->where('id',$partner_filter->type_of_technical_education_id)->first()->name;
        }
    @endphp
    <div class="event-search-result-sub">
        <h2>Search : {{implode(' | ', $search_parameter)}}</h2>
    </div>
    <div class="event-search-result-container">
        <div class="FilterPopupBtn btn btn-primary btn-shadow">Filter</div>
        <div class="event-search-filter signUpform">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    please select at least one filter
                </div>
            @endif
            <form method="POST" action="{{ route(Auth::user()->roles[0]->name.'.technical_education.store') }}">
                @csrf
                <div class="filterSroll eventdropdown">
                    <div class="form-group filter-row">
                        <select id="stateFilter" class="filterevent btn-shadow" name="state" >
                            <option value="0" selected>State</option>
                            @foreach($states as $single)
                                <option value="{{$single->id}}" {{ (isset($partner_filter->state_id) && $partner_filter->state_id==$single->id?'selected':'') }}>{{$single->name}}</option>
                            @endforeach
                        </select>
                        <div class="inputInnerShadow"></div> 
                    </div>
                    <div class="form-group filter-row">
                        <select id="cityFilter" class="filterevent btn-shadow" name="city" >
                            <option value="0" selected>City</option>
                            @foreach($cities as $single)
                                <option value="{{$single->id}}" {{ (isset($partner_filter->city_id) && $partner_filter->city_id==$single->id?'selected':'') }}>{{$single->name}}</option>
                            @endforeach
                        </select>
                        <div class="inputInnerShadow"></div>
                    </div>
                    <div class="form-group filter-row">
                        <div class="month-event">
                            <input type="text" name="month" class="daterange form-control" value="{{ (isset($partner_filter->to_month) ? Carbon\Carbon::parse($partner_filter->to_month)->format('m/d/Y').' - '.Carbon\Carbon::parse($partner_filter->from_month)->format('m/d/Y') : '' ) }}" readonly placeholder="Month"/>
                            <span class="inp-arrow"></span>
                        </div>
                    </div>
                    <div class="form-group filter-row">
                        <select id="solutionFilter" class="filterevent btn-shadow" name="solution" >
                            <option value="0" selected>Solution</option>
                            @foreach($solutions as $single)
                                <option value="{{$single->id}}" {{ (isset($partner_filter->solution_id) &&  $partner_filter->solution_id==$single->id?'selected':'') }}>{{$single->name}}</option>
                            @endforeach
                        </select>
                        <div class="inputInnerShadow"></div>
                    </div>
                    <div class="form-group filter-row">
                        <select id="industryFilter" class="filterevent btn-shadow" name="industry" >
                            <option value="0" selected>Industry</option>
                            @foreach($industries as $single)
                                <option value="{{$single->id}}" {{ (isset($partner_filter->industry_id) && $partner_filter->industry_id==$single->id?'selected':'') }}>{{$single->name}}</option>
                            @endforeach
                        </select>
                        <div class="inputInnerShadow"></div>
                    </div>
                    <div class="form-group filter-row">
                        <select id="vendorFilter" class="filterevent btn-shadow" name="vendor" >
                            <option value="0" selected>Vendor</option>
                            @foreach($vendors as $single)
                                <option value="{{$single->id}}" {{ (isset($partner_filter->vendor_id) && $partner_filter->vendor_id==$single->id?'selected':'') }}>{{$single->name}}</option>
                            @endforeach
                        </select>
                        <div class="inputInnerShadow"></div>
                    </div>
                    <div class="form-group filter-row">
                        <select id="typeOfTechnicalEducationFilter" class="filterevent btn-shadow" name="type_of_technical_education" >
                            <option value="0" selected>Technical Eduction Type</option>
                            @foreach($type_of_technical_educations as $single)
                                <option value="{{$single->id}}" {{ (isset($partner_filter->type_of_technical_education_id) && $partner_filter->type_of_technical_education_id==$single->id?'selected':'') }}>{{$single->name}}</option>
                            @endforeach
                        </select>
                        <div class="inputInnerShadow"></div>
                    </div> 
                </div>
                <div class="filterAction">
                    <button type="submit"><img src="{{ asset('public/assets/images/saveFilter-icon.svg') }}" alt=""> Save filter</button>
                    @if(isset($partner_filter) && $partner_filter->count() > 0)
                        <button id="reset" type="button" data-href="{{route(Auth::user()->roles[0]->name.'.events.destroy',Crypt::encrypt($partner_filter->id))}}">Clear filter</button>
                    @else
                        <button id="reset_btn" type="reset">Clear filter</button>
                    @endif
                </div>
            </form>
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

        $(document).on('click', '#reset', function(){
            var deltlink = $(this).data('href');
//            alert(deltlink); return false;
            var token = $("meta[name='csrf-token']").attr("content");
            var res = confirm('Are you sure to clear filter');
            if(res){
                $.ajax({
                    url: deltlink,
                    type: 'DELETE',
                    data: {
                        "_token": token,
                    },
                    success: function (res){
                        if(res=="success"){
                            window.location.reload();
                        }
                    }
                });
            }
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

        $(document).on('click', '#reset_btn', function(){
            $('.filterevent').val(0).trigger('change');
            var filter_arry = {};
            var filterlink = "{{route(Auth::user()->roles[0]->name.'.technical_education.filter')}}";
            var token = $("meta[name='csrf-token']").attr("content");
            startdt=null;
            enddt=null;

            $.ajax({
                url: filterlink,
                type: 'POST',
                data: {
                    "_token": token,
                    "filter": filter_arry
                },
                success: function (res){
                    var res = JSON.parse(res);
                    if(res.display.length > 2){
                        $('#scrollbar-custombox').html(res.display);
                    }else{
                        $('#scrollbar-custombox').html('');
                    }
                    $('.event-search-result-sub').html('<h2>Search : '+res.filter+'</h2>');
                }
            });
        });

        function filter_event(){
            var filter_arry = {};
            if($('#cityFilter').val()!=null){
                filter_arry['city'] = $('#cityFilter').val(); 
            }
            if($('#stateFilter').val()!=null){
                filter_arry['state'] = $('#stateFilter').val(); 
            }
            if($('#solutionFilter').val()!=null){
                filter_arry['solution'] = $('#solutionFilter').val(); 
            }
            if($('#industryFilter').val()!=null){
                 filter_arry['industry'] = $('#industryFilter').val(); 
             }
            if($('#vendorFilter').val()!=null){
                filter_arry['vendor'] = $('#vendorFilter').val(); 
            }
            if($('#typeOfTechnicalEducationFilter').val()!=null){
                filter_arry['type_of_technical_education'] = $('#typeOfTechnicalEducationFilter').val(); 
            }
            if(startdt!=null){
                filter_arry['startdt'] = startdt; 
            }
            if(enddt!=null){
                filter_arry['enddt'] = enddt; 
            }
            
            /* return false; */
            /* var field_nm = $(this).attr('name');
            var field_val = $(this).val(); */
            var filterlink =  "{{route(Auth::user()->roles[0]->name.'.technical_education.filter')}}";
            var token = $("meta[name='csrf-token']").attr("content");
            /* debugger; */
            var sum = 0;
            for (var single in filter_arry){
                if(filter_arry.hasOwnProperty(single)){
                    sum += parseInt(filter_arry[single]);
                }
            }
            /* if(sum <= 0){
                return false;
            } */

            $.ajax({
                url: filterlink,
                type: 'POST',
                /* contentType: "application/json", */
                data: {
                    "_token": token,
                    "filter": filter_arry
                },
                success: function (res){
                    /* console.log(res);
                    return false; */
                    var res = JSON.parse(res);
                    /* console.log(res);
                    return false; */
                    if(res.display.length > 2){
                        $('#scrollbar-custombox').html(res.display);
                    }else{
                        $('#scrollbar-custombox').html('');
                    }
                    $('.event-search-result-sub').html('<h2>Search : '+res.filter+'</h2>');
                }
            });
        }
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