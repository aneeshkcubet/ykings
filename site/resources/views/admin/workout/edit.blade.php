@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit Workout - {{  $workout->name }}
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
    <h1>Edit Workout - {{{  $workout->name }}}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.workouts') }}">Workouts</a></li>
        <li class="active">Edit: {{{  $workout->name }}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        {{{  $workout->name }}} 
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <!--main content-->
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav  nav-tabs ">
                                <li class="active">
                                    <a href="#tab1" data-toggle="tab"> 
                                        Basic Details
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab"> 
                                        Strength Endurance Exercises
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle="tab"> 
                                        Speed Strength Exercises
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab4" data-toggle="tab"> 
                                        Absolute Strength Exercises
                                    </a>
                                </li>
                            </ul>

                            <div  class="tab-content mar-top">
                                <div id="tab1" class="tab-pane fade active in">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel">
                                                <div class="panel-body">
                                                    <!-- BEGIN FORM WITH VALIDATION -->
                                                    <div class="table-responsive">
                                                        <form class="form-wizard form-horizontal" action="{{ route('admin.workout.postedit', $workout->id) }}" method="POST" id="wizard" enctype="multipart/form-data">
                                                            <!-- CSRF Token -->
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                                            <!-- first tab -->
                                                            <!-- first tab -->
                                                            <h1>Basic Details</h1>
                                                            <section>
                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 control-label">Name *</label>
                                                                    <div class="col-sm-10">
                                                                        <input id="name" name="name" type="text" placeholder="Name" class="form-control required" value="{{{ Input::old('name', $workout->name) }}}" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="description" class="col-sm-2 control-label">Description</label>
                                                                    <div class="col-sm-10">
                                                                        <input id="description" name="description" type="text" placeholder="Description" class="form-control" value="{{{ Input::old('description',$workout->description) }}}" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="rounds" class="col-sm-2 control-label">Rounds *</label>
                                                                    <div class="col-sm-3">
                                                                        <select id="unit" name="rounds" class="form-control required">
                                                                            <option value="">Select Rounds</option>
                                                                            <option value="1" @if(Input::old('rounds', $workout->rounds) == 1) selected="selected" @endif>1</option>
                                                                            <option value="2" @if(Input::old('rounds', $workout->rounds) == 2) selected="selected" @endif>2</option>
                                                                            <option value="3" @if(Input::old('rounds', $workout->rounds) == 3) selected="selected" @endif>3</option>
                                                                            <option value="4" @if(Input::old('rounds', $workout->rounds) == 4) selected="selected" @endif>4</option>
                                                                            <option value="5" @if(Input::old('rounds', $workout->rounds) == 5) selected="selected" @endif>5</option>
                                                                            <option value="6" @if(Input::old('rounds', $workout->rounds) == 6) selected="selected" @endif>6</option>
                                                                            <option value="7" @if(Input::old('rounds', $workout->rounds) == 7) selected="selected" @endif>7</option>
                                                                            <option value="8" @if(Input::old('rounds', $workout->rounds) == 8) selected="selected" @endif>8</option>
                                                                        </select>                                            
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="category" class="col-sm-2 control-label">Category *</label>
                                                                    <div class="col-sm-3">
                                                                        <select id="category" name="category" class="form-control required">
                                                                            <option value="">Select a category</option>
                                                                            <option value="1" @if(Input::old('category', $workout->category) == 1) selected="selected" @endif>Strength</option>
                                                                            <option value="2" @if(Input::old('category', $workout->category) == 2) selected="selected" @endif>HIIT Strength</option>
                                                                        </select>                                            
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="type" class="col-sm-2 control-label">Type *</label>
                                                                    <div class="col-sm-3">
                                                                        <select id="type" name="type" class="form-control required">
                                                                            <option value="">Select free/paid</option>
                                                                            <option value="1" @if(Input::old('type', $workout->type) == 1) selected="selected" @endif>Free</option>
                                                                            <option value="2" @if(Input::old('type', $workout->type) == 2) selected="selected" @endif>Paid</option>                                                
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="rewards" class="col-sm-2 control-label">Rewards *</label>

                                                                    <div class="col-sm-3">Strength Endurance</div>
                                                                    <div class="col-sm-3">Speed Strength</div>
                                                                    <div class="col-sm-3">Absolute Strength</div>
                                                                    <?php
                                                                    $rewardsArray = json_decode($workout->rewards);
//                                                                    print_r($rewardsArray);
//                                                                    die;

                                                                    ?>
                                                                    <div class="col-sm-3">
                                                                        <input id="lean-rewards" name="lean-rewards" type="text" placeholder="rewards for lean exercises" class="form-control required number" value="{{{ Input::old('lean-rewards', $rewardsArray->lean) }}}" />
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <input id="athletic-rewards" name="athletic-rewards" type="text" placeholder="rewards for athletic exercises" class="form-control required number" value="{{{ Input::old('athletic-rewards', $rewardsArray->athletic) }}}" />
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <input id="strength-rewards" name="strength-rewards" type="text" placeholder="rewards for strength exercises" class="form-control required number" value="{{{ Input::old('strength', $rewardsArray->strength) }}}" />
                                                                    </div>
                                                                </div>                                  
                                                                <div class="form-group">
                                                                    <label for="equipments" class="col-sm-2 control-label">Equipments</label>
                                                                    <div class="col-sm-10">
                                                                        <input id="equipments" name="equipments" type="text" placeholder="Equipment" class="form-control required" value="{{{ Input::old('equipments', $workout->equipments) }}}" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="type" class="col-sm-2 control-label">Is Reps & Sets *</label>
                                                                    <div class="col-sm-3">
                                                                        <select id="type" name="is_repsandsets" class="form-control required">
                                                                            <option value="">Select No/Yes</option>
                                                                            <option value="0" @if(Input::old('is_repsandsets', $workout->is_repsandsets) == 0) selected="selected" @endif>No</option>
                                                                            <option value="1" @if(Input::old('is_repsandsets', $workout->is_repsandsets) == 1) selected="selected" @endif>Yes</option>                                                
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <p>(*) Mandatory</p>
                                                            </section>
                                                        </form>
                                                    </div>
                                                    <!-- END FORM WITH VALIDATION -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab2" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        @foreach ($exercises['lean'] as $eKey => $workoutExercise)
                                                        <div class="col-sm-6">
                                                            <h3>{{ucfirst($eKey)}}</h3>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped" id="users">
                                                                    <thead>
                                                                    <th width='40%'>Exercices</th>
                                                                    <th width='30%'>Value</th>
                                                                    @if($workout->is_repsandsets == 1)<th width='15%'>Sets</th>@endif
                                                                    <th width='15%'>Actions</th>
                                                                    </thead>
                                                                    @foreach($workoutExercise as $wKey => $exercise)
                                                                    <tr>
                                                                        <td><a href="{{ route('admin.exercise.show', $exercise->exercise_id) }}">{{$exercise['exercise']->name}}</a></td>
                                                                        <td>
                                                                            @if($exercise->unit == 'times')
                                                                            {{$exercise->repititions}} Reps
                                                                            @else
                                                                            {{$exercise->repititions}} Seconds
                                                                            @endif
                                                                        </td>
                                                                        @if($workout->is_repsandsets == 1)
                                                                        <td width='15%'>
                                                                            {{$exercise->sets}}
                                                                        </td>
                                                                        @endif
                                                                        <td>
                                                                            <a href="{{ route('admin.workout.workoutexercise.edit', $exercise->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Update Exercise"></i></a>
                                                                            <a href="{{ route('admin.workout.workoutexercise.delete', $exercise->id) }}">
                                                                                <i class="livicon" data-name="exercise-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Remove this exercise.">
                                                                                </i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach 
                                                                </table>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <a href="{{ route('admin.workout.workoutexercise.create', $workout->id) }}" class="btn btn-primary">Add more exercises to {{$workout->name}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab3" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        @foreach ($exercises['athletic'] as $eKey => $workoutExercise)
                                                        <div class="col-sm-6">
                                                            <h3>{{ucfirst($eKey)}}</h3>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped" id="users">
                                                                    <thead>
                                                                    <th width='50%'>Exercices</th>
                                                                    <th width='35%'>Value</th>
                                                                    @if($workout->is_repsandsets == 1)<th width='15%'>Sets</th>@endif
                                                                    <th width='15%'>Actions</th>
                                                                    </thead>
                                                                    @foreach($workoutExercise as $wKey => $exercise)
                                                                    <tr>
                                                                        <td><a href="{{ route('admin.exercise.show', $exercise->exercise_id) }}">{{$exercise['exercise']->name}}</a></td>
                                                                        <td>
                                                                            @if($exercise->unit == 'times')
                                                                            {{$exercise->repititions}} Reps
                                                                            @else
                                                                            {{$exercise->repititions}} Seconds
                                                                            @endif
                                                                        </td>
                                                                        @if($workout->is_repsandsets == 1)<td width='15%'>{{$exercise->sets}}</td>@endif
                                                                        <td>
                                                                            <a href="{{ route('admin.workout.workoutexercise.edit', $exercise->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Update Exercise"></i></a>
                                                                            <a href="{{ route('admin.workout.workoutexercise.delete', $exercise->id) }}">
                                                                                <i class="livicon" data-name="exercise-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Remove this exercise.">
                                                                                </i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach 
                                                                </table>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <a href="{{ route('admin.workout.workoutexercise.create', $workout->id) }}" class="btn btn-primary">Add more exercises to {{$workout->name}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab4" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        @foreach ($exercises['strength'] as $eKey => $workoutExercise)
                                                        <div class="col-sm-6">
                                                            <h3>{{ucfirst($eKey)}}</h3>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped" id="users">
                                                                    <thead>
                                                                    <th width='50%'>Exercices</th>
                                                                    <th width='35%'>Value</th>
                                                                    @if($workout->is_repsandsets == 1)<th width='15%'>Sets</th>@endif
                                                                    <th width='15%'>Actions</th>
                                                                    </thead>
                                                                    @foreach($workoutExercise as $wKey => $exercise)
                                                                    <tr>
                                                                        <td><a href="{{ route('admin.exercise.show', $exercise->exercise_id) }}">{{$exercise['exercise']->name}}</a></td>
                                                                        <td>
                                                                            @if($exercise->unit == 'times')
                                                                            {{$exercise->repititions}} Reps
                                                                            @else
                                                                            {{$exercise->repititions}} Seconds
                                                                            @endif                                                           
                                                                        </td>
                                                                        @if($workout->is_repsandsets == 1)<td width='15%'>{{$exercise->sets}}</td>@endif
                                                                        <td>
                                                                            <a href="{{ route('admin.workout.workoutexercise.edit', $exercise->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Update Exercise"></i></a>
                                                                            <a href="{{ route('admin.workout.workoutexercise.delete', $exercise->id) }}">
                                                                                <i class="livicon" data-name="exercise-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Remove this exercise.">
                                                                                </i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach 
                                                                </table>
                                                            </div>
                                                        </div>
                                                        @endforeach                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <a href="{{ route('admin.workout.workoutexercise.create', $workout->id) }}" class="btn btn-primary">Add more exercises to {{$workout->name}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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