@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
View Media - {{ $media->name }}
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
    <h1>View Media : {{ $media->name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.medias') }}">Media</a></li>
        <li class="active">{{ $media->name }}</li>
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
                                                        {{ $media->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td>
                                                        {{ $media->description }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Media</td>
                                                    <td>
                                                        <img width="100%" src="{{asset('uploads/images/media/original/'.$media->path)}}" alt="{{ $media->name }}" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Large Url</td>
                                                    <td>
                                                        {{asset('uploads/images/media/large/'.$media->path)}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Medium Url</td>
                                                    <td>
                                                        {{asset('uploads/images/media/medium/'.$media->path)}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Small Url</td>
                                                    <td>
                                                        {{asset('uploads/images/media/small/'.$media->path)}}
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