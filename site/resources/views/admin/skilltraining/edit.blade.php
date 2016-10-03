@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit Skilltraining - {{  $skilltraining->name }}
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
    <h1>Edit Skilltraining - {{{  $skilltraining->name }}}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.skilltrainings') }}">Skilltrainings</a></li>
        <li class="active">Edit: {{{  $skilltraining->name }}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        {{{  $skilltraining->name }}} 
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
                                                        <form class="form-wizard form-horizontal" action="{{ route('admin.skilltraining.postedit', $skilltraining->id) }}" method="POST" id="wizard" enctype="multipart/form-data">
                                                            <!-- CSRF Token -->
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                                            <!-- first tab -->
                                                            <!-- first tab -->
                                                            <h1>Basic Details</h1>
                                                            <section>
                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 control-label">Name *</label>
                                                                    <div class="col-sm-10">
                                                                        <input id="name" name="name" type="text" placeholder="Name" class="form-control required" value="{{{ Input::old('name', $skilltraining->name) }}}" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="description" class="col-sm-2 control-label">Description</label>
                                                                    <div class="col-sm-10">
                                                                        <input id="description" name="description" type="text" placeholder="Description" class="form-control" value="{{{ Input::old('description',$skilltraining->description) }}}" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="rewards" class="col-sm-2 control-label">Rewards *</label>

                                                                    <div class="col-sm-3">Lean</div>
                                                                    <div class="col-sm-3">Athletic</div>
                                                                    <div class="col-sm-3">Strength</div>
                                                                    <?php
                                                                    $rewardsArray = json_decode($skilltraining->rewards);
//                                                                    print_r($rewardsArray);
//                                                                    die;

                                                                    ?>
                                                                    <div class="col-sm-3">
                                                                        <input id="lean-rewards" name="lean-rewards" type="text" placeholder="rewards for Strength Endurance exercises" class="form-control required number" value="{{{ Input::old('lean-rewards', $rewardsArray->lean) }}}" />
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <input id="athletic-rewards" name="athletic-rewards" type="text" placeholder="rewards for Speed Strength exercises" class="form-control required number" value="{{{ Input::old('athletic-rewards', $rewardsArray->athletic) }}}" />
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <input id="strength-rewards" name="strength-rewards" type="text" placeholder="rewards for Absolute Strength exercises" class="form-control required number" value="{{{ Input::old('strength-rewards', $rewardsArray->strength) }}}" />
                                                                    </div>
                                                                </div>                                  
                                                                <div class="form-group">
                                                                    <label for="equipments" class="col-sm-2 control-label">Equipments</label>
                                                                    <div class="col-sm-10">
                                                                        <input id="equipments" name="equipments" type="text" placeholder="Equipment" class="form-control required" value="{{{ Input::old('equipments', $skilltraining->equipments) }}}" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-4 col-sm-offset-2">
                                                                        <input type="checkbox" name="is_circuit" @if(Input::old('is_circuit') == 'on' || $skilltraining->is_circuit == 1)checked="" @endif> Check if Circuit Training
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
                                                        <div class="col-sm-6">                                                            
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped" id="users">
                                                                    <thead>
                                                                    <th width='50%'>Name</th>
                                                                    <th width='20%'>Reps</th>
                                                                    <th width='15%'>Sets</th>
                                                                    <th width='15%'>Actions</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($exercises['lean'] as $eKey => $exercise)
                                                                        <tr>
                                                                            <td><a href="{{ route('admin.exercise.show', $exercise->exercise_id) }}">{{$exercise['exercise']->name}}</a></td>
                                                                            <td>
                                                                                @if($exercise->unit == 'times')
                                                                                {{$exercise->repititions}} Reps
                                                                                @else
                                                                                {{$exercise->repititions}} Seconds
                                                                                @endif
                                                                            </td>
                                                                            <td>                                                                            
                                                                                {{$exercise->sets}}                            
                                                                            </td>
                                                                            <td>
                                                                                <a href="{{ route('admin.skilltraining.skilltrainingexercise.edit', $exercise->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Update Exercise"></i></a>
                                                                                <a href="{{ route('admin.skilltraining.skilltrainingexercise.delete', $exercise->id) }}">
                                                                                    <i class="livicon" data-name="exercise-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Remove this exercise.">
                                                                                    </i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>                                                                    
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <a href="{{ route('admin.skilltraining.skilltrainingexercise.create', $skilltraining->id) }}" class="btn btn-primary">Add more exercises to {{$skilltraining->name}}</a>
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
                                                        <div class="col-sm-6">                                                            
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped" id="users">
                                                                    <thead>
                                                                    <th width='50%'>Name</th>
                                                                    <th width='20%'>Reps</th>
                                                                    <th width='15%'>Sets</th>
                                                                    <th width='15%'>Actions</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($exercises['athletic'] as $eKey => $exercise)
                                                                        <tr>
                                                                            <td><a href="{{ route('admin.exercise.show', $exercise->exercise_id) }}">{{$exercise['exercise']->name}}</a></td>
                                                                            <td>
                                                                                @if($exercise->unit == 'times')
                                                                                {{$exercise->repititions}} Reps
                                                                                @else
                                                                                {{$exercise->repititions}} Seconds
                                                                                @endif
                                                                            </td>
                                                                            <td>                                                                            
                                                                                {{$exercise->sets}}                            
                                                                            </td>
                                                                            <td>
                                                                                <a href="{{ route('admin.skilltraining.skilltrainingexercise.edit', $exercise->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Update Exercise"></i></a>
                                                                                <a href="{{ route('admin.skilltraining.skilltrainingexercise.delete', $exercise->id) }}">
                                                                                    <i class="livicon" data-name="exercise-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Remove this exercise.">
                                                                                    </i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>                                                                    
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <a href="{{ route('admin.skilltraining.skilltrainingexercise.create', $skilltraining->id) }}" class="btn btn-primary">Add more exercises to {{$skilltraining->name}}</a>
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
                                                        <div class="col-sm-6">                                                            
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped" id="users">
                                                                    <thead>
                                                                    <th width='50%'>Name</th>
                                                                    <th width='20%'>Reps</th>
                                                                    <th width='15%'>Sets</th>
                                                                    <th width='15%'>Actions</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($exercises['strength'] as $eKey => $exercise)
                                                                        <tr>
                                                                            <td><a href="{{ route('admin.exercise.show', $exercise->exercise_id) }}">{{$exercise['exercise']->name}}</a></td>
                                                                            <td>
                                                                                @if($exercise->unit == 'times')
                                                                                {{$exercise->repititions}} Reps
                                                                                @else
                                                                                {{$exercise->repititions}} Seconds
                                                                                @endif
                                                                            </td>
                                                                            <td>                                                                            
                                                                                {{$exercise->sets}}                            
                                                                            </td>
                                                                            <td>
                                                                                <a href="{{ route('admin.skilltraining.skilltrainingexercise.edit', $exercise->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Update Exercise"></i></a>
                                                                                <a href="{{ route('admin.skilltraining.skilltrainingexercise.delete', $exercise->id) }}">
                                                                                    <i class="livicon" data-name="exercise-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Remove this exercise.">
                                                                                    </i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>                                                                    
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <a href="{{ route('admin.skilltraining.skilltrainingexercise.create', $skilltraining->id) }}" class="btn btn-primary">Add more exercises to {{$skilltraining->name}}</a>
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