@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-10">Current events</div>
                        <div class="col-sm-2"><a href="{{route(Auth::user()->roles[0]->name.'.events.create')}}" class="btn btn-default float-right">+ Add</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Summary</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <th scope="row">{{$event->id}}</th>
                                    <td>{{$event->name}}</td>
                                    <td>{{$event->start_date}}</td>
                                    <td>{{$event->end_date}}</td>
                                    <td>{{$event->summary}}</td>
                                    <td>{!! $event->Statusview !!}</td>
                                    <td>
                                        <a href="{{route(Auth::user()->roles[0]->name.'.events.edit',Crypt::encrypt($event->id))}}" class="btn btn-sm btn-primary">edit</a>
                                        <a href='javascript:void(0)' data-href="{{route(Auth::user()->roles[0]->name.'.events.destroy',Crypt::encrypt($event->id))}}" class="btn btn-sm btn-danger btn-delete">delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(function () {
        $(document).on('click', '.btn-delete', function(){
            var deltlink = $(this).data('href');
//            alert(deltlink); return false;
            var token = $("meta[name='csrf-token']").attr("content");
            var res = confirm('Are you sure to delete this');
            if(res){
                $.ajax(
                {
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