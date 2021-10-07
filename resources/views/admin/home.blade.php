@extends('layouts.dashboard')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@section('content')
<div class="admin-container">
    <div class="col-md-12">
    <!-- <div class="card">
        <div class="card-header">Events</div>
        <div class="card-body"> -->
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    asd
                </div>
            @endif
            <table class="table table-striped" id="datatable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Category</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr> 
                            <th scope="row">{{$event->id}}</th>
                            <td>{{ substr($event->name, 0, 15).(strlen($event->name) > 15 ? '...' : null) }}</td>
                            <td>{{$event->start_date}}</td>
                            <td>{{$event->end_date}}</td>
                            <td>{{ $event->category }}</td>
                            <td>
                                <select class="form-control form-control-sm" id="event_status" data-href="{{route(Auth::user()->roles[0]->name.'.event.status',Crypt::encrypt($event->id))}}">
                                    <option disabled {{($event->status=="approved"?'selected':'')}}>Approved</option>
                                    <option value="in_review" {{($event->status=="in_review"?'selected':'')}}>In Review</option>
                                    <option value="draft" {{($event->status=="draft"?'selected':'')}}>Draft</option>
                                    <option value="rejected" {{($event->status=="rejected"?'selected':'')}}>Rejected</option>
                                </select>
                            </td>
                            <td>
                                <a href="{{route(Auth::user()->roles[0]->name.'.events.edit',Crypt::encrypt($event->id))}}" class="btn btn-sm btn-info">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <!-- </div>
    </div> -->
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(function () {
        $('table#datatable').DataTable();

        $(document).on('change','#event_status',function(){
            var evestatlink = $(this).data('href');
            var evestat = $(this).val();
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: evestatlink,
                type: 'POST',
                data: {
                    "_token": token,
                    'evestat': evestat
                },
                success: function (res){
                    /* console.log(res); */
                    if(res=="success"){
                        swal({
                            title: "",
                            text: "Event status is successfully changed.",
                            timer: 2000,
                            icon: "success",
                            button: false
                        });
                    }else{
                        swal({
                            title: "",
                            text: "something issue occurs. Please try after sometime.",
                            timer: 2000,
                            icon:"info",
                            button:false
                        });
                    }
                }
            });
        });
    });
</script>
@endpush
