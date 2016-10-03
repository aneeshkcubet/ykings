@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Add New Warmup
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
    <h1>Add New Warmup</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.warmups') }}">Warmups</a></li>
        <li class="active">Add New Warmup</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="warmups" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        Add New Warmup
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
                            <form class="form-wizard form-horizontal" action="{{ route('admin.warmup.postcreate') }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <!-- first tab -->
                                <h1>Basic Details</h1>

                                <section>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name*</label>
                                        <div class="col-sm-10">
                                            <input id="name" name="name" type="text" placeholder="Name" class="form-control required" value="{{{ Input::old('name') }}}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Repitition / Duration *</label>
                                        <div class="col-sm-5" style="text-align: center">
                                            <strong>Beginner</strong>
                                        </div>
                                        <div class="col-sm-5" style="text-align: center">
                                            <strong>Advanced</strong>
                                                
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="minimum" name="duration[1][min]" value="{{Input::old('duration[1][min]')}}" class="form-control required number" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="maximum" name="duration[1][max]" value="{{Input::old('duration[1][max]')}}" class="form-control number" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="minimum" name="duration[2][min]" value="{{Input::old('duration[2][min]')}}" class="form-control required number" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="maximum" name="duration[2][max]" value="{{Input::old('duration[2][max]')}}" class="form-control number" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="unit" class="col-sm-2 control-label">Unit *</label>
                                        <div class="col-sm-3">
                                            <select id="unit" name="unit" class="form-control required">
                                                <option value="">Select unit</option>
                                                <option value="times" @if(Input::old('type') == "times") selected="selected" @endif>Repetitions</option>
                                                <option value="seconds" @if(Input::old('type') == "seconds") selected="selected" @endif>Seconds</option>                                                
                                            </select>                                            
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