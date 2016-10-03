@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
View Skill - {{ $skill['exercise']->name }}
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
    <h1>View Skill : {{ $skill['exercise']->name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.skills') }}">Skills</a></li>
        <li class="active">{{ $skill['exercise']->name }}</li>
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
                <li><a href="#tab2" data-toggle="tab"> 
                        Media
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
                                                    <td>Progression</td>
                                                    <td>
                                                        {{ $skill['progression']->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>
                                                        {{ $skill['exercise']->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td>
                                                        {{ $skill->description }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">@if($skill->is_allies == 1) Allies Skill @else Standard Skill @endif</td>
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
                                    @if(count($skill['exercise']['video']))
                                    <video id="skill_video" class="video-js vjs-default-skin" controls
                                           preload="none" width="920" height="560" poster="{{{ url('/').'/uploads/videos/'.$skill['exercise']['video'][0]['videothumbnail'] }}}"
                                           data-setup='{}'>
                                        <source src="{{{ url('/').'/uploads/videos/'.$skill['exercise']['video'][0]['path'] }}}" type='video/mp4'>                                        
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