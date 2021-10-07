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