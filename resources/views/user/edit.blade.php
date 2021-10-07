@extends('layouts.dashboard')
@push('css')
<style>
span.select2-selection.select2-selection--multiple {
    border: none;
    background: #f2f3f7;
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
    border: none;
    outline: 0;
}
li.select2-search.select2-search--inline {
    display: none;
}
</style>
@endpush
@section('content')
<div class="">
    <div class="middle-cnt signUpform">
        <div class="col-md-10">
            <div class="getStarted-right-action">
            @hasanyroles(['vendor','partner'])
                <form method="POST" action="{{ route(Auth::user()->roles[0]->name.'.user.update') }}">
            @endhasanyroles
            @hasrole('admin')
                <form method="POST" action="{{ route(Auth::user()->roles[0]->name.'.users.update', Crypt::encrypt($user->id)) }}">
            @endhasrole
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="">
                                    <input class="btn-shadow @error('firstname') is-invalid @enderror" type="text" value="{{ (old('firstname') ? old('firstname') : $user->firstname) }}" placeholder="First name" id="firstname" name="firstname" required autocomplete="firstname" />
                                    <div class="inputInnerShadow"></div>
                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="">
                                    <input id="lastname" name="lastname" class="btn-shadow @error('lastname') is-invalid @enderror" type="text" value="{{ (old('lastname') ? old('lastname') : $user->lastname) }}" placeholder="Last name" required autocomplete="lastname" />
                                    <div class="inputInnerShadow"></div>
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="">
                                        <input id="email" readonly disabled class="btn-shadow @error('email') is-invalid @enderror" type="email" name="email" value="{{ (old('email') ? old('email') : $user->email) }}" placeholder="Work email" required autocomplete="email" />
                                        <div class="inputInnerShadow"></div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="">
                                        <input id="companyname" name="companyname" class="btn-shadow @error('companyname') is-invalid @enderror" type="text" value="{{ (old('companyname') ? old('companyname') : $user->companyname) }}" placeholder="Company name" required autocomplete="companyname"/>
                                        <div class="inputInnerShadow"></div>
                                        @error('companyname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <div class="form-group">
                                <div class="">
                                    <input id="jobtitle" name="jobtitle" class="btn-shadow @error('jobtitle') is-invalid @enderror" type="text" value="{{ old('jobtitle', $user->job_title) }}" placeholder="Job title" autocomplete="jobtitle"/>
                                    <div class="inputInnerShadow"></div>
                                    @error('jobtitle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-12 col-lg-6 jobcategory">
                            <div class="form-group">
                                <div class="">
                                    <select id="jobcategory" class="btn-shadow @error('jobcategory') is-invalid @enderror" data-minimum-results-for-search="Infinity" name="jobcategory" required>
                                        <option disabled selected>Job category</option>
                                        @foreach($jobs as $job)
                                            <option value="{{$job->id}}" {{ (old('jobcategory', $user->job_category_id)==$job->id?'selected':'') }}>{{$job->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="inputInnerShadow"></div>
                                    @error('jobcategory')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                        <!-- <div class="col-md-12 jobcategory">
                            <div class="form-group">
                                <div class="">
                                    <select id="jobcategory" class="btn-shadow @error('jobcategory') is-invalid @enderror" data-minimum-results-for-search="Infinity" name="jobcategory" required>
                                        <option disabled selected>Job category</option>
                                        @foreach($jobs as $job)
                                            <option value="{{$job->id}}" {{ (old('jobcategory', $user->job_category_id)==$job->id?'selected':'') }}>{{$job->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="inputInnerShadow"></div>
                                    @error('jobcategory')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div> -->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="">
                                        @php 
                                            $busi_id = [];
                                        @endphp
                                        <select id="businesstype" class="btn-shadow @error('businesstype') is-invalid @enderror"  name="businesstype">
                                            <option disabled selected>Business type</option>
                                            @foreach($business as $busi)
                                                @php
                                                    $busi_id[] = $busi->id;
                                                @endphp
                                                <option value="{{$busi->id}}" {{ (old('businesstype', $user->business_type_id)==$busi->id?'selected':'') }}>{{$busi->name}}</option>
                                                @if($loop->last)
                                                    @if(old('businesstype') && !in_array(old('businesstype'),$busi_id))
                                                        <option value="{{old('businesstype')}}" selected="">{{old('businesstype')}}</option>
                                                    @endif
                                                    @if(!old('businesstype') && $user->business_type_id==0 && !in_array($user->business_type_id, $busi_id))
                                                        <option value="{{$user->business_type_other}}" selected="">{{$user->business_type_other}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="inputInnerShadow"></div>
                                        @error('businesstype')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div>
                        <!-- <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-shadow">
                                        <input id="address" class="btn-shadow search @error('address') is-invalid @enderror" type="text" value="{{ (old('address') ? old('address') : $user->address) }}" placeholder="Address" name="address" autocomplete="off" />
                                        <div class="inputInnerShadow"></div>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="row">
                            <div class="col-sm-4 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <div class="input-shadow">
                                        <input id="city" class="btn-shadow @error('city') is-invalid @enderror" type="text" value="{{ (old('city') ? old('city') : $user->city) }}" placeholder="City" name="city" required autocomplete="city" />
                                        <div class="inputInnerShadow"></div>
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <div class="input-shadow">
                                        <input id="state" class="btn-shadow @error('state') is-invalid @enderror" name="state" type="text" value="{{ (old('state') ? old('state') : $user->state) }}" placeholder="State" required autocomplete="state" />
                                        <div class="inputInnerShadow"></div>
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <div class="input-shadow">
                                        <input id="postcode" name="postcode" class="btn-shadow @error('postcode') is-invalid @enderror" type="text" value="{{ (old('postcode') ? old('postcode') : $user->post_code) }}" placeholder="Post Code" required autocomplete="postcode"/>
                                        <div class="inputInnerShadow"></div>
                                        @error('postcode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        @if($user->step >= 2)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="">
                                            <select id="primary" class="btn-shadow @error('primary') is-invalid @enderror" name="primary[]" multiple="multiple">
                                                @foreach($primaries as $pri)
                                                    <option value="{{$pri->cpid}}" {{ (old('primary')==$pri->cpid?'selected':(isset($user->capability_primary_id) && in_array($pri->cpid, $user->capability_primary_id)?'selected':'')) }}>{{$pri->type}}</option>
                                                @endforeach
                                            </select>
                                            <div class="inputInnerShadow"></div>
                                            @error('primary')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="">
                                            <select id="secondary" class="btn-shadow @error('secondary') is-invalid @enderror" name="secondary[]" multiple="multiple">
                                                @if($secondaries)
                                                @foreach($secondaries as $sec)
                                                    <option value="{{$sec->csid}}" {{ (old('secondary')==$sec->csid?'selected':(isset($user->capability_secondary_id) && in_array($sec->csid, $user->capability_secondary_id)?'selected':'')) }}>{{$sec->type}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="inputInnerShadow"></div>
                                            @error('secondary')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <div class="">
                                            <select id="vendor" class="btn-shadow @error('vendor') is-invalid @enderror" name="vendor">
                                                @foreach($vendors as $ved)
                                                    <option value="{{$ved->id}}" {{ (old('vendor', $user->vendor_id)==$ved->id?'selected':'') }}>{{$ved->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="inputInnerShadow"></div>
                                            @error('vendor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-sm-8">
                        @hasanyroles(['vendor','partner'])
                                <a href="{{ route(Auth::user()->roles[0]->name.'.home') }}" class="btn btn-light my-2 my-sm-0 btn-shadow">
                                    Cancel
                                </a>
                            @endhasanyroles
                            @hasrole('admin')
                            <a href="{{ route(Auth::user()->roles[0]->name.'.users') }}" class="btn btn-light my-2 my-sm-0 btn-shadow">
                                Cancel
                            </a>
                            @endhasrole
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-info my-2 my-sm-0 btn-shadow float-right" type="submit">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(function() {
        $("select").on("select2:open", function(event) {
            $('input.select2-search__field').attr('placeholder', 'Please specify..');
        });
        
        $("#jobcategory").select2();
        $("#primary").select2({
            placeholder: 'Select Primary Capability',
            allowClear: true
        }).on('change', function(){
            var cpid = $(this).val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({ 
                url: "{{route('secondary_data')}}",
                type: "POST",
                data: {
                    _token: CSRF_TOKEN,
                    cpid: cpid
                },
                success: function(res){
                    //console.log(res);
                    var res = JSON.parse(res);
                    $("#secondary").empty();
                    var sec_val = new Array();
                    @if($user->capability_secondary_id)
                        @foreach($user->capability_secondary_id as $s)
                            sec_val.push({!! $s !!})
                        @endforeach
                        console.log(sec_val);
                    @endif
                    $.each(res, function(key, val){
                        if(sec_val.indexOf(val.csid)!=-1){
                            $("#secondary").append($("<option></option>").attr("value", val.csid).text(val.type).attr('selected','selected'));
                        }else{
                            $("#secondary").append($("<option></option>").attr("value", val.csid).text(val.type));
                        }
                    })
                }
            });
            //console.log(11);
        });
        $("#secondary").select2({
            placeholder: 'Select Secondary Capability',
            allowClear: true
        });
        $("#vendor").select2();
        
        $('#businesstype').select2({
            tags: true,
            placeholder: 'Select Business type',
        });
    });
</script>
@endpush
