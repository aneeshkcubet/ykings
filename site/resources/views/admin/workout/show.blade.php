@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
View Workout - {{ $workout->name }}
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet" type="text/css"/>
<link href="http://vjs.zencdn.net/5.0.2/video-js.css" rel="stylesheet">
<style>
    .video-js .vjs-big-play-button{
        top:45% !important;
        left:43% !important;
    }
</style>
<!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>View Workout</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.workouts') }}">Workouts</a></li>
        <li class="active">{{ $workout->name }}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav  nav-tabs ">
                <li class="active">
                    <a href="#tab1" data-toggle="tab"> 
                        Basic Details
                    </a>
                </li>
                <li>
                    <a href="#tab2" data-toggle="tab"> 
                        Lean Exercises
                    </a>
                </li>
                <li>
                    <a href="#tab3" data-toggle="tab"> 
                        Athletic Exercises
                    </a>
                </li>
                <li>
                    <a href="#tab3" data-toggle="tab"> 
                        Strength Exercises
                    </a>
                </li>
            </ul>
            <div  class="tab-content mar-top">
                <div id="tab1" class="tab-pane fade active in">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <form method="post" action="#">
                                            <table class="table table-bordered table-striped" id="users">
                                                <thead>
                                                <th width='20%'>Field</th>
                                                <th>Value</th>
                                                </thead>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>
                                                        {{ $workout->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td>
                                                        {{ $workout->description }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rounds</td>
                                                    <td>
                                                        {{ $workout->rounds }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Category</td>
                                                    <td>
                                                        @if($workout->category == 1)
                                                        Strength
                                                        @elseif($workout->category == 2)                                                        
                                                        Cardio Strength
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Type
                                                    </td>
                                                    <td>
                                                        @if($workout->type == 1)
                                                        Free
                                                        @elseif($workout->type == 2)
                                                        Paid
                                                        @else
                                                        @endif

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rewards</td>
                                                    <td><?php
                                                        $rewardsArray = json_decode($workout->rewards);

                                                        ?>
                                                        Lean - {{ $rewardsArray->lean }}, Athletic - {{$rewardsArray->athletic}}, Strength - {{$rewardsArray->strength}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Duration</td>
                                                    <td>
                                                        {{ $workout->duration }} Seconds
                                                    </td>
                                                </tr>                                                

                                                <tr>
                                                    <td>Equipments</td>
                                                    <td>
                                                        {{ $workout->equipments }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
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
                                                    <th width='70%'>Exercices</th>
                                                    <th>Value</th>
                                                    </thead>
                                                    @foreach($workoutExercise as $wKey => $exercise)
                                                    <tr>
                                                        <td><a href="{{ route('admin.exercise.show', $exercise->exercise_id) }}">{{$exercise['exercise']->name}}</a></td>
                                                        <td>
                                                            @if($exercise->unit == 'times')
                                                                {{$exercise->repititions}} Repetitions
                                                            @else
                                                                {{$exercise->repititions}} Seconds
                                                            @endif
                                                           
                                                        </td>
                                                    </tr>
                                                    @endforeach 
                                                </table>
                                            </div>
                                        </div>
                                        @endforeach

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
                                                    <th width='70%'>Exercices</th>
                                                    <th>Value</th>
                                                    </thead>
                                                    @foreach($workoutExercise as $wKey => $exercise)
                                                    <tr>
                                                        <td><a href="{{ route('admin.exercise.show', $exercise->exercise_id) }}">{{$exercise['exercise']->name}}</a></td>
                                                        <td>
                                                            @if($exercise->unit == 'times')
                                                                {{$exercise->repititions}} Repetitions
                                                            @else
                                                                {{$exercise->repititions}} Seconds
                                                            @endif
                                                           
                                                        </td>
                                                    </tr>
                                                    @endforeach 
                                                </table>
                                            </div>
                                        </div>
                                        @endforeach
                                        
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
                                                    <th width='70%'>Exercices</th>
                                                    <th>Value</th>
                                                    </thead>
                                                    @foreach($workoutExercise as $wKey => $exercise)
                                                    <tr>
                                                        <td><a href="{{ route('admin.exercise.show', $exercise->exercise_id) }}">{{$exercise['exercise']->name}}</a></td>
                                                        <td>
                                                            @if($exercise->unit == 'times')
                                                                {{$exercise->repititions}} Repetitions
                                                            @else
                                                                {{$exercise->repititions}} Seconds
                                                            @endif                                                           
                                                        </td>
                                                    </tr>
                                                    @endforeach 
                                                </table>
                                            </div>
                                        </div>
                                        @endforeach                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- Bootstrap WYSIHTML5 -->
<script  src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="http://vjs.zencdn.net/ie8/1.1.0/videojs-ie8.min.js"></script>
<script src="http://vjs.zencdn.net/5.0.2/video.js"></script>
@stop