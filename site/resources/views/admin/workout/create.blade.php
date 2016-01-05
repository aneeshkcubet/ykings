@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Add New Exercise
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/jquery.steps.css') }}">
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Add New Exercise</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Users</li>
        <li class="active">Add New Exercise</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        Add New Exercise
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
                            <form class="form-wizard form-horizontal" action="{{ route('create.exercise') }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <!-- first tab -->
                                <h1>Exercise</h1>

                                <section>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name*</label>
                                        <div class="col-sm-10">
                                            <input id="name" name="name" type="text" placeholder="Name" class="form-control required" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="col-sm-2 control-label">Description *</label>
                                        <div class="col-sm-10">
                                            <input id="description" name="description" type="text" placeholder="Description" class="form-control required" value="{{{ Input::old('description') }}}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="category" class="col-sm-2 control-label">Category *</label>
                                        <div class="col-sm-10">
                                            <input id="category" name="category" placeholder="Category" type="text" class="form-control required " value="{{{ Input::old('category') }}}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="type" class="col-sm-2 control-label">Type *</label>
                                        <div class="col-sm-10">
                                            <input id="type" name="type" type="text" placeholder="Type" class="form-control required" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="rewards" class="col-sm-2 control-label">Rewards *</label>
                                        <div class="col-sm-10">
                                            <input id="rewards" name="rewards" type="text" placeholder="Rewards" class="form-control required" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="repititions" class="col-sm-2 control-label">Repititions *</label>
                                        <div class="col-sm-10">
                                            <input id="repititions" name="repititions" type="text" placeholder="Repititions" class="form-control required" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="duration" class="col-sm-2 control-label">Duration *</label>
                                        <div class="col-sm-10">
                                            <input id="duration" name="duration" type="text" placeholder="Duration" class="form-control required" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="unit" class="col-sm-2 control-label">Unit *</label>
                                        <div class="col-sm-10">
                                            <input id="duration" name="unit" type="text" placeholder="Unit" class="form-control required" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="equipment" class="col-sm-2 control-label">Equipment *</label>
                                        <div class="col-sm-10">
                                            <input id="equipment" name="equipment" type="text" placeholder="Equipment" class="form-control" value="" />
                                        </div>
                                    </div>
                                    
                                    <p>(*) Mandatory</p>

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
<script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/pages/add_user.js') }}"></script>
@stop