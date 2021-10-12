@extends('layouts.dashboard')

@push('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<style>.slow .toggle-group { transition: left 0.9s; -webkit-transition: left 0.9s; }</style>

<style>
    /*----  Main Style  ----*/
    #cards_landscape_wrap-2{
      text-align: center;
      background: #F7F7F7;
    }
    #cards_landscape_wrap-2 .container{
      /*padding-top: 80px; */
      padding-bottom: 20px;
    }
    #cards_landscape_wrap-2 a{
      text-decoration: none;
      outline: none;
    }
    #cards_landscape_wrap-2 .card-flyer {
      border-radius: 5px;
    }
    #cards_landscape_wrap-2 .card-flyer .image-box{
      background: #ffffff;
      overflow: hidden;
      box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.50);
      border-radius: 5px;
    }
    #cards_landscape_wrap-2 .card-flyer .image-box img{
      -webkit-transition:all .9s ease; 
      -moz-transition:all .9s ease; 
      -o-transition:all .9s ease;
      -ms-transition:all .9s ease; 
      width: 100%;
      height: 200px;
    }
    #cards_landscape_wrap-2 .card-flyer:hover .image-box img{
      opacity: 0.7;
      -webkit-transform:scale(1.15);
      -moz-transform:scale(1.15);
      -ms-transform:scale(1.15);
      -o-transform:scale(1.15);
      transform:scale(1.15);
    }
    #cards_landscape_wrap-2 .card-flyer .text-box{
      text-align: center;
    }
    #cards_landscape_wrap-2 .card-flyer .text-box .text-container{
      padding: 30px 18px;
    }
    #cards_landscape_wrap-2 .card-flyer{
      background: #FFFFFF;
      margin-top: 50px;
      -webkit-transition: all 0.2s ease-in;
      -moz-transition: all 0.2s ease-in;
      -ms-transition: all 0.2s ease-in;
      -o-transition: all 0.2s ease-in;
      transition: all 0.2s ease-in;
      box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.40);
      min-height: 100px!important;
      max-height: 100px!important;
    }
    #cards_landscape_wrap-2 .card-flyer:hover{
      background: #fff;
      box-shadow: 0px 15px 26px rgba(0, 0, 0, 0.50);
      -webkit-transition: all 0.2s ease-in;
      -moz-transition: all 0.2s ease-in;
      -ms-transition: all 0.2s ease-in;
      -o-transition: all 0.2s ease-in;
      transition: all 0.2s ease-in;
      margin-top: 50px;
    }
    #cards_landscape_wrap-2 .card-flyer .text-box p{
      margin-top: 10px;
      margin-bottom: 0px;
      padding-bottom: 0px; 
      font-size: 14px;
      letter-spacing: 1px;
      color: #000000;
    }
    #cards_landscape_wrap-2 .card-flyer .text-box h6{
      margin-top: 0px;
      margin-bottom: 4px; 
      font-size: 18px;
      font-weight: bold;
      /*text-transform: uppercase;*/
      /*font-family: 'Roboto Black', sans-serif;*/
      letter-spacing: 1px;
      color: #00acc1;
    }
    .dropdown-toggle::after {
            display: none !important;
     }
</style>

@endpush

@section('content')
<div class="admin-container">

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
      
        <!-- Topic Cards -->
        <div id="cards_landscape_wrap-2">
            <div class="container">
                <div class="row">
                    @foreach($templatePage as $data)
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <a href="template/view/{{ $data->id }}" target="_blank">
                            <div class="card-flyer">
                                <div class="text-box">
                                    <!-- <div class="image-box">
                                        <img src="https://cdn.pixabay.com/photo/2018/03/30/15/11/deer-3275594_960_720.jpg" alt="" />
                                    </div> -->
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float:right;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            
                                            <a class="dropdown-item" data-toggle="modal" data-target="#deleteModal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-recycle" viewBox="0 0 16 16">
                                                    <path d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242-2.532-4.431zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24l2.552-4.467zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.498.498 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244l-1.716-3.004z"/>
                                                </svg> 
                                                Restore
                                            </a>
                                        </div>
                                        <div id="deleteModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Restore Page Template</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Do you really want to restore this template ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="restore/{{ $data->id }}">Yes</a>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-container">
                                        <h6>Title : {{ $data->title }}</h6>
                                        <p>Page :  {{ $data->page_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('js')

@endpush
