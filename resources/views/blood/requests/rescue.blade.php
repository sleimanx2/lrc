@extends('layouts.master')

@section('sub-header')
<div class="clearfix">
	<a href="{{ route('blood-donors-list') }}" class="btn btn-success btn-no-bg" style="margin-top: -5px; margin-right: 10px"><i class="fa fa-angle-left"></i></a>
    <h5 class="page-title">Blood Rescue</h5>
    <ul class="list-unstyled toolbar pull-right">
        <li class="blood-request-info-header">
            <span>Completed</span>
            @if($bloodRequest->completed)
                <span popover="Confirmed" popover-trigger="mouseenter" class="badge badge-success"><i class="fa fa-check"></i></span>
            @else
                <span popover="Not Confirmed" popover-placement="left" popover-trigger="mouseenter" class="badge badge-warning"><i class="fa fa-times"></i></span>
            @endif
            
            <span class="m-l-sm">All Donors Confirmed</span>
            @if($bloodRequest->confirmed)
                <span popover="Confirmed" popover-trigger="mouseenter" class="badge badge-success"><i class="fa fa-check"></i></span>
            @else
                <span popover="Not Confirmed" popover-placement="left" popover-trigger="mouseenter" class="badge badge-warning"><i class="fa fa-times"></i></span>
            @endif
        </li>
        <li><a href="{{ route('blood-request-edit',[$bloodRequest->id]) }}" class="btn btn-info btn-action"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit Request</a></li>
        @if(!$bloodRequest->completed)
        <li>
            {!! Form::open(['method'=>'post', 'route'=>['blood-request-set-completed', $bloodRequest->id], 'style'=>'display:inline', 'id'=>'btn-set-complete-form-'.$bloodRequest->id]) !!}

            <button id="btn-set-complete-{{ $bloodRequest->id }}" class="btn btn-success btn-action"><i class="fa fa-check"></i>&nbsp;&nbsp;Set as Complete</button>

            {!!Form::close()!!}

            <script type="text/javascript">
                $("#btn-set-complete-{{ $bloodRequest->id }}").click(function(e){
                    swal({
                        title: "Are you sure?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes!",
                        closeOnConfirm: false
                    },
                    function(){
                        $('#btn-set-complete-form-{{ $bloodRequest->id }}').submit();
                    });
                    e.preventDefault();
                    return false;
                });
            </script>
        </li>
        @endif
    </ul>
</div>
@endsection

@section('content')
<div class="page">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><i class="fa fa-list panel-ico"></i>Blood Request Info</strong>
                    <span class="badge {{$bloodRequest->due_date == date('Y-m-d',time()) ? 'badge-warning' : ''}} {{$bloodRequest->due_date < date('Y-m-d',time()) ? 'badge-danger' : 'badge-success'}} pull-right">Due: {{ Carbon\Carbon::parse($bloodRequest->due_date)->diffForHumans() }} </span>
                </div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <ul class="list-unstyled list-info">
                                        <li>
                                            <span class="icon fa fa-heart-o"></span>
                                            <label>Patient Name</label>
                                            <div class="pull-right">{!! Html::gender($bloodRequest->patient_gender) !!}<span class="sub-panel-title"><b>{{ $bloodRequest->patient_name }}</b></span></div>
                                        </li>
                                        <li>
                                            <span class="icon fa fa-calendar"></span>
                                            <label>Patient Age</label>
                                            <div class="pull-right"><b>{{ $bloodRequest->patient_age or 'Not defined'}}</b></div>
                                        </li>
                                        <li>
                                            <i class="icon fa fa-user-md"></i>
                                            <label>Case</label>
                                            <div class="pull-right"><b>{{ $bloodRequest->case }}</b></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <div class="blood-request-info">
                                        <span class="blood-type">{{ $bloodRequest->blood_type->name or 'Not defined'}}</span>
                                        <div class="blood-units">
                                            <label><i popover="Blood" popover-trigger="mouseenter" class="fa fa-heart color-danger"></i>&nbsp;&nbsp;Blood Units</label>
                                            <div class="badge pull-right">{{ $bloodRequest->blood_quantity_confirmed }} / {{ $bloodRequest->blood_quantity }}</div>
                                            <br>
                                            <label><i popover="Platelets" popover-trigger="mouseenter" class="fa fa-heart color-warning"></i>&nbsp;&nbsp;Platelets</label>
                                            <div class="badge pull-right">{{ $bloodRequest->platelets_quantity_confirmed}} / {{ $bloodRequest->platelets_quantity }}</div>
                                        </div>                                            
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-unstyled list-info">
                                        <li>
                                            <span class="icon fa fa-user"></span>
                                            <label>Contact Person</label>
                                            <div class="pull-right"><b>{{ $bloodRequest->contact_name }}</b></div>
                                        </li>
                                        <li>
                                            <span class="icon fa fa-phone"></span>
                                            <label>Contact Phone</label>
                                            <div class="pull-right">
                                                <button class="btn btn-primary dial-item-btn" data-dial='["{{ $bloodRequest->phone_primary }}", "{{ $bloodRequest->phone_secondary }}"]' data-dial-name="{{ $bloodRequest->contact_name }}" data-log-request-id="{{ $bloodRequest->id }}" data-log-call-type="contact"><i class="fa fa-phone"></i>&nbsp;&nbsp;DIAL</button>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="icon fa fa-bullhorn"></span>
                                            <label>Who to Blame</label>
                                            <div class="pull-right"><b>{{ $bloodRequest->user->full_name or 'Not defined' }}</b></div>
                                        </li>
                                        <li>
                                            <span class="icon fa fa-pencil"></span>
                                            <label>Last Updated</label>
                                            <div class="pull-right"><b>{{ Carbon\Carbon::parse($bloodRequest->updated_at)->diffForHumans() }}</b></div>
                                        </li>
                                        @if($bloodRequest->note)
                                        <li class="blood-request-notes">
                                            <span class="icon fa fa-sticky-note"></span>
                                            <label>Important Notes</label>
                                            <p>{{$bloodRequest->note}}</p>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><i class="fa fa-h-square panel-ico"></i>Blood Bank Info</strong>
                    <button class="btn btn-primary dial-item-btn pull-right" data-dial='{{ json_encode($bloodRequest->blood_bank->phone_numbers) }}' data-dial-name="{{ $bloodRequest->blood_bank->name }}" data-log-request-id="{{ $bloodRequest->id }}" data-log-call-type="hospital"><i class="fa fa-phone"></i>&nbsp;&nbsp;DIAL</button>
                </div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-body">
                            <ul class="list-unstyled list-info">
                                <li>
                                    <span class="icon fa fa-hospital-o"></span>
                                    <span>Name</span>
                                    <b class="pull-right">{{ $bloodRequest->blood_bank->name_fmt }}</b>
                                </li>
                                <li>
                                    <span class="icon fa fa-map-marker"></span>
                                    <span>Location</span>
                                    <b class="pull-right">{{ $bloodRequest->blood_bank->location }}</b>
                                </li>
                            </ul>

                            <div class="form-group">
                                <div class="ui-map" id="map-canvas"></div>
                            </div>

                            <input type="hidden" id="hidden_location_name" value="{{ $bloodRequest->blood_bank->name }}"/>
                            <input type="hidden" id="hidden_location_latitude" value="{{ $bloodRequest->blood_bank->latitude }}"/>
                            <input type="hidden" id="hidden_location_longitude" value="{{ $bloodRequest->blood_bank->longitude }}"/>

                            <script type="text/javascript">
                                var location_name = $("#hidden_location_name");
                                var location_latitude = $("#hidden_location_latitude");
                                var location_longitude = $("#hidden_location_longitude");
                                var location_marker = null;

                                $(document).ready(function() {
                                    initMap();
                                    moveMap();
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><i class="fa fa-address-book panel-ico"></i>Call Logs</strong>
                </div>
                <div class="panel-body">
                    @if($callLogs->count())
                    <table class="table">
                        <thead>
                            <th>Call Type</th>
                            <th>User</th>
                            <th>Donor Info</th>
                            <th>Called On</th>
                        </thead>
                        <tbody>
                            @foreach($callLogs as $callLog)
                            <tr>
                                <th><span class="label label-log-{{ $callLog->call_type }}">{{ ucWords($callLog->call_type) }}</span></th>
                                <td>{{ $callLog->user->full_name }}</td>
                                @if($callLog->call_type == "donor")
                                <td><a class="label label-success" href="/blood/donors/{{ $callLog->donor->id }}/edit" target="blank">{{ strtoupper($callLog->donor->first_name) }} {{ strtoupper($callLog->donor->last_name) }} {{ $callLog->donor->trashed() ? ' (Deleted)' : '' }}</a></td>
                                @else
                                <td></td>
                                @endif
                                <td class="text-small">{{ Carbon\Carbon::parse($callLog->created_at)->format('F j, Y \a\t h:i A') }} ({{ Carbon\Carbon::parse($callLog->created_at)->diffForHumans() }})</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-center"><i>No calls made for this request yet.</i></p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><i class="fa fa-check panel-ico"></i>Successful Blood Donations</strong>
                </div>
                <div class="panel-group" id="accordion-success-donations">
                    <div class="panel panel-default">
                        @foreach($bloodDonations as $bloodDonation)
                            <div class="panel-heading">
                                <div data-toggle="collapse" style="cursor: pointer;" data-parent="#accordion-success-donations" href="#{{ 'collapse-success-'.$bloodDonation->id  }}" class="collapse-panel-heading">
                                    {!! Html::gender($bloodDonation->donor->gender) !!}
                                    <span class="text-small sub-panel-title">{{ $bloodDonation->donor->first_name }} {{$bloodDonation->donor->last_name}}</span>

                                    <span class="pull-right">
                                        @if($bloodDonation->platelets)
                                            <span class="badge badge-outline"><i popover="Platelets" popover-trigger="mouseenter" class="fa fa-heart color-warning"></i></span>
                                        @else
                                            <span class="badge badge-outline"><i popover="Blood" popover-trigger="mouseenter" class="fa fa-heart color-danger"></i></span>
                                        @endif

                                        @if($bloodDonation->confirmed)
                                            <span popover="Confirmed" popover-trigger="mouseenter" class="badge badge-success"><i class="fa fa-check"></i></span>
                                        @else
                                            <span popover="Not Confirmed" popover-trigger="mouseenter" class="badge badge-warning"><i class="fa fa-times"></i></span>
                                        @endif

                                        <span popover="Donation Date" popover-trigger="mouseenter" class="badge">
                                            {{ $bloodDonation->will_donate_on}}
                                            {{ $bloodDonation->time ? ' | ' . $bloodDonation->time : '' }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div id="{{ 'collapse-success-'.$bloodDonation->id  }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="list-unstyled list-infolist-unstyled list-info m-b-0">
                                        <li>
                                            <span class="icon fa fa-bullhorn"></span>
                                            <label>Last Contacted By</label>
                                            <b>{{ $bloodDonation->user->first_name or 'Not defined'}} {{ $bloodDonation->user->last_name or ''}}</b>
                                        </li>
                                        <li>
                                            <button class="btn btn-primary dial-item-btn m-r-sm" data-dial='["{{ $bloodDonation->donor->phone_primary }}", "{{ $bloodDonation->donor->phone_secondary }}"]' data-dial-name="{{ $bloodDonation->donor->first_name }} {{$bloodDonation->donor->last_name }}" data-log-request-id="{{ $bloodRequest->id }}" data-log-call-type="donor" data-log-donor-id="{{ $bloodDonation->donor->id }}"><i class="fa fa-phone"></i>&nbsp;&nbsp;DIAL</button>

                                            <div class="pull-right">
                                                @if( ! $bloodDonation->confirmed )
                                                    {!!Form::open([
                                                    'route'=>['blood-donation-confirmed',$bloodDonation->id],
                                                    'style'=>'display:inline',
                                                    'onsubmit'=>'return confirm("Are you sure you want to confirm
                                                    '.$bloodDonation->user->first_name.' donation ?");'
                                                    ]) !!}

                                                    <button type="submit" class="btn btn-success"
                                                            popover="Confirm"
                                                            popover-trigger="mouseenter">
                                                        Confirm
                                                    </button>

                                                    {!!Form::close()!!}
                                                @endif

                                                <button onclick="openWontDonate({{ $bloodDonation->donor->id }})" class="btn btn-bordered-danger">Can't Donate</button>
                                            </div> 
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @if( !$bloodRequest->completed )
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><i class="fa fa-tint panel-ico"></i>Suggested Blood Donors</strong>
                    <div class="panel-control">
                        <a class="btn btn-primary btn-sm" style="margin-top: -2px" href="javascript:void(0);" data-toggle="modal" data-target="#modalSearchDonor"><i class="fa fa-search"></i></a>
                    </div>
                </div>

                <div class="panel-group" id="accordion-potential-donations">
                    <div class="panel panel-default">
                        @foreach($bloodDonors as $bloodDonor)
                            <div class="panel-heading">
                                <div data-toggle="collapse" style="cursor: pointer;" data-parent="#accordion-potential-donations" href="#{{ 'collapse-potential-'.$bloodDonor->id  }}">
                                    {!! Html::gender($bloodDonor->gender) !!}

                                    @if($bloodDonor->golden_donor)
                                        <span popover="Golden Donor" popover-trigger="mouseenter" class="badge badge-warning">GD</span>
                                    @endif

                                    <span class="text-small sub-panel-title">{{ $bloodDonor->first_name }} {{$bloodDonor->last_name}}</span>

                                    <span class="pull-right">
                                        <span class="badge badge-distance" popover="Distance" popover-trigger="mouseenter">{{ $bloodDonor->distance_value ? Html::distance($bloodDonor->distance_value/1000) . ' | ' . $bloodDonor->duration_value : Html::distance($bloodDonor->distance) }}</span>
                                        <span class="badge">{{ Html::age($bloodDonor->birthday) }} Years </span>
                                    </span>
                                </div>
                            </div>
                            <div id="{{ 'collapse-potential-'.$bloodDonor->id  }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="list-unstyled list-infolist-unstyled list-info m-b-0">
                                        @if($bloodDonor->note)
                                        <li>
                                            <h5 class="no-margin m-b-sm"><b>Notes</b></h5>
                                            <p id="donor_notes_{{ $bloodDonor->id }}">{!! nl2br($bloodDonor->note) !!}</p>
                                        </li>
                                        @endif
                                        <li>
                                            @if($bloodDonor->note)
                                            <br>
                                            @endif
                                            <button class="btn btn-primary dial-item-btn m-r-sm" data-dial='["{{ $bloodDonor->phone_primary }}", "{{ $bloodDonor->phone_secondary }}"]' data-dial-name="{{ $bloodDonor->first_name }} {{$bloodDonor->last_name }}" data-log-request-id="{{ $bloodRequest->id }}" data-log-call-type="donor" data-log-donor-id="{{ $bloodDonor->id }}"><i class="fa fa-phone"></i>&nbsp;&nbsp;DIAL</button>

                                            <div class="pull-right">
                                                <button onclick="openWillDonate({{ $bloodDonor->id }})" class="btn btn-bordered-success">Will Donate</button>
                                                <button onclick="openWontDonate({{ $bloodDonor->id }})" class="btn btn-bordered-danger">Can't Donate</button>
                                                <a class="btn btn-info" target="blank" href="{{ route('blood-donor-edit',[$bloodDonor->id]) }}"><i class="fa fa-edit m-r-sm"></i> Edit Donor</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

<div class="modal fade" id="wontDonate" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Can't Donate Before</h4>
            </div>
            {!! Form::open(['route' => 'blood-donor-wont-donate', 'method' => 'post']) !!}
            <div class="modal-body">
                <input type="hidden" name="bloodDonorId" id="bloodDonorId"/>
                <input type="hidden" name="bloodRequestId" value="{{$bloodRequest->id}}"/>
                
                <span class="list-unstyled">
                    <label class="ui-radio">
                        <input name="delay" checked="checked" type="radio" value="{{strtotime('+1 day')}}"><span> Tomorrow</span>
                    </label>
                    <label class="ui-radio">
                        <input name="delay" type="radio" value="{{strtotime('+2 weeks')}}"><span> 2 Weeks</span>
                    </label>
                    <label class="ui-radio">
                        <input name="delay" type="radio" value="{{strtotime('+3 weeks')}}"><span> 3 Weeks</span>
                    </label>
                    <label class="ui-radio">
                        <input name="delay" type="radio" value="{{strtotime('+1 month')}}"><span> 1 Month</span>
                    </label>
                    <label class="ui-radio">
                        <input name="delay" type="radio" value="{{strtotime('+3 months')}}"><span> 3 Months</span>
                    </label>
                    <label class="ui-radio">
                        <input name="delay" type="radio" value="{{strtotime('+6 months')}}"><span> 6 Months</span>
                    </label>
                    <label class="ui-radio">
                        <input name="delay" type="radio" value="{{strtotime('+1 year')}}"><span> 1 Year</span>
                    </label>
                </span>

                <hr/>
                
                <h5>Donor Notes</h5>
                <textarea name="note" class="donor-notes form-control autogrow"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="reset">CANCEL</button>
                <button class="btn btn-success" type="submit">SAVE</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="willDonate" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Will Donate</h4>
            </div>
            {!! Form::open(['route' => 'blood-donor-will-donate', 'method' => 'post']) !!}
            <div class="modal-body">
                <input type="hidden" name="donor_id" id="donorId"/>
                <input type="hidden" name="blood_request_id" value="{{$bloodRequest->id}}"/>

                <span class="list-unstyled">
                    <label class="ui-radio">
                      <input name="will_donate_on" checked="checked" type="radio" value="{{strtotime('+0 day')}}"><span> Today</span>
                    </label>
                    <label class="ui-radio">
                        <input name="will_donate_on" checked="checked" type="radio" value="{{strtotime('+1 day')}}"><span> Tomorrow</span>
                    </label>
                    <label class="ui-radio">
                        <input name="will_donate_on" type="radio" value="{{strtotime('+2 day')}}"><span> After Tomorrow</span>
                    </label>
                </span>
                <div class="row m-t-sm">
                    <div class="col-md-6">
                        <h5>Will Donate At</h5>
                        <div class="input-group ui-datepicker">
                            <input name="time" required class="form-control timepicker">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Donation Type</h5>
                        <span class="list-unstyled" style="padding-top: 4px; display: block;">
                            @if($bloodRequest->blood_quantity !== $bloodRequest->blood_quantity_confirmed)
                                <label class="ui-radio">
                                    <input name="donation_type" checked="checked" type="radio" value="blood"><span> Blood</span>
                                </label>
                            @endif
                            @if($bloodRequest->platelets_quantity !== $bloodRequest->platelets_quantity_confirmed)
                                <label class="ui-radio">
                                    <input name="donation_type" type="radio" value="platelets"><span> Platelets</span>
                                </label>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="reset">CANCEL</button>
                <button class="btn btn-success" type="submit">SAVE</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="modalSearchDonor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Search for Donor</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            {!! Form::select('donor_id', [], null, ['class' => 'form-control ajax-search-select donors-search-select']) !!}
                        </div>
                    </div>
                    <div class="search-result-container" style="display: none">
                        <hr>
                        <div class="col-md-12 m-b-md">
                            <span class="badge-gender badge"><i class="fa"></i></span>
                            <span class="badge-golden badge badge-warning">GD</span>
                            <span class="badge badge-age"></span>
                            <span class="donor-name sub-panel-title"><b></b></span>
                            <span class="pull-right">
                                <button class="btn btn-primary dial-item-btn m-l-sm btn-sm" data-dial='' data-dial-name="" data-log-request-id="{{ $bloodRequest->id }}" data-log-call-type="donor" data-log-donor-id=""><i class="fa fa-phone"></i>&nbsp;&nbsp;DIAL</button>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tabWillDonate" role="tab" data-toggle="tab" aria-expanded="true">Will Donate</a></li>
                                    <li role="presentation" class=""><a href="#tabCantDonate" role="tab" data-toggle="tab" aria-expanded="false">Can't Donate</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tabWillDonate">
                                        {!! Form::open(['route' => 'blood-donor-will-donate', 'method' => 'post']) !!}
                                        <input type="hidden" name="donor_id" id="donorId" value="12"/>
                                        <input type="hidden" name="blood_request_id" value="{{$bloodRequest->id}}"/>
                                        <br>
                                        <span class="list-unstyled">
                                            <label class="ui-radio">
                                              <input name="will_donate_on" checked="checked" type="radio" value="{{strtotime('+0 day')}}"><span> Today</span>
                                            </label>
                                            <label class="ui-radio">
                                                <input name="will_donate_on" checked="checked" type="radio" value="{{strtotime('+1 day')}}"><span> Tomorrow</span>
                                            </label>
                                            <label class="ui-radio">
                                                <input name="will_donate_on" type="radio" value="{{strtotime('+2 day')}}"><span> After Tomorrow</span>
                                            </label>
                                        </span>
                                        <div class="row m-t-sm">
                                            <div class="col-md-6">
                                                <h5>Will Donate At</h5>
                                                <div class="input-group ui-datepicker">
                                                    <input name="time" required class="form-control timepicker">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Donation Type</h5>
                                                <span class="list-unstyled" style="padding-top: 4px; display: block;">
                                                    @if($bloodRequest->blood_quantity !== $bloodRequest->blood_quantity_confirmed)
                                                        <label class="ui-radio">
                                                            <input name="donation_type" checked="checked" type="radio" value="blood"><span> Blood</span>
                                                        </label>
                                                    @endif
                                                    @if($bloodRequest->platelets_quantity !== $bloodRequest->platelets_quantity_confirmed)
                                                        <label class="ui-radio">
                                                            <input name="donation_type" type="radio" value="platelets"><span> Platelets</span>
                                                        </label>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="pull-right m-t-md">
                                            <button class="btn btn-default m-r-xs" data-dismiss="modal" type="reset">CANCEL</button>
                                            <button class="btn btn-success" type="submit">SAVE</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tabCantDonate">
                                        {!! Form::open(['route' => 'blood-donor-wont-donate', 'method' => 'post']) !!}
                                        <input type="hidden" name="bloodDonorId" id="bloodDonorId"/>
                                        <input type="hidden" name="bloodRequestId" value="{{$bloodRequest->id}}"/>
                                        <br>
                                        <span class="list-unstyled">
                                            <label class="ui-radio">
                                                <input name="delay" checked="checked" type="radio" value="{{strtotime('+1 day')}}"><span> Tomorrow</span>
                                            </label>
                                            <label class="ui-radio">
                                                <input name="delay" type="radio" value="{{strtotime('+2 weeks')}}"><span> 2 Weeks</span>
                                            </label>
                                            <label class="ui-radio">
                                                <input name="delay" type="radio" value="{{strtotime('+3 weeks')}}"><span> 3 Weeks</span>
                                            </label>
                                            <label class="ui-radio">
                                                <input name="delay" type="radio" value="{{strtotime('+1 month')}}"><span> 1 Month</span>
                                            </label>
                                            <label class="ui-radio">
                                                <input name="delay" type="radio" value="{{strtotime('+3 months')}}"><span> 3 Months</span>
                                            </label>
                                            <label class="ui-radio">
                                                <input name="delay" type="radio" value="{{strtotime('+6 months')}}"><span> 6 Months</span>
                                            </label>
                                            <label class="ui-radio">
                                                <input name="delay" type="radio" value="{{strtotime('+1 year')}}"><span> 1 Year</span>
                                            </label>
                                        </span>

                                        <hr/>
                                        
                                        <h5>Donor Notes</h5>
                                        <textarea name="note" class="donor-notes form-control autogrow"></textarea>

                                        <div class="pull-right m-t-md">
                                            <button class="btn btn-default m-r-xs" data-dismiss="modal" type="reset">CANCEL</button>
                                            <button class="btn btn-success" type="submit">SAVE</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function openWillDonate(id) {
            $('#donorId').val(id);
            $('#willDonate').modal('show');
        }

        function openWontDonate(id) {
            $('#bloodDonorId').val(id);
            $('#wontDonate').find(".donor-notes").val($("#donor_notes_" + id).text());
            $('#wontDonate').modal('show');
            
            setTimeout(function() {
                $('#wontDonate').find(".donor-notes").autoGrow();
            }, 200);
        }

    </script>
@endsection
