@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Add New Workout
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
    <h1>Add New Workout</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.workouts') }}">Workouts</a></li>
        <li class="active">Add New Workout</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="workouts" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        Add New Workout
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="panel-body">

                    <!-- errors -->
                    <div class="has-error">
                    </div>

                    <!--main content-->
                    <div class="row">

                        <div class="col-md-12">

                            <!-- BEGIN FORM WIZARD WITH VALIDATION -->
                            <form class="form-wizard form-horizontal" action="{{ route('admin.workout.postcreate') }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <!-- first tab -->
                                <h1>Basic Details</h1>
                                <section>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name *</label>
                                        <div class="col-sm-10">
                                            <input id="name" name="name" type="text" placeholder="Name" class="form-control required" value="{{{ Input::old('name') }}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <input id="description" name="description" type="text" placeholder="Description" class="form-control" value="{{{ Input::old('description') }}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="rounds" class="col-sm-2 control-label">Rounds *</label>
                                        <div class="col-sm-3">
                                            <select id="unit" name="rounds" class="form-control required">
                                                <option value="">Select unit</option>
                                                <option value="1" @if(Input::old('type') == 1) selected="selected" @endif>1</option>
                                                <option value="2" @if(Input::old('type') == 2) selected="selected" @endif>2</option>
                                                <option value="3" @if(Input::old('type') == 3) selected="selected" @endif>3</option>
                                                <option value="4" @if(Input::old('type') == 4) selected="selected" @endif>4</option>
                                                <option value="5" @if(Input::old('type') == 5) selected="selected" @endif>5</option>
                                                <option value="6" @if(Input::old('type') == 6) selected="selected" @endif>6</option>
                                                <option value="7" @if(Input::old('type') == 7) selected="selected" @endif>7</option>
                                                <option value="8" @if(Input::old('type') == 8) selected="selected" @endif>8</option>
                                            </select>                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="category" class="col-sm-2 control-label">Category *</label>
                                        <div class="col-sm-3">
                                            <select id="category" name="category" class="form-control required">
                                                <option value="">Select a category</option>
                                                <option value="1" @if(Input::old('category') == 1) selected="selected" @endif>Strength</option>
                                                <option value="2" @if(Input::old('category') == 2) selected="selected" @endif>Cardio Strength</option>
                                            </select>                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="type" class="col-sm-2 control-label">Type *</label>
                                        <div class="col-sm-3">
                                            <select id="type" name="type" class="form-control required">
                                                <option value="">Select free/paid</option>
                                                <option value="1" @if(Input::old('type') == 1) selected="selected" @endif>Free</option>
                                                <option value="2" @if(Input::old('type') == 2) selected="selected" @endif>Paid</option>                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="rewards" class="col-sm-2 control-label">Rewards *</label>
                                        <div class="col-sm-3">
                                            <input id="lean-rewards" name="lean-rewards" type="text" placeholder="rewards for lean exercises" class="form-control required number" value="{{{ Input::old('rewards') }}}" />
                                        </div>
                                        <div class="col-sm-3">
                                            <input id="athletic-rewards" name="athletic-rewards" type="text" placeholder="rewards for athletic exercises" class="form-control required number" value="{{{ Input::old('rewards') }}}" />
                                        </div>
                                        <div class="col-sm-3">
                                            <input id="strength-rewards" name="strength-rewards" type="text" placeholder="rewards for strength exercises" class="form-control required number" value="{{{ Input::old('rewards') }}}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="duration" class="col-sm-2 control-label">Duration in Seconds</label>
                                        <div class="col-sm-10">
                                            <input id="duration" name="duration" type="text" placeholder="Duration in seconds" class="form-control number" value="{{{ Input::old('duration') }}}" />
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="equipments" class="col-sm-2 control-label">Equipments (Use Comma separated values)</label>
                                        <div class="col-sm-10">
                                            <input id="equipments" name="equipments" type="text" placeholder="Equipment" class="form-control" value="{{{ Input::old('equipments') }}}" />
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