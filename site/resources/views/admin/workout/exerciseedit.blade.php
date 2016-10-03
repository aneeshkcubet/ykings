@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit Workout Exercise - {{  $workoutExercise['exercise']->name }}
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
    <h1>Edit Workout Exercise - {{{  $workoutExercise['exercise']->name }}}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.workouts') }}">Workouts</a></li>
        <li class="active">Edit: {{{  $workoutExercise['exercise']->name }}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        {{{  $workout->name }}} :  {{{  $workoutExercise['exercise']->name }}}
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
                            <form class="form-wizard form-horizontal" action="{{ route('admin.workout.workoutexercise.postedit', $workoutExercise->id) }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="workout_id" value="{{ $workout->id }}" />
                                <input type="hidden" name="workout_exercise_id" value="{{ $workoutExercise->id }}" />

                                <!-- first tab -->
                                <h1>Edit</h1>
                                <section>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Exercise *</label>
                                        <div class="col-sm-3">
                                            <select id="exercise_id" name="exercise_id" class="form-control required">
                                                <option value="">Select an exercise</option>
                                                @foreach($exercises as $eKey => $exercise)
                                                <option value="{{$exercise->id}}" @if(Input::old('exercise_id', $workoutExercise->exercise_id) == $exercise->id) selected="selected" @endif>{{$exercise->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="category" class="col-sm-2 control-label">Category *</label>
                                        <div class="col-sm-3">
                                            <select id="category" name="category" class="form-control required">
                                                <option value="">Select a category</option>
                                                <option value="1" @if(Input::old('category', $workoutExercise->category) == 1) selected="selected" @endif>Strength Endurance</option>
                                                <option value="2" @if(Input::old('category', $workoutExercise->category) == 2) selected="selected" @endif>Speed Strength</option>
                                                <option value="3" @if(Input::old('category', $workoutExercise->category) == 3) selected="selected" @endif>Absolute Strength</option>
                                            </select>                                            
                                        </div>
                                    </div>
                                    @if($workout->is_repsandsets == 0)
                                    <div class="form-group">
                                        <label for="round" class="col-sm-2 control-label">Round *</label>                                        
                                        <div class="col-sm-3">
                                            <input type="text" id="round" name="round" class="form-control required" value="{{Input::old('round', $workoutExercise->round)}}" />                                       
                                        </div>
                                    </div>
                                    @else
                                    <input type="hidden" name="round" value="1" />
                                    @endif
                                    <div class="form-group">
                                        <label for="repititions" class="col-sm-2 control-label">Repetitions / Duration *</label>                                        
                                        <div class="col-sm-3">
                                            <input type="text" name='repititions' id='repititions' placeholder="Repetitions/Duration" class="form-control required" value="{{Input::old('repitations', $workoutExercise->repititions)}}" />                                          
                                        </div>
                                    </div>
                                    @if($workout->is_repsandsets == 1)
                                    <div class="form-group">
                                        <label for="sets" class="col-sm-2 control-label">Sets *</label>                                        
                                        <div class="col-sm-3">
                                            <input type="text" name='sets' id='sets' placeholder="Sets" class="form-control required" value="{{Input::old('sets', $workoutExercise->sets)}}" />                                          
                                        </div>
                                    </div>
                                    @else
                                    <input type="hidden" name="sets" value="0" />
                                    @endif
                                    <p>(*) Mandatory</p>
                                </section>
                            </form>
                        </div>
                    </div>

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