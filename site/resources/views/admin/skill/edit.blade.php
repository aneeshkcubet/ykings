@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit Skill - {{  $skill['exercise']->name }}
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
    <h1>Edit Skill - {{{  $skill['exercise']->name }}}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.skills') }}">Skills</a></li>
        <li class="active">Edit: {{{  $skill['exercise']->name }}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        {{{  $skill['exercise']->name }}} 
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="panel-body">

                    <!--main content-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN FORM WIZARD WITH VALIDATION -->
                            <form class="form-wizard form-horizontal" action="{{ route('admin.skill.postedit', $skill->id) }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <!-- first tab -->
                                <!-- first tab -->
                                <h1>Basic Details</h1>

                                <section>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="progression_id">Select Progression *</label>
                                        <div class="col-sm-4">
                                            <select id="progression_id" name="progression_id" class="form-control required" readonly>
                                                @foreach ($progressions as $mKey => $progression)
                                                <option @if(Input::old('progression_id', $skill->progression_id) == $progression->id) selected="selected" @endif value="{{ $progression->id }}">{{ $progression->name }}</option>
                                                @endforeach                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="exercise_id">Select Exercise *</label>
                                        <div class="col-sm-4">
                                            <select id="exercise_id" name="exercise_id" class="form-control required">
                                                @foreach ($exercises as $mKey => $exercise)
                                                <option @if(Input::old('exercise_id', $skill->exercise_id) == $exercise->id) selected="selected" @endif value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                                                @endforeach                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="exercise_id">Description</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="{{Input::old('description', $skill->description)}}" name="description" id="description" placeholder="Enter description of this skill here" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="level" class="col-sm-2 control-label">Level *</label>
                                        <div class="col-sm-4">
                                            <select id="level" name="level" class="form-control required" readonly>
                                                <option value="">Select Level of Progression</option>
                                                <option value="1" @if(Input::old('level', $skill->level) == 1) selected="selected" @endif>1</option>
                                                <option value="2" @if(Input::old('level', $skill->level) == 2) selected="selected" @endif>2</option>
                                                <option value="3" @if(Input::old('level', $skill->level) == 3) selected="selected" @endif>3</option>
                                                <option value="4" @if(Input::old('level', $skill->level) == 4) selected="selected" @endif>4</option>
                                                <option value="5" @if(Input::old('level', $skill->level) == 5) selected="selected" @endif>5</option>                                                
                                            </select>                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="level" class="col-sm-2 control-label">Row *</label>
                                        <div class="col-sm-4">
                                            <select id="row" name="row" class="form-control required" readonly>
                                                <option value="">Select Row in Progression</option>
                                                <option value="1" @if(Input::old('row', $skill->row) == 1) selected="selected" @endif>1</option>
                                                <option value="2" @if(Input::old('row', $skill->row) == 2) selected="selected" @endif>2</option>
                                                <option value="3" @if(Input::old('row', $skill->row) == 3) selected="selected" @endif>3</option>
                                                <option value="4" @if(Input::old('row', $skill->row) == 4) selected="selected" @endif>4</option>
                                                <option value="5" @if(Input::old('row', $skill->row) == 5) selected="selected" @endif>5</option>
                                            </select>                                            
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