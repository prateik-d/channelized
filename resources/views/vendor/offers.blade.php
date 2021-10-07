@extends('layouts.dashboard')
@section('content')
<div class="admin-container  table-full">
    <div class="event-search-result">
        <div class="event-search-result-header tableevent-name">
            <h1>
                Hello {{ Auth::user()->firstname }},here is your Product Promotions & Offers activities summary:
            </h1>
            <div class="create-event-action">
                <a href="{{route(Auth::user()->roles[0]->name.'.offers.index')}}" class="btn btn-primary btn-shadow">
                    Current  Product Promotions & Offers
                </a>
                <a href="{{route(Auth::user()->roles[0]->name.'.offers.create')}}" class="btn btn-primary btn-shadow">
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
        <div class="accordions-panel">
            <button class="accordions">
                <img src="{{ asset('public/assets/images/user-icons.png') }}">
                <span>Your Product Promotions & Offers status</span>
            </button>
            <div class="panel">
                <div class="user-eventtable">
                    <table id="paneltable" class="table current-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Company Logo</th>
                                <th>Product Image</th>
                                <th>Short Description </th>
                                <th>Description</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($events as $event)
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <th><img src="{{asset('public/uploads/events')}}/{{($event->logo) ? $event->logo : 'no_image.jpg'}}" height="50" width="50"/></th>
                                    <td><img src="{{asset('public/uploads/events')}}/{{($event->banner) ? $event->banner : 'no_image.jpg' }}" height="50" width="50"/></td>
                                    <td>{{$event->short_summary}}</td>
                                    <td>{{$event->summary}}</td>
                                    <td>{{$event->start_date}}</td>
                                    <td>{{$event->end_date}}</td>
                                    <td>{!! $event->Statusview !!}</td>
                                    <td>
                                        <a href="{{route(Auth::user()->roles[0]->name.'.offers.edit',Crypt::encrypt($event->id))}}" class="table-ico"><img src="{{ asset('public/assets/images/edite.jpg') }}" /></a>
                                        <a href='javascript:void(0)' data-href="{{route(Auth::user()->roles[0]->name.'.events.destroy',Crypt::encrypt($event->id))}}" class="table-ico delete_event"><img src="{{ asset('public/assets/images/close.jpg') }}" /></a>
                                        <a href="{{route(Auth::user()->roles[0]->name.'.offers.edit',Crypt::encrypt($event->id))}}" class="table-ico"> <img src="{{ asset('public/assets/images/eyes-icon.png') }}" /></a>
                                    </td>
                                </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="white-table">
            <div class="top-tablebar">
                <img src="{{ asset('public/assets/images/calander.png') }}" />
                <span>Current Product Promotions & Offers</span>
            </div>
            <div class="curr-rvnt-table current-arrow">
                <table id="currenevent-table" class="table current-table" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Event ID</th>
                            <th>Product Name</th>
                            <th class="cur">Start date</th>
                            <th>End date</th>
                            <th>product performance</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($ecounts as $count)
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <th>{{$count->eid}}</th>
                                <td>{{$count->name}}</td>
                                <td>{{$count->start_date}}</td>
                                <td>{{$count->end_date}}</td>
                                    @if($count->impression == '')
                                        <td>0 impressions 
                                    @else
                                        <td>{{$count->impression}} impressions 
                                    @endif;
                                    <a href="#event_perfomance" class="view-btn" onclick="view_event_perfomance('{{$count->eid}}');">View</a></td>
                                <td>
                                    <a href="{{route(Auth::user()->roles[0]->name.'.offers.edit',Crypt::encrypt($count->eid))}}" class="table-ico"><img src="{{ asset('public/assets/images/edite.jpg') }}" /></a>
                                    <a href='javascript:void(0)' data-href="{{route(Auth::user()->roles[0]->name.'.events.destroy',Crypt::encrypt($count->eid))}}" class="table-ico delete_event"><img src="{{ asset('public/assets/images/close.jpg') }}" /></a>
                                </td>
                            </tr>
                        @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="white-table" id="event_perfomance" style="display: none;">
            <div class="top-tablebar">
                <div class="s">
                    <div class="table-dropdownt">
                        <div class="drop-image">
                            <img src="{{ asset('public/assets/images/drop-graph.png') }}" />
                        </div>
                        <div class="drop-select">
                            <select id="imgeventname">
                                @foreach($ecounts as $event)
                                <option value="{{$event->eid}}"> [{{$event->name}}] performance: </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="curr-rvnt-table">
                <table id="view-role-table" class="table current-table mytable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Type of partners
                                <p></p>
                            </th>
                            <th>Impressions
                                <p class="table-seond-txt">Number of times people saw your ad</p>
                            </th>
                            <th>Engagements
                                <p class="table-seond-txt">Number of times people view your ad</p>
                            </th>
                            <th>Action
                                <p class="table-seond-txt">Number of times people click on your ad</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="performance_state">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="white-table" id="event_profile" style="display:none;">
            
        </div>
    </div>
</div>    
@endsection

@push('js')    
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('#imgeventname').select2({
        minimumResultsForSearch: -1,
        dropdownCssClass: "filterDropdown imgeventname"
    });

    $(document).ready(function(){
        $('#paneltable').DataTable();
        $('#currenevent-table').DataTable();
        $('#view-role-table').DataTable();
    
        $("#imgeventname").change(function() {
            var selectId =  $(this).val();
            var geturl =  '<?php echo route(Auth::user()->roles[0]->name.'.event.getdata'); ?>';
            var token = $("meta[name='csrf-token']").attr("content");
            // alert(geturl);
            $.ajax({
                url: geturl,
                type: 'POST',
                data: {
                    "id":selectId,
                    "_token": token,
                },
                success: function (res){
                    $('#view-role-table tbody').empty();
                    $('#event_profile').hide();
                    $.each(res['data'],function(index,value){
                        if(value['business_type_id'] == 0 || value['business_type_id'] == '0'){
                            var name = value['business_type_other'];
                        }else{
                            var name = value['name'];
                        }
                        $("#view-role-table tbody").append('<tr><td>'+name+'</td><td><div class="w3-light-grey"><div class="w3-container w3-green w3-center" style="width:50%">'+value['impression']+'</div></div></td><td><div class="w3-light-grey"><div class="w3-container w3-green w3-center" style="width:55%">'+value['engagment']+'</div></div></td><td><div class="w3-light-grey"><div class="w3-container w3-green w3-center" style="width:55%">'+value['action']+'</div></div></td></tr>');
                    });
                    load_profile_view(selectId);
                }
            });  
        });

        function load_profile_view(eid){
            var eveid = eid;
            var profile_summary_link = "{{route(Auth::user()->roles[0]->name.'.event.profile',':id')}}";
            profile_summary_link = profile_summary_link.replace(':id', eveid);
            $('#event_profile').show();
            $('#event_profile').empty();
            $.ajax({
                url: profile_summary_link,
                type: 'GET',
                success: function (res){
                    $('#event_profile').html(res);
                }
            });
        }
    }); 

    //view-btn     
    function view_event_perfomance(id){
        $("#event_perfomance").show();
        $('#event_profile').hide();
        $('#imgeventname').val(id).trigger('change');
    }

    var acc = document.getElementsByClassName("accordions");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
    $(function () {
        $(document).on('click', '.delete_event', function(){
            var deltlink = $(this).data('href');
           // alert(deltlink); return false;
            var token = $("meta[name='csrf-token']").attr("content");
            var res = confirm('Are you sure to delete this');
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
                return false;
            }
            alert('no');
        });
    });
</script>
@endpush