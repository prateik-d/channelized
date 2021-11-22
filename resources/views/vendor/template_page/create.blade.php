@extends('layouts.dashboard')

<!-- <script src="{{ asset('public/assets/ckeditor/ckeditor.js')}}"></script> -->
<script src="https://cdn.ckeditor.com/4.16.2/standard-all/ckeditor.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>
<style type="text/css">
    .a_pdf  {
                /*display: block;*/
                margin-right: 20px;
            }
</style>
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
        <h2>Create Template</h2>


        <form action="{{ action('PageTemplateController@vendor_added') }}" method="POST" class="" enctype="multipart/form-data">
            <input name="_token" id="_token" type="hidden" value="{{ csrf_token() }}"/>
            <input name="id" id="id" type="hidden" value="{{ $templateData->id }}"/>
            
            <div class="form-group">
                
                <div class="col-sm-12 logo_container"  style="padding: 0px;">
                    <div class="col-sm-6" style="padding: 0px;">
                        <label for="page_logo">Page Logo</label>
                        <input 
                                type="file" 
                                class="" 
                                id="page_logo" 
                                name="page_logo" 
                                placeholder="Enter Page Logo" 
                            >
                    </div>
                    <div class="col-sm-4" style="float:left;">
                        <img id="logo_img_updated" src="" style="display:none; width: 100px;">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12 pdf_container"  style="padding: 0px;margin-top: 20px;">
                    <div class="col-sm-6" style="padding: 0px;">
                        <label for="pdf_logo">Upload PDF</label>
                        <input 
                                type="file" 
                                class="" 
                                id="page_pdf" 
                                name="page_pdf" 
                                placeholder="Upload PDF" 
                            >
                    </div>
                    <div class="col-sm-12" style="padding: 0px;float:left;">
                        <div class="alert alert-danger" role="alert" id="pdf_error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span id="pdf_span_error"></span>
                        </div>

                        <?php 

                            // echo "<pre>";
                        ?>
                            <!-- <ul id="pdf_up"> -->
                        <?php
                            foreach ($pdfFileNames as $pdfFileName) 
                            {
                                $file_name_path = $pdfFileName['file_path_name'];      
                        ?>
                                <p style="margin-bottom: 0px;">
                                    <a class="a_pdf" href="{{ asset($file_name_path) }}" target='_blank' > 
                                        <?php // print_r($pdfFileName['file_name']); ?>
                                        <?php  print_r($file_name_path); ?>
                                    </a>
                                </p>
                                    <!-- <li><?php // print_r($file_name_path); ?></li> -->
                                    

                        <?php 
                            }
                        ?>
                                <!-- <a id="pdf_updated" target="_blank"></a> -->
                            
                        <!-- </ul> -->
                    </div>
                </div>
            </div>
            <div class="form-group" style="display:contents;">
                <label for="page_desc">Page Description</label>
                <textarea type="text" class="form-control ckeditor " id="page_desc" name="page_desc" placeholder="Enter Page Description" >{{ $templateData->content }}</textarea>
                
                <p><a href="https://ckeditor.com/docs/ckeditor4/latest/features/index.html" target="_blank" style="float: right;" class="">Editor Documentation</a></p>
            </div>

            <div class="form-group" style="padding-top: 30px;">
                <div class="col-sm-6" style="padding: 0px;">
                    <label for="page_desc">Email</label>
                    <input name="send_email" id="send_email" type="email" class="form-control"  required="true" />
                </div>
                <span>This email id will received emails whenever any user fill contact form.</span>
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

            $('#pdf_error').hide();

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
                    url: "{{ url('/vendor/template/logo_upload') }}",
                    type: 'post',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(result){
                        // console.log(result);

                        $(".logo_container").css("height", "110px");
                        $(".logo_container .col-sm-6").css("float", "left");
                        $("#logo_img_updated").css("display", "block");

                        $('#logo_img_updated').attr('src', result['page_logo']);

                        CKEDITOR.instances.page_desc.setData(result['html']); 

                    }
                });
            });

            jQuery('#page_pdf').change(function(e)
            {
                var formdata = new FormData();
                
                var id = $("#id").val();
                formdata.append("id", id); 
                
                var _token = $("#_token").val();
                formdata.append("_token", _token);

              
                if($(this).prop('files').length > 0)
                {
                    file =$(this).prop('files')[0];

                    formdata.append("page_pdf", file);
                }

                // console.log(formdata);
                // return;

                jQuery.ajax({
                    url: "{{ url('/vendor/template/pdf_upload') }}",
                    type: 'post',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(result)
                    {
                        // console.log(result);
                        // return;

                        if(result == 'pdf_not_matched')
                        {
                                // console.log(1);
                                $('#pdf_error').show();
                                $('#pdf_span_error').text('Please select pdf file');
                                $('#pdf_error').delay(5000).fadeOut('slow');
                        }
                        else
                        {
                            // console.log(2);

                            $(".pdf_container").css("height", "150px");
                            $(".pdf_container .col-sm-6").css("float", "left");
                            $("#pdf_updated").css("display", "block");

                            // $('#pdf_up').append('<li>'+result['page_pdf']+'</li>');    
                            $('.pdf_container').append('<p style="margin-bottom: 0px;"><a class="a_pdf" href="'+result['page_pdf']+'" target="_blank">'+result['page_pdf']+'</a></p>');    

                        }
                    }
                });
            });
        });
    </script> 
@endpush