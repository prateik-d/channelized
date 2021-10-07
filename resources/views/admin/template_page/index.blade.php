@extends('layouts.dashboard')

@push('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<style>.slow .toggle-group { transition: left 0.9s; -webkit-transition: left 0.9s; }</style>
@endpush

@section('content')
<div class="admin-container">

    <div class="col-md-12">
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>
                    <th scope="col">title</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($templatePage as $data)
                    <tr> 
                        <td>{{ $data->title }}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-info">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    //https://gitbrent.github.io/bootstrap4-toggle/
    $(function () {
        var table = $('table#datatable').DataTable({
            "columnDefs": [ 
                {
                    "targets": [ 4 ],
                    "visible": false
                },
                {
                    "targets": [ 5, 6 ],
                    "orderable": false,
                    "searchable": false
                }
            ]
        });

        // $('select#user_role').on( 'change', function () {
        //     if(this.value=="all"){
        //         table.column(4).search('').draw();
        //     }else{
        //         table.column(4).search(this.value).draw();
        //     }
        // });

        // $(document).on('change', '.btn_switch', function(){
        //     var ele = $(this).attr('id');
        //     var eleval = $(this).prop('checked');
        //     var elehref = $('#'+ele).data('href');
        //     $('#'+ele).bootstrapToggle('disable');
        //     var token = $("meta[name='csrf-token']").attr("content");
        //     $.ajax({
        //         url: elehref,
        //         type: 'POST',
        //         data: {
        //             "_token": token,
        //             'role': (eleval==true ? 'vendor' : 'partner')
        //         },
        //         success: function (res){
        //             $('#'+ele).bootstrapToggle('enable');
        //             if(res.status=="success"){
        //                 swal({
        //                     title: "",
        //                     text: res.message,
        //                     timer: 2000,
        //                     icon: "success",
        //                     button: false
        //                 });
        //             }else{
        //                 swal({
        //                     title: "",
        //                     text: res.message,
        //                     timer: 2000,
        //                     icon:"info",
        //                     button:false
        //                 });
        //                 if(eleval==true){
        //                     $('#'+ele).bootstrapToggle('off', true);
        //                 }else{
        //                     $('#'+ele).bootstrapToggle('on', true);
        //                 }
        //             }
        //         }
        //     });

        //     //$('#toggle-demo').bootstrapToggle('disable')
        //     //$('#toggle-demo').bootstrapToggle('toggle')
        //     //$('#toggle-demo').bootstrapToggle('enable')
        // });
    });
</script>
@endpush
