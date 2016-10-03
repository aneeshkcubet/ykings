@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
View Exercise - {{ $exercise->name }}
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
    <h1>View Exercise : {{ $exercise->name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.exercises') }}">Exercises</a></li>
        <li class="active">{{ $exercise->name }}</li>
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
                        Media
                    </a>
                </li>
                <li>
                    <a href="#tab3" data-toggle="tab"> 
                        Additional Details
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
                                                        {{ $exercise->name }}
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td>
                                                        {{ $exercise->description }}
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Category</td>
                                                    <td>
                                                        @if($exercise->category == 1)
                                                        Lean
                                                        @elseif($exercise->category == 2)
                                                        Athletic
                                                        @else
                                                        Strength
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Type
                                                    </td>
                                                    <td>
                                                        @if($exercise->type == 1)
                                                        Free
                                                        @elseif($exercise->type == 2)
                                                        Paid
                                                        @else
                                                        @endif

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rewards</td>
                                                    <td>
                                                        {{ $exercise->rewards }}

                                                    </td>
                                                </tr>                                             
                                                <tr>
                                                    <td>Unit</td>
                                                    <td>
                                                        {{ $exercise->unit }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Equipment</td>
                                                    <td>
                                                        {{ $exercise->equipment }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Muscle Groups</td>
                                                    <td>
                                                        {{ $exercise->musclegroup_string }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Static</td>
                                                    <td>
                                                        @if($exercise->is_static == 1)
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
                                <div class="panel-body" style="text-align: center">
                                    @if(isset($exercise['video'][0]))
                                    <video id="exercise_video" class="video-js vjs-default-skin" controls
                                           preload="none" width="920" height="560" poster="{{{ url('/').'/uploads/videos/'.$exercise['video'][0]['videothumbnail'] }}}"
                                           data-setup='{}'>
                                        <source src="{{{ url('/').'/uploads/videos/'.$exercise['video'][0]['path'] }}}" type='video/mp4'>                                        
                                        <p class="vjs-no-js">
                                            To view this video please enable JavaScript, and consider upgrading to a web browser
                                            that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                        </p>
                                    </video>
                                    @endif
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
                                    <div class="table-responsive">
                                        <form method="post" action="#">
                                            <table class="table table-bordered table-striped" id="users">
                                                <thead>
                                                <th width='20%'>Field</th>
                                                <th>Value</th>
                                                </thead>

                                                <tr>
                                                    <td>Range of Motion</td>
                                                    <td>
                                                        {!! $exercise->range_of_motion_html !!}
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Pro Tips</td>
                                                    <td>
                                                        {!! $exercise->pro_tips_html !!}
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