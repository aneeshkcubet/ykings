@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit Hiit - {{  $hiit->name }}
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
    <h1>Edit Hiit - {{{  $hiit->name }}}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.hiits') }}">Hiit</a></li>
        <li class="active">Edit: {{{  $hiit->name }}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        {{{  $hiit->name }}} 
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
                            <form class="form-wizard form-horizontal" action="{{ route('admin.hiit.postedit', $hiit->id) }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <!-- first tab -->
                                <h1>Hiit</h1>

                                <section>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name*</label>
                                        <div class="col-sm-10">
                                            <input id="name" name="name" type="text" placeholder="Name" class="form-control required" value="{{{ Input::old('name',$hiit->name) }}}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <input id="description" name="description" type="text" placeholder="Description" class="form-control" value="{{{ Input::old('description',$hiit->description) }}}" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="rewards" class="col-sm-2 control-label">Rewards *</label>
                                        <div class="col-sm-10">
                                            <input id="rewards" name="rewards" type="text" placeholder="Rewards" class="form-control required number" value="{{{  Input::old('rewards', $hiit->rewards) }}}" />
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