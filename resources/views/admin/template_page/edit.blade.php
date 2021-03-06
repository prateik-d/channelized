@extends('layouts.dashboard')

<style type="text/css">
    
</style>
@section('content')
<div class="admin-container">

    <div class="col-md-12">
        <h2>Edit Template</h2>


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


        <form action="{{ action('TemplatePageController@update') }}" method="POST" class="" enctype="multipart/form-data">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <input name="id" type="hidden" value="{{ $templateData->id }}"/>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required="true" value="{{ $templateData->title }}">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" placeholder="Enter code here..." required="true">{{ $templateData->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="page_name">Page Name</label>
                <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Enter Page Name" required="true" value="{{ $templateData->page_name }}">
            </div>
            <div class="form-group">
                <label for="page_title">Page Title</label>
                <input type="text" class="form-control" id="page_title" name="page_title" placeholder="Enter Page Title" required="true" value="{{ $templateData->page_title }}">
            </div>
            <div class="form-group">
                <label for="page_logo">Page Logo</label>
                <input 
                        type="file" 
                        class="" 
                        id="page_logo" 
                        name="page_logo" 
                        placeholder="Enter Page Logo" 
                        <?php if(!empty($templateData->page_logo))
                        
                           echo "style='color: transparent; width:20%;'"
                         
                    ?> >

                <label for="page_logo">{{ $templateData->page_logo }}</label>
            </div>
            <div class="form-group">
                <label for="page_desc">Page Description</label>
                <textarea type="text" class="form-control" id="page_desc" name="page_desc" placeholder="Enter Page Description" required="true">{{ $templateData->page_desc }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>



    </div>
</div>
@endsection
