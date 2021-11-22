@extends('layouts.dashboard')

@section('content')
<div class="admin-container">

    <div class="col-md-12">
        <h2>Create New Template</h2>


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


        <form action="{{ action('PageTemplateController@create') }}" method="POST" class="" enctype="multipart/form-data">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required="tue">
            </div>
            <!-- <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" placeholder="Enter code here..." required="tue"></textarea>
            </div>
            <div class="form-group">
                <label for="page_name">Page Name</label>
                <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Enter Page Name" required="tue">
            </div>
            <div class="form-group">
                <label for="page_title">Page Title</label>
                <input type="text" class="form-control" id="page_title" name="page_title" placeholder="Enter Page Title" required="tue">
            </div>
            <div class="form-group">
                <label for="page_logo">Page Logo</label>
                <input type="file" class="form-control" id="page_logo" name="page_logo" placeholder="Enter Page Logo" required="tue">
            </div>
            <div class="form-group">
                <label for="page_desc">Page Description</label>
                <textarea type="text" class="form-control" id="page_desc" name="page_desc" placeholder="Enter Page Description" required="tue"></textarea>
            </div> -->
            <!-- <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->

            <div class="form-group">
                <label for="zip_file">Upload .zip</label>
                <input type="file" class="form-control" id="zip_file" name="zip_file" placeholder="Enter zip file" required="tue">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</div>
@endsection
