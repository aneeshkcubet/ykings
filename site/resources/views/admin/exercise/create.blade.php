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
        <li><a href="{{ route('admin.exercises') }}">Exercises</a></li>
        <li class="active">Add New Exercise</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="exercises" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        Add New Exercise
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
                            <form class="form-wizard form-horizontal" action="{{ route('admin.exercise.postcreate') }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <!-- first tab -->
                                <h1>Basic Details</h1>

                                <section>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name*</label>
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
                                        <label for="category" class="col-sm-2 control-label">Category *</label>
                                        <div class="col-sm-3">
                                            <select id="category" name="category" class="form-control required">
                                                <option value="">Select a categoty</option>
                                                <option value="1" @if(Input::old('category') == 1) selected="selected" @endif>Lean</option>
                                                <option value="2" @if(Input::old('category') == 2) selected="selected" @endif>Athletic</option>
                                                <option value="3" @if(Input::old('category') == 3) selected="selected" @endif>Strength</option>
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
                                        <div class="col-sm-10">
                                            <input id="rewards" name="rewards" type="text" placeholder="Rewards" class="form-control required number" value="{{{ Input::old('rewards') }}}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="repititions" class="col-sm-2 control-label">Repititions/Duration *</label>
                                        <div class="col-sm-10">
                                            <input id="repetitions" name="repetitions" type="text" placeholder="Repetitions" class="form-control required number" value="{{{ Input::old('repetitions') }}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="unit" class="col-sm-2 control-label">Unit *</label>
                                        <div class="col-sm-3">
                                            <select id="unit" name="unit" class="form-control required">
                                                <option value="">Select unit</option>
                                                <option value="times" @if(Input::old('type') == "times") selected="selected" @endif>Repetitions</option>
                                                <option value="seconds" @if(Input::old('type') == "seconds") selected="selected" @endif>Seconds</option>                                                
                                            </select>                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="equipment" class="col-sm-2 control-label">Equipment</label>
                                        <div class="col-sm-10">
                                            <input id="equipment" name="equipment" type="text" placeholder="Equipment" class="form-control" value="{{{ Input::old('equipment') }}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="muscle_groups">Select Muscle Groups</label>
                                        <div class="col-sm-4">
                                            <select id="muscle_groups" name="muscle_groups[]" class="form-control" multiple="multiple">
                                                @foreach ($muscleGroups as $mKey => $muscleGroup)
                                                <option value="{{ $muscleGroup->id }}">{{ $muscleGroup->name }}</option>
                                                @endforeach                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <input type="checkbox" name="is_static" > Mark as static
                                        </div>
                                    </div>
                                    
                                    <p>(*) Mandatory</p>
                                </section>

                                <!-- Second tab -->
                                <h1>Media</h1>

                                <section>
                                    <div class="form-group">
                                        <label for="video" class="col-sm-2 control-label">Exercise video</label>
                                        <div class="col-sm-10">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;">
                                                    <img src="http://placehold.it/100x100" alt="Exercise Video">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100px; max-height: 100px;"></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select Video</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input id="video" name="video" MAX_FILESIZE type="file" class="form-control" />
                                                    </span>
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12 control-label">Video Tips</div>
                                        <div class="col-sm-12">
                                            <textarea name="video_tips" placeholder="Type the video tips of this exercise here" id="video_tips" class="form-control">@if(Input::old('video_tips') != '') Input::old('video_tips') @endif</textarea>
                                        </div>
                                    </div>
                                </section>

                                <!-- Third tab -->
                                <h1>Additional Details</h1>                                
                                <section>
                                    <div class="form-group">                                        
                                        <div class="col-sm-12">
                                            <textarea name="range_of_motion" placeholder=" Type the range of motion of this exercise here " id="range_of_motion" class="form-control">@if(Input::old('range_of_motion') != '') Input::old('range_of_motion') @endif</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">                                        
                                        <div class="col-sm-12">
                                            <textarea name="pro_tips" placeholder="Type the pro tips for this exercise here" id="pro_tips" class="form-control">@if(Input::old('pro_tips') != '') Input::old('pro_tips') @endif</textarea>
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
<script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/pages/add_user.js') }}"></script>
@stop