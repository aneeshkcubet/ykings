@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit User - {{ $tUser['profile'][0]['first_name'] }} {{ $tUser['profile'][0]['last_name'] }}
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/jquery.steps.css') }}">
<link href="{{ asset('assets/vendors/bootstrapdatepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" media="screen" />
<!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Edit user - {{ $tUser['profile'][0]['first_name'] }} {{ $tUser['profile'][0]['last_name'] }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.users') }}">Users</a></li>
        <li class="active">Edit : {{ $tUser['profile'][0]['first_name'] }} {{ $tUser['profile'][0]['last_name'] }}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        Edit: {{{  $tUser['profile'][0]['first_name']}}} {{{ $tUser['profile'][0]['last_name']}}}
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="panel-body">

                    <!-- errors -->
                    <div class="has-error">
                        {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                        {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                        {!! $errors->first('group', '<span class="help-block">:message</span>') !!}
                        {!! $errors->first('pic', '<span class="help-block">:message</span>') !!}
                    </div>

                    <!--main content-->
                    <div class="row">

                        <div class="col-md-12">

                            <!-- BEGIN FORM WIZARD WITH VALIDATION -->
                            <form class="form-wizard form-horizontal" action="{{ route('admin.user.postedit', $tUser->id) }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <!-- first tab -->
                                <h1>User Profile</h1>
                                <section>
                                    <div class="form-group">
                                        <label for="first_name" class="col-sm-3 control-label">First Name *</label>
                                        <div class="col-sm-9">
                                            <input id="first_name" name="first_name" type="text" placeholder="First Name" class="form-control required" value="{{{ Input::old('first_name',$tUser['profile'][0]['first_name']) }}}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="last_name" class="col-sm-3 control-label">Last Name *</label>
                                        <div class="col-sm-9">
                                            <input id="last_name" name="last_name" type="text" placeholder="Last Name" class="form-control required" value="{{{ Input::old('last_name', $tUser['profile'][0]['last_name']) }}}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-sm-3 control-label">Email *</label>
                                        <div class="col-sm-9">
                                            <input id="email" name="email" readonly="" placeholder="E-Mail" type="text" class="form-control required" value="{{{ Input::old('email', $tUser->email) }}}" />
                                        </div>
                                    </div>
                                    @if($tUser['is_admin'] == 1)
                                    <div class="form-group">
                                        <label for="last_name" class="col-sm-3 control-label">Password</label>
                                        <div class="col-sm-9">
                                            <input id="password" name="password" type="password" placeholder="Password" class="form-control" value="{{{ Input::old('password') }}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="col-sm-3 control-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                            <input id="password_confirm" name="password_confirm" type="password" placeholder="Confirm Password" class="form-control" value="{{{ Input::old('password_confirm') }}}" />
                                        </div>
                                    </div>
                                    @endif
                                    <p>(*) Mandatory</p>
                                </section>
                                <!-- second tab -->
                                <h1>Bio</h1>
                                <section>
                                    <div class="form-group">
                                        <label for="pic" class="col-sm-3 control-label">Profile picture</label>
                                        <div class="col-sm-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                    @if($tUser['profile'][0]['image'] )
                                                    <img src="{{{ url('/').'/uploads/images/profile/original/'.$tUser['profile'][0]['image'] }}}" alt="profile pic">
                                                    @else
                                                    <img src="http://placehold.it/200x200" alt="profile pic">
                                                    @endif
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input id="pic" name="image" type="file" class="form-control" />
                                                    </span>
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- third tab -->
                                <h1>Address</h1>
                                <section>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-3 control-label">Gender</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" title="Select Gender..." name="gender">
                                                <option value="">Select</option>
                                                <option value="1" @if($tUser['profile'][0]['gender'] === '1') selected="selected" @endif >Male</option>
                                                <option value="2" @if($tUser['profile'][0]['gender'] === '2') selected="selected" @endif >Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="country" class="col-sm-3 control-label">Country</label>
                                        <div class="col-sm-9">
                                            <select id="country" name="country" class="form-control">
                                                @foreach ($countries as $country => $code)
                                                <option value="{{ $code->name }}" @if($tUser['profile'][0]['country'] == $code->name || Input::old('country') === $code->name) selected="selected" @endif>{{ $code->name }}</option>
                                                @endforeach             
                                            </select>                                            
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="state" class="col-sm-3 control-label">State</label>
                                        <div class="col-sm-9">
                                            <input id="state" name="state" type="text" class="form-control" value="{{{ Input::old('state',  $tUser['profile'][0]['state']) }}}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="city" class="col-sm-3 control-label">City</label>
                                        <div class="col-sm-9">
                                            <input id="city" name="city" type="text" class="form-control" value="{{{ Input::old('city', $tUser['profile'][0]['city']) }}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subscription_start_date" class="col-sm-3 control-label">Subscription Start Date</label>
                                        <div class="date form_datetime col-sm-8">
                                            @if($tUser->subscription_start_date > 0)
                                            <input placeholder="yyyy/mm/dd" class="form-control" size="16" type="text" value="{{{ Input::old('subscription_start_date', $tUser->subscription_start_date) }}}" name="subscription_start_date" readonly>
                                            @else
                                            <input placeholder="yyyy/mm/dd" class="form-control" size="16" type="text" value="{{{ Input::old('subscription_start_date') }}}" name="subscription_start_date" readonly>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subscription_end_date" class="col-sm-3 control-label">Subscription End Date</label>
                                        <div class="date form_datetime col-sm-8">
                                            @if($tUser->subscription_end_date > 0)
                                            <input placeholder="yyyy/mm/dd" class="form-control" size="16" type="text" value="{{{ Input::old('subscription_end_date', $tUser->subscription_end_date) }}}" name="subscription_end_date" readonly>
                                            @else
                                            <input placeholder="yyyy/mm/dd" class="form-control" size="16" type="text" value="{{{ Input::old('subscription_end_date') }}}" name="subscription_end_date" readonly>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <input type="checkbox" name="is_admin" class="flat-red" @if($tUser['is_admin'] == 1 || Input::old('is_admin') == 'on')checked="" @endif /> Check here to add as Administrator.
                                        </div>
                                    </div>
                                </section>

                            </form>
                            <!-- END FORM WIZARD WITH VALIDATION --> 
                        </div>
                    </div>
                    <!--main content end--> 
                </div>
            </div>
        </div>
    </div>
    <!--row end-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.steps.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrapdatepicker/js/bootstrap-datepicker.min.js') }}" charset="UTF-8"></script>
<script src="{{ asset('assets/js/pages/add_user.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('.form_datetime input').datepicker({
        format: "yyyy/mm/dd",
        weekStart: 1,
        startDate: today,
        clearBtn: true,
        orientation: "bottom left",
        autoclose: true
    });
});
</script>
@stop