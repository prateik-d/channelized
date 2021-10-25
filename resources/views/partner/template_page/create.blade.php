@extends('layouts.dashboard')

<!-- <script src="{{ asset('public/assets/ckeditor/ckeditor.js')}}"></script> -->
<script src="https://cdn.ckeditor.com/4.16.2/standard-all/ckeditor.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>
<!-- <meta name="_token" content="{{csrf_token()}}" /> -->


    
@section('content')

<div class="event-list-main even-hom-full">
         @if (session('status'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('status') }}
    </div>
    @elseif(session('failed'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('failed') }}
    </div>
    @endif

    <div class="col-md-12">
        <h2>Edit Template</h2>


        <form action="{{ action('PageTemplateController@partner_added') }}" method="POST" class="" enctype="multipart/form-data">
            <input name="_token" id="_token" type="hidden" value="{{ csrf_token() }}"/>
            <input name="id" id="id" type="hidden" value="{{ $templateData->id }}"/>
            <!-- <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required="true" value="{{ $templateData->name }}">
            </div> -->
            <!-- <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" placeholder="Enter code here..." required="true">{{ $templateData->content }}</textarea>
            </div> -->
            <!-- <div class="form-group">
                <label for="page_name">Page Name</label>
                <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Enter Page Name"  value="{{ $templateData->page_name }}">
            </div> -->
            <!-- <div class="form-group">
                <label for="page_title">Page Title</label>
                <input type="text" class="form-control" id="page_title" name="page_title" placeholder="Enter Page Title"  value="{{ $templateData->page_title }}">
            </div> -->
            <!-- <div class="form-group">
                <label for="page_sub_title">Page Sub Title</label>
                <input type="text" class="form-control" id="page_sub_title" name="page_sub_title" placeholder="Enter Page Sub Title"  value="{{ $templateData->page_sub_title }}">
            </div> -->
            <div class="form-group">
                <label for="page_logo">Page Logo</label>
                <input 
                        type="file" 
                        class="form-control" 
                        id="page_logo" 
                        name="page_logo" 
                        placeholder="Enter Page Logo" 
                    >
            </div>
            <div class="form-group">
                <label for="page_desc">Page Description</label>
                <textarea type="text" class="form-control ckeditor " id="page_desc" name="page_desc" placeholder="Enter Page Description" >{{ $templateData->content }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>



    </div>
</div>


@endsection

@push('js')    
   

    <script type="text/javascript">



            CKEDITOR.replace( 'page_desc' , {
                fullPage: true,
                // extraPlugins: 'docprops',
                // Disable content filtering because if you use full page mode, you probably
                // want to  freely enter any HTML content in source mode without any limitations.
                allowedContent: true,
                height: 320,
                removeButtons: 'PasteFromWord'
                } 
            );
        // $(window).on('load', function (){
            // $( '#page_desc' ).ckeditor();

        // });

        jQuery(document).ready(function(){
            jQuery('#page_logo').change(function(e)
            {
                var formdata = new FormData();
                
                var id = $("#id").val();
                formdata.append("id", id); 
                
                var _token = $("#_token").val();
                formdata.append("_token", _token);

                var page_desc = CKEDITOR.instances['page_desc'].getData();
                formdata.append("page_desc", page_desc);

                // console.log(page_desc);

              
                if($(this).prop('files').length > 0)
                {
                    file =$(this).prop('files')[0];
                    formdata.append("page_logo", file);

                }


                jQuery.ajax({
                    url: "{{ url('/partner/template/logo_upload') }}",
                    type: 'post',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(result){
                        // console.log(result);
                        // $('#page_desc').val('');
                        // $('#page_desc').val(result);
                        CKEDITOR.instances.page_desc.setData(result);

                    }
                });
            });
        });
    </script> 
@endpush