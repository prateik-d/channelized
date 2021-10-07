<div class="top-tablebar">
    <img src="{{ asset('public/assets/images/calander.png') }}" />
    <span>{{$event->name}} profile roles summary</span>
</div>
<div class="curr-rvnt-table current-arrow">
    <table id="currenevent-table" class="table current-table" style="width:100%">
        <thead>
            <tr>
                <th>Type of partners</th>
                @foreach($job_cat_prt as $single)
                    <th>{{$single->name}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($prt_bus_types as $psingle)
                <tr>
                    <td>{{$psingle->name}}</td>
                    @foreach($job_cat_prt as $jsingle)
                        @php
                            $evt_pro = $profile_data->where('business_type_id',$psingle->id)->where('job_category_id',$jsingle->id)->first();
                            
                            $progress_val = (empty($evt_pro) ? 0 : $evt_pro->rtotal);
                            $total_partner = $users->where('job_category_id',$jsingle->id)->where('business_type_id',$psingle->id)->count();
                            $progress_per = ($total_partner==0 ? 0 : ($progress_val/$total_partner)*100);
                        @endphp
                        <td>
                            @if($progress_per==0)
                                <p>{{$progress_val}}</p>
                            @else
                                <div class="w3-light-grey">
                                    <div class="w3-container w3-green w3-center" style="width:{{$progress_per}}%">
                                        {{$progress_val}}
                                    </div>
                                </div>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
            <tr>
                <td>Other</td>
                @foreach($job_cat_prt as $jsingle)
                    @php
                        $evt_pro = $profile_data->where('business_type_id',0)->where('job_category_id',$jsingle->id)->first();

                        $progress_val = (empty($evt_pro) ? 0 : $evt_pro->rtotal);
                        $total_partner = $users->where('job_category_id',$jsingle->id)->where('business_type_id',0)->count();
                        $progress_per = ($total_partner==0 ? 0 : ($progress_val/$total_partner)*100);
                    @endphp
                    <td>
                        @if($progress_per==0)
                            <p>{{$progress_val}}</p>
                        @else
                            <div class="w3-light-grey">
                                <div class="w3-container w3-green w3-center" style="width:{{$progress_per}}%">
                                    {{$progress_val}}
                                </div>
                            </div>
                        @endif
                    </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>