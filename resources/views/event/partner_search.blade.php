@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">Hello {{ Auth::user()->firstname }},</div>
                        <div class="col-sm-4">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @if($events->count()==0)
                                <div class="row">
                                    No Events Found.
                                </div>
                            @else
                                @php
                                    $i=0;
                                @endphp
                                @foreach($events as $event)
                                    @if($i==0)
                                        <div class="row">
                                    @endif
                                    @php
                                        $event_shortlisted = ($event->eventShortlisted ? $event->eventShortlisted->short_list : 0);
                                    @endphp
                                        <div class="col-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <h5 class="card-title">{{$event->name}}</h5>
                                                        </div>
                                                        <div class="col-2">
                                                            <a class="btn btn-sm {{($event_shortlisted==1 ? 'btn-danger' : 'btn-primary' )}} event-shortlist" data-href="{{route(Auth::user()->roles[0]->name.'.events.shortlist', ['event'=>Crypt::encrypt($event->id),'shortlist'=>($event_shortlisted==1?0:1)])}}" >S</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">{{$event->summary}} <a href="#" class="alert-link event-readmore" data-href="{{route(Auth::user()->roles[0]->name.'.events.readmore', Crypt::encrypt($event->id))}}">read more</a></p>
                                                    <p>{{Carbon\Carbon::parse($event->start_date)->isoFormat('dddd').' | '.Carbon\Carbon::parse($event->start_date)->format('d M Y')}}</p>
                                                    <p>{{Carbon\Carbon::parse($event->start_duration)->format('h:i:s A')}}-{{Carbon\Carbon::parse($event->end_duration)->format('h:i:s A')}}</p>
                                                    <a href="#" class="alert-link">view agenda</a>
                                                </div>
                                            </div>
                                        </div>
                                    @php $i++; @endphp
                                    @if($i==3)
                                        @php $i=0; @endphp
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(function () {
        $(document).on('click','.event-shortlist', function(){
            var deltlink = $(this).data('href');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: deltlink,
                type: 'POST',
                data: {
                    "_token": token,
                },
                success: function (res){
                    if(res=="success"){
                        window.location.reload();
                    }
                }
            });
        });
        
        $(document).on('click','.event-readmore', function(){
            var deltlink = $(this).data('href');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: deltlink,
                type: 'POST',
                data: {
                    "_token": token,
                },
                success: function (res){
                    if(res=="success"){
//                        window.location.reload();
                        alert('done read more');
                    }
                }
            });
        });
    });
</script>
@endpush