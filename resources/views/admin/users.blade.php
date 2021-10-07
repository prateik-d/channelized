@extends('layouts.dashboard')

@push('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<style>.slow .toggle-group { transition: left 0.9s; -webkit-transition: left 0.9s; }</style>
@endpush

@section('content')
<div class="admin-container">
<div class="col-md-12 mb-2">
        <div class="col-md-4">
            <select class="form-control" id="user_role">
                <option disabled>Select</option>
                <option value="all">All</option>
                <option value="vendor">Vendor</option>
                <option value="partner">Partner</option>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Comapny Name</th>
                    <th scope="col">hidden_role</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr> 
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->companyname }}</td>
                        <td>{{ $user->roles[0]->name }}</td>
                        <td>
                            <input type="checkbox" class="btn_switch" id="switch_{{$user->id}}" {{ ($user->roles[0]->name!="vendor" ?: 'checked') }} data-href="{{route(Auth::user()->roles[0]->name.'.users.role',Crypt::encrypt($user->id))}}" data-toggle="toggle" data-on="Vendor" data-off="Partner" data-onstyle="success" data-offstyle="warning" data-size="sm" data-style="slow">
                        </td>
                        <td>
                            <a href="{{route(Auth::user()->roles[0]->name.'.users.edit',Crypt::encrypt($user->id))}}" class="btn btn-sm btn-info">Edit</a>
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

        $('select#user_role').on( 'change', function () {
            if(this.value=="all"){
                table.column(4).search('').draw();
            }else{
                table.column(4).search(this.value).draw();
            }
        });

        $(document).on('change', '.btn_switch', function(){
            var ele = $(this).attr('id');
            var eleval = $(this).prop('checked');
            var elehref = $('#'+ele).data('href');
            $('#'+ele).bootstrapToggle('disable');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: elehref,
                type: 'POST',
                data: {
                    "_token": token,
                    'role': (eleval==true ? 'vendor' : 'partner')
                },
                success: function (res){
                    $('#'+ele).bootstrapToggle('enable');
                    if(res.status=="success"){
                        swal({
                            title: "",
                            text: res.message,
                            timer: 2000,
                            icon: "success",
                            button: false
                        });
                    }else{
                        swal({
                            title: "",
                            text: res.message,
                            timer: 2000,
                            icon:"info",
                            button:false
                        });
                        if(eleval==true){
                            $('#'+ele).bootstrapToggle('off', true);
                        }else{
                            $('#'+ele).bootstrapToggle('on', true);
                        }
                    }
                }
            });

            //$('#toggle-demo').bootstrapToggle('disable')
            //$('#toggle-demo').bootstrapToggle('toggle')
            //$('#toggle-demo').bootstrapToggle('enable')
        });
    });
</script>
@endpush
