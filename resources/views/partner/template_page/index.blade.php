@extends('layouts.dashboard')


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
      margin-top: 20px;
      -webkit-transition: all 0.2s ease-in;
      -moz-transition: all 0.2s ease-in;
      -ms-transition: all 0.2s ease-in;
      -o-transition: all 0.2s ease-in;
      transition: all 0.2s ease-in;
      box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.40);
      min-height: 125px!important;
      max-height: 125px!important;
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

    .active{float: right; padding: 4px 10px 0px 0px;}
</style>

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

        @if($userTemplateFlag != 0)

            <h2>Your Active Template</h2>
            <div style="margin-bottom: 30px;" id="cards_landscape_wrap-2">
                <div class="container">
                    <div class="row">
                        @foreach($templatePageUser as $data)
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <a href="template/view/{{ $data->id }}" target="_blank">
                                <div class="card-flyer">
                                    <div class="text-box">
                                        <!-- <div class="image-box">
                                            <img src="https://cdn.pixabay.com/photo/2018/03/30/15/11/deer-3275594_960_720.jpg" alt="" />
                                        </div> -->
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float:right;padding: 5px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="template/edit/{{ $data->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                    </svg> 
                                                    Edit
                                                </a>
                                                <a class="dropdown-item" href="../public/templates/users/vendor/{{ $user_id }}/{{ $data->title }}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eyeglasses" viewBox="0 0 16 16">
                                                        <path d="M4 6a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm2.625.547a3 3 0 0 0-5.584.953H.5a.5.5 0 0 0 0 1h.541A3 3 0 0 0 7 8a1 1 0 0 1 2 0 3 3 0 0 0 5.959.5h.541a.5.5 0 0 0 0-1h-.541a3 3 0 0 0-5.584-.953A1.993 1.993 0 0 0 8 6c-.532 0-1.016.208-1.375.547zM14 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                                                    </svg> 
                                                    View
                                                </a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteModal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightbulb-off-fill" viewBox="0 0 16 16">
                                                        <path d="M2 6c0-.572.08-1.125.23-1.65l8.558 8.559A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm10.303 4.181L3.818 1.697a6 6 0 0 1 8.484 8.484zM5 14.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5zM2.354 1.646a.5.5 0 1 0-.708.708l12 12a.5.5 0 0 0 .708-.708l-12-12z"/>
                                                    </svg> 
                                                    Deactivate
                                                </a>
                                            </div>

                                            <div id="deleteModal" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Deactivate Page Template</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Do you really want to deactivate this template ?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="template/deactivate/{{ $data->id }}">Yes</a>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="text-container">
                                            <h6>{{ ucfirst(trans($data->title)) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        
        @endif

        <h2>Available Templates</h2>
        <!-- Topic Cards -->
        <div id="cards_landscape_wrap-2">
            <div class="container">
                <div class="row">
                    @foreach($templatePage as $data)
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <!-- <a href="template/view/{{ $data->id }}" target="_blank"> -->
                            <div class="card-flyer">
                                <div class="text-box">

                                    <!-- <div class="image-box">
                                        <img src="https://cdn.pixabay.com/photo/2018/03/30/15/11/deer-3275594_960_720.jpg" alt="" />
                                    </div> -->


                                    <?php

                                        if (!(in_array($data->id, $masterFlag)))
                                        {
                                    ?>

                                            <div class="dropdown">
                                                <a class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float:right;padding: 5px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                    </svg>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="template/create/{{ $data->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                        </svg> 
                                                        Use Template
                                                    </a>
                                                    <!-- <a class="dropdown-item" href="template/view/{{ $data->id }}" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eyeglasses" viewBox="0 0 16 16">
                                                            <path d="M4 6a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm2.625.547a3 3 0 0 0-5.584.953H.5a.5.5 0 0 0 0 1h.541A3 3 0 0 0 7 8a1 1 0 0 1 2 0 3 3 0 0 0 5.959.5h.541a.5.5 0 0 0 0-1h-.541a3 3 0 0 0-5.584-.953A1.993 1.993 0 0 0 8 6c-.532 0-1.016.208-1.375.547zM14 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                                                        </svg> 
                                                        View
                                                    </a> -->
                                                </div>
                                            </div>
                                    <?php
                                        }
                                        else
                                        {
                                            echo "<span class='active'>Active</span>";
                                        }
                                    ?>
                                    <div class="text-container">
                                        <h6 class="text-center">{{ ucfirst(trans($data->name)) }}</h6>
                                        <p><a href="{{ url($data->filepath) }}" target="_blank">view</a></p>
                                    </div>
                                </div>
                            </div>
                        <!-- </a> -->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
</div>


@endsection

@push('js')    

<script>

</script>
@endpush