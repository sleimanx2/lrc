@extends('layouts.master')

@section('sub-header')
<div class="clearfix">
    <h5 class="page-title">Edit Blood Request</h5>
</div>
@endsection

@section('content')
    <div class="page page-form ng-scope">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 ng-scope">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::model($bloodRequest,['route'=>['blood-request-update',$bloodRequest->id],'name'=>'blood_request_edit_form']) !!}
                            @include('forms.blood.request')
                        {!! Form::close() !!}

                        <hr/>
                        
                        <div class="col-md-6">
                            <a href="{{ route('blood-request-rescue',[$bloodRequest->id]) }}" class="btn btn-success btn-block"><i class="fa fa-life-ring"></i> Rescue this Request</a>
                        </div>
                        
                        <div class="col-md-6">
                            {!! Form::open([
                                'method'=>'delete',
                                'route'=>['blood-request-destroy',$bloodRequest->id],
                                'style'=>'display:inline',
                                'onsubmit'=>'return confirm("Are you sure you want to delete '. $bloodRequest->patient_name.'\'s request?");'
                            ]) !!}

                            <button type="submit" class="btn btn-danger btn-block" popover="Delete" popover-trigger="mouseenter"><i class="fa fa-remove"></i> Delete this Request</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
