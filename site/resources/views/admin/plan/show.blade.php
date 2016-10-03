@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
View Plan - {{ $plan->name }}
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
    <h1>View Plan : {{ $plan->name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.plans') }}">Plans</a></li>
        <li class="active">{{ $plan->name }}</li>
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
                                                        {{ $plan->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Amount</td>
                                                    <td>
                                                        {{ $plan->amount }}
                                                    </td>
                                                </tr>                                                
                                                <tr>
                                                    <td>Currency</td>
                                                    <td>{{$currencyCodes[$plan->currency]}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Duration</td>
                                                    <td>
                                                        {{ $plan->duration }} Months
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>App Purchase Id</td>
                                                    <td>
                                                        {{ $plan->inapp_id }}
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