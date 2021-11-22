@if (session('status'))
<style type="text/css">
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    .alert {
        position: relative;
        padding: 0.75rem  1.25rem ;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;
    }
</style>
<div class="alert alert-success" role="alert">
    <!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
    Your information is submitted successfully!!!
</div>


@endif

{!! $content !!}