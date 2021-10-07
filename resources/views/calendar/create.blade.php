@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-4">
        <form action="{{route('gcalendar.store')}}" method="POST" role="form">
            {{csrf_field()}}
            <input type="hidden" name="tz" id="tz">
            <legend>
                Create Event
            </legend>
            <div class="form-group">
                <label for="title">
                    Title
                </label>
                <input class="form-control" name="title" placeholder="Title" type="text">
            </div>
            <div class="form-group">
                <label for="description">
                    Description
                </label>
                <input class="form-control" name="description" placeholder="Description" type="text">
            </div>
            <div class="form-group">
                <label for="start_date">
                    Start Date <small>formate : 2020-03-06T19:30:00</small>
                </label>
                <input class="form-control" name="start_date" placeholder="Start Date" type="datetime-local">
                <!--            <div class="input-group date form_datetime col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                                <input class="form-control" size="16" type="text" value="" readonly>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input1" value="" /><br/>-->
            </div>
            <div class="form-group">
                <label for="end_date">
                    End Date <small>formate : 2020-03-06T19:30:00</small>
                </label>
                <input class="form-control" name="end_date" placeholder="End Date" type="datetime-local">
            </div>
            <button class="btn btn-primary" type="submit">
                Submit
            </button>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    $(function () {
        // guess user timezone 
        $('#tz').val(moment.tz.guess());
        // date time
//            $('.form_datetime').datetimepicker({
//                weekStart: 1,
//                todayBtn:  1,
//                autoclose: 1,
//                todayHighlight: 1,
//                startView: 2,
//                forceParse: 0,
//                showMeridian: 1
//            });
    })
</script>
@endpush