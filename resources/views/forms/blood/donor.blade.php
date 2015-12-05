<span data-ng-controller="locationFormCtrl">
<div class="form-group">
    <label for="">First Name</label>
    {!! Form::text('first_name', old('first_name'), ['class' =>
    'form-control','pattern'=>'.{2,}','required'=>'true','title'=>'2 characters minimum']) !!}
</div>
<div class="form-group">
    <label for="">Last Name </label>
    {!! Form::text('last_name', old('last_name'), ['class' =>
    'form-control','pattern'=>'.{2,}','required'=>'true','title'=>'2 characters minimum']) !!}
</div>
<div class="form-group">
    <label for="">Blood Type</label>
    {!! Form::select('blood_type_id',$bloodTypes,
    old('blood_type_id'), ['class' => 'form-control']) !!}
</div>
<div class="form-group" data-ng-controller="DatepickerCtrl">
    <label for="">Birth Date</label>

    <div class="input-group ui-datepicker">
        {!! Form::text('birthday', old('birthday'), [
        'class' => 'form-control',
        'id'=>'datepicker',
        'datepicker-popup'=>'yyyy-M-dd',
        'ng-model'=>'dt',
        'ng-value'=> old('birthday'),
        'is-open'=>'opened',
        'datepicker-options'=>'dateOptions',
        'date-disabled'=>'disabled(date, mode)',
        'ng-required'=>'true',
        'close-text'=>'Close',
        ]) !!}

        <span class="input-group-addon" ng-click="open($event)"><i class="fa fa-calendar"></i></span>
    </div>
</div>
<div class="form-group">
    <label for="">Email</label>
    {!! Form::email('email', old('email') , ['class' => 'form-control']) !!}

    <span></span>
</div>
<div class="form-group">
    <label for="">Phone Primary</label>
    {!! Form::text(
    'phone_primary',old('phone_number'),['class'=>'form-control','pattern'=>'.{8,8}','required'=>true,'title'=>'The
    number should contain 8 digits']) !!}
    <span></span>
</div>
<div class="form-group">
    <label for="">Phone Secondary</label>
    {!! Form::text(
    'phone_secondary',old('phone_secondary'),['class'=>'form-control','pattern'=>'.{8,8}','title'=>'The number
    should contain 8 digits']) !!}
</div>
<div class="form-group">
    <label for="">Male</label>
    {!! Form::radio('gender', 'male', true); !!}
    &nbsp;&nbsp;
    <label for="">Female</label>
    {!! Form::radio('gender', 'female', false); !!}
</div>
<hr/>
    {{--Location Field--}}
    @include('partials.location')
    {{--End Location Field--}}
    <div class="form-group">
        <div class="ui-map" id="map-canvas"></div>
    </div>
<hr/>
<div class="form-group" data-ng-controller="DonateDatepickerCtrl">
    <label for="">Can't Donate before</label>
    <small>Make sure you know what you are doing.</small>

    <div class="input-group ui-datepicker">
        {!! Form::text('incapable_till', old('incapable_till'), [
        'class' => 'form-control',
        'id'=>'donordatepicker',
        'datepicker-popup'=>'yyyy-M-dd',
        'ng-model'=>'dt',
        'ng-value'=> old('incapable_till'),
        'is-open'=>'opened',
        'datepicker-options'=>'dateOptions',
        'date-disabled'=>'disabled(date, mode)',
        'ng-required'=>'false',
        'close-text'=>'Close',
        ]) !!}

        <span class="input-group-addon" ng-click="open($event)"><i class="fa fa-calendar"></i></span>
    </div>
</div>
<button type="submit" class="btn btn-success">
    Save
</button>
<button class="btn btn-default" type="reset">Revert Changes
</button>
</span>