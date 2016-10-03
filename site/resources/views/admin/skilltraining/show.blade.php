@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
View Skilltraining - {{ $skilltraining->name }}
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
    <h1>View Skilltraining : {{ $skilltraining->name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.skilltrainings') }}">Skilltrainings</a></li>
        <li class="active">{{ $skilltraining->name }}</li>
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
                                    <div class="table-responsive">
                                        <form method="post" action="#">
                                            <table class="table table-bordered table-striped" id="skilltrainings">
                                                <thead>
                                                <th width='20%'>Field</th>
                                                <th>Value</th>
                                                </thead>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>
                                                        {{ $skilltraining->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td>
                                                        {{ $skilltraining->description }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rewards</td>
                                                    <td><?php
                                                        $rewardsArray = json_decode($skilltraining->rewards);

                                                        ?>
                                                        Strength Endurance - {{ $rewardsArray->lean }}, Speed Strength - {{$rewardsArray->athletic}}, Absolute Strength - {{$rewardsArray->strength}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Equipments</td>
                                                    <td>
                                                        {{ $skilltraining->equipments }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Is Circuit?</td>
                                                    <td>
                                                        @if($skilltraining->is_circuit == 1)
                                                        Yes
                                                        @else
                                                        No
                                                        @endif
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
                                        <div class="col-sm-6">                                                            
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped" id="users">
                                                    <thead>
                                                    <th width='35%'>Name</th>
                                                    <th width='35%'>Reps</th>
                                                    <th width='30%'>Sets</th>                                                    
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
                                                        </tr>                                                                    
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
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
                                                    <th width='35%'>Name</th>
                                                    <th width='35%'>Reps</th>
                                                    <th width='30%'>Sets</th>                                                    
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
                                                        </tr>                                                                    
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
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
                                                    <th width='35%'>Name</th>
                                                    <th width='35%'>Reps</th>
                                                    <th width='30%'>Sets</th>                                                    
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
                                                        </tr>                                                                    
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

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