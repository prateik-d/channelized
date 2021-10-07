@extends('layouts.dashboard')

@section('content')
<div class="admin-container">
    <form method="POST" id="opportunity_add" class="event-add-form" action="{{ route(Auth::user()->roles[0]->name.'.opportunities.store') }}" enctype='multipart/form-data'>
        @csrf
        <div class="col-md-12">
            @if (session('success'))
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            </div>
        @endif

            @if (session('error'))
                <div class="col-sm-12">
                    <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                </div>
            @endif
            <div class="create-form" style="display: inline-block;">
                <div class="create-event-form">
                    <div class="create-event-form-row">
                        <div for="name" class="create-event-form-label">Do you have a project right now</div>
                        <div class="create-event-form-input">
                              <select class="event-dropcreate" id="have_project" name="have_project">
                                    <option value="1">Yes, I'm looking to start a project</option>
                                    <option value="0">No, I'm just looking to learn more about Channelised</option>
                              </select>
                        </div>
                    </div>
                </div>
                  <div id="other_fields">
                    <div class="create-event-form-row">
                        <div class="create-event-form-label">Are happy to Sign the Partnering agreement? </div>
                            <div class="create-event-form-input">
                                    <div class="create-event-form-input">
                                        <select class="event-dropcreate" id="agreement" name="agreement">
                                            <option value="">Select Partnering agreement?</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                           </div>
                   </div>
                   <div class="create-event-form-row">
                        <div class="create-event-form-label">What's your project about? </div>
                            <div class="create-event-form-input">
                                    <div class="create-event-form-input">
                                        <select class="event-dropcreate" id="project_about" name="project_about">
                                            <option value=""> Select about your project?</option>
                                            <option value="Project title - single line text">Project title - single line text</option>
                                            <option value="Project description - multi line text">Project description - multi line text</option>
                                        </select>
                                    </div>
                           </div>
                   </div>
                   <div class="create-event-form-row">
                        <div class="create-event-form-label">Add favourite vendor</div>
                            <div class="create-event-form-input">
                                    <div class="create-event-form-input">
                                        <select id="vendorFilter" class="event-dropcreate" name="vendor" >
                                            <option value="">Select your favourite vendor</option>
                                            @foreach($vendors as $single)
                                                <option value="{{$single->id}}">{{$single->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                           </div>
                   </div>
                   <div class="create-event-form-row">
                        <div class="create-event-form-label">Solution</div>
                            <div class="create-event-form-input">
                                    <div class="create-event-form-input">
                                        <select id="solutionFilter" class="event-dropcreate" name="solution_category" >
                                            <option value="">Select solution</option>
                                            @foreach($solutions as $single)
                                                <option value="{{$single->id}}">{{$single->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                           </div>
                   </div>
                   <div class="create-event-form-row">
                            <div for="name" class="create-event-form-label">Any specific certification criteria</div>
                            <div class="create-event-form-input">
                                <input id="name" type="text"  name="certification" autocomplete="certification" placeholder="Enter specific certification criteria">
                            </div>
                    </div>
                    <div class="create-event-form-row">
                        <div class="create-event-form-label">How much time do you think will be required for this Project? </div>
                            <div class="create-event-form-input">
                                    <div class="create-event-form-input">
                                        <select class="event-dropcreate" id="time" name="project_time">
                                            <option value="">Select time required for this Project?</option>
                                            <option value="Less than 1 week">Less than 1 week</option>
                                            <option value="1 to 4 weeks">1 to 4 weeks</option>
                                            <option value="1 to 3 months">1 to 3 months</option>
                                            <option value="more than 3 monthss">more than 3 months</option>
                                        </select>
                                    </div>
                           </div>
                   </div>
                   <div class="create-event-form-row">
                        <div class="create-event-form-label">When do you need the service provider to start? </div>
                            <div class="create-event-form-input">
                                    <div class="create-event-form-input">
                                        <select class="event-dropcreate" id="service_provider" name="service_time">
                                            <option value="">Select service provider to start?</option>
                                            <option value="ASAP">ASAP</option>
                                            <option value="In 1-2 weeks">In 1-2 weeks</option>
                                            <option value="More than 2 weeks from now">More than 2 weeks from now</option>
                                        </select>
                                    </div>
                           </div>
                   </div>
                   <div class="create-event-form-row">
                     <div class="row">
                      <div class="col-md-6">
                        <div class="create-event-form-label"> What is the budget for this project? </div>
                            <div class="create-event-form-input">
                                    <div class="create-event-form-input">
                                        <select class="event-dropcreate" id="budget" name="budget">
                                            <option value="">Select budget for this project?</option>
                                            <option value="I have a fixed budget in mind"> I have a fixed budget in mind</option>
                                            <option value='I have a "Day Rate" budget in mind'>I have a "Day Rate" budget in mind</option>
                                            <option value="I dont know my budget">I dont know my budget</option>
                                        </select>
                                    </div>
                        </div>
                       </div>
                      <div class="col-md-2" id="amount" style="display:none">
                            <div for="name" class="create-event-form-label">Amount</div>
                            <div class="create-event-form-input">
                                <input type="number" class="" name="amount"  autocomplete="amount" placeholder="Amount">
                            </div>
                      </div>
                    </div>
                   </div>
                   <div class="create-event-form-row">
                      <div class="row">
                         <div class="col-md-8">
                            <div class="create-event-form-label">Where is your office location? Do you want work delivered onsite</div>
                                <div class="create-event-form-input">
                                        <div class="create-event-form-input">
                                            <select class="event-dropcreate" id="city" name="location">
                                                <option value="">Select your office location</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                               </div>
                            </div>
                            <div class="col-md-4" id="selectCity" style="display:none">
                                <div class="create-event-form-label">City</div>
                                <div class="create-event-form-input">
                                        <div class="create-event-form-input">
                                            <select class="event-dropcreate" id="city_name" name="city">
                                                <option value="">Select City</option>
                                               @foreach($cities as $city)
                                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                               </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-4 mb-5">
            <div class="event-subsv-btn">
                <!-- <div id="hiden_fields_here"></div> -->
                <button type="submit" id="submit_btn" class="btn btn-primary btn-shadow event-sabbtn">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
@push('js')

<script>
    $(function () {
        // guess user timezone 
        $('#have_project').change(function(){
            var value = $(this).val();
            if(value == 0){
                $('#other_fields').css('display','none');
                $('#other_fields').find('.event-dropcreate').each(function(){
                    $(this).val('');
                });
                $('#other_fields').find('input').each(function(){
                    $(this).val('');
                });
            }else{
                $('#other_fields').css('display','block');
            }
        });

      $('#budget').change(function (){
         var value = $(this);
         if(value[0].selectedIndex != 1){
            $('#amount').hide();
         }else{
            $('#amount').show();
         }
      });

      $('#city').change(function (){
         var value = $(this).val();
         if(value == 'no'){
            $('#selectCity').hide();
         }else{
            $('#selectCity').show();
         }
      })


    });

    //event add dropdown
    
    $(".event-dropcreate").select2();
</script>
@endpush