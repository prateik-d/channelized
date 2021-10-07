@extends('layouts.dashboard')

@push('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

@endpush

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="shadow rounded p-3 wh-c">
                <div class="event-img">
                    <img src="{{ asset('public/assets/images/details-event.jpg') }}" class="img-fluid">
                </div>
                <div class="event-details">
                    <h2>WHAT'S ABOUT EVENT / whats going on there come and learn</h2>
                    <p>Lorazepam, sold under the brand name Ativan among others, is a benzodiazepine medication. It is
                        used to treat anxiety disorders, trouble sleeping, active seizures including status epilepticus,
                        alcohol withdrawal, and chemotherapy-induced
                        nausea and vomiting.</p>

                    <p>Lorazepam, sold under the brand name Ativan among others, is a benzodiazepine medication. It is
                        used to treat anxiety disorders, trouble sleeping, active seizures including status epilepticus,
                        alcohol withdrawal, and chemotherapy-induced
                        nausea and vomiting.</p>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="solu-tag">
                            <h4>Solution</h4>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="solu-det">
                            <p>Event solution</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="solu-tag">
                            <h4>Industry</h4>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="solu-det">
                            <p>Event Industry</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="solu-tag">
                            <h4>Event Type</h4>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="solu-det">
                            <p>Event Type</p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="solu-tag mb-3">
                            <h4>Agenda</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="solu-det">
                            <p>20/02/2020</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="solu-det">
                            <p>01/03/2020</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="solu-det">
                            <p>Jony desk</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="solu-det">
                            <p>20/02/2020</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="solu-det">
                            <p>01/03/2020</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="solu-det">
                            <p>Jony desk</p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                    <div class="solu-tag">
                            <h4>Registration Link</h4>
                        </div>
                        <div class="solu-det">
                           <a href="#">google.com/</a>
                        </div>
                    </div>
                 
                </div>
            </div>

        </div>
        <div class="col-md-4">

            <div class="shadow rounded wh-c p-3 loc-event">
                <div class="event-detailsi mb-3">
                    <img src="{{ asset('public/assets/images/getStartedImg.svg') }}" class="img-fluid">
                </div>
                <hr>
                <h4>Event location</h4>
                <p>NewYork Tower, Melbourne</p>
                <hr>
                <h4>Start Date</h4>
                <p>22 December, 2020</p>
                <hr>
                <h4>End Date</h4>
                <p>22 Jan, 2021</p>
        
            </div>

        </div>
    </div>
</div>
@endsection
@push('js')

@endpush